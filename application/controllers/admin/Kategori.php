<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        cek_pengunjung();
        cek_admin();
        $this->load->model('kategori_model');
        // $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->kategori_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/produk/kategori/kategori_data', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {
        $kategori = new stdClass();
        $kategori->id_kategori = null; //field sesuai dengan database
        $kategori->nama_kategori = null;
        $data = array(
            'page' => 'tambah',
            'row' => $kategori
        );
        $this->load->view('admin/produk/kategori/kategori_form', $data);
    }

    public function edit($id)
    {
        $query = $this->kategori_model->get($id);
        if ($query->num_rows() > 0) {
            $kategori = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $kategori
            );
            $this->load->view("admin/produk/kategori/kategori_form", $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            redirect('admin/kategori');
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->kategori_model->add($post);
        } else if (isset($_POST['edit'])) {
            $this->kategori_model->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/kategori');
    }

    public function delete($id)
    {
        $this->kategori_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/kategori');
    }
}
