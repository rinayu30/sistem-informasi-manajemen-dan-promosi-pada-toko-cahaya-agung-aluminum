 <!-- Begin Page Content -->
 <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Produk</h1><br/>
        <a href="<?=site_url('admin/produks/add')?>" class="btn btn-primary btn-sm"><i class="fas fa-user-plus fa-sm"></i> Tambah Data</a>
        </div>
<!-- DataTales Example -->
<div class="card shadow mb-4">  
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Gambar</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th colspan="3"><center>Aksi</center></th>
          </tr>
        </thead> 
        <?php 
        $no=1;
        foreach ($produks as $produk): ?>
        <tr>
            <td> <?php echo $no++ ?> </td>
            <td> <?php echo $produk->kd_produk ?> </td>
            <td> <?php echo $produk->nama_produk ?> </td>
            <td> <img src="<?php echo base_url('upload/produk/'.$produk->gambar) ?>" width="64" /> </td>
            <td> <?php echo $produk->stok ?> </td>    
           <!-- <td> <?php echo $produk->harga_modal ?> </td>   -->  
            <!--<td> <?php echo $produk->harga_jual ?> </td> -->
            <td> <?php echo $produk->kategori ?> </td> 
            <td> <?php echo $produk->detail ?> </td>  
            <td><?php echo anchor ('admin/produks/detail/'.$produk->kd_produk,'<div class ="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></div>')?></td> 
            <td><?php echo anchor ('admin/produks/edit/'.$produk->kd_produk, '<div class ="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>')?></td> 
            <td onclick="javascript : return confirm('Anda yakin menghapus data?')"><?php echo anchor('admin/produks/delete/'.$produk->kd_produk, '<div class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></div>')?></td>     
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  </div>
</div>
        </div>
        <!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Data Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <form action="<?php echo base_url().'admin/produks/add';?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
								<label for="kd_produk">Kode Produk</label>
								<input class="form-control <?php echo form_error('kd_produk') ? 'is-invalid':'' ?>"
								 type="text" name="kd_produk" placeholder="Kode produk" />
								<div class="invalid-feedback">
									<?php echo form_error('kd_produk') ?>
								</div>
							</div>

              <div class="form-group">
								<label for="nama_produk">Nama Produk</label>
								<input class="form-control <?php echo form_error('nama_produk') ? 'is-invalid':'' ?>"
								 type="text" name="nama_produk" placeholder="Nama produk" />
								<div class="invalid-feedback">
									<?php echo form_error('nama_produk') ?>
								</div>
							</div>

              <div class="form-group">
								<label for="name">Gambar <div class="small text-muted">
								Ukuran file harus kecil dari 2 MB
							</div>
							</label>
								<input type="file" name="gambar">
								</div>
              <div class="form-group">
								<label for="stok">Stok*</label>
								<input class="form-control <?php echo form_error('stok') ? 'is-invalid':'' ?>"
								 type="number" name="stok" min="0" placeholder="Stok produk" />
								<div class="invalid-feedback">
									<?php echo form_error('stok') ?>
								</div>
							</div>

            	<div class="form-group">
								<label for="kategori">Kategori</label>
								<input class="form-control <?php echo form_error('kategori') ? 'is-invalid':'' ?>"
								 type="text" name="kategori" placeholder="" />
								<div class="invalid-feedback">
									<?php echo form_error('kategori') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="name">Keterangan</label>
								<textarea class="form-control <?php echo form_error('detail') ? 'is-invalid':'' ?>"
								 name="detail" placeholder="Detail produk..."></textarea>
								<div class="invalid-feedback">
								</form>
								</div>
							</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <button type="submit" class="btn btn-success" name="btn">Simpan</button>
      </div>
      <?php echo form_close();?>

    </div>
  </div>
</div>


<!-- edit -->
<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("templates_adm/header.php") ?>
</head>

<body id="page-top">


		<?php $this->load->view("templates_adm/sidebar.php") ?>

			<div class="container-fluid">

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/produks/') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">

					<?php echo form_open_multipart('admin/produks/add');?>
                        <input type="hidden" name="kd_produk" value="<?php echo $produk->kd_produk?>" />

                            <div class="form-group">
								<label for="nama_produk">Nama Produk</label>
								<input class="form-control <?php echo form_error('nama_produk') ? 'is-invalid':'' ?>"
								 type="text" name="nama_produk" placeholder="Nama produk" value="<?php echo $produk->nama_produk ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('nama_produk') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="name">Gambar
								<div class="small text-muted">
								Ukuran file harus kecil dari 2 MB
							</div>
								</label>
								<input class="form-control-file <?php echo form_error('gambar') ? 'is-invalid':'' ?>"
								 type="file" name="gambar" />
                                 <input type="hidden" name="old_image" value="<?php echo $produk->gambar ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('gambar') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="stok">Stok*</label>
								<input class="form-control <?php echo form_error('stok') ? 'is-invalid':'' ?>"
								 type="number" name="stok" min="0" placeholder="Stok produk" value="<?php echo $produk->stok ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('stok') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="kategori">Kategori</label>
								<input class="form-control <?php echo form_error('kategori') ? 'is-invalid':'' ?>"
								 type="text" name="kategori" placeholder="" value="<?php echo $produk->kategori ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('kategori') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="name">Keterangan</label>
								<textarea class="form-control <?php echo form_error('detail') ? 'is-invalid':'' ?>"
								 name="detail" placeholder="Keterangan produk..."><?php echo $produk->detail ?></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('detail') ?>
								</div>
							</div>

							<button type="submit" class="btn btn-success" name="btn">Simpan</button>
							<?php echo form_close();?>
					</div>

					<!--<div class="card-footer small text-muted">
						* harus diisi
					</div>-->


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("templates_adm/footer.php") ?>

			<!-- /.content-wrapper -->

	
		<!-- /#wrapper -->

</body>

</html>

<!-- Controller -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
       $this->load->library('form_validation');
    }

    public function index()
    {
        $data["produks"] = $this->produk_model->getAll();
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view("admin/produk/daftar_produk", $data);
        $this->load->view('templates_adm/footer');
       
    }

    public function detail($id_pro)
    {
        
        $data["produks"] = $this->produk_model->tampil($id_pro);
        $this->load->view('templates_adm/header');
        $this->load->view('templates_adm/sidebar');
        $this->load->view("admin/produk/detail", $data);
        $this->load->view('templates_adm/footer');
       
    }

    public function add()
    {
        $produk = $this->produk_model;
        $validation = $this->form_validation;

        //$this->form_validation->set_rules('kd_produk', 'Kd_produk', 'required');
        //$this->form_validation->set_rules('nama_produk', 'Nama_produk', 'required');
        //$this->form_validation->set_rules('stok', 'Stok', 'required');
        //$this->form_validation->set_rules('kategori', 'Kategori', 'required');

        $validation->set_rules($produk->rules());

        if($validation->run())
        {
            $produk->save();
            $this->session->set_flashdata('success','Produk berhasil disimpan');     
        }
       // $this->load->view("admin/produk/form_baru");
       $data["produks"] = $this->produk_model->getAll();
       if (!$data["produks"]) show_404();
       redirect('admin/produks/index');
    }

    public function edit($id)
    {
        //$where = array('kd_produk' => $id);
        //$data['produks']= $this->produk_model->update();
        if(!isset($id)) redirect('admin/produks');
        $produk = $this->produk_model;
       $validation=$this->form_validation;
       $validation->set_rules($produk->rules());
       if($validation->run()){
            $produk->update();
            $this->session->set_flashdata('success', 'Produk berhasil disimpan'); 
        }
        $data["produk"] = $produk->getById($id);
        if(!$data["produk"]) show_404();
        $this->load->view("admin/produk/edit_form", $data);
        //redirect('admin/produks/index');
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->produk_model->delete($id))
        {
            redirect(site_url('admin/produks'));
        }
    }
}

// model



//  class Produk_model extends CI_Model
//  {
     private $_table = "produk";
    

     public $kd_produk;
     public $nama_produk;
     public $gambar ="default.jpg";
     public $stok;
     public $kategori;
     public $detail;  
     
     public function rules()
     {
        return[

            ['field'=>'kd_produk',
            'label'=>'Kd_produk',
            'rules'=>'required'],

            ['field'=>'nama_produk',
            'label'=>'Nama_produk',
            'rules'=>'required'],

            ['field'=>'stok',
            'label'=>'Stok',
            'rules'=>'required'],

            ['field'=>'kategori',
            'label'=>'Kategori',
            'rules'=>'required'],

            ['field'=>'detail',
            'label'=>'Detail',
            'rules'=>'required']
        ];

     }

     public function getAll()
     {
         return $this->db->get($this->_table)->result();
     }

     public function getById($id)
     {
         return $this->db->get_where($this->_table, ["kd_produk" => $id])->row();
     }

     public function save()
     {
         $post = $this->input->post();
         $this->kd_produk = $post["kd_produk"];
         $this->nama_produk = $post["nama_produk"];
         $this->gambar=$this->_uploadImage();
         $this->stok = $post["stok"];
         $this->kategori = $post["kategori"];
         $this->detail = $post["detail"];
         return $this->db->insert($this->_table, $this);
     }
     public function update()
     {
         $post = $this->input->post();
         $this->kd_produk = $post["kd_produk"];
         $this->nama_produk = $post["nama_produk"];

         if (!empty($_FILES["gambar"]["nama_produk"]))
         {
             $this->gambar=$this->_uploadImage();
         }else {
             $this->gambar = $post["old_image"];
         }
         $this->stok = $post["stok"];
         $this->kategori = $post["kategori"];
         $this->detail = $post["detail"];
         return $this->db->update($this->_table, $this, array('kd_produk' => $post['kd_produk']));
     }
     public function delete($id)
     {
         $this->_deleteImage($id);
        return $this->db->delete($this->_table, array("kd_produk" => $id));
     }

     private function _uploadImage()//private karena dipanggil dari class sendiri
    {
        $config['upload_path']          = './upload/produk/';//lokasi alamat path
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->kd_produk; //nama file
        $config['overwrite']			= true; //menindih file yg terupload
        $config['max_size']             = 1024; // 1MB,ukuran file
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);//konfigurasi ditentukan

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
    
        return "default.jpg";
    }

    private function _deleteImage($id)
    {
        $produk = $this->getById($id);
        if ($produk->gambar != "default.jpg"){
            $filename = explode(".", $produk->gambar)[0];
            return array_map('unlink', glob(FCPATH."upload/produk/$filename.*"));
        }
    }

    public function tampil($id_pro)
     {
        $result=$this->db->where('kd_produk', $id_pro)->get('produk');
        if ($result->num_rows() > 0)
        {
            return $result->result();
        }else
        {
            return false;
        }
        return $this->db->delete($this->_table, array("kd_produk" => $id));
     }
/*
     <select name="kode" class="form-control" id="">
                <option value="">--Pilih--</option>
                <!-- <?php foreach($query_produk->result() as $kd => $data) {?>
                    <option value="<?=$data->kd_produk?>"><?=$data->nama_produk?></option>
                <?php }?> -->
                </select>