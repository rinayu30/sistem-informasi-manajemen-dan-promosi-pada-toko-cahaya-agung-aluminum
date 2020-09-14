<section class="content">
    <div class="card mb-3">
        <div class="card-header">
            <hr>

            <h4 align="center"> <b>LAPORAN PEMBATALAN PESANAN</b></h4><br>
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
                                <button href="<?php echo site_url('admin/penjualan/laporan_batal_periode') ?>" class="btn btn-primary btn-sm" type="submit" name="submit"><i class="fas fa-search"></i> Tampilkan</button>
                                <button href="<?php echo site_url('admin/penjualan/cetak_batal_penjualan_periode') ?>" class="btn btn-primary btn-sm" type="submit" name="cetak"><i class="fas fa-print"></i> Cetak</button>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Seluruh Penjualan</h6>
                        <a href="<?php echo site_url('admin/penjualan/cetak_batal_penjualan') ?>" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak Semua</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr class="text-center">
                                    <th>No Faktur</th>
                                    <th>Pembeli</th>
                                    <th>PJ</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Pengembalian Uang</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($record->result() as $key => $data) { ?>
                                    <tr>
                                        <td width=2%><?= $data->kd_penjualan ?></td>
                                        <td class="text-center" value="<?= $data->id_pembeli ?>"><?= $data->nama_pembeli ?></td>
                                        <td class="text-center" value="<?= $data->id_user ?>"><?= $data->nama_user ?></td>
                                        <td class="text-center" width=10%><?= $data->tgl_penjualan ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->dp_awal, 0, ',', '.') ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('admin/penjualan/detail_batal/' . $data->kd_penjualan) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-info"></i> <b>Detail</b> </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table><br><small><i>*PJ : Penanggung Jawab</i></small>
                    </div>
                </div>
            </div>

        </div>

</section>