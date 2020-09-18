<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        check_already_login();
        $this->load->view('login');
    }

    public function proses()
    {

        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('auth_model');
            $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
            $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
            $this->output->set_header("Pragma: no-cache");
            $query = $this->auth_model->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'userid' => $row->id_user,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                switch ($this->session->set_userdata('level')) {
                    case 1:
                        echo "<script> alert ('Selamat, login berhasil'); </script>";
                        redirect('admin/dashboard');
                        break;
                    case 2:
                        echo "<script> alert ('Selamat, login berhasil'); </script>";
                        redirect('admin/dashboard');
                        break;
                    case 3:
                        echo "<script> alert ('Selamat, login berhasil');</script>";
                        redirect('dashboard');
                        break;
                    default:
                        break;
                }
                // echo "<script> 
                // alert ('Selamat, login berhasil');
                // window.location='" . site_url('admin/dashboard') . "'
                // </script>";
            } else {
                echo "<script> 
                alert ('Maaf login gagal, password/username salah');
                window.location='" . site_url('auth/login') . "'
                </script>";
                // $this->session->set
            }
        }
    }

    public function logout()
    {
        $params = array('userid', 'level');
        $this->session->unset_userdata($params);
        redirect('auth/login');
    }
}
