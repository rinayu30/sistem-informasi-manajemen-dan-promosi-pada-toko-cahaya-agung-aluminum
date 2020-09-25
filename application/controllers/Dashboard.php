<?php
//untuk website
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_not_login();
        // cek_admin();
        // check_not_login();
        $this->load->model(['produk_model', 'kategori_model']);
        // $this->load->library('form_validation');
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
        // $this->load->view('user/templates/sidebar');
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
        // $this->load->view('user/template/sidebar');
        $this->load->view('user/produk/detail', $data);
        $this->load->view('user/template/footer');
    }

    public function tambah_keranjang($id)
    {
        // check_not_login();
        // cek_pengunjung();
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
        // $this->load->view('user/template/sidebar');
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
        // $this->load->view('user/templates/sidebar');
        $this->load->view('user/pembayaran');
        $this->load->view('user/template/footer');
    }
    public function profil()
    {
        // check_not_login();
        $this->load->view('user/template/header');
        // $this->load->view('user/templates/sidebar');
        $this->load->view('user/profil');
        $this->load->view('user/template/footer');
    }
    public function proses_pesanan()
    {
        // check_not_login();
        $is_processed = $this->penjualanonline_model->pesan_produk();
        if ($is_processed) {
            $this->cart->destroy();
            $this->load->view('user/template/header');
            $this->load->view('user/proses_pesanan');
            $this->load->view('user/template/footer');
        } else {
            echo "<alert>Maaf, Pesanan Anda Gagal Diproses !</alert>";
        }
    }

    public function login_user()
    {
        // check_not_login();
        $this->load->view('user/template/header');
        // $this->load->view('user/templates/sidebar');
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
