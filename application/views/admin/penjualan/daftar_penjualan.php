<section class="content">
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Seluruh Penjualan</h6>
                    <p align="right"><a href="<?php echo site_url('admin/penjualan') ?>" class="btn btn-primary btn-sm"><i class="fas fa-undo"></i> Kembali </a> &emsp; &emsp;</p>

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
                                <th>Alamat Pengiriman</th>
                                <th>Tanggal Penjualan</th>
                                <th>Total Bayar</th>
                                <th>Uang Muka</th>
                                <th>Sisa</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody id="show_data">

                            <?php
                            $no = 1;
                            foreach ($record->result() as $key => $data) { ?>
                                <tr>
                                    <td width=2%><?= $data->kd_penjualan ?></td>
                                    <td class="text-center" value="<?= $data->id_pembeli ?>"><?= $data->nama_pembeli ?></td>
                                    <td class="text-center" value="<?= $data->id_user ?>"><?= $data->level == '3' ? 'Online' : $data->nama_user ?></td>
                                    <td width=5% class="text-center"><?= $data->alamat_kirim ?></td>
                                    <td class="text-center" width=10%><?= $data->tgl_penjualan ?></td>
                                    <td class="text-center">Rp. <?= number_format($data->tot_bayar, 0, ',', '.') ?></td>
                                    <td class="text-center">Rp. <?= number_format($data->dp_awal, 0, ',', '.') ?></td>
                                    <td class="text-center">Rp. <?= number_format($data->sisa, 0, ',', '.') ?></td>
                                    <!-- <td class="text-center"><?= $data->status_jual ?></td> -->
                                    <td class="text-center" width=3%>

                                        <?php if ($data->status_jual == '0') { ?>
                                            <span class="badge badge-primary">Proses</span>
                                            <a href='' class="btn btn-success btn-circle btn-sm" class="d-inline" data-target="#staticBackdrop<?php echo $data->kd_penjualan ?>" data-toggle="modal">

                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php } else if ($data->status_jual == '1') { ?>
                                            <span class="badge badge-success">Selesai</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Batal</span>
                                            <a href='' class="btn btn-success btn-circle btn-sm" class="d-inline" data-target="#staticBackdrop<?php echo $data->kd_penjualan ?>" data-toggle="modal">

                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php } ?>
                                        <!-- <a href='' id='btn-edit' class="btn btn-outline btn-circle btn-md purple" data-id='<?php echo $data->kd_penjualan; ?>'><i class="fa fa-edit"></i> </a> -->
                                    </td>

                                </tr>
                                <div class="modal fade" id="staticBackdrop<?php echo $data->kd_penjualan ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="<?= base_url('admin/penjualan/edit_status/' . $data->kd_penjualan) ?>" method="post">
                                                    <div class="form-group">
                                                        <label for="status_jual">Ubah Status Penjualan</label>
                                                        <select name="status_jual" class="form-control text-sm">
                                                            <option value="">--Pilih--</option>
                                                            <?php if ($data->status_jual == '-1') : ?>
                                                                <option value="-1" selected>Batal</option>
                                                                <option value="0">Proses</option>
                                                                <option value="1">Selesai</option>

                                                            <?php elseif ($data->status_jual == '0') : ?>
                                                                <option value="-1">Batal</option>
                                                                <option value="0" selected>Proses</option>
                                                                <option value="1">Selesai</option>
                                                            <?php else : ?>
                                                                <option value="-1">Batal</option>
                                                                <option value="0">Proses</option>
                                                                <option value="1" selected>Selesai</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                                                        <button class="btn btn-info btn-sm" id="btn_update" type="submit">Ubah Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Akhir Modal Edit Status--->
                                <?php } ?>

                        </tbody>
                    </table><br><small><i>*PJ : Penanggung Jawab</i></small>
                </div>
            </div>
        </div>

    </div>

</section>
<!-- Awal Modal Edit Status--->

<!-- Button trigger modal -->

<!-- Modal -->
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>
<script type="text/javascript">

</script>