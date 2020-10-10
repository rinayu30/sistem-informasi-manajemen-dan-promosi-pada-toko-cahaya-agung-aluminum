<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        cek_pengunjung();
        cek_admin();
        $this->load->model('jenis_model');
        // $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->jenis_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/jenis/jenis_data', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {
        //$this->form_validation->set_rules('nama', 'Nama jenis', 'required');
        //$this->form_validation->set_message('required', '%s harus diisi');

        // if ($this->form_validation->run() == FALSE){
        $jenis = new stdClass();
        $jenis->id_jenis = null; //field sesuai dengan database
        $jenis->nama_jenis = null;
        $jenis->nilai_satuan = null;
        $data = array(
            'page' => 'tambah',
            'row' => $jenis
        );
        $this->load->view('admin/bahan/jenis/jenis_form', $data);
        // }else{
        //     $post = $this->input->post(null, TRUE);
        //     $this->jenis_model->add($post);
        //     if($this->db->affected_rows() > 0 ){
        //         $this->session->set_flashdata('success',' Data berhasil disimpan');
        //     }
        //     redirect('admin/jenis');
        // } 

    }

    public function edit($id)
    {
        $query = $this->jenis_model->get($id);
        if ($query->num_rows() > 0) {
            $jenis = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $jenis
            );
            $this->load->view("admin/bahan/jenis/jenis_form", $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            redirect('admin/jenis');
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->jenis_model->add($post);
        } else if (isset($_POST['edit'])) {
            $this->jenis_model->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/jenis');
    }

    public function delete($id)
    {
        $this->jenis_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/jenis');
    }
}
