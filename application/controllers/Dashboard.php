<?php
class Dashboard extends CI_Controller
{
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
}
    //untuk website