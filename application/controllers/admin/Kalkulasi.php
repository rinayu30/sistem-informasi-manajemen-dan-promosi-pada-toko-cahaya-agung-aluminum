<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kalkulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['kalkulasi_model', 'produk_model', 'item_model', 'jenis_model']);
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->kalkulasi_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_data', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {

        $kalkulasi = new stdClass();
        $kalkulasi->id_kalkulasi = null; //field sesuai dengan database

        $query_jenis = $this->jenis_model->get();
        $jenis[null] = '--Pilih--';
        foreach ($query_jenis->result() as $jns) {
            $jenis[$jns->id_jenis] = $jns->nama_jenis;
        }
        $data = array(
            'page' => 'tambah',
            'row' => $kalkulasi,
            'jenis' => $jenis, 'selectedjenis' => null,
        );
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_data', $data);
    }


    public function edit($id)
    {
        $query = $this->kalkulasi_model->get($id);
        if ($query->num_rows() > 0) {
            $kalkulasi = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $kalkulasi,
                // 'kode' =>$kode,'selectedkode'=>$kode->kd_produk,
            );
            $this->load->view("admin/kalkulasi/kalkulasi_data", $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            echo "window.location='" . site_url('admin/kalkulasi') . "';</script>";
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->kalkulasi_model->add($post);
        } else if (isset($_POST['edit'])) {
            $this->kalkulasi_model->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/kalkulasi');
    }

    public function delete($id)
    {
        $this->kalkulasi_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/kalkulasi');
    }
}
