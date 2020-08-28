
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_perabot_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('bahan_perabot');
        $this->db->join('item', 'item.id_item = bahan_perabot.id_item');

        if ($id != null) {
            $this->db->where('id_bahan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function kode_kalkulasi()
    {
        $this->db->select('Right(kalkulasi.id_kalkulasi,3) as kode ', false);
        $this->db->order_by('id_kalkulasi', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('kalkulasi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "KH" . $kodemax;
        return $kodejadi;
    }
    public function get_subharga()
    {
        $jumlah = $this->input->post('jumlah');
        $harga = $this->input->post('harga_satuan');
        $total = $jumlah * $harga;
        return $total;
    }
    public function tambah_bahan($post)
    {
        $params = [
            'id_bahan' => $this->kode_kalkulasi(),
            'id_item' => $post['item'],
            'banyak' => $post['banyak'],
            'ukuran' => $post['ukuran'],
            'uk_panjang' => $post['ukuran_p'],
            'uk_lebar' => $post['ukuran_p'],
            'jumlah' => $post['jumlah'],
            'harga_satuan' => $post['harga'],
            'jumlah_harga' => $this->get_subharga(),
        ];
        $this->db->insert('bahan_perabot', $params);
    }


    // function get_jenisbahan()
    // {
    //     $hasil = $this->db->query("SELECT * FROM jenis_bahan");
    //     return $hasil;
    // }

    // function get_item($id)
    // {
    //     $hasil = $this->db->query("SELECT * FROM item WHERE id_jenis='$id'");
    //     return $hasil->result();
    // }
}
