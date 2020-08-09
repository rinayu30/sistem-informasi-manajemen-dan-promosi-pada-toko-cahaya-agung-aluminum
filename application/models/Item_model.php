
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model
{

    public function get($id = null){
        $this->db->from('item');
        $this->db->join('jenis_bahan', 'jenis_bahan.id_jenis = item.id_jenis');
        if($id != null){
            $this->db->where('id_item', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function add($post)
    {
        $params = [
            'nama_item' => $post['nama'],
            'id_jenis' => $post['jenis'],
            
        ];
        $this->db->insert('item', $params);
    }

    public function edit($post)
    {
        $params = [
            
            'nama_item' => $post['nama'],
            'id_jenis' => $post['jenis'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_item', $post['id']);
        $this->db->update('item', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('id_item', $id);
        $this->db->delete('item');
    }
    
}