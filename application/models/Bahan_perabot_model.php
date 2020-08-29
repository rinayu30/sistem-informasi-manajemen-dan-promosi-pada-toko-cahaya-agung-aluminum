
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_perabot_model extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('bahan_perabot');
        if ($id != null) {
            $this->db->where('id_bahan', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    function get_bahan()
    {
        $hasil = $this->db->query("SELECT bahan_perabot.*,item.* FROM bahan_perabot LEFT OUTER JOIN item ON bahan_perabot.id_item=item.id_item");
        return $hasil->result();
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

    function get_nilai_satuan()
    {
        $id = $this->input->post('item', true);
        $satuan = $this->db->query("SELECT jenis_bahan.nilai_satuan FROM jenis_bahan left outer join item ON  item.id_jenis = jenis_bahan.id_jenis WHERE item.id_item=$id ");
        // $satuan = $this->db->query("SELECT jenis_bahan.nilai_satuan FROM jenis_bahan RIGHT OUTER JOIN item ON item.id_jenis = jenis_bahan.id_jenis WHERE item.id_item=$id_item");
        // $query = $this->db->get();
        if ($satuan->num_rows() > 0) {
            return $satuan->row()->nilai_satuan;
        }
        return false;
        // return $satuan;
    }
    public function get_jumlah()
    {
        $byk = $this->input->post('banyak');

        $uk = $this->input->post('ukuran');
        $ukp = $this->input->post('ukuran_p');
        $ukl = $this->input->post('ukuran_l');
        $sat = $this->get_nilai_satuan();
        if ($uk == TRUE) {
            $total = $byk * $uk / $sat;
        } elseif ($ukp == TRUE && $ukl == TRUE) {
            $total = ($ukp * $sat) * ($ukl * $sat) * $byk;
        } else {
            $total = $byk * 1;
        }
        return $total;
    }
    public function get_subharga()
    {
        $jumlah = $this->get_jumlah();
        $harga = $this->input->post('harga_s');
        $sub = $jumlah * $harga;
        return $sub;
    }
    public function get_hargaJual()
    {
        $jumlah = $this->get_subharga();
        $diskon = $this->input->post('persentase');
        $sub = $diskon / 100 * $jumlah;
        return $sub;
    }
    public function tambahKalkulasi($post)
    {
        $params = [
            'id_kalkulasi' => $this->kode_kalkulasi(),
            'kd_produk' => $post['kd_produk'],
            'harga_modal' => $this->get_subharga(),
            'harga_jual' => $this->get_hargaJual(),

        ];
        $this->db->insert('kalkulasi', $params);
        // $this->db->select('jumlah_harga')->from('bahan_perabot')->where('id_kalkulasi', $subharga);
        // $query = $this->db->get();
        // return $query;

    }
    public function tambah_bahan($post)
    {
        $params = [
            'id_kalkulasi' => $this->kode_kalkulasi(),
            'id_item' => $post['item'],
            'banyak' => $post['banyak'],
            'ukuran' => $post['ukuran'],
            'uk_panjang' => $post['ukuran_p'],
            'uk_lebar' => $post['ukuran_l'],
            'jumlah' => $this->get_jumlah(),
            'harga_satuan' => $post['harga_s'],
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
