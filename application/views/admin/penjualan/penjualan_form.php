<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Penjualan</h1><br />
        <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
        <!-- Page Heading -->
    </div>
    <section class="content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form <?= ucfirst($page) ?> Penjualan</h6>
            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-5 offset-1 justify-content-left">
                            <form action="<?= site_url('admin/penjualan/proses') ?>" method="post">
                                <div class="form-group">
                                    <label for="kd_produk">Kode Produk*</label>
                                    <select id="kd_produk" class="form-control" name="kd_produk" required>
                                        <option value="" selected hidden>---Pilih---</option>
                                        <?php
                                        $db = $this->db->get('produk');
                                        foreach ($db->result() as $data) {
                                        ?>
                                            <option value="<?php echo $data->kd_produk; ?>">
                                                <?php echo $data->kd_produk; ?>&emsp;:&emsp;
                                                <?php echo $data->nama_produk; ?>
                                            </option>
                                        <?php } ?>
                                    </select> <!-- <?= form_error('barang') ?> -->
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" min="0" name="jumlah" value="<?= $row->jumlah ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="uang_dp">Uang Muka</label>
                                    <input type="number" min="0" name="uang_dp" value="<?= $row->dp_awal ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="stok">Tanggal Penjualan</label>
                                    <input type="date" name="tgl_pej" value="<?= $row->tgl_penjualan ?>" class="form-control">
                                </div>
                        </div>
                        <div class="col-md-5 justify-content-right">
                            <div class="form-group">
                                <label for="kode">Kode Penjualan</label>
                                <input type="text" name="kode" value="<?= $row->kd_penjualan ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual <small>(Rp)</small></label>
                                <input type="number" name="harga_jual" value="<?= number_format($row->harga_jual, 0, ',', '.')  ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Total Bayar <small>(Rp)</small></label>
                                <input type="text" name="bayar" value="<?= $row->tot_bayar ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="sisa">Sisa Bayar <small>(Rp)</small></label>
                                <input type="text" name="sisa" value="<?= $row->sisa ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <p> </p>
                                <p> </p>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="<?= $page ?>" class="btn btn-success btn-sm">Simpan</button>
                                <button type="reset" class="btn btn-danger btn-sm">Reset</button>

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