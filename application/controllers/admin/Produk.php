<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['produk_model', 'kategori_model']);
        // $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->produk_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/produk/daftar_produk', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {
        $produk = new stdClass();
        //field sesuai dengan database
        $produk->kd_produk = $this->produk_model->buat_kode();
        $produk->nama_produk = null;
        $produk->gambar = null;
        $produk->stok = null;
        $produk->detail = null;

        $query_kategori = $this->kategori_model->get();
        $kategori[null] = '--Pilih--';
        foreach ($query_kategori->result() as $kat) {
            $kategori[$kat->id_kategori] = $kat->nama_kategori;
        }
        $data = array(
            'page' => 'tambah',
            'row' => $produk,
            'kategori' => $kategori, 'selectedkategori' => null,
        );
        $this->load->view('admin/produk/produk_form', $data);
    }

    public function edit($id)
    {
        $query = $this->produk_model->get($id);
        if ($query->num_rows() > 0) {

            $produk = $query->row();
            $query_kategori = $this->kategori_model->get();
            $kategori[null] = '--Pilih--';
            foreach ($query_kategori->result() as $kat) {
                $kategori[$kat->id_kategori] = $kat->nama_kategori;
            }
            $data = array(
                'page' => 'edit',
                'row' => $produk,
                'kategori' => $kategori, 'selectedkategori' =>  $produk->id_kategori,
            );
            $this->load->view("admin/produk/produk_form", $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            echo "window.location='" . site_url('admin/produk') . "';</script>";
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->produk_model->add($post);
        } else if (isset($_POST['edit'])) {

            $produk = $this->produk_model->get($post['kode'])->row();
            if ($produk->gambar != null) {
                $this->produk_model->_deleteImage($post['gambar']);
            }
            $post['gambar'] = $this->produk_model->_uploadImage();

            $this->produk_model->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/produk');
    }

    public function detail($id)
    {
        $result = $this->db->where('kd_produk', $id)->get('produk');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
        return $this->db->delete($this->_table, array("kd_produk" => $id));
    }

    public function delete($id)
    {
        $this->produk_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/produk');
    }
}
