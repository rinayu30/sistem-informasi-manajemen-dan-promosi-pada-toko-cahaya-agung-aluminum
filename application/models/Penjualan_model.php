
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('detail_penjualan');
        if ($id != null) {
            $this->db->where('kd_penjualan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_Dpenjualan()
    {

        $hasil = $this->db->query("SELECT detail_penjualan.*, produk.*
         FROM detail_penjualan
         LEFT OUTER JOIN produk ON detail_penjualan.kd_produk=produk.kd_produk
          WHERE detail_penjualan.status ='1'");
        return $hasil->result();
    }

    function get_Detail($id)
    {
        $hasil = $this->db->query("SELECT detail_penjualan.*, kalkulasi.*, produk.* FROM detail_penjualan 
        LEFT OUTER JOIN kalkulasi ON detail_penjualan.kd_produk=kalkulasi.kd_produk
        LEFT OUTER JOIN produk ON detail_penjualan.kd_produk=produk.kd_produk 
        WHERE detail_penjualan.status ='1' AND produk.kd_produk ='$id' ");
        return $hasil->result();
        // $hasil = $this->db->query("SELECT *
        // FROM detail_penjualan
        // WHERE detail_penjualan.status ='1'");
        // $results = array();
        // $this->db->from('detail_penjualan');
        // $query = $this->db->get();
        // if ($query->num_rows() > 0) {
        //     $results = $query->result();
        // }
        // return $results;
        // return $query;
        // return $hasil->result();

        // $hasil = $this->db->query("SELECT detail_penjualan.*,produk.*,kalkulasi.harga_jual 
        // FROM detail_penjualan LEFT OUTER JOIN produk,kalkulasi 
        // ON detail_penjualan.kd_produk=produk.kd_produk 
        // AND detail_penjualan.kd_produk=kalkulasi.kd_produk
        // WHERE detail_penjualan.status ='1'");
        // return $hasil->result();
    }


    public function buat_kode_penjualan()
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
    }

    public function getHargaJual()
    {
        // $id = $this->input->post('kd_produk');
        // $hasil = $this->db->query("SELECT kalkulasi.harga_jual FROM kalkulasi WHERE kd_produk.kalkulasi='$id'");
        // return $hasil->result();
        // $satuan = $this->db->query("SELECT jenis_bahan.nilai_satuan FROM jenis_bahan left outer join item ON  item.id_jenis = jenis_bahan.id_jenis WHERE item.id_item=$id ");
        $id = $this->input->post('kd_produk');
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
    public function getSub()
    {
        $jml = $this->input->post('jumlah');
        $harga = $this->getHargaJual();
        $sub = $jml * $harga;
        return $sub;
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

            'kd_penjualan' => $this->buat_kode_penjualan(),
            'kd_produk' => $post['kd_produk'],
            'harga_jual' => $this->getHargaJual(),
            // 'gambar' => $this->_uploadImage(),
            'jumlah' => $post['jumlah'],
            'subtotal' => $this->getSub(),
            // 'tgl_penjualan' => $post['tgl_pej'],
            'status' => '1',
        ];
        $this->db->insert('detail_penjualan', $params);
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
        $this->db->where('id_detail', $id);
        $this->db->delete('detail_penjualan');
    }
    public function bulk_delete($id)
    {
        $this->db->where_in('id_detail', $id);
        $this->db->delete('detail_penjualan');
    }
}
