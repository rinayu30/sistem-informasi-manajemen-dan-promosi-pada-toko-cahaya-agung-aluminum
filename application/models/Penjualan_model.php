
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('penjualan');
        if ($id != null) {
            $this->db->where('kd_penjualan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // public function getKode()
    // {
    //     $this->db->select('Right(penjualan.kd_penjualan,3) as kode ', false);
    //     $this->db->order_by('kd_penjualan', 'desc');
    //     $this->db->limit(1);
    //     $query = $this->db->get('penjualan');
    //     if ($query->num_rows() <> 0) {
    //         $data = $query->row();
    //         $kode = intval($data->kode) + 1;
    //     } else {
    //         $kode = 1;
    //     }
    //     $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
    //     $kodejadi  = "PR" . $kodemax;
    //     return $kodejadi;
    // }
    public function buat_kode()
    {
        $this->db->select('Right(penjualan.kd_penjualan,3) as kode ', false);
        $this->db->order_by('kd_penjualan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('penjualan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodejadi  = "PJ" . date('ymd') . $kodemax;
        return $kodejadi;
        // $this->db->select('Right(penjualan.kd_penjualan,3) as kode ', false);
        // $this->db->order_by('kd_penjualan', 'desc');
        // $this->db->limit(1);
        // $query = $this->db->get('penjualan');
        // if ($query->num_rows() <> 0) {
        //     $data = $query->row();
        //     $kode = intval($data->kode) + 1;
        // } else {
        //     $kode = 1;
        // }
        // $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);
        // $kodejadi  = "PJ" . date('ymd') . $kodemax;
        // return $kodejadi;
    }
    public function getHargaJual($id)
    {
        // $id = $this->input->post('kd_produk');
        // $hasil = $this->db->query("SELECT kalkulasi.harga_jual FROM kalkulasi WHERE kd_produk.kalkulasi='$id'");
        // return $hasil->result();
        // $satuan = $this->db->query("SELECT jenis_bahan.nilai_satuan FROM jenis_bahan left outer join item ON  item.id_jenis = jenis_bahan.id_jenis WHERE item.id_item=$id ");

        $this->db->select('kalkulasi.harga_jual');
        $this->db->from('kalkulasi');
        $this->db->join('produk', 'produk.kd_produk = kalkulasi.kd_produk');
        if ($id != null) {
            $this->db->where('kalkulasi.kd_produk', $id);
        }
        $query = $this->db->get();
        if ($query->num_rows() <> 0) {
            return $query->row()->harga_jual;
        }
        return false;
        // return $query;
    }
    public function getBayar()
    {
    }
    public function getSisa()
    {
    }
    public function getTgl()
    {
    }

    public function add($post)
    {
        $params = [
            'kd_penjualan' => $post['kode'],
            'nama_penjualan' => $post['nama'],
            // 'gambar' => $this->_uploadImage(),
            'stok' => $post['stok'],
            'kategori' => $post['kategori'],
            'detail' => empty($post['ket']) ? null : $post['ket'],
        ];
        $this->db->insert('penjualan', $params);
    }

    public function edit($post)
    {

        $params = [
            'kd_penjualan' => $post['kode'],
            'nama_penjualan' => $post['nama'],
            // 'gambar' => $this->cek_gambar($post),
            'stok' => $post['stok'],
            'kategori' => $post['kategori'],
            'detail' => empty($post['ket']) ? null : $post['ket'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('kd_penjualan', $post['kode']);
        $this->db->update('penjualan', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('kd_penjualan', $id);
        $this->db->delete('penjualan');
    }
}
