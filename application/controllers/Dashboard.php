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
        $this->load->view('user/templates/header');
        $this->load->view('dashboard');
        $this->load->view('user/templates/footer');
        // $this->load->view('user/templates/sidebar');
    }

    public function kontak()
    {
        $this->load->view('user/templates/header');
        $this->load->view('user/kontak');
        $this->load->view('user/templates/footer');
        // $this->load->view('user/templates/sidebar');
    }

    public function produk()
    {
        $data['row'] = $this->produk_model->get();
        $this->load->view('user/templates/header');
        $this->load->view('user/produk/data_produk', $data);
        $this->load->view('user/templates/footer');
    }
    public function detail($id)
    {
        $data['row'] = $this->produk_model->get($id);
        $this->load->view('user/templates/header');
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/produk/detail', $data);
        $this->load->view('user/templates/footer');
    }

    public function tambah_keranjang($id)
    {
        $produk = $this->produk_model->find($id);
        $data = array(
            'id'      => $produk->kd_produk,
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
        $this->load->view('user/templates/header');
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/keranjang');
        $this->load->view('user/templates/footer');
    }
    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('dashboard/produk');
    }
    public function pembayaran()
    {
        $this->load->view('user/templates/header');
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/pembayaran');
        $this->load->view('user/templates/footer');
    }
}
