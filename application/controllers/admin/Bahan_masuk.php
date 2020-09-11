<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['bahan_masuk_model', 'pemasok_model', 'item_model']);
        // $this->load->library('form_validation');
    }

    public function index()
    {

        $data['row'] = $this->bahan_masuk_model->get();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/pembelian/bahan_masuk_data', $data);
        $this->load->view('templates_adm/footer');
    }

    public function add()
    {

        $bahan_masuk = new stdClass();
        $bahan_masuk->id_bmasuk = $this->bahan_masuk_model->buat_kode(); //field sesuai dengan database
        $bahan_masuk->jumlah = null;
        $bahan_masuk->satuan = null; //field sesuai dengan database
        $bahan_masuk->harga_satuan = null;
        $bahan_masuk->total_harga = null;
        $bahan_masuk->tgl_beli = null;

        // $query_satuan = $this->bahan_masuk_model->get();
        // $satuan[null] = '--Pilih--';
        // foreach ($query_satuan->result() as $sat) {
        //     $satuan[$sat->id_satuan] = $sat->nama_pemasok;
        // }

        $query_pemasok = $this->pemasok_model->get();
        $pemasok[null] = '--Pilih--';
        foreach ($query_pemasok->result() as $pem) {
            $pemasok[$pem->id_pemasok] = $pem->nama_pemasok;
        }

        $query_item = $this->item_model->get();
        $item[null] = '--Pilih--';
        foreach ($query_item->result() as $itm) {
            $item[$itm->id_item] = $itm->nama_item;
        }
        $data = array(
            'page' => 'tambah',
            'row' => $bahan_masuk,
            'pemasok' => $pemasok, 'selectedpemasok' => null,
            'item' => $item, 'selecteditem' => null,
        );
        $this->load->view('admin/bahan/pembelian/bahan_masuk_form', $data);
    }

    public function edit($id)
    {
        $query = $this->bahan_masuk_model->get($id);
        // $tgl = date('Y-m-d 00:00:00', strtotime($this->input->post('tgl_beli')));
        if ($query->num_rows() > 0) {
            $bahan_masuk = $query->row();

            $query_pemasok = $this->pemasok_model->get();
            $pemasok[null] = '--Pilih--';
            foreach ($query_pemasok->result() as $pem) {
                $pemasok[$pem->id_pemasok] = $pem->nama_pemasok;
            }

            $query_item = $this->item_model->get();
            $item[null] = '--Pilih--';
            foreach ($query_item->result() as $itm) {
                $item[$itm->id_item] = $itm->nama_item;
            }

            $data = array(
                'page' => 'edit',
                'row' => $bahan_masuk,
                'pemasok' => $pemasok, 'selectedpemasok' => $bahan_masuk->id_pemasok,
                'item' => $item, 'selecteditem' => $bahan_masuk->id_item,
                'tgl_beli' => $bahan_masuk->tgl_beli
            );
            $this->load->view('admin/bahan/pembelian/bahan_masuk_form', $data);
        } else {
            echo "<script>alert('Data tidak dapat ditemukan');";
            redirect('admin/bahan_masuk');
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            $this->bahan_masuk_model->add($post);
            $this->item_model->update_tambah_stok($post);
        } else if (isset($_POST['edit'])) {
            $this->bahan_masuk_model->edit($post);
            $this->item_model->update_tambah_stok($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/bahan_masuk');
    }

    public function delete($id)
    {
        $this->bahan_masuk_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/bahan_masuk');
    }

    public function detail($id)
    {
        $data['laporan'] = $this->bahan_masuk_model->detail($id);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/bahan/pembelian/pembelian_detail', $data);
        $this->load->view('templates_adm/footer');
    }
    public function laporan()
    {
        $tanggal1 =  $this->input->post('tanggal1');
        $tanggal2 =  $this->input->post('tanggal2');

        if (isset($_POST['submit'])) {
            $tanggal1 =  $this->input->post('tanggal1');
            $tanggal2 =  $this->input->post('tanggal2');

            $data['laporan'] =  $this->bahan_masuk_model->laporan_periode($tanggal1, $tanggal2);
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/bahan/pembelian/laporan_bahan_masuk', $data);
            $this->load->view('templates_adm/footer');
        } else {
            $data['laporan'] = $this->bahan_masuk_model->laporan();
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/bahan/pembelian/laporan_bahan_masuk', $data);
            $this->load->view('templates_adm/footer');
        }
    }

    // public function pdf_pembelian_periode()
    // {
    //     $tanggal1 =  $this->input->post('tanggal1');
    //     $tanggal2 =  $this->input->post('tanggal2');
    //     $this->load->library('dompdf_gen');
    //     $data['laporan'] = $this->bahan_masuk_model->laporan_periode($tanggal1, $tanggal2);

    //     $this->load->view('admin/bahan/pembelian/cetak_laporan', $data);

    //     $paper_size = 'A4';
    //     $orientation = 'potrait';
    //     $html = $this->output->get_output();
    //     $this->dompdf->set_paper($paper_size, $orientation);

    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream("laporan_pembelian.pdf", array('Attachment' => 0));
    // }
}
