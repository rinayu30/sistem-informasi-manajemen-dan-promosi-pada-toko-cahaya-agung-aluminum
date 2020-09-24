
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penjualanonline_model');
        // $this->load->library('form_validation');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['pesan'] = $this->penjualanonline_model->tampil_data();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/daftar_penjualan', $data);
        $this->load->view('templates_adm/footer');
    }
    public function pesan_produk()
    {
        $data['pesan'] = $this->penjualan_model->tampil_pesanan();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/daftar_penjualan', $data);
        $this->load->view('templates_adm/footer');
    }
}
//END halaman website 