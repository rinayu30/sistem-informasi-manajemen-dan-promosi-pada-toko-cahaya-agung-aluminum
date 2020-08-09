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
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna</h6>
            </div>
                <div class="card-body">
                <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-4 offset-4">
                    <?php //echo validation_errors(); ?>
                    <form action="" method="post">
                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?> ">
                        <label for="nama">Nama *</label>
                        <input type="text" name="nama" value="<?=set_value('nama')?>" class="form-control" >
                        <?=form_error('nama')?>
                       
                        </div>

                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                        <label for="username">Nama Pengguna *</label>
                        <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                        <?=form_error('username')?>
                        </div>

                        <div class="form-group <?=form_error('pass') ? 'has-error' : null?>">
                        <label for="pass">Kata Sandi *</label>
                        <input type="password" name="pass" value="<?=set_value('pass')?>" class="form-control">
                        <?=form_error('pass')?>
                        </div>

                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                        <label for="passconf">Konfirmasi Kata Sandi *</label>
                        <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                        <?=form_error('passconf')?>
                        </div>

                        <div class="form-group <?=form_error('email') ? 'has-error' : null?>">
                        <label for="email">Alamat Email *</label>
                        <input type="text" name="email" value="<?=set_value('email')?>" class="form-control">
                        <?=form_error('email')?>
                        </div>

                        <div class="form-group <?=form_error('kontak') ? 'has-error' : null?>">
                        <label for="kontak">Nomor Kontak *</label>
                        <input type="text" name="kontak" value="<?=set_value('kontak')?>"class="form-control">
                        <?=form_error('kontak')?>
                        </div>

                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                        <label for="level">Level *</label>
                        <select name="level" class="form-control text-sm">
                            <option value="">--Pilih--</option>
                            <option value="1" <?=set_value('level') == 1 ? "selected" : null ?>>Admin</option>
                            <option value="2" <?=set_value('level') == 2 ? "selected" : null ?>>Karyawan</option>
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