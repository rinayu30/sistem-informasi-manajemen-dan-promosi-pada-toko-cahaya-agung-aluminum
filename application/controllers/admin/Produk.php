<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['produk_model', 'kategori_model', 'bahan_perabot_model', 'kalkulasi_model']);
        // $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->produk_model->get_produkb();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/produk/daftar_produk', $data);
        $this->load->view('templates_adm/footer');
    }
    // public function add_harga()
    // {
    //     $this->load->view('templates_adm/header');
    //     $this->load->view('templates_adm/sidebar');
    //     $this->load->view('admin/bahan/kalkulasi/kalkulasi_data');
    //     $this->load->view('templates_adm/footer');
    // }
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
        // $data['harga_modal'] = $this->bahan_perabot_model->get_subtotal($id);
        // $hrg = $this->produk_model->getHarga($id);
        // if ($hrg == TRUE) {
        //     $data = array(
        //         'harga' => $this->produk_model->getHarga($id),
        //         'row' => $this->produk_model->get($id),
        //         // 'row' => $this->produk_model->get_produkb($id),

        //     );
        // } else {
        //     $data['row'] = $this->produk_model->get_produkb($id);
        // }
        $data = array(
            'harga' => $this->produk_model->getHarga($id),
            'row' => $this->produk_model->get($id),
            // 'row' => $this->produk_model->get_produkb($id),
        );
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/produk/detail', $data);
        $this->load->view('templates_adm/footer');
    }

    public function delete($id)
    {
        $this->produk_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/produk');
    }
    //untuk website
    public function getProduk()
    {
        return $this->db->get('produk');
    }
}
