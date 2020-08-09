
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('kategori');
        if ($id != null) {
            $this->db->where('id_kategori', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama_kategori' => $post['nama'],
        ];
        $this->db->insert('kategori', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_kategori' => $post['nama'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_kategori', $post['id']);
        $this->db->update('kategori', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }
}
