
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public function get($id = null){
        $this->db->from('penjualan');
        if($id != null){
            $this->db->where('kd_penjualan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './uploads/penjualan/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = 'penjualan-'.date('ymd').'-'.substr(md5(rand()),0,10); //nama file
        $config['overwrite']			= true;
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

    private function _deleteImage($id)
    {
        $penjualan = $this->get($id);
        if ($penjualan->gambar != "default.jpg") {
            $filename = explode(".", $penjualan->gambar)[0];
            return array_map('unlink', glob(FCPATH."uploads/penjualan/$filename.*"));
        }
    }

    public function buat_kode(){
        $this->db->select('Right(penjualan.kd_penjualan,3) as kode ',false);
        $this->db->order_by('kd_penjualan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('penjualan');
        if($query->num_rows()<>0){
            $data = $query->row();
            $kode = intval($data->kode)+1;
        }else{
            $kode = 1;
        }
        $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
        $kodejadi  = "PR".$kodemax;
        return $kodejadi;
     }
    
    public function add($post)
    {
        $params = [
            'kd_penjualan' => $post['kode'],
            'nama_penjualan' => $post['nama'],
            'gambar' => $this->_uploadImage(),
            'stok' => $post['stok'],
            'kategori' => $post['kategori'],
            'detail' => empty($post['ket']) ? null : $post['ket'],
        ];
        $this->db->insert('penjualan', $params);
    }
    public function cek_gambar($post)
    {
        if (!empty($_FILES["gambar"]["nama_penjualan"])) {
            $gbr= $this->gambar = $this->_uploadImage();
        } else {
           $gbr= $this->gambar = $post["gambar_lama"];
        }

        return $gbr;
    }

    public function edit($post)
    {
        
        $params = [
            'kd_penjualan' => $post['kode'],
            'nama_penjualan' => $post['nama'],
            'gambar' => $this->cek_gambar($post),
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
        $this->_deleteImage($id);
        $this->db->where('kd_penjualan', $id);
        $this->db->delete('penjualan');
    }
    
}