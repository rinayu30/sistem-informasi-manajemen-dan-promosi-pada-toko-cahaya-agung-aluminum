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
                                <button href="<?php echo site_url('admin/penjualan/cetak_penjualan_periode') ?>" class="btn btn-primary btn-sm" type="submit" name="cetak"><i class="fas fa-print"></i> Cetak</button>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Seluruh Penjualan</h6>
                </div>
                <div class="card-body">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No Faktur</th>
                                    <th>Pembeli</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Total Bayar</th>
                                    <th>Uang Muka</th>
                                    <th>Sisa</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
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
                                        </td>

                                        <td class="text-center" width=22%>
                                            <a href="<?= site_url('admin/penjualan/edit_status/' . $data->kd_penjualan) ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i> Edit Status</a>
                                            <a href="<?= site_url('admin/penjualan/detail/' . $data->kd_penjualan) ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search-plus"></i> Detail</a>

                                            <!-- <input type="hidden" name="id_kategori" value="<?= $data->id_kategori ?>">
                                    <button onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Hapus
                                    </button> -->

                                            <!-- <td onclick="javascript : return confirm('Anda yakin menghapus data?')"><?php echo anchor('admin/pengguna/delete/' . $data->id_user) ?>,'<div class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></div></td> -->
                                            <!-- <a href="#modalDel" data-toggle="modal" onclick="$('#modalDel #formDel').attr('action','<?= site_url('admin/pengguna/delete/' . $data->id_user) ?>')" class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></a></i> -->
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