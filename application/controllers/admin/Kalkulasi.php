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


    function get_item()
    {
        $id = $this->input->post('id');
        $data = $this->kalkulasi_model->get_item($id);
        echo json_encode($data);
    }

    public function index()
    {

        // $data['row'] = $this->kalkulasi_model->get();
        $data['kd_produk'] = $this->produk_model->get();
        // $data['id_item'] = $this->item_model->get_item_byjenis('id_jenis');
        $data['data'] = $this->kalkulasi_model->get_jenisbahan();

        if (isset($_POST['submit'])) {
        }
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_data', $data);
        $this->load->view('templates_adm/footer');
    }
    public function tambah_bahan()
    {
        $post = $this->input->post(null, TRUE);
        $data['row'] =  $this->kalkulasi_model->tambah_bahan($post);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_data', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {

        $kalkulasi = new stdClass();
        $kalkulasi->id_kalkulasi = null; //field sesuai dengan database

        $query_item = $this->item_model->get();
        $item[null] = '--Pilih--';
        foreach ($query_item->result() as $itm) {
            $item[$itm->id_item] = $itm->nama_item;
        }
        $data = array(
            'page' => 'tambah',
            'row' => $kalkulasi,
            'item' => $item, 'selecteditem' => null,
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

    public function proses_bahan()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->kalkulasi_model->add_bahan($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/kalkulasi');
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
