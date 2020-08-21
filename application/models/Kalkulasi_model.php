
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kalkulasi_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('kalkulasi');
        $this->db->join('produk', 'produk.kd_produk = kalkulasi.kd_produk');

        if ($id != null) {
            $this->db->where('id_kalkulasi', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function add_bahan($post)
    {
        $params = [
            'kd_produk' => $post['kode'],
            'id_jenis' => $post['jenis'],
        ];
        $this->db->insert('kalkulasi', $params);
    }

    public function add($post)
    {
        $params = [
            'kd_produk' => $post['kode'],
            'id_jenis' => $post['jenis'],
            'id_item' => $post['item'],

        ];
        $this->db->insert('kalkulasi', $params);
    }
    //fungsi dibawah diabaikan dulu 
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

    function get_jenisbahan(){
        $hasil=$this->db->query("SELECT * FROM jenis_bahan");
        return $hasil;
    }
 
    function get_item($id){
        $hasil=$this->db->query("SELECT * FROM item WHERE id_jenis='$id'");
        return $hasil->result();
    }
}
