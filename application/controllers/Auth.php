<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    public function login(){
        check_already_login();
        $this->load->view('login');
        
    }

    public function proses(){
     
        $post= $this->input->post(null, TRUE);
        if(isset($post['login'])){
            $this->load->model('auth_model');
            $query = $this->auth_model->login($post);
            if($query->num_rows()>0){
                $row= $query->row();
                $params = array(
                    'userid' => $row->id_user,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                echo "<script> 
                alert ('Selamat, login berhasil');
                window.location='".site_url('admin/dashboard')."'
                </script>";
            }else{
                echo "<script> 
                alert ('Maaf login gagal, password/username salah');
                window.location='".site_url('auth/login')."'
                </script>";
            }
        }   
    }

    public function logout(){
        $params= array('userid','level');
        $this->session->unset_userdata($params);
        redirect ('auth/login');
        
    }
}