<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_perabot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        cek_pengunjung();
        cek_admin();
        $this->load->model(['bahan_perabot_model', 'item_model', 'jenis_model', 'kalkulasi_model']);
        $this->load->library('form_validation');
    }


    function get_item()
    {
        $id = $this->input->post('id');
        $data = $this->bahan_perabot_model->get_item($id);
        echo json_encode($data);
    }

    public function tambah_bahan()
    {
        $bahan = new stdClass();
        $bahan->id_bahan = null;
        $bahan->id_kalkulasi = $this->bahan_perabot_model->kode_kalkulasi();
        $bahan->id_item = null;
        $bahan->banyak = null;
        $bahan->id_item = null;
        $bahan->ukuran = null;
        $bahan->uk_panjang = null;
        $bahan->uk_lebar = null;
        $bahan->jumlah = null;
        $bahan->harga_satuan = null;
        $bahan->jumlah_harga = $this->bahan_perabot_model->get_subharga();
        $data['row'] =  $bahan;
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_data', $data);
    }


    public function proses_bahan()
    {
        $post = $this->input->post(null, TRUE);
        $this->bahan_perabot_model->tambah_bahan($post);
        $pos = $this->bahan_perabot_model->get_jumlah();
        $this->item_model->update_kurang_stok($post, $pos);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/kalkulasi');
    }

    public function delete($id)
    {
        $this->bahan_perabot_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/bahan_perabot');
    }
}
