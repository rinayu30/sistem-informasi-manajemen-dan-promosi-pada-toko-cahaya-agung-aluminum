<section class="content">
    <div class="card mb-3">
        <div class="card-header">
            <hr>

            <h4 align="center"> <b>LAPORAN PENJUALAN</b></h4><br>
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
                                <button href="<?php echo site_url('admin/penjualan/laporan') ?>" class="btn btn-primary btn-sm" type="submit" name="submit"><i class="fas fa-search"></i> Tampilkan</button>
                                <button href="<?php echo site_url('admin/penjualan/laporan') ?>" class="btn btn-primary btn-sm" type="submit" name="cetak"><i class="fas fa-print"></i> Cetak</button>
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
                        <!-- <button href="<?php echo site_url('admin/penjualan/cetak_penjualan_semua') ?>" class="btn btn-primary btn-sm" type="submit" name="cetak"><i class="fas fa-print"></i> Cetak Semua</button> -->
                        <p align="right"><a href="<?php echo site_url('admin/penjualan/cetak_penjualan') ?>" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak Semua </a> &emsp; &emsp;</p>

                    </div>
                </div>
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr class="text-center">
                                    <th>No Faktur</th>
                                    <th>Pembeli</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Total Bayar</th>
                                    <th>Uang Muka</th>
                                    <th>Sisa</th>
                                    <th>Status</th>
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
                                        <td class="text-center" width=10%><?= $data->tgl_penjualan ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->tot_bayar, 0, ',', '.') ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->dp_awal, 0, ',', '.') ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->sisa, 0, ',', '.') ?></td>
                                        <!-- <td class="text-center"><?= $data->status_jual ?></td> -->
                                        <td class="text-center" width=3%>
                                            <?php if ($data->status_jual == '0') { ?>
                                                <span class="badge badge-primary">Proses</span>
                                            <?php } else if ($data->status_jual == '1') { ?>
                                                <span class="badge badge-success">Selesai</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Batal</span>
                                            <?php } ?>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticBackdrop<?= $data->kd_penjualan ?>"><i class="fas fa-edit"></i></button>

                                        </td>
                                        <td class="text-center">
                                            <a href="<?= site_url('admin/penjualan/detail/' . $data->kd_penjualan) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-info"></i> <b>Detail</b> </a>



                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

</section>
<!-- Awal Modal Edit Status--->

<!-- Button trigger modal -->

<!-- Modal -->
<?php
$no = 1;
foreach ($record->result() as $key => $data) { ?>
    <div class="modal fade" id="staticBackdrop<?= $data->kd_penjualan ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status_jual">Ubah Status Penjualan</label>
                        <select name="status_jual" class="form-control text-sm">
                            <?php $status = $this->input->post('status_jual') ?? $data->status_jual ?>
                            <option value="-1" <?= $status == -1 ? 'selected' : null ?>>Batal</option>
                            <option value="0" <?= $status == 0 ? 'selected' : null ?>>Proses</option>
                            <option value="1">Selesai</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Akhir Modal Edit Status--->