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
        // require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
        $this->load->library('form_validation');
        // require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
        $this->load->library('pdf');
    }

    // public function index()
    // {

    //     $data['row'] = $this->penjualan_model->get();
    //     $this->load->view('templates_adm/header');
    //     $this->load->view('templates_adm/sidebar');
    //     $this->load->view('admin/penjualan/penjualan_data', $data);
    //     $this->load->view('templates_adm/footer');
    // }

    // public function index()
    // {

    //     $data['row'] = $this->penjualan_model->get_Detail();
    //     $this->load->view('templates_adm/header');
    //     $this->load->view('templates_adm/sidebar');
    //     $this->load->view('admin/penjualan/penjualan_form', $data);
    //     $this->load->view('templates_adm/footer');
    // }

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
        // $data = array(
        //     'page' => 'tambah',
        //     'row' => $penjualan,
        //     'detail' => $this->penjualan_model->get_Detail(),
        // );
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_form', $data);
        $this->load->view('templates_adm/footer');
    }

    function selesai_hitung()
    {
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
            'tot_bayar' => $data['bayar'],
            'dp_awal' => $dp_awal,
            'sisa' => $data['sisa'],
            'tgl_penjualan' => $tgl_penjualan,
            'tgl_pengiriman' => $tgl_penjualan,
            'status_jual' => '0',
        );

        $this->penjualan_model->selesai_hitung($data);
        $this->session->set_flashdata('success', ' Data Penjualan berhasil disimpan');
        redirect('admin/penjualan');
    }


    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah_jual'])) {
            $this->penjualan_model->add($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', ' Data berhasil disimpan');
        }
        redirect('admin/penjualan');
    }

    public function detail($id)
    {
        $data['record'] = $this->penjualan_model->detail($id);
        // $query = $this->penjualan_model->detail($id);
        // $row = $query->first_row();
        // if (isset($row)) {
        //     echo $row['tgl_penjualan'];
        //     echo $row['kd_penjualan'];
        //     echo $row['id_pembeli'];
        // }
        // $data['first'] = $this->penjualan_model->ambil($id);
        $data['info'] = $this->penjualan_model->ambil($id);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view('admin/penjualan/penjualan_detail', $data);
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

            $pdf = new FPDF('p','mm','A4');
            $pdf->SetLeftMargin(28);
            $pdf->AddPage();

            $pdf->SetFont('Arial','B',12);
            
            $pdf->Cell(150,7,'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(150,7,'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ',0,1,'C');
            $pdf->Ln(2.5);

            $pdf->Cell(10,7,'',0,1,'C');
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(30,6,'No FAKTUR',1,0,'C');
            $pdf->Cell(40,6,'PEMBELI',1,0,'C');
            $pdf->Cell(27,6,'TOTAL BAYAR',1,0,'C');
            $pdf->Cell(25,6,'UANG MUKA',1,0,'C');
            $pdf->Cell(25,6,'SISA',1,1,'C');
            $pdf->SetFont('Arial','',9);

            $record = $this->db->query("SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
            FROM penjualan
            LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
            WHERE penjualan.tgl_penjualan between '$tanggal1' and '$tanggal2'
            order by tgl_penjualan desc")->result();
                
            foreach ($record as $row){
                $pdf->Cell(30,6,$row->kd_penjualan,1,0,'C');
                $pdf->Cell(40,6,$row->nama_pembeli,1,0);
                $pdf->Cell(27,6,'Rp.'.number_format($row->tot_bayar),1,0);
                $pdf->Cell(25,6,'Rp.'.number_format($row->dp_awal),1,0); 
                $pdf->Cell(25,6,'Rp.'.number_format($row->sisa),1,1); 
            }
            $pdf->Output();
        
		
        } else {
            $data['record'] =  $this->penjualan_model->laporan_default();
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
            $this->load->library('dompdf_gen');
            $tanggal1 =  $this->input->post('tanggal1');
            $tanggal2 =  $this->input->post('tanggal2');
            $data['record'] = $this->db->query("SELECT p.no_penjualan,p.tgl_penjualan,u.nama_lengkap,sum(dp.jumlah_jual) as jml,sum(dp.harga_jual*dp.jumlah_jual) as total
                    FROM penjualan as p,detailpenjualan as dp,user as u
                    WHERE dp.no_penjualan=p.no_penjualan and u.id_user=p.id_user 
            		and p.tgl_penjualan between '$tanggal1' and '$tanggal2'
                    group by p.no_penjualan")->result();


            $html = $this->load->view("admin/penjualan/cetak_penjualan_periode", $data, true);

            $this->dompdf->load_html($html);

            $this->dompdf->set_paper('A4', 'potrait');
            $this->dompdf->render();


            // $pdf = dompdf->output();

            $this->dompdf->stream('laporan_penjualanbln.pdf', array("Attachchment" => false));
        } else {
            $data['record'] =  $this->penjualan_model->laporan_batal();
            $this->load->view('templates_adm/header');
            $this->load->view('templates_adm/sidebar');
            $this->load->view('admin/penjualan/laporan_batal', $data);
            $this->load->view('templates_adm/footer');
        }
    }


    
	public function cetak_penjualan(){
		
            // $this->load->view("admin/penjualan/cetak_penjualan", $data);
            
            $pdf = new FPDF('p','mm','A4');

            $pdf->SetLeftMargin(28);
            $pdf->AddPage();

            $pdf->SetFont('Arial','B',12);

            $pdf->Cell(150,7,'TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(150,7,'Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan ',0,1,'C');
            $pdf->Ln(2.5);

            $pdf->Cell(10,7,'',0,1,'C');
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(30,6,'No FAKTUR',1,0,'C');
            $pdf->Cell(40,6,'PEMBELI',1,0,'C');
            $pdf->Cell(27,6,'TOTAL BAYAR',1,0,'C');
            $pdf->Cell(25,6,'UANG MUKA',1,0,'C');
            $pdf->Cell(25,6,'SISA',1,1,'C');
            $pdf->SetFont('Arial','',9);

            $record = $this->db->query("SELECT kd_penjualan,pembeli.id_pembeli,pembeli.nama_pembeli,tgl_penjualan,tot_bayar,dp_awal,sisa,status_jual
            FROM penjualan
            LEFT OUTER JOIN pembeli ON penjualan.id_pembeli=pembeli.id_pembeli
            order by tgl_penjualan desc")->result(); 
                
            foreach ($record as $row){
                $pdf->Cell(30,6,$row->kd_penjualan,1,0,'C');
                $pdf->Cell(40,6,$row->nama_pembeli,1,0);
                $pdf->Cell(27,6,'Rp.'.number_format($row->tot_bayar),1,0);
                $pdf->Cell(25,6,'Rp.'.number_format($row->dp_awal),1,0); 
                $pdf->Cell(25,6,'Rp.'.number_format($row->sisa),1,1); 
            }
            $pdf->Output();
		
         
	}
}
