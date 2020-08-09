<?php $this->load->view('templates_adm/header')?>
<?php $this->load->view('templates_adm/sidebar')?>
        <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Pengguna</h1><br/>
        <a href="<?=site_url('admin/pengguna')?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
          <!-- Page Heading -->
          
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>
          <section class="content">
          <!-- <?php $this->view('messages') ?> -->
          <div class="card shadow mb-4">  
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Pengguna</h6>
            </div>
                <div class="card-body">
                <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-4 offset-4">
                    <form action="" method="post">
                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?> ">
                        <label for="nama">Nama *</label>
                        <input type="hidden" name ="id_user" value="<?=$row->id_user?>">
                        <input type="text" name="nama" value="<?=$this->input->post('nama') ?? $row->nama_user ?>" class="form-control" >
                        <?=form_error('nama')?>
                        </div>

                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                        <label for="username">Nama Pengguna *</label>
                        <input type="text" name="username" value="<?=$this->input->post('username') ?? $row->username ?>" class="form-control">
                        <?=form_error('username')?>
                        </div>

                        <div class="form-group <?=form_error('pass') ? 'has-error' : null?>">
                        <label for="pass">Kata Sandi</label><small>(Biarkan kosong, jika tidak diganti)</small>
                        <input type="password" name="pass" value="<?=$this->input->post('pass') ?>" class="form-control">
                        <?=form_error('pass')?>
                        </div>

                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                        <label for="passconf">Konfirmasi Kata Sandi</label>
                        <input type="password" name="passconf" value="<?=$this->input->post('passconf')?>" class="form-control">
                        <?=form_error('passconf')?>
                        </div>

                        <div class="form-group <?=form_error('email') ? 'has-error' : null?>">
                        <label for="email">Alamat Email *</label>
                        <input type="text" name="email" value="<?=$this->input->post('email') ?? $row->email ?>" class="form-control">
                        <?=form_error('email')?>
                        </div>

                        <div class="form-group <?=form_error('kontak') ? 'has-error' : null?>">
                        <label for="kontak">Nomor Kontak *</label>
                        <input type="text" name="kontak" value="<?=$this->input->post('kontak') ?? $row->no_telp ?>"class="form-control">
                        <?=form_error('kontak')?>
                        </div>

                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?>">
                        <label for="nama">Level</label>
                        <select name="level" class="form-control text-sm">
                        <?php $level = $this->input->post('level') ?? $row->level ?>
                            <option value="1">Admin</option>
                            <option value="2" <?=$level == 2 ? 'selected' : null ?>>Karyawan</option>
                        </select>
                        <?=form_error('level')?>
                        <br>

                        <div class="form-group text-center">
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            
                </div>
            </div>
            </div>
          </section>      
        <!-- /.container-fluid -->
  <!-- End of Page Wrapper -->

<?php $this->load->view('templates_adm/footer')?>