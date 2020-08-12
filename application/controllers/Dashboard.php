<?php
//untuk website
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
}
