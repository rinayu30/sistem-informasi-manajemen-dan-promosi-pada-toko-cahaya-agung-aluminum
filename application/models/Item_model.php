
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Item_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('item');
        $this->db->join('jenis_bahan', 'jenis_bahan.id_jenis = item.id_jenis');
        if ($id != null) {
            $this->db->where('id_item', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function get_item_byjenis($id = null)
    {
        $this->db->from('item');
        if ($id != null) {
            $this->db->where('id_jenis', $id);
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
    public function bulk_delete($id)
    {
        $this->db->where_in('id_item', $id);
        $this->db->delete('item');
    }

    function update_tambah_stok($post)
    {
        $jumlah = $post['jumlah'];
        $id = $post['item'];
        $sql = "UPDATE item SET stok = stok + '$jumlah' WHERE id_item='$id'";
        $this->db->query($sql);
    }
    function update_tambah_stokedit($post)
    {
        $jml1 = $post['jumlah_lama'];
        $jumlah = $post['jumlah'];
        $id = $post['item'];
        $sql = "UPDATE item SET stok = stok - '$jml1'+ '$jumlah' WHERE id_item='$id'";
        $this->db->query($sql);
    }

    function update_kurang_stok($post, $pos)
    {
        $id = $post['item'];
        $sql = "UPDATE item SET stok = stok - '$pos' WHERE id_item='$id'";
        $this->db->query($sql);
    }
}
