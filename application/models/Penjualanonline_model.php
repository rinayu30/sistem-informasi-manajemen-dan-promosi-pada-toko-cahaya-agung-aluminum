
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualanonline_model extends CI_Model
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nama = $this->input->post('nama_lengkap');
        $jk = $this->input->post('jk');
        $alamat = $this->input->post('alamat');
        $notel = $this->input->post('notel');

        $pembeli = array(
            'nama_pembeli' => $nama,
            'jk' => $jk,
            'no_telp' => $notel,
            'alamat' => $alamat,
        );

        $this->db->insert('pembeli', $pembeli);
        $tgl_penjualan = date('Y-m-d');
    }
    public function tampil_pesanan()
    {
    }

}
//END halaman website 