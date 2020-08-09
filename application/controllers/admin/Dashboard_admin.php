<?php
//untuk admin dan karyawan
class Dashboard_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
    }

    public function index(){
       
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates_adm/footer');
       
    }
}