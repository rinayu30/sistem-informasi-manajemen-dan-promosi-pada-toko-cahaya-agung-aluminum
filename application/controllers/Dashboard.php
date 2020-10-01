<?php
//untuk website

use phpDocumentor\Reflection\Types\False_;

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_not_login();
        // cek_admin();
        $this->load->model(['produk_model', 'kategori_model', 'penjualan_model']);
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('user/template/header');
        $this->load->view('dashboard');
        // $this->load->view('user/template/sidebar');
        $this->load->view('user/template/footer');
    }

    public function kontak()
    {
        $this->load->view('user/template/header');
        $this->load->view('user/kontak');
        $this->load->view('user/template/footer');
    }

    public function produk()
    {
        $data['row'] = $this->produk_model->get();
        $data['categories'] = $this->produk_model->get_kategori();
        $this->load->view('user/template/header');
        $this->load->view('user/produk/data_produk', $data);
        $this->load->view('user/template/footer');
    }
    public function detail($id)
    {
        $data['row'] = $this->produk_model->get($id);
        $this->load->view('user/template/header');
        $this->load->view('user/produk/detail', $data);
        $this->load->view('user/template/footer');
    }

    public function tambah_keranjang($id)
    {
        check_not_login();
        $produk = $this->produk_model->find($id);
        $data = array(
            'id'      => $produk->kd_produk,
            'gbr'      => $produk->gambar,
            'qty'     => 1,
            'price'   =>  $produk->harga_jual, //atur nnti sepertidiatas
            'name'    =>  $produk->nama_produk,
        );

        $this->cart->insert($data);
        redirect('home/produk');
        // $this->load->view('user/templates/header');
        // $this->load->view('user/produk/data_produk', $produk);
        // $this->load->view('user/templates/footer');
    }
    public function detail_keranjang()
    {
        // check_not_login();
        $this->load->view('user/template/header');
        $this->load->view('user/keranjang');
        $this->load->view('user/template/footer');
    }
    public function hapus_keranjang()
    {
        // check_not_login();
        $this->cart->destroy();
        redirect('dashboard/produk');
    }
    public function pembayaran()
    {
        // check_not_login();
        $this->load->view('user/template/header');
        $this->load->view('user/pembayaran');
        $this->load->view('user/template/footer');
    }

    public function getIdentitas()
    {
        $user =  $this->fungsi->user_login();
        $id = $user->id_user;
        $this->db->from('pembeli');
        if ($id != null) {
            $this->db->where('id_user', $id);
        }
        $query = $this->db->get()->result();
        // return var_dump($id);
        return $query;
    }

    public function profil()
    {
        // check_not_login();
        $showEdit = $this->input->get('show_edit');
        $data = [
            'showEdit' => false,
            'row' => $this->getIdentitas(),
        ];
        if (isset($showEdit)) $data['showEdit'] = true;
        $this->load->view('user/template/header');
        $this->load->view('user/profil', $data);
        $this->load->view('user/template/footer');
    }
    public function proses_pesanan()
    {
        check_not_login();
        $cartData = $this->cart->contents();
        if (count($cartData) <= 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Maaf, Anda belum menambahkan produk apapun, silahkan pilih produk terlebih dahulu!
                <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
            return redirect('home/pemesanan');
        }
        $mData = [];
        // return var_dump($cartData);
        foreach ($cartData as $key => $value) {
            $data1 = array(
                'kd_produk' => $value['id'],
                'jumlah' => $value['qty'],
                // 'harga_jual' => $value['price'],
                // 'subtotal' => $value['subtotal']
            );
            $mData[] = $data1;
            $this->penjualan_model->add_ol($data1);
        }

        // return var_dump($cartData);

        $user =  $this->fungsi->user_login();

        if ($user->level != '3') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Login terlebih dahulu sebagai user website !
                <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
            return redirect('home/pemesanan');
        }

        $userId = $user->id_user;

        $id_pembeli    =  $this->db->query("SELECT id_pembeli FROM pembeli WHERE id_user='$userId'")->row();
        $id_pembeli = $id_pembeli->id_pembeli;
        $alamat = $this->input->post('alamat');
        $alamat = $this->db->query("SELECT alamat FROM pembeli WHERE id_user='$userId'")->row();
        $alamat = $alamat->alamat;

        if (empty($alamat)) {
            $ala = $alamat;
        } else {
            $ala = $alamat;
        }
        // return $ala;
        // return var_dump($ala);
        $id = $this->penjualan_model->buat_kode_penjualan();
        $bayar = $this->penjualan_model->get_bayar($id);

        $tgl_penjualan    =  date('Y-m-d');
        $data = array(
            'kd_penjualan' => $id,
            'id_pembeli' => $id_pembeli,
            'id_user' => $userId,
            'tot_bayar' => $bayar,
            'dp_awal' => null,
            'sisa' => null,
            'tgl_penjualan' => $tgl_penjualan,
            'alamat_kirim' => $ala,
            'status_jual' => '0',
        );
        // return var_dump($data);
        $this->penjualan_model->selesai_hitung_ol($data);
        $this->cart->destroy();
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pesanan berhasil, Admin kami akan segera menghubungi Anda.
        <button type="button" class="close" data-dismiss="alert" arial-label="Close">
        <span aria-hidden="true">&times;</span></button></div>');
        return redirect('home/pemesanan');
    }

    public function proses_identitas()
    {
        check_not_login();
        // $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('notel', 'Nomor WA/HP', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        $this->form_validation->set_message('required', '%s harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $showEdit = $this->input->get('show_edit');
            $data = [
                'showEdit' => false,
            ];
            if (isset($showEdit)) $data['showEdit'] = true;
            $this->load->view('user/template/header');
            $this->load->view('user/profil', $data);
            $this->load->view('user/template/footer');
        } else {
            $data = [
                'nama_pembeli' => $this->input->post('nama', true),
                'jk' => $this->input->post('jk', true),
                'no_telp' => $this->input->post('notel', true),
                'alamat' => $this->input->post('alamat', true),
                'created' => date('Y-m-d H:i:s'),
            ];
            $id = $this->session->userdata('userid');
            // return var_dump($id);
            $this->db->where('pembeli.id_user', $id)->update('pembeli', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data pengguna berhasil diubah
                <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
            redirect('home/produk');
        }
    }

    public function login_user()
    {
        // check_not_login();
        $this->load->view('user/template/header');
        $this->load->view('user/auth/login');
        $this->load->view('user/template/footer');
    }
    public function register()
    {
        // check_not_login();
        $this->load->view('user/template/header');
        $this->load->view('user/auth/register');
        $this->load->view('user/template/footer');
    }

    public function kategori($id)
    {
        $data['row'] = $this->produk_model->get_($id);
        $data['categories'] = $this->produk_model->get_kategori();
        $this->load->view('user/template/header');
        $this->load->view('user/produk/data_produk', $data);
        $this->load->view('user/template/footer');
    }
}
