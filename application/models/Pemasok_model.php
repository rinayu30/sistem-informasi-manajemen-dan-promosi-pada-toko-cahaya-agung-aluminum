
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasok_model extends CI_Model
{

    public function get($id = null){
        $this->db->from('pemasok');
        if($id != null){
            $this->db->where('id_pemasok', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function add($post)
    {
        $params = [
            'nama_pemasok' => $post['nama'],
            'kontak' => $post['kontak'],
            'alamat' => $post['alamat'],
            'keterangan' => empty($post['ket']) ? null : $post['ket'],
        ];
        $this->db->insert('pemasok', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_pemasok' => $post['nama'],
            'kontak' => $post['kontak'],
            'alamat' => $post['alamat'],
            'keterangan' => empty($post['ket']) ? null : $post['ket'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_pemasok', $post['id']);
        $this->db->update('pemasok', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('id_pemasok', $id);
        $this->db->delete('pemasok');
    }
    
}