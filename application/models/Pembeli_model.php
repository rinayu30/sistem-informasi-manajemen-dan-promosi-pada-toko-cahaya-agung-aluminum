
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli_model extends CI_Model
{

    public function get($id = null){
        $this->db->from('pembeli');
        if($id != null){
            $this->db->where('id_pembeli', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function add($post)
    {
        $params = [
            'nama_pembeli' => $post['nama'],
            'jk' => $post['jk'],
            'no_telp' => $post['kontak'],
            'alamat' => $post['alamat'],
        ];
        $this->db->insert('pembeli', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_pembeli' => $post['nama'],
            'jk' => $post['jk'],
            'no_telp' => $post['kontak'],
            'alamat' => $post['alamat'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_pembeli', $post['id']);
        $this->db->update('pembeli', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('id_pembeli', $id);
        $this->db->delete('pembeli');
    }
    
}