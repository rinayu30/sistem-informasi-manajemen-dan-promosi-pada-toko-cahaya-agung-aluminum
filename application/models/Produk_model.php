
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    public function getHarga($id)
    {
        $query = $this->db->query("SELECT kalkulasi.harga_jual,kalkulasi.harga_modal FROM kalkulasi left outer join produk ON  produk.kd_produk = kalkulasi.kd_produk ");
        if ($id != null) {
            $this->db->where('kalkulasi.kd_produk', $id);
        }
        $query = $this->db->get('kalkulasi');
        return $query;
    }
    public function get($id = null)
    {
        // $produk = $this->data['produk'];
        // untuk mendapatkan harga produk pada detail
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        $this->db->join('kalkulasi', 'kalkulasi.kd_produk = produk.kd_produk');
        if ($id != null) {
            $this->db->where('produk.kd_produk', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function get_produk($id = null)
    {
        //untuk tampilan di website
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        if ($id != null) {
            $this->db->where('kd_produk');
            $this->db->group_by('produk.id_kategori', $id);
        }
        $query = $this->db->get();
        if ($query->num_rows() <> 0) {
            $data = $query->row();
        }
        return $data;
    }

    public function get_produkb($id = null)
    {
        //untuk tampilan produk sistem informasi
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        if ($id != null) {
            $this->db->where('kd_produk');
            // $this->db->group_by('produk.id_kategori', $id);
        }
        $query = $this->db->get();

        return $query;
    }

    public function _uploadImage()
    {
        $config['upload_path']          = './uploads/produk/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = 'produk-' . date('ymd') . '-' . substr(md5(rand()), 0, 10); //nama file
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
        print_r($this->upload->display_errors());
        return "default.jpg";
    }

    // public function _deleteImage($id)
    // {
    //     $produk = $this->data['produk'];
    //     if (file_exists($produk . $id))
    //         if ($id != $this->data['gambar_lama']) {
    //             // $target_file = '.uploads/produk/' . $produk->gambar;
    //             unlink($produk . $id);
    //             // $filename = explode(".", $produk->gambar)[0];
    //             // return array_map('unlink', glob(FCPATH . "uploads/produk/$filename.*"));
    //         }
    // }
    public function _deleteImage($id)
    {
        $produk = $this->data['produk'];
        if (file_exists($produk->gambar . $id))
            if ($produk->gambar  != null) {
                unlink($produk->gambar . $id);
            }
    }

    public function buat_kode()
    {
        $this->db->select('Right(produk.kd_produk,3) as kode ', false);
        $this->db->order_by('kd_produk', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('produk');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi  = "PR" . $kodemax;
        return $kodejadi;
    }

    public function add($post)
    {
        $params = [
            'kd_produk' => $post['kode'],
            'nama_produk' => $post['nama'],
            'gambar' => $this->_uploadImage(),
            'stok' => $post['stok'],
            'id_kategori' => $post['kategori'],
            'detail' => empty($post['ket']) ? null : $post['ket'],
            'updated' => '1'
        ];
        $this->db->insert('produk', $params);
    }
    // public function cek_gambar($post)
    // {
    //     if (!empty($_FILES['gambar']['nama_produk'])) {
    //         $gbr =  $this->_uploadImage();
    //     } else {
    //         $gbr = $post['gambar_lama'];
    //     }
    //     return $gbr;
    // }

    public function edit($post)
    {

        $params = [
            'kd_produk' => $post['kode'],
            'nama_produk' => $post['nama'],
            'stok' => $post['stok'],
            'id_kategori' => $post['kategori'],
            'detail' => empty($post['ket']) ? null : $post['ket'],

        ];
        if ($post['gambar'] != null) {
            $params['gambar'] = $this->_uploadImage();
        }
        $this->db->where('kd_produk', $post['kode']);
        $this->db->update('produk', $params);
    }
    // public function cekHarga($id){
    //     $this->db->from('produk');
    //     $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
    //     $this->db->join('kalkulasi', 'kalkulasi.kd_produk = produk.kd_produk');
    //     if ($id != null) {
    //         $this->db->where('produk.kd_produk', $id);
    //     }
    //     $query = $this->db->get();
    //     return $query;
    //     $d = $this->db->get('kalkulasi');

    // }


    public function hapus_data($id)
    {
        $this->_deleteImage($id);
        $this->db->where('kd_produk', $id);
        $this->db->delete('produk');
    }
    //untuk website
    public function find($id)
    {
        $result = $this->db->where('kalkulasi.kd_produk', $id)
            ->limit(1)
            ->join('kalkulasi', 'kalkulasi.kd_produk = produk.kd_produk')
            ->get('produk');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
