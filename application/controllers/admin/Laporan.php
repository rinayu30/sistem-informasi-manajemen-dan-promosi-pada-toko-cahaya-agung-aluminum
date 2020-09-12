<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['penjualan_model', 'bahan_masuk_model', 'auth_model', 'produk_model', 'item_model', 'jenis_model']);
        $this->load->library('form_validation');
    }

    public function cetak_penjualan_periode()
    {
    }
}
