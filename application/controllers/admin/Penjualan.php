<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penjualan_model');
        // $this->load->library('form_validation');
    }

    // public function index()
    // {

    //     $data['row'] = $this->penjualan_model->get();
    //     $this->load->view('templates_adm/header');
    //     $this->load->view('templates_adm/sidebar');
    //     $this->load->view('admin/penjualan/penjualan_data', $data);
    //     $this->load->view('templates_adm/footer');
    // }

    // public function index()
    // {

    //     $data['row'] = $this->penjualan_model->get_Detail();
    //     $this->load->view('templates_adm/header');
    //     $this->load->view('templates_adm/sidebar');
    //     $this->load->view('admin/penjualan/penjualan_form', $data);
    //     $this->load->view('templates_adm/footer');
    // }

    public function index()
    {
        $id = $this->input->post('kd_produk');
        $penjualan = new stdClass();
        //field sesuai dengan database
        $penjualan->kd_penjualan = $this->penjualan_model->buat_kode_penjualan();
        $penjualan->kd_produk = null;
        $penjualan->jumlah = null;
        $penjualan->harga_jual = $this->penjualan_model->getHargaJual($id);
        // $penjualan->tot_bayar = $this->penjualan_model->getBayar();
        // $penjualan->dp_awal = null;
        // $penjualan->sisa = $this->penjualan_model->getSisa();
        // $penjualan->tgl_penjualan = null;
        // $penjualan->tgl_pengiriman = $this->penjualan_model->getTgl();
        // $data['detail'] = $this->penjualan_model->get_Detail($id);
        $data['detail'] = $this->penjualan_model->get_Dpenjualan();
        $data['row'] = $penjualan;
        $data['page'] = 'tambah';
        // $data = array(
        //     'page' => 'tambah',
        //     'row' => $penjualan,
        //     'detail' => $this->penjualan_model->get_Detail(),
        // );
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_form', $data);
        $this->load->view('templates_adm/footer');
    }

    function selesai_hitung()
    {
        // $kd_produk =  $this->input->post('kd_produk');
        $data['kd_penjualan'] = $this->penjualan_model->buat_kode_penjualan();
        $data['bayar'] = $this->penjualan_model->get_bayar();
        $data['sisa'] = $this->penjualan_model->get_sisa();
        $id_pembeli    =  $this->input->post('pembeli');
        $dp_awal    =  $this->input->post('uang_m');
        $tgl_penjualan    =  $this->input->post('tgl_pej');
        // $kd_produk    = $this->db->get_where('produk', array('kd_produk' => $kd_produk))->row_array();


        $data = array(
            'kd_penjualan' => $data['kd_penjualan'],
            'id_pembeli' => $id_pembeli,
            'tot_bayar' => $data['bayar'],
            'dp_awal' => $dp_awal,
            'sisa' => $data['sisa'],
            'tgl_penjualan' => $tgl_penjualan,
            'tgl_pengiriman' => $tgl_penjualan,
            'status_jual' => '0',
        );

        $this->penjualan_model->selesai_hitung($data);
        $this->session->set_flashdata('success', ' Data Penjualan berhasil disimpan');
        redirect('admin/penjualan');
    }


    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah_jual'])) {
            $this->penjualan_model->add($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/penjualan');
    }

    public function detail($id)
    {
        $result = $this->db->where('kd_penjualan', $id)->get('penjualan');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
        return $this->db->delete($this->_table, array("kd_penjualan" => $id));
    }

    public function delete($id)
    {
        $this->penjualan_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/penjualan');
    }
    public function bulk_delete()
    {
        $id = $_POST['id_detail']; // Ambil data id_bahan yang dikirim oleh view.php melalui form submit
        $this->penjualan_model->bulk_delete($id); // Panggil fungsi delete dari model
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data yang ditandai berhasil dihapus');
        }
        redirect('admin/penjualan');
    }
}
