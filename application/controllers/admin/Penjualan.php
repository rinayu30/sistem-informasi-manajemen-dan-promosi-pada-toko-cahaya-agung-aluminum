<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penjualan_model');
        // $this->load->library('form_validation');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }

    public function search()
    {
        $key = $this->input->post('keyword');
        $data['produk'] = $this->penjualan_model->get_keyword($key);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_form', $data);
        $this->load->view('templates_adm/footer');
    }
    public function index()
    {
        $id = $this->input->post('kd_produk');
        $penjualan = new stdClass();
        //field sesuai dengan database
        $penjualan->kd_penjualan = $this->penjualan_model->buat_kode_penjualan();
        $penjualan->kd_produk = null;
        $penjualan->jumlah = null;
        $penjualan->harga_jual = $this->penjualan_model->getHargaJual($id);
        // $penjualan->tot_bayar = $this->penjualan_model->getBayar();
        // $penjualan->dp_awal = null;
        // $penjualan->sisa = $this->penjualan_model->getSisa();
        // $penjualan->tgl_penjualan = null;
        // $penjualan->tgl_pengiriman = $this->penjualan_model->getTgl();
        // $data['detail'] = $this->penjualan_model->get_Detail($id);
        $data['detail'] = $this->penjualan_model->get_Dpenjualan();
        $data['row'] = $penjualan;
        $data['page'] = 'tambah';
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_form', $data);
        $this->load->view('templates_adm/footer');
    }

    function selesai_hitung()
    {
        $user =  $this->fungsi->user_login()->id_user;
        // $id_user =  $this->db->get_where('user', array('username' => $user))->row_array();

        // $kd_produk =  $this->input->post('kd_produk');
        $data['kd_penjualan'] = $this->penjualan_model->buat_kode_penjualan();
        $id = $this->penjualan_model->buat_kode_penjualan();
        $data['bayar'] = $this->penjualan_model->get_bayar($id);
        $data['sisa'] = $this->penjualan_model->get_sisa($id);
        $id_pembeli    =  $this->input->post('pembeli');
        $dp_awal    =  $this->input->post('uang_m');
        $tgl_penjualan    =  $this->input->post('tgl_pej');
        // $kd_produk    = $this->db->get_where('produk', array('kd_produk' => $kd_produk))->row_array();


        $data = array(
            'kd_penjualan' => $data['kd_penjualan'],
            'id_pembeli' => $id_pembeli,
            'id_user' => $user,
            'tot_bayar' => $data['bayar'],
            'dp_awal' => $dp_awal,
            'sisa' => $data['sisa'],
            'tgl_penjualan' => $tgl_penjualan,
            'status_jual' => '0',
        );

        $this->penjualan_model->selesai_hitung($data);
        $this->session->set_flashdata('success', ' Data Penjualan berhasil disimpan silahkan lihat pada menu Laporan Penjualan');
        redirect('admin/penjualan/daftar_penjualan');
    }
    //ubah status jual pake ajax
    function edit_status_jual($id)
    {
        // $id = $this->penjualan_model->buat_kode_penjualan();
        $status = $this->input->post('status_jual');
        $data = $this->penjualan_model->edit_status($id);
        echo json_encode($data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah_jual'])) {
            $this->penjualan_model->add($post);
        }
        // if (isset($_POST['edit_status'])) {
        //     $this->penjualan_model->edit_status($post);
        // }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Penjualan berhasil ditambahkan');
        }
        redirect('admin/penjualan');
    }

    public function edit_status()
    {

        $kode = $this->input->post('kd_penjualan');
        $status_jual = $this->input->post('status_jual');
        $this->penjualan_model->edit_status($status_jual, $kode);
        // echo json_encode($data);
        redirect('admin/penjualan/laporan');
        // $post = $this->input->post(null, TRUE);
        // if (isset($_POST['submit'])) {
        //     $this->penjualan_model->edit_status($post);
        // }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Status penjualan berhasil diubah');
        }
    }

    public function detail($id)
    {

        $data['record'] = $this->penjualan_model->detail($id);
        $data['info'] = $this->penjualan_model->ambil($id);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_detail', $data);
        $this->load->view('templates_adm/footer');
    }

    public function daftar_penjualan()
    {

        $data['record'] =  $this->penjualan_model->laporan_default();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/daftar_penjualan', $data);
        $this->load->view('templates_adm/footer');
    }

    public function detail_batal($id)
    {
        $data['record'] = $this->penjualan_model->detail($id);
        $data['info'] = $this->penjualan_model->ambil($id);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_batal_detail', $data);
        $this->load->view('templates_adm/footer');
    }

    public function delete($id)
    {
        $this->penjualan_model->hapus_data($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil dihapus');
        }
        redirect('admin/penjualan');
    }
    public function bulk_delete()
    {
        $id = $_POST['id_detail']; // Ambil data id_bahan yang dikirim oleh view.php melalui form submit
        $this->penjualan_model->bulk_delete($id); // Panggil fungsi delete dari model
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data yang ditandai berhasil dihapus');
        }
        redirect('admin/penjualan');
    }

    public function laporan()
    {

        $tanggal1 =  $this->input->post('tanggal1');
        $tanggal2 =  $this->input->post('tanggal2');

        if (isset($_POST['submit'])) {
            $tanggal1 =  $this->input->post('tanggal1');
            $tanggal2 =  $this->input->post('tanggal2');

            $data['record'] =  $this->penjualan_model->laporan_periode($tanggal1, $tanggal2);
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/penjualan/laporan', $data);
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
            $pdf->Cell(180, 7, 'LAPORAN PENJUALAN PER PERIODE', 0, 1, 'C');
            $pdf->SetFont('Arial', 'I', 9);
            $pdf->Cell(10, 7, '', 0, 1, 'C');

            $pdf->Cell(180, 3, 'Dari :' . $tanggal1 . ' s/d ' . $tanggal2, 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(30, 6, 'No FAKTUR', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal Penjualan', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Create by', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Pembeli', 1, 0, 'C');
            $pdf->Cell(27, 6, 'Total Bayar', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Uang Muka', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Sisa', 1, 1, 'C');

            $pdf->SetFont('Arial', '', 9);

            $record = $this->db->query("SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,user.id_user,user.nama_user,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
            FROM penjualan
            LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
            LEFT OUTER JOIN user ON penjualan.id_user=user.id_user

            WHERE penjualan.tgl_penjualan between '$tanggal1' and '$tanggal2'
            AND status_jual='1' order by tgl_penjualan desc")->result();
            $byr = 0;
            $awal = 0;
            $sisa = 0;
            foreach ($record as $row) {
                $pdf->Cell(30, 6, $row->kd_penjualan, 1, 0, 'C');
                $pdf->Cell(30, 6, $row->tgl_penjualan, 1, 0, 'C');
                $pdf->Cell(25, 6, $row->nama_user, 1, 0);
                $pdf->Cell(25, 6, $row->nama_pembeli, 1, 0);
                $pdf->Cell(27, 6, 'Rp.' . number_format($row->tot_bayar), 1, 0, 'R');
                $pdf->Cell(25, 6, 'Rp.' . number_format($row->dp_awal), 1, 0, 'R');
                $pdf->Cell(25, 6, 'Rp.' . number_format($row->sisa), 1, 1, 'R');
                $byr = $byr + $row->tot_bayar;
                $awal = $awal + $row->dp_awal;
                $sisa = $sisa + $row->sisa;
            }
            $pdf->Cell(110, 6, 'Total', 1, 0, 'C');
            $pdf->Cell(27, 6, 'Rp.' . number_format($byr), 1, 0, 'R');
            $pdf->Cell(25, 6, 'Rp.' . number_format($awal), 1, 0, 'R');
            $pdf->Cell(25, 6, 'Rp.' . number_format($sisa), 1, 0, 'R');
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
            $data['record'] =  $this->penjualan_model->laporan_default_selesai();
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/penjualan/laporan', $data);
            $this->load->view('templates_adm/footer');
        }
    }

    public function laporan_b()
    {
        $tanggal1 =  $this->input->post('tanggal1');
        $tanggal2 =  $this->input->post('tanggal2');

        if (isset($_POST['submit'])) {
            $tanggal1 =  $this->input->post('tanggal1');
            $tanggal2 =  $this->input->post('tanggal2');

            $data['record'] =  $this->penjualan_model->laporan_batal_periode($tanggal1, $tanggal2);
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/penjualan/laporan_batal', $data);
            $this->load->view('templates_adm/footer');
        } else if (isset($_POST['cetak'])) {
            // $this->load->library('dompdf_gen');
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
            $pdf->Cell(180, 7, 'LAPORAN PEMBATALAN PESANAN PER PERIODE', 0, 1, 'C');
            $pdf->SetFont('Arial', 'I', 9);
            $pdf->Cell(10, 7, '', 0, 1, 'C');
            $pdf->SetLeftMargin(30);
            $pdf->Cell(180, 3, 'Dari :' . $tanggal1 . ' s/d ' . $tanggal2, 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(30, 6, 'No FAKTUR', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal Penjualan', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Create by', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Pembeli', 1, 0, 'C');
            $pdf->Cell(45, 6, 'Pengembalian Uang Muka', 1, 1, 'C');

            $pdf->SetFont('Arial', '', 9);

            $record = $this->db->query("SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,user.id_user,user.nama_user,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
            FROM penjualan
            LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
            LEFT OUTER JOIN user ON penjualan.id_user=user.id_user
            WHERE penjualan.tgl_penjualan between '$tanggal1' and '$tanggal2' and status_jual ='-1'
            order by tgl_penjualan desc")->result();
            $awal = 0;
            foreach ($record as $row) {
                $pdf->Cell(30, 6, $row->kd_penjualan, 1, 0, 'C');
                $pdf->Cell(30, 6, $row->tgl_penjualan, 1, 0, 'C');
                $pdf->Cell(25, 6, $row->nama_user, 1, 0);
                $pdf->Cell(25, 6, $row->nama_pembeli, 1, 0);
                $pdf->Cell(45, 6, 'Rp.' . number_format($row->dp_awal), 1, 1, 'R');
                $awal = $awal + $row->dp_awal;
            }
            $pdf->Cell(110, 6, 'Total', 1, 0, 'C');
            $pdf->Cell(45, 6, 'Rp.' . number_format($awal), 1, 0, 'R');
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
            $data['record'] =  $this->penjualan_model->laporan_batal();
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/penjualan/laporan_batal', $data);
            $this->load->view('templates_adm/footer');
        }
    }



    public function cetak_penjualan()
    {
        // $this->load->view("admin/penjualan/cetak_penjualan", $data);
        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->SetLeftMargin(18);
        $pdf->SetRightMargin(10);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, '', 0, 1, 'L');
        $pdf->Image('assets_user/img/gallery/caa3p.png', 20, 20, 35, 30, '', '');
        $pdf->Cell(195, 7, 'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195, 11, 'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ', 0, 1, 'C');
        $pdf->Ln(8.5);
        $pdf->Cell(180, 7, '_______________________________________________________________________________________', 0, 1, 'C');
        $pdf->Ln(8.5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(180, 7, 'LAPORAN PENJUALAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 6, 'No FAKTUR', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Tanggal Penjualan', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Create by', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Pembeli', 1, 0, 'C');
        $pdf->Cell(27, 6, 'Total Bayar', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Uang Muka', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Sisa', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 9);

        $record = $this->penjualan_model->laporan_default()->result();
        $byr = 0;
        $awal = 0;
        $sisa = 0;
        foreach ($record as $row) {
            $pdf->Cell(30, 6, $row->kd_penjualan, 1, 0, 'C');
            $pdf->Cell(30, 6, $row->tgl_penjualan, 1, 0, 'C');
            $pdf->Cell(25, 6, $row->nama_user, 1, 0);
            $pdf->Cell(25, 6, $row->nama_pembeli, 1, 0);
            $pdf->Cell(27, 6, 'Rp.' . number_format($row->tot_bayar), 1, 0, 'R');
            $pdf->Cell(25, 6, 'Rp.' . number_format($row->dp_awal), 1, 0, 'R');
            $pdf->Cell(25, 6, 'Rp.' . number_format($row->sisa), 1, 1, 'R');
            $byr = $byr + $row->tot_bayar;
            $awal = $awal + $row->dp_awal;
            $sisa = $sisa + $row->sisa;
        }
        $pdf->Cell(110, 6, 'Total', 1, 0, 'C');
        $pdf->Cell(27, 6, 'Rp.' . number_format($byr), 1, 0, 'R');
        $pdf->Cell(25, 6, 'Rp.' . number_format($awal), 1, 0, 'R');
        $pdf->Cell(25, 6, 'Rp.' . number_format($sisa), 1, 0, 'R');
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
        $pdf->Cell(10, 10, '', 0, 1, 'C');
        $pdf->Cell(170, 7, 'Pekanbaru,' . date('d') . ' ' . $bulan[$kd_bulan] . ' ' . date('Y'), 0, 1, 'R');
        $pdf->Output();
    }


    public function cetak_batal_penjualan()
    {
        // $this->load->view("admin/penjualan/cetak_penjualan", $data);
        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->SetLeftMargin(18);
        $pdf->SetRightMargin(10);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, '', 0, 1, 'L');
        $pdf->Image('assets_user/img/gallery/caa3p.png', 20, 20, 35, 30, '', '');
        $pdf->Cell(195, 7, 'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195, 11, 'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ', 0, 1, 'C');
        $pdf->Ln(8.5);
        $pdf->Cell(180, 7, '_______________________________________________________________________________________', 0, 1, 'C');
        $pdf->Ln(8.5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(180, 7, 'LAPORAN PEMBATALAN PESANAN', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1, 'C');
        $pdf->SetLeftMargin(35);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 6, 'No FAKTUR', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Tanggal Penjualan', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Create by', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Pembeli', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Pengembalian Uang Muka', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 9);

        $record = $this->penjualan_model->laporan_batal()->result();
        $awal = 0;
        foreach ($record as $row) {
            $pdf->Cell(30, 6, $row->kd_penjualan, 1, 0, 'C');
            $pdf->Cell(30, 6, $row->tgl_penjualan, 1, 0, 'C');
            $pdf->Cell(25, 6, $row->nama_user, 1, 0);
            $pdf->Cell(25, 6, $row->nama_pembeli, 1, 0);
            $pdf->Cell(45, 6, 'Rp.' . number_format($row->dp_awal), 1, 1, 'R');
            $awal = $awal + $row->dp_awal;
        }
        $pdf->Cell(110, 6, 'Total', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Rp.' . number_format($awal), 1, 0, 'R');
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
        $pdf->Cell(10, 10, '', 0, 1, 'C');
        $pdf->SetLeftMargin(15);
        $pdf->Cell(150, 7, 'Pekanbaru,' . date('d') . ' ' . $bulan[$kd_bulan] . ' ' . date('Y'), 0, 1, 'R');
        $pdf->Output();
    }
    public function cetak_faktur($id)
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        $pdf->SetLeftMargin(18);
        $pdf->SetRightMargin(10);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(5, 10, '', 0, 1, 'L');
        $pdf->Image('assets_user/img/gallery/caa3p.png', 10, 10, 25, 20, '', 'C');
        $pdf->SetLeftMargin(18);
        $pdf->Cell(180, 5, 'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(180, 11, 'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ', 0, 1, 'C');
        $pdf->Cell(150, 10, '________________________________________________________________________________________________________________________________________________________', 0, 1, 'C');
        $pdf->Ln(1.5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(180, 7, 'FAKTUR PEMBELIAN PRODUK', 0, 1, 'C');
        $pdf->Cell(10, 4, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetLeftMargin(30);
        $info = $this->penjualan_model->ambil($id);
        foreach ($info->result() as $row) {
            $pdf->Cell(200, 3, 'Tgl. Transaksi       ' . '  :   ' . $row->tgl_penjualan . '                                               No Faktur           ' . '     :   ' . $row->kd_penjualan, 0, 1, 'L');
            $pdf->Cell(10, 3, '', 0, 1, 'C');
            $pdf->Cell(90, 3, 'Dibuat oleh          ' . '   :   ' . $row->nama_user . '                                                      Pembeli             ' . '      :   ' . $row->nama_pembeli, 0, 1, 'L');
            $pdf->Cell(10, 5, '', 0, 1, 'C');
        }
        $pdf->SetLeftMargin(35);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(52, 6, 'Nama Produk', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Harga', 1, 0, 'C');
        $pdf->Cell(27, 6, 'Total Harga', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 9);

        $record = $this->penjualan_model->detail($id);
        $byr = 0;

        $sisa = 0;
        $no = 1;
        foreach ($record->result() as $row) {
            $pdf->Cell(8, 6, $no, 1, 0, 'C');
            $pdf->Cell(52, 6, $row->nama_produk, 1, 0, 'C');
            $pdf->Cell(25, 6, $row->jumlah, 1, 0, 'C');
            $pdf->Cell(25, 6, 'Rp.' . number_format($row->harga_jual), 1, 0, 'R');
            $pdf->Cell(27, 6, 'Rp.' . number_format($row->subtotal), 1, 1, 'R');

            $no++;
            $byr = $byr + $row->subtotal;
            $awal = $row->dp_awal;
            $sisa = $byr - $awal;
        }
        $pdf->Cell(110, 6, 'Total', 1, 0, 'R');
        $pdf->Cell(27, 6, 'Rp.' . number_format($byr), 1, 1, 'R');
        $pdf->Cell(110, 6, 'Dibayar', 1, 0, 'R');
        $pdf->Cell(27, 6, 'Rp.' . number_format($awal), 1, 1, 'R');
        $pdf->Cell(110, 6, 'Sisa Pembayaran', 1, 0, 'R');
        $pdf->Cell(27, 6, 'Rp.' . number_format($sisa), 1, 1, 'R');

        $pdf->Ln(2.5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(150, 11, 'Terima Kasih Telah Membeli Produk Kami ', 0, 1, 'C');

        $pdf->Output();
    }
}
