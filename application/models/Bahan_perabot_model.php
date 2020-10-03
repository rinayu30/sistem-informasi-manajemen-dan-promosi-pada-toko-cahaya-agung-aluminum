
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
        $hasil = $this->db->query("SELECT bahan_perabot.*,item.* FROM bahan_perabot LEFT OUTER JOIN item ON bahan_perabot.id_item=item.id_item WHERE bahan_perabot.status ='1'");
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
    // public function get_subtotal()
    // {
    //     $this->db->select_sum('jumlah_harga');
    //     $query = $this->db->get('bahan_perabot');
    //     if ($query->num_rows() > 0) {
    //         return $query->row()->jumlah_harga;
    //     }
    //     return false;
    // }

    public function get_subtotalD($id)
    {
        $this->db->select_sum('jumlah_harga');
        $this->db->where('id_kalkulasi', $id);
        $query = $this->db->get('bahan_perabot');
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_harga;
        }
        return false;
        // return $query;
    }

    public function get_hargaJual($id)
    {
        $jumlah = $this->get_subtotalD($id);
        $persentase = $this->input->post('persentase');
        $sub = $persentase / 100 * $jumlah;
        $sub2 = $jumlah + $sub;
        return $sub2;
    }

    function selesai_hitung($data)
    {
        $id = $this->input->post('kd_produk');
        $this->db->insert('kalkulasi', $data);
        $last_id =  $this->db->query("select id_kalkulasi from kalkulasi order by  id_kalkulasi desc")->row_array();
        $this->db->query("update bahan_perabot set id_kalkulasi='" . $last_id['id_kalkulasi'] . "' where status='1' ");
        $this->db->query("update bahan_perabot set status='0' where status='1'");
        $this->db->query("update produk set updated='0' where updated='1' AND kd_produk= '$id'");
    }
    public function tambah_bahan($post)
    {

        $params = [
            'id_kalkulasi' => $this->kode_kalkulasi(),
            'id_item' => $post['item'],
            'banyak' => $post['banyak'],
            'ukuran' =>  isset($_POST['ukuran']) ? $_POST['ukuran'] : '',
            'uk_panjang' => isset($_POST['ukuran_p']) ? $_POST['ukuran_p'] : '',
            'uk_lebar' => isset($_POST['ukuran_l']) ? $_POST['ukuran_l'] : '',
            'jumlah' => $this->get_jumlah(),
            'harga_satuan' => $post['harga_s'],
            'jumlah_harga' => $this->get_subharga(),
            'status' => '1',
        ];
        // print_r($params);
        // $generate=
        //         $data = ['id_kalkulasi' => $this->kode_kalkulasi()];
        // if($data )
        // $data = ['id_kalkulasi' => $this->kode_kalkulasi()];
        // $this->db->insert('kalkulasi', $data);
        $this->db->insert('bahan_perabot', $params);
    }
    public function getKalkulasi($id = null)
    {
        // $this->db->from('kalkulasi');
        $this->db->join('produk', 'produk.kd_produk = kalkulasi.kd_produk');
        if ($id != null) {
            $this->db->where('id_kalkulasi', $id);
        }
        $query = $this->db->get('kalkulasi');
        return $query;
        // $hasil = $this->db->query("SELECT * FROM kalkulasi LEFT OUTER JOIN produk ON kalkulasi.kd_produk=produk.kd_produk");
        // return $hasil->result();
    }
    public function detailHarga($id)
    {
        //masih error
        $query = "SELECT bahan_perabot.*,item.* 
					FROM bahan_perabot,produk as p,kalkulasi as k
                    JOIN item ON bahan_perabot.id_item=item.id_item
					WHERE p.kd_produk=k.kd_produk and k.id_kalkulasi=bahan_perabot.id_kalkulasi and p.kd_produk='$id'";
        return $this->db->query($query);

        //$query="select sum(total_harga)/sum(jumlah) from barangmasuk"

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
