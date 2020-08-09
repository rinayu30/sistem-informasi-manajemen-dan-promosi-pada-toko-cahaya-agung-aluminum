
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model
{

    public function get($id = null){
        $this->db->from('jenis_bahan');
        if($id != null){
            $this->db->where('id_jenis', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function add($post)
    {
        $params = [
            'nama_jenis' => $post['nama'],
            'nilai_satuan' => $post['nilai'],
        ];
        $this->db->insert('jenis_bahan', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_jenis' => $post['nama'],
            'nilai_satuan' => $post['nilai'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_jenis', $post['id']);
        $this->db->update('jenis_bahan', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('id_jenis', $id);
        $this->db->delete('jenis_bahan');
    }
    
}