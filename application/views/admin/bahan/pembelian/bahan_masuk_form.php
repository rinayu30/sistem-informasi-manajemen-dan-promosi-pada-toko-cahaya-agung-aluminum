<?php $this->load->view('templates_adm/header') ?>
<?php $this->load->view('templates_adm/sidebar') ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-gray-800">Pembelian</h1><br />
    <a href="<?= site_url('admin/bahan_masuk') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
    <!-- Page Heading -->

    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>
  <section class="content">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form <?= ucfirst($page) ?> Bahan Masuk</h6>
      </div>
      <div class="card-body">
        <div class="box-body table-responsive">
          <div class="row">
            <div class="col-md-4 offset-4">
              <form action="<?= site_url('admin/bahan_masuk/proses') ?>" method="post">
                <div class="form-group">
                  <label for="name">Tanggal Pembelian*</label>
                  <input class="form-control" type="date" name="tgl_beli" value="<?= $row->tgl_beli ?>" required>
                </div>
                <div class="form-group">
                  <label for="kode">Kode Bahan Masuk</label>
                  <input type="text" name="kode" value="<?= $row->id_bmasuk ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="pemasok">Pemasok *</label>
                  <?php echo form_dropdown(
                    'pemasok',
                    $pemasok,
                    $selectedpemasok,
                    ['class' => 'form-control', 'required' => 'required']
                  ); ?>
                </div>

                <div class="form-group">
                  <label for="item">Nama item *</label>
                  <?php echo form_dropdown(
                    'item',
                    $item,
                    $selecteditem,
                    ['class' => 'form-control', 'required' => 'required']
                  ); ?>
                </div>

                <div class="form-group">
                  <label for="satuan">Satuan</label>
                  <select name="satuan" class="form-control text-sm">
                    <?php $satuan = $this->input->post('satuan') ?? $row->satuan ?>
                    <option value="">--Pilih--</option>
                    <option value="1">meter</option>
                    <option value="2" <?= $satuan == 2 ? 'selected' : null ?>>pcs</option>
                  </select>
                  <!-- <input type="text" name="satuan" value="<?= $row->satuan ?>" class="form-control" required> -->
                </div>

                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" min="0" name="jumlah" value="<?= $row->jumlah ?>" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" min="0" name="harga" value="<?= $row->harga_satuan ?>" class="form-control" required>
                </div>

                <!-- <div class="form-group">
                        <label for="total">Total Harga</label>
                        <input type="number" min="0" name="total" value="<?= $row->total_harga ?>" class="form-control" required>
                        </div> -->
                <br>

                <div class="form-group text-center">
                  <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                  <button type="submit" name="<?= $page ?>" class="btn btn-success btn-sm">Simpan</button>
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
<?php $this->load->view('templates_adm/footer') ?>