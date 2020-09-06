
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
        $this->db->where('id_bahan', $id);
        $this->db->delete('bahan_perabot');
    }

    public function bulk_delete($id)
    {
        $this->db->where_in('id_bahan', $id);
        $this->db->delete('bahan_perabot');
    }

    function get_jenisbahan()
    {
        $hasil = $this->db->query("SELECT * FROM jenis_bahan");
        return $hasil;
    }

    function get_item($id)
    {
        $hasil = $this->db->query("SELECT * FROM item WHERE id_jenis='$id'");
        return $hasil->result();
    }
    // $id1 = $this->db->query("SELECT kalkulasi.id_kalkulasi JOIN produk ON kalkulasi.kd_produk=produk.kd_produk WHERE kalkulasi.kd_produk=$id");
    // $id1 = $this->getID($id);
    // $hasil = $this->db->query("SELECT * FROM bahan_perabot LEFT OUTER JOIN kalkulasi ON bahan_perabot.id_kalkulasi=kalkulasi.id_kalkulasi WHERE bahan_perabot.id_kalkulasi ='$id1'");
    // return $hasil->result();

    function detaiil($id)
    {
        $hasil = $this->db->query("SELECT bahan_perabot.*, kalkulasi.*, produk.*, item.* FROM bahan_perabot 
        LEFT OUTER JOIN item ON bahan_perabot.id_item=item.id_item 
        LEFT OUTER JOIN kalkulasi ON bahan_perabot.id_kalkulasi=kalkulasi.id_kalkulasi 
        LEFT OUTER JOIN produk ON kalkulasi.kd_produk=produk.kd_produk 
        WHERE bahan_perabot.status ='1' AND produk.kd_produk ='$id' ");
        return $hasil->result();
    }

    // public function detail($id)
    // {
    //     $kode = $this->db->query("SELECT kalkulasi.id_kalkulasi FROM kalkulasi left outer join produk ON  produk.kd_produk = kalkulasi.kd_produk WHERE produk.kd_produk='$id' ");
    //     if ($kode->num_rows() > 0) {
    //         return $kode->row()->id_kalkulasi;
    //     }
    //     return false;
    //     $this->db->select('bahan_perabot.*');
    //     $this->db->from('bahan_perabot');
    //     $this->db->join('kalkulasi', 'kalkulasi.id_kalkulasi=bahan_perabot.id_kalkulasi');
    //     $this->db->join('item', 'item.id_item=bahan_perabot.id_item');
    //     if ($kode != null) {
    //         $this->db->where('bahan_perabot.id_kalkulasi', $kode);
    //     }
    //     // $query = $this->db->get('bahan_perabot');
    //     // return $query;
    //     $query = $this->db->get();
    //     return $query;
    //     // if ($query->num_rows() > 0) {
    //     //     return $query;
    //     // }
    //     // return false;

    //     // $this->db->select('kalkulasi.id_kalkulasi');
    //     // $this->db->from('kalkulasi');
    //     // $this->db->join('produk', 'produk.kd_produk = kalkulasi.kd_produk');
    //     // // if ($id != null) {
    //     // $this->db->where('produk.kd_produk', $id);
    //     // // }
    //     // $query = $this->db->get();
    //     // // if ($query->num_rows() > 0) {
    //     // //     return $query->row()->id_kalkulasi;
    //     // // }
    //     // // return false;
    //     // return $query;
    // }
}
