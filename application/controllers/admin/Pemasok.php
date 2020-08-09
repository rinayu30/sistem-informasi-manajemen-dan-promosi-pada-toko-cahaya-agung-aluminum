<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Pemasok extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            check_not_login();
            $this->load->model('pemasok_model'); 
            // $this->load->library('form_validation');
        }

        public function index(){
           
            $data['row'] = $this->pemasok_model->get();
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/pemasok/daftar_pemasok', $data);
            $this->load->view('templates_adm/footer');
        }

         public function add()
        {
            // $this->form_validation->set_rules('nama', 'Nama Pemasok', 'required');
            // $this->form_validation->set_rules('kontak', 'Kontak', 'required');
            // $this->form_validation->set_message('required', '%s harus diisi');

            // if ($this->form_validation->run() == FALSE){
                $pemasok = new stdClass();
                $pemasok->id_pemasok = null;//field sesuai dengan database
                $pemasok->nama_pemasok = null;
                $pemasok->kontak = null;
                $pemasok->alamat = null;
                $pemasok->keterangan = null;
                $data = array(
                    'page' => 'tambah',
                    'row' => $pemasok
                );
                $this->load->view('admin/pemasok/pemasok_form', $data);
            // }else{
            //     $post = $this->input->post(null, TRUE);
            //     $this->pemasok_model->add($post);
            //     if($this->db->affected_rows() > 0 ){
            //         echo "<script>alert('Data berhasil disimpan');</script>";
            //     }
            //     echo "<script>window.location='".site_url('admin/pemasok')."';</script>";
            // } 
           
        }

        public function edit($id){
            $query = $this->pemasok_model->get($id);
            if($query->num_rows() > 0 ){
                $pemasok = $query->row();
                $data = array(
                    'page' => 'edit',
                    'row' => $pemasok
                );
                $this->load->view("admin/pemasok/pemasok_form", $data);
            }else{
                echo "<script>alert('Data tidak dapat ditemukan');";
                echo "window.location='".site_url('admin/pemasok')."';</script>";
            }

        }

        public function proses(){
            $post= $this->input->post(null, TRUE);
            if(isset($_POST['tambah'])){
                $this->pemasok_model->add($post);
            }else if(isset($_POST['edit'])){
                $this->pemasok_model->edit($post);
            }

            if($this->db->affected_rows() > 0 ){
               $this->session->set_flashdata('success',' Data berhasil disimpan');
            }
            redirect('admin/pemasok');
        }

        public function delete($id){
            $this->pemasok_model->hapus_data($id);
            if($this->db->affected_rows() > 0 ){
                $this->session->set_flashdata('success',' Data berhasil dihapus');
            }
            redirect('admin/pemasok');

        }
    }
