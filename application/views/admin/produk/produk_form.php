<?php $this->load->view('templates_adm/header') ?>
<?php $this->load->view('templates_adm/sidebar') ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-gray-800">Produk</h1><br />
    <a href="<?= site_url('admin/produk') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
    <!-- Page Heading -->

    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>
  <section class="content">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= ucfirst($page) ?> Produk</h6>
      </div>
      <div class="card-body">
        <div class="box-body table-responsive">
          <div class="row">
            <div class="col-md-4 offset-4">
              <?php echo form_open_multipart('admin/produk/proses') ?>
              <div class="form-group">
                <label for="kode">Kode produk</label>
                <input type="text" name="kode" value="<?= $row->kd_produk ?>" class="form-control" readonly>
              </div>

              <div class="form-group">
                <label for="nama">Nama produk*</label>
                <input type="text" name="nama" value="<?= $row->nama_produk ?>" class="form-control" required>
                <!-- <?= form_error('nama') ?> -->
              </div>

              <div class="form-group">
                <label for="gambar">Gambar</label>
                <?php if ($page == 'edit') {
                  if ($row->gambar != null) { ?>
                    <div style="margin-bottom: 5px;">
                      <img src="<?= base_url('uploads/produk/' . $row->gambar) ?>" style="width : 80%">
                    </div>
                <?php
                  }
                } ?>
                <!-- <input type="hidden" name="gambar_lama" value="<?= $row->gambar ?>" /> -->
                <input type="file" name="gambar" value="<?= $row->gambar ?>" class="form-control-file" />
                <small>(Biarkan kosong jika gambar tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?>)</small>
              </div>

              <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" min="0" name="stok" value="<?= $row->stok ?>" class="form-control">
              </div>

              <div class="form-group">
                <label for="kategori">Kategori</label>
                <div class="form-group">
                  <?php echo form_dropdown(
                    'kategori',
                    $kategori,
                    $selectedkategori,
                    ['class' => 'form-control', 'required' => 'required']
                  ); ?>
                </div>
                <!-- <input name="kategori" value="<?= $row->kategori ?>" class="form-control"> -->
              </div>

              <div class="form-group">
                <label for="ket">Keterangan</label>
                <textarea name="ket" value="<?= $row->detail ?>" class="form-control" required><?= $row->detail ?></textarea>
              </div>
              <br>

              <div class="form-group text-center">
                <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                <button type="submit" name="<?= $page ?>" class="btn btn-success btn-sm">Simpan</button>
              </div>
            </div>
            <!-- </form> -->
            <?php echo form_close() ?>
          </div>
        </div>

      </div>
    </div>
</div>
</section>
<!-- /.container-fluid -->
<!-- End of Page Wrapper -->
<?php $this->load->view('templates_adm/footer') ?>