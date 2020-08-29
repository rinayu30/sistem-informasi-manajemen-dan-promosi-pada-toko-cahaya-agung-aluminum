<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_perabot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['bahan_perabot_model', 'item_model', 'jenis_model', 'kalkulasi_model']);
        $this->load->library('form_validation');
    }


    function get_item()
    {
        $id = $this->input->post('id');
        $data = $this->bahan_perabot_model->get_item($id);
        echo json_encode($data);
    }

    // public function index()
    // {

    //     // $data['row'] = $this->bahan_perabot_model->get();
    //     $data['kd_produk'] = $this->produk_model->get();
    //     // $data['id_item'] = $this->item_model->get_item_byjenis('id_jenis');
    //     $data['data'] = $this->bahan_perabot_model->get_jenisbahan();
    //     $data['id_bahan'] =  $this->bahan_perabot_model->add_bahan();

    //     // if (isset($_POST['submit'])) {
    //     // }
    //     $this->load->view('templates_adm/header');
    //     $this->load->view('templates_adm/sidebar');
    //     $this->load->view('admin/bahan/bahan_perabot/bahan_perabot_data', $data);
    //     $this->load->view('templates_adm/footer');
    // }
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

    public function add()
    {

        $bahan_perabot = new stdClass();
        $bahan_perabot->id_bahan_perabot = null; //field sesuai dengan database

        $query_item = $this->item_model->get();
        $item[null] = '--Pilih--';
        foreach ($query_item->result() as $itm) {
            $item[$itm->id_item] = $itm->nama_item;
        }
        $data = array(
            'page' => 'tambah',
            'row' => $bahan_perabot,
            'item' => $item, 'selecteditem' => null,
        );
        $this->load->view('admin/bahan/bahan_perabot/bahan_perabot_data', $data);
    }


    public function edit($id)
    {
        $query = $this->bahan_perabot_model->get($id);
        if ($query->num_rows() > 0) {
            $bahan_perabot = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $bahan_perabot,
                // 'kode' =>$kode,'selectedkode'=>$kode->kd_produk,
            );
            $this->load->view("admin/bahan_perabot/bahan_perabot_data", $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            echo "window.location='" . site_url('admin/bahan_perabot') . "';</script>";
        }
    }

    public function proses_bahan()
    {

        $post = $this->input->post(null, TRUE);
        $this->bahan_perabot_model->tambah_bahan($post);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/kalkulasi');
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->bahan_perabot_model->add($post);
        } else if (isset($_POST['edit'])) {
            $this->bahan_perabot_model->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/bahan_perabot');
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
