<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kalkulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['bahan_perabot_model', 'kalkulasi_model', 'produk_model', 'item_model', 'jenis_model']);
        $this->load->library('form_validation');
    }


    function get_item()
    {
        $id = $this->input->post('id');
        $data = $this->kalkulasi_model->get_item($id);
        echo json_encode($data);
    }
    function selesai_hitung()
    {
        // $kd_produk =  $this->input->post('kd_produk');
        $data['id_kalkulasi'] = $this->bahan_perabot_model->kode_kalkulasi();
        $data['harga_modal'] = $this->bahan_perabot_model->get_subtotal();
        $data['harga_jual'] = $this->bahan_perabot_model->get_hargaJual();
        $kd_produk    =  $this->input->post('kd_produk');
        // $kd_produk    = $this->db->get_where('produk', array('kd_produk' => $kd_produk))->row_array();


        $data = array(
            'id_kalkulasi' => $data['id_kalkulasi'],
            'kd_produk' => $kd_produk,
            'harga_modal' => $data['harga_modal'],
            'harga_jual' => $data['harga_jual'],
        );

        $this->bahan_perabot_model->selesai_hitung($data);
        $this->session->set_flashdata('success', ' Data Harga Produk Tersimpan Silahkan Lihat Detail Produk');
        redirect('admin/kalkulasi');
    }

    public function index()
    {

        // $data['row'] = $this->bahan_perabot_model->get();
        $data['bahanperabot'] = $this->bahan_perabot_model->get_bahan();
        // $data['jumlah'] = $this->bahan_perabot_model->get_nilai_satuan();
        // $data['kd_produk'] = $this->produk_model->get();
        $data['item'] = $this->item_model->get_item_byjenis('id_jenis');
        $data['data'] = $this->kalkulasi_model->get_jenisbahan();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_data', $data);
        $this->load->view('templates_adm/footer');
    }
    public function tampilHarga()
    {
        $data['row'] = $this->bahan_perabot_model->getKalkulasi();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_list', $data);
        $this->load->view('templates_adm/footer');
    }
    public function rincianbahan($id)
    {
        // $query = $this->kalkulasi_model->detail($id);
        //     if ($query->num_rows() > 0) {
        //         $bahan = $query->row();
        //         // $data = array(
        //         //     'page' => 'edit',
        //         //     'row' => $bahan
        //         // );
        //         $data['row'] = $bahan;
        // $data = array(
        //     'id_bahan' => $data['id_bahan'],
        //     'id_item' => $data['id_item'],
        //     'banyak' => $data['banyak'],
        //     'ukuran' => $data['ukuran'],
        //     'uk_panjang' => $data['uk_panjang'],
        //     'uk_lebar' => $data['uk_lebar'],
        //     'jumlah' => $data['jumlah'],
        //     'harga_satuan' => $data['harga_satuan'],
        //     'jumlah_harga' => $data['jumlah_harga'],
        // );
        // $bahan = new stdClass();
        // $bahan->id_bahan;
        // $bahan->id_item;
        // $bahan->banyak;
        // $bahan->ukuran;
        // $bahan->uk_panjang;
        // $bahan->uk_lebar;
        // $bahan->jumlah;
        // $bahan->harga_satuan;
        // $bahan->jumlah_harga;

        $data['row'] = $this->kalkulasi_model->detaiil($id);
        // $bahan = $this->kalkulasi_model->detail($id);
        // $data['row'] = $bahan;

        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/kalkulasi/kalkulasi_detail', $data);
        $this->load->view('templates_adm/footer');
        // } else {
        //     echo "<script>alert('Data tidak dapat ditemukan');";
        //     echo "window.location='" . site_url('admin/produk') . "';</script>";
        // }
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
        if (isset($_POST['tambah_bahan'])) {
            $this->bahan_perabot_model->add_bahan($post);
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

    public function bulk_delete()
    {
        $id = $_POST['id_bahan']; // Ambil data id_bahan yang dikirim oleh view.php melalui form submit
        $this->kalkulasi_model->bulk_delete($id); // Panggil fungsi delete dari model
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data yang ditandai berhasil dihapus');
        }
        redirect('admin/kalkulasi');
    }
}
