<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="<?= site_url('admin/penjualan/laporan') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
                <a href="<?= site_url('admin/penjualan/laporan') ?>" class="btn btn-primary btn-sm"><i class="fa fa-print fa-sm"></i> Cetak Faktur</a>
            </div>
        </div><br>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan </h6>
            </div>
            <?php foreach ($record->result() as $key => $data) { ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-body" style="height: 100px;">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="tgl_jual">Tanggal Transaksi</label> </div>
                                <div class="form-group col-md-2">
                                    <label>:</label> </div>
                                <div class="form-group col-md-5">
                                    <?= $data->tgl_penjualan ?> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body" style="height: 100px;">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="tgl_jual">No Faktur </label> </div>
                                <div class="form-group col-md-2">
                                    <label>:</label> </div>
                                <div class="form-group col-md-5">
                                    <?= $data->kd_penjualan ?> </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="tgl_jual">Nama Pembeli</label> </div>
                                <div class="form-group col-md-2">
                                    <label>:</label> </div>
                                <div class="form-group col-md-5" value="<?= $data->id_pembeli ?>">
                                    <?= $data->nama_pembeli ?> </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
            <div class="card-body">
                <div class="box-body table-responsive">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <!-- <th>No Faktur</th>
                                <th>Pembeli</th> -->
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($record->result() as $key => $data) { ?>
                                <tr class="text-center">
                                    <td width=2%><?= $no ?></td>
                                    <td><?= $data->kd_produk ?>&emsp;|&emsp;<?= $data->nama_produk ?></td>
                                    <td>Rp. <?= number_format($data->harga_jual, 0, ',', '.') ?></td>
                                    <td><?= $data->jumlah ?></td>
                                    <td>Rp. <?= number_format($data->subtotal, 0, ',', '.') ?></td>

                                </tr>
                            <?php $no++;
                            } ?>

                            <tr class="gradeA text-right">
                                <td colspan="4">Total bayar</td>
                                <td>Rp. <?php
                                        echo number_format($data->tot_bayar, 0, ',', '.'); ?></td>

                            </tr>
                            <tr class="gradeA text-right">
                                <td colspan="4">Uang Muka</td>
                                <td>Rp. <?php
                                        echo number_format($data->dp_awal, 0, ',', '.'); ?></td>

                            </tr>
                            <tr class="gradeA text-right">
                                <td colspan="4">Sisa</td>
                                <td>Rp. <?php
                                        echo number_format($data->sisa, 0, ',', '.'); ?></td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>