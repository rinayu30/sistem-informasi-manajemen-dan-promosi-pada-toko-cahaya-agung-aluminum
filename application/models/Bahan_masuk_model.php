
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_masuk_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('bahan_masuk');
        $this->db->join('pemasok', 'pemasok.id_pemasok = bahan_masuk.id_pemasok');
        $this->db->join('item', 'item.id_item = bahan_masuk.id_item');
        if ($id != null) {
            $this->db->where('id_bmasuk', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function buat_kode()
    {
        $this->db->select('Right(bahan_masuk.id_bmasuk,3) as kode ', false);
        $this->db->order_by('id_bmasuk', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('bahan_masuk');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "BMK" . $kodemax;
        return $kodejadi;
    }

    public function get_harga()
    {
        $jumlah = $this->input->post('jumlah');
        $harga = $this->input->post('harga');
        $total = $jumlah * $harga;
        return $total;
    }

    public function add($post)
    {
        $params = [
            'id_bmasuk' => $post['kode'],
            'id_pemasok' => $post['pemasok'],
            'id_item' => $post['item'],
            'jumlah' => $post['jumlah'],
            'satuan' => $post['satuan'],
            'harga_satuan' => $post['harga'],
            'total_harga' =>  $this->get_harga($post),
            'tgl_beli' =>  $post['tgl_beli'],
        ];
        $this->db->insert('bahan_masuk', $params);
    }
    // function update_tambah_stok($data)
    // {
    //     $jumlah = $data['jumlah'];
    //     $id = $data['id_item'];
    //     $sql = "UPDATE item SET stok = stok + '$jumlah' WHERE id_item='$id'";
    //     $this->db->query($sql);
    // }
    public function edit($post)
    {

        $params = [
            'id_bmasuk' => $post['kode'],
            'id_pemasok' => $post['pemasok'],
            'id_item' => $post['item'],
            'jumlah' => $post['jumlah'],
            'satuan' => $post['satuan'],
            'harga_satuan' => $post['harga'],
            'total_harga' =>  $this->get_harga($post),
            'tgl_beli' =>  $post['tgl_beli'],
            'tgl_ubah' => date('Y-m-d')
        ];
        $this->db->where('id_bmasuk', $post['kode']);
        $this->db->update('bahan_masuk', $params);
    }


    public function hapus_data($id)
    {
        $this->db->where('id_bmasuk', $id);
        $this->db->delete('bahan_masuk');
    }
    public function laporan()
    {
        $query = "SELECT bahan_masuk.*,pemasok.*, item.*
                FROM bahan_masuk
                LEFT OUTER JOIN pemasok ON bahan_masuk.id_pemasok=pemasok.id_pemasok
                LEFT OUTER JOIN item ON bahan_masuk.id_item=item.id_item
				order by tgl_beli desc";
        return $this->db->query($query);
    }
    function laporan_periode($tanggal1, $tanggal2)
    {
        $query = "SELECT bahan_masuk.*,pemasok.*, item.*
        FROM bahan_masuk
        LEFT OUTER JOIN pemasok ON bahan_masuk.id_pemasok=pemasok.id_pemasok
        LEFT OUTER JOIN item ON bahan_masuk.id_item=item.id_item
        WHERE bahan_masuk.tgl_beli between '$tanggal1' and '$tanggal2'
        order by tgl_beli desc";
        return $this->db->query($query);
    }
}
