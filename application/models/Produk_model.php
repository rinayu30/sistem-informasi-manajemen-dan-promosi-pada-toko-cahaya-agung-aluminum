
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        if ($id != null) {
            $this->db->where('kd_produk', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_produk($id = null)
    {
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
    // function DeleteFile($oldthumbnail)
    // {
    //     $Folder = $this->data['Folder'];
    //     if (file_exists($Folder . $oldthumbnail)) {
    //         if ($oldthumbnail != $this->data['PictureForbid']) {
    //             unlink("$Folder$oldthumbnail");
    //         }
    //     }
    // }

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
            'updated' => date('Y-m-d H:i:s')
        ];
        if ($post['gambar'] != null) {
            $params['gambar'] = $this->_uploadImage();
        }
        $this->db->where('kd_produk', $post['kode']);
        $this->db->update('produk', $params);
    }


    public function hapus_data($id)
    {
        $this->_deleteImage($id);
        $this->db->where('kd_produk', $id);
        $this->db->delete('produk');
    }
    //untuk website
    public function find($id)
    {
        $result = $this->db->where('kd_produk', $id)
            ->limit(1)
            ->get('produk');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
