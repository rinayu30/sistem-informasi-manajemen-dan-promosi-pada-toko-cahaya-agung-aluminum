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
                                    <th>PJ</th>
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
                                        <td class="text-center" value="<?= $data->id_user ?>"><?= $data->nama_user ?></td>

                                        <td class="text-center" width=10%><?= $data->tgl_penjualan ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->tot_bayar, 0, ',', '.') ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->dp_awal, 0, ',', '.') ?></td>
                                        <td class="text-center">Rp. <?= number_format($data->sisa, 0, ',', '.') ?></td>
                                        <!-- <td class="text-center"><?= $data->status_jual ?></td> -->
                                        <td class="text-center" width=3%>

                                            <?php if ($data->status_jual == '0') { ?>
                                                <span class="badge badge-primary">Proses</span>
                                                <a href='' class="btn btn-success btn-circle btn-sm" class="d-inline" data-target="#staticBackdrop<?php $data->kd_penjualan; ?>" data-toggle="modal">

                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php } else if ($data->status_jual == '1') { ?>
                                                <span class="badge badge-success">Selesai</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Batal</span>
                                                <a href='' class="btn btn-success btn-circle btn-sm" class="d-inline" data-target="#staticBackdrop<?php $data->kd_penjualan; ?>" data-toggle="modal">

                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php } ?>
                                            <!-- <a href='' id='btn-edit' class="btn btn-outline btn-circle btn-md purple" data-id='<?php echo $data->kd_penjualan; ?>'><i class="fa fa-edit"></i> </a> -->
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= site_url('admin/penjualan/detail/' . $data->kd_penjualan) ?>" class="btn btn-info btn-sm">
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
<!-- Awal Modal Edit Status--->

<!-- Button trigger modal -->

<!-- Modal -->
<?php foreach ($record->result() as $key => $data) { ?>

    <div class="modal fade" id="staticBackdrop<?php $data->kd_penjualan; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/penjualan/proses_edit/' . $data->kd_penjualan) ?>" method="post">
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

                                <!-- <?php $status = $this->input->post('status_jual') ?? $data->status_jual ?>
                                <option value=" <?= $status == -1 ? 'selected' : null ?>">Batal</option>
                                <option value=" <?= $status == 0 ? 'selected' : null ?>">Proses</option>
                                <option value=" <?= $status == 1 ? 'selected' : null ?>">Selesai</option> -->
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                            <button class="btn btn-info btn-sm">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show_data').on('click', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('admin/penjualan/laporan') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $.each(data, function(kd_penjualan, status_jual) {
                            $('#ModalaEdit').modal('show');
                            $('[name="kd_penjualan"]').val(data.kd_penjualan);
                            $('[name="status_jual"]').val(data.status_jual);
                            // $('[name="harga_edit"]').val(data.barang_harga);
                        });
                    }
                });
                return false;
            });

        });
    </script>
    <!-- Akhir Modal Edit Status--->
    <!--
<div class="modal fade in" id="modal">
    <div class="modal-dialog moda-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                 <div class="modal-title">
                        <h5>Edit status penjualan</h5>
                    </div> 
            </div>
            <div class="modal-body">
                <form id="mb">
                    <input type="hidden" name="kd_penjualan" value="">

                    <div class="form-group">
                        <label for="status_jual">Ubah Status Penjualan</label>
                        <select name="status_jual" class="form-control text-sm">
                            < <?php $status = $this->input->post('status_jual') ?? $data->status_jual ?> -->
    <!-- <option value="-1" <?= $status == -1 ? 'selected' : null ?>>Batal</option>
                            <option value="0" <?= $status == 0 ? 'selected' : null ?>>Proses</option>
                            <option value="1" <?= $status == 1 ? 'selected' : null ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <button type="button" data-dismiss="modal">Batal</button>
                        <button type="button" id='btn' class="btn btn-success pull-right">Simapan</button>
                    </div> -->
    <!-- </form>
            </div>
        </div>
    </div>
</div> 
Akhir Modal Edit Status--->
    <!-- <script type="text/javascript">
        $(function() {
            $('#btn-edit').click(function(e) {
                e.preventDefault();
                $('#modal').modal({
                    backdrop: 'static',
                    show: true
                });
                id = $(this).data('id');
                // mengambil nilai data-id yang di click
                $.ajax({
                    url: 'admin/penjualan/proses_edit/' + id,
                    success: function(data) {
                        $("input[name='kd_penjualan']").val(data.id);
                        $("input[name='status_jual']").val(data.status_jual);
                        // $("textarea[name='alamat']").val(data.alamat);
                    }
                });
            });
        })
    </script> -->