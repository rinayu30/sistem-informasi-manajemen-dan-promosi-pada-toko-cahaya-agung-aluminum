<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        $this->load->library('session');
    }
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }
    public function login_web($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $post['email']);
        $this->db->where('password', sha1($post['pass']));
        $query = $this->db->get();
        $user = $query->row();
        if (isset($user)) {
            $this->session->set_userdata('userid', $user->id_user);
            $this->session->set_userdata('nama_user', $user->nama_user);
            $this->session->set_userdata('username', $user->username);
            $this->session->set_userdata('email', $user->email);
            $this->session->set_userdata('no_telp', $user->no_telp);
            $this->session->set_userdata('level', $user->level);
        }
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('id_user', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['nama_user'] = $post['nama'];
        $params['username'] = $post['username'];
        $params['password'] = sha1($post['pass']);
        $params['email'] = $post['email'];
        $params['no_telp'] = $post['kontak'];
        $params['level'] = $post['level'];
        //params field yang di database, post yang di form
        $this->db->insert('user', $params);
    }

    public function hapus_data($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }

    public function edit($post)
    {
        $params['nama_user'] = $post['nama'];
        $params['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['pass']);
        }
        $params['email'] = $post['email'];
        $params['no_telp'] = $post['kontak'];
        $params['level'] = $post['level'];
        $this->db->where('id_user', $post['id_user']);
        $this->db->update('user', $params);
    }

    public function logout()
    {
        $this->session->unset_userdata([
            'userid',
            'nama_user',
            'username',
            'email',
            'no_telp',
            'level'
        ]);
    }
}
