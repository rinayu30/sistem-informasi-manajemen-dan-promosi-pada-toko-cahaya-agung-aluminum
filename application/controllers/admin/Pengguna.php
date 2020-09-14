<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        check_not_login();
        cek_admin();
        //$this->load->model('pengguna_m');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->auth_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/pengguna/pengguna_data', $data);
        $this->load->view('templates_adm/footer');
        // $this->template->load('template_adm/template', 'admin/pengguna/pengguna_data', $data);

    }

    public function add()
    {

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|is_unique[user.username]');
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'required|matches[pass]');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s harus diisi');
        $this->form_validation->set_message('matches', '%s tidak cocok');
        $this->form_validation->set_message('is_unique', '%s sudah ada, silahkan ganti');
        $this->form_validation->set_message('min_length', '%s minimal 6 karakter');

        $this->form_validation->set_error_delimiters('<h6><span class="alert alert-danger">', '</span></h6>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/pengguna/form_user');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->auth_model->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Data berhasil disimpan');
            }
            echo "<script>window.location='" . site_url('admin/pengguna') . "';</script>";
        }
    }

    public function delete()
    {
        $id = $this->input->post('id_user');
        $this->auth_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location='" . site_url('admin/pengguna') . "';</script>";
    }

    public function edit($id)
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|callback_nama_cek');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_username_cek');
        if ($this->input->post('pass')) {
            $this->form_validation->set_rules('pass', 'Password', 'min_length[6]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'matches[pass]');
        }
        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'matches[pass]');
        }
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s harus diisi');
        $this->form_validation->set_message('matches', '%s tidak cocok');
        $this->form_validation->set_message('is_unique', '%s sudah ada, silahkan ganti');
        $this->form_validation->set_message('min_length', '%s minimal 6 karakter');

        $this->form_validation->set_error_delimiters('<h6><span class="alert alert-danger">', '</span></h6>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->auth_model->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->load->view('admin/pengguna/form_edit_user', $data);
            } else {
                echo "<script>alert('Data tidak dapat ditemukan');";
                echo "window.location='" . site_url('admin/pengguna') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->auth_model->edit($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil diubah');</script>";
            }
            echo "<script>window.location='" . site_url('admin/pengguna') . "';</script>";
        }
    }

    function username_cek()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username ='$post[username]' AND id_user != '$post[id_user]'");

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_cek', '%s ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function nama_cek()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE nama_user ='$post[nama]' AND id_user != '$post[id_user]'");

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('nama_cek', '%s ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
