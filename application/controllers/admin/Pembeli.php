<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pembeli extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('pembeli_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->pembeli_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/pembeli/daftar_pembeli', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama pembeli', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_message('required', '%s harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $pembeli = new stdClass();
            $pembeli->id_pembeli = null; //field sesuai dengan database
            $pembeli->nama_pembeli = null;
            $pembeli->jk = null;
            $pembeli->no_telp = null;
            $pembeli->alamat = null;

            $data = array(
                'page' => 'tambah',
                'row' => $pembeli
            );
            $this->load->view('admin/pembeli/pembeli_form', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $this->pembeli_model->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', ' Data berhasil disimpan');
            }
            echo "<script>window.location='" . site_url('admin/pembeli') . "';</script>";
        }
    }

    public function edit($id)
    {
        $query = $this->pembeli_model->get($id);
        if ($query->num_rows() > 0) {
            $pembeli = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $pembeli
            );
            $this->load->view("admin/pembeli/pembeli_form", $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            echo "window.location='" . site_url('admin/pembeli') . "';</script>";
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->pembeli_model->add($post);
        } else if (isset($_POST['edit'])) {
            $this->pembeli_model->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/pembeli');
    }

    public function delete($id)
    {
        $this->pembeli_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/pembeli');
    }
}
