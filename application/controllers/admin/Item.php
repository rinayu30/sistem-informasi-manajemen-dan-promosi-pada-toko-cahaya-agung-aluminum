<?php
defined('BASEPATH') or exit('No direct script access allowed');

class item extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['item_model', 'jenis_model']);
        // $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->item_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/item/item_data', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {

        $item = new stdClass();
        $item->id_item = null; //field sesuai dengan database
        $item->nama_item = null;
        $query_jenis = $this->jenis_model->get();
        $jenis[null] = '--Pilih--';
        foreach ($query_jenis->result() as $jns) {
            $jenis[$jns->id_jenis] = $jns->nama_jenis;
        }

        $data = array(
            'page' => 'tambah',
            'row' => $item,
            'jenis' => $jenis, 'selectedjenis' => null,

        );
        $this->load->view('admin/bahan/item/item_form', $data);
    }

    public function edit($id)
    {
        $query = $this->item_model->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();
            $query_jenis = $this->jenis_model->get();
            $jenis[null] = '--Pilih--';
            foreach ($query_jenis->result() as $jns) {
                $jenis[$jns->id_jenis] = $jns->nama_jenis;
            }
            $data = array(
                'page' => 'edit',
                'row' => $item,
                'jenis' => $jenis, 'selectedjenis' => $item->id_jenis,
            );
            $this->load->view('admin/bahan/item/item_form', $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            redirect('admin/item');
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->item_model->add($post);
        } else if (isset($_POST['edit'])) {
            $this->item_model->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/item');
    }

    public function delete($id)
    {
        $this->item_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/item');
    }
}
