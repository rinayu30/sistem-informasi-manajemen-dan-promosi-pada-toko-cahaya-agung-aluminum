
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
        // $query1 = $this->db->first();
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
    }


    public function buat_kode_penjualan()
    {
        $this->db->select('Right(penjualan.kd_penjualan,2) as kode ', false);
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
    public function get_bayar($id)
    {
        $this->db->select_sum('subtotal');
        $this->db->where('kd_penjualan', $id);
        $query = $this->db->get('detail_penjualan');
        if ($query->num_rows() > 0) {
            return $query->row()->subtotal;
        }
        return false;
    }

    // public function get_bayar()
    // {
    //     $jumlah = $this->get_subtotal();
    //     // $persentase = $this->input->post('persentase');
    //     // $sub = $persentase / 100 * $jumlah;
    //     // $sub2 = $jumlah + $sub;
    //     return $jumlah;
    // }
    public function get_sisa($id)
    {
        $jumlah = $this->get_bayar($id);
        $dp = $this->input->post('uang_m');
        if ($dp == null) {
            return $jumlah;
        } else {
            $sisa = $jumlah - $dp;
            return $sisa;
        }
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
            'jumlah' => $post['jumlah'],
            'subtotal' => $this->getSub(),
            'status' => '1',
        ];
        $this->db->insert('detail_penjualan', $params);
    }
    function selesai_hitung($data)
    {
        $this->db->insert('penjualan', $data);
        $last_id =  $this->db->query("select kd_penjualan from penjualan order by  kd_penjualan desc")->row_array();
        $this->db->query("update detail_penjualan set kd_penjualan='" . $last_id['kd_penjualan'] . "' where status='1' ");
        $this->db->query("update detail_penjualan set status='0' where status='1'");
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

    public function detail($id)
    {
        $hasil = $this->db->query("SELECT detail_penjualan.*, produk.*,penjualan.*,pembeli.*
        FROM detail_penjualan
        LEFT OUTER JOIN produk ON detail_penjualan.kd_produk=produk.kd_produk
        LEFT OUTER JOIN penjualan ON detail_penjualan.kd_penjualan=penjualan.kd_penjualan
        LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli 
        WHERE penjualan.kd_penjualan ='$id'");
        return $hasil;
    }

    public function ambil($id = null)
    {
        $query = $this->db->query("SELECT detail_penjualan.*, produk.*,penjualan.*,pembeli.*
        FROM detail_penjualan
        LEFT OUTER JOIN produk ON detail_penjualan.kd_produk=produk.kd_produk
        LEFT OUTER JOIN penjualan ON detail_penjualan.kd_penjualan=penjualan.kd_penjualan
        LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli 
        WHERE penjualan.kd_penjualan ='$id' GROUP BY penjualan.kd_penjualan");

        return $query;
    }

    public function laporan_default()
    {
        $query = "SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
                FROM penjualan
                LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
				order by tgl_penjualan desc";
        return $this->db->query($query);
    }
    public function laporan_batal()
    {
        $query = "SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
                FROM penjualan
                LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
                WHERE status_jual ='-1'
				order by tgl_penjualan desc";
        return $this->db->query($query);
    }


    function laporan_periode($tanggal1, $tanggal2)
    {
        $query = "SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
                FROM penjualan
                LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
                WHERE penjualan.tgl_penjualan between '$tanggal1' and '$tanggal2'
                order by tgl_penjualan desc";
        return $this->db->query($query);
    }
    function laporan_batal_periode($tanggal1, $tanggal2)
    {
        $query = "SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
        FROM penjualan
        LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
        WHERE status_jual ='-1' and penjualan.tgl_penjualan between '$tanggal1' and '$tanggal2'
        order by tgl_penjualan desc";
        return $this->db->query($query);
    }
}
