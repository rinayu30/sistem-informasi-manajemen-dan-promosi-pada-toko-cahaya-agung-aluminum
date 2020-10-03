<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['bahan_masuk_model', 'pemasok_model', 'item_model']);
        $this->load->library('pdf');

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
            $this->item_model->update_tambah_stokedit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/bahan_masuk');
    }

    public function delete($id)
    {

        $this->bahan_masuk_model->hapus_data($id);
        // $this->item_model->update_minus_stok($iditem);
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

            $data['record'] =  $this->bahan_masuk_model->laporan_periode($tanggal1, $tanggal2);
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/bahan/pembelian/laporan_bahan_masuk', $data);
            $this->load->view('templates_adm/footer');
        } else if (isset($_POST['cetak'])) {

            $tanggal1 =  $this->input->post('tanggal1');
            $tanggal2 =  $this->input->post('tanggal2');

            $pdf = new FPDF('p', 'mm', 'A4');
            $pdf->SetLeftMargin(18);
            $pdf->SetRightMargin(10);
            $pdf->AddPage();

            $pdf->SetFont('Arial', 'B', 14);

            $pdf->Cell(10, 10, '', 0, 1, 'L');
            $pdf->Image('assets_user/img/gallery/caa3p.png', 20, 20, 35, 30, '', '');
            $pdf->Cell(195, 7, 'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(195, 11, 'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ', 0, 1, 'C');
            $pdf->Ln(8.5);
            $pdf->Cell(180, 7, '_______________________________________________________________________________________', 0, 1, 'C');
            $pdf->Ln(8.5);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 7, 'LAPORAN PEMBELIAN PER PERIODE', 0, 1, 'C');
            $pdf->SetFont('Arial', 'I', 9);
            $pdf->Cell(10, 7, '', 0, 1, 'C');

            $pdf->Cell(180, 3, 'Dari :' . $tanggal1 . ' s/d ' . $tanggal2, 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(30, 6, 'Kode', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal Beli', 1, 0, 'C');
            $pdf->Cell(35, 6, 'Pemasok', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Nama Bahan', 1, 0, 'C');
            $pdf->Cell(15, 6, 'Jumlah', 1, 0, 'C');
            $pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Total Harga', 1, 1, 'C');

            $pdf->SetFont('Arial', '', 9);

            $bmasuk = $this->db->query("SELECT bahan_masuk.*,pemasok.*, item.*
            FROM bahan_masuk
            LEFT OUTER JOIN pemasok ON bahan_masuk.id_pemasok=pemasok.id_pemasok
            LEFT OUTER JOIN item ON bahan_masuk.id_item=item.id_item
            WHERE bahan_masuk.tgl_beli between '$tanggal1' and '$tanggal2'
            order by tgl_beli desc")->result();
            $tot = 0;

            foreach ($bmasuk as $row) {
                $pdf->Cell(30, 6, $row->id_bmasuk, 1, 0, 'C');
                $pdf->Cell(30, 6, $row->tgl_beli, 1, 0, 'C');
                $pdf->Cell(35, 6, $row->nama_pemasok, 1, 0);
                $pdf->Cell(30, 6, $row->nama_item, 1, 0, 'C');
                $pdf->Cell(15, 6,  $row->jumlah, 1, 0, 'C');
                $pdf->Cell(20, 6, 'Rp.' . number_format($row->harga_satuan), 1, 0, 'R');
                $pdf->Cell(25, 6, 'Rp.' . number_format($row->total_harga), 1, 1, 'R');
                $tot = $tot + $row->total_harga;
            }
            $pdf->Cell(160, 6, 'Total Pengeluaran', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Rp.' . number_format($tot), 1, 0, 'R');

            $pdf->Cell(10, 7, '', 0, 1, 'C');
            $bulan = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            );
            $kd_bulan = date('m');
            // for($i=1;$i<=12;$i++;){}
            $pdf->Cell(10, 7, '', 0, 1, 'C');
            $pdf->Cell(170, 7, 'Pekanbaru,' . date('d') . ' ' . $bulan[$kd_bulan] . ' ' . date('Y'), 0, 1, 'R');
            $pdf->Output();
        } else {
            $data['record'] =  $this->bahan_masuk_model->laporan();
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/bahan/pembelian/laporan_bahan_masuk', $data);
            $this->load->view('templates_adm/footer');
        }
    }
    public function laporan_seluruh()
    {
        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->SetLeftMargin(18);
        $pdf->SetRightMargin(10);
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(10, 10, '', 0, 1, 'L');
        $pdf->Image('assets_user/img/gallery/caa3p.png', 20, 20, 35, 30, '', '');
        $pdf->Cell(195, 7, 'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195, 11, 'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ', 0, 1, 'C');
        $pdf->Ln(8.5);
        $pdf->Cell(180, 7, '_______________________________________________________________________________________', 0, 1, 'C');
        $pdf->Ln(8.5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(180, 7, 'LAPORAN SELURUH PEMBELIAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(10, 7, '', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 6, 'Kode', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Tanggal Beli', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Pemasok', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Nama Bahan', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Total Harga', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 9);
        $bmasuk = $this->bahan_masuk_model->laporan()->result();

        // $bmasuk = $this->db->query("SELECT bahan_masuk.*,pemasok.*, item.*
        //     FROM bahan_masuk
        //     LEFT OUTER JOIN pemasok ON bahan_masuk.id_pemasok=pemasok.id_pemasok
        //     LEFT OUTER JOIN item ON bahan_masuk.id_item=item.id_item
        //     WHERE bahan_masuk.tgl_beli
        //     order by tgl_beli desc")->result();
        $total = 0;
        foreach ($bmasuk as $row) {
            $pdf->Cell(30, 6, $row->id_bmasuk, 1, 0, 'C');
            $pdf->Cell(30, 6, $row->tgl_beli, 1, 0, 'C');
            $pdf->Cell(35, 6, $row->nama_pemasok, 1, 0);
            $pdf->Cell(30, 6, $row->nama_item, 1, 0, 'C');
            $pdf->Cell(15, 6,  $row->jumlah, 1, 0, 'C');
            $pdf->Cell(20, 6, 'Rp.' . number_format($row->harga_satuan), 1, 0, 'R');
            $pdf->Cell(25, 6, 'Rp.' . number_format($row->total_harga), 1, 1, 'R');
            $total = $total + $row->total_harga;
        }
        $pdf->Cell(160, 6, 'Total Pengeluaran', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Rp.' . number_format($total), 1, 1, 'R');

        $pdf->Cell(10, 7, '', 0, 1, 'C');
        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $kd_bulan = date('m');
        // for($i=1;$i<=12;$i++;){}
        $pdf->Cell(10, 7, '', 0, 1, 'C');
        $pdf->Cell(170, 7, 'Pekanbaru,' . date('d') . ' ' . $bulan[$kd_bulan] . ' ' . date('Y'), 0, 1, 'R');
        $pdf->Output();
    }
}
