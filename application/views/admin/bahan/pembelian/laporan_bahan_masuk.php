<section class="content">
    <div class="card mb-3">
        <div class="card-header">
            <hr>

            <h4 align="center"> <b>LAPORAN PEMBELIAN BAHAN</b></h4><br>
            <h4 align="center"> <b>TOKO CAHAYA AGUNG ALUMINIUM</b></h4>
            <br>
            <hr>
        </div>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                </div>
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-md-6">

                                    <label for="exampleInputName2"><b>Dari Tanggal</b></label>
                                    <input type="date" name="tanggal1" class="form-control" required placeholder="Tanggal Mulai">

                                </div>
                                <div class="form-group col-md-6">

                                    <label for="exampleInputEmail2"> <b>Hingga Tanggal</b></label>
                                    <input type="date" name="tanggal2" class="form-control" required placeholder="Tanggal Selesai">
                                </div>

                            </div>
                            <div class="form-group text-center">
                                <button href="<?php echo site_url('admin/bahan_masuk/laporan') ?>" class="btn btn-primary btn-sm" type="submit" name="submit"><i class="fas fa-search"></i> Tampilkan</button>
                                <button href="<?php echo site_url('admin/bahan_masuk/laporan') ?>" class="btn btn-primary btn-sm" type="submit" name="cetak"><i class="fas fa-print"></i> Cetak</button>

                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Seluruh Pembelian Bahan</h6>
                        <p align="right"><a href="<?php echo site_url('admin/bahan_masuk/laporan_seluruh') ?>" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak Semua </a> &emsp; &emsp;</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr class="text-center">
                                    <th>Kode</th>
                                    <th>Pemasok</th>
                                    <th>Tanggal Beli</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $jumlah = 0;
                                foreach ($record->result() as $key => $data) { ?>
                                    <tr class="text-center">
                                        <td><?= $data->id_bmasuk ?></td>
                                        <td value="<?= $data->id_pemasok ?>"><?= $data->nama_pemasok ?></td>
                                        <td> <?= $data->tgl_beli ?></td>
                                        <td value="<?= $data->id_item ?>"><?= $data->nama_item ?></td>
                                        <td><?= $data->jumlah ?></td>
                                        <td>Rp. <?= number_format($data->harga_satuan, 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($data->total_harga, 0, ',', '.') ?></td>

                                    </tr>
                                <?php
                                    $total = $total + $data->total_harga;
                                }
                                ?>

                            </tbody>
                            <tr>
                                <td align="center" colspan="6"><b>Total</b></td>
                                <td colspan="1">Rp. <?= number_format($total, 0, ',', '.') ?></td>

                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

</section>