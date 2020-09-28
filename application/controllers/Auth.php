<?php

use phpDocumentor\Reflection\Types\Object_;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_not_login();
        // $this->load->model(['produk_model', 'kategori_model', 'bahan_perabot_model', 'kalkulasi_model']);
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('auth_model');
    }
    public function login()
    {
        check_already_login();
        $this->load->view('login');
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('auth_model');
            // $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            // $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
            // $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
            // $this->output->set_header("Pragma: no-cache");
            $query = $this->auth_model->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'userid' => $row->id_user,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                if ($this->session->userdata("level") == "1") {
                    redirect('admin/dashboard/');
                } elseif ($this->session->userdata("level") == "2") {
                    redirect('admin/dashboard/');
                } else {
                    redirect('home');
                }
            } else {

                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username atau password Anda Salah!
                <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
                redirect('auth/login');
            }
        }
    }

    public function logout()
    {
        // $params = array('userid', 'level');
        // $this->session->unset_userdata($params);

        $userdata = (object) $this->session->userdata();
        // $this->cart->destroy();

        $redirect = $userdata->level == 3 ? '/home/login' : '/auth/login';

        $this->auth_model->logout();
        redirect(base_url($redirect));
    }

    public function proses_register()
    {
        // check_not_login();
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[pass]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');

        $this->form_validation->set_message('required', '%s harus diisi');
        $this->form_validation->set_message('matches', '%s tidak cocok');
        $this->form_validation->set_message('is_unique', '%s sudah ada, silahkan ganti');
        $this->form_validation->set_message('min_length', '%s minimal 6 karakter');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/template/header');
            $this->load->view('user/auth/register');
            $this->load->view('user/template/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true));
            $data = [
                'nama_user' =>  $nama,
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => sha1($this->input->post('passconf')),
                'level' => '3',
                'created' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('user', $data);

            // $data1 = [
            //     'id_user' => $this->session->userdata()['id_user'],
            //     'nama_pembeli' => $nama,
            // ];
            // return var_dump($data1);
            // $this->db->insert('pembeli', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Daftar akun berhasil, silahkan login</div>');
            redirect('home/login');
        }
    }
    public function proses_login()
    {
        // check_not_login();
        $this->form_validation->set_rules('pass', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_message('required', '%s harus diisi');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/template/header');
            $this->load->view('user/auth/login');
            $this->load->view('user/template/footer');
        } else {
            $post = $this->input->post(null, TRUE);
            if (isset($post['submit'])) {
                $this->load->model('auth_model');
                $query = $this->auth_model->login_web($post);
                // print_r($this->session->userdata);
                // return;
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $params = array(
                        'userid' => $row->id_user,
                        'level' => $row->level
                    );
                    $this->session->set_userdata($params);
                    redirect('home/produk');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username atau password Anda Salah!
                    <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>');
                    redirect('home/login');
                }
            }
        }
    }

    // private function _login()
    // {
    //     $email = $this->input->post('email');
    //     $pass = $this->input->post('pass');
    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();
    // }
}
