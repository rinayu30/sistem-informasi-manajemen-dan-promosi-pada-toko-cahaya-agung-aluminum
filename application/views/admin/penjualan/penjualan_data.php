        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Penjualan</h1><br />
                <a href="<?= site_url('admin/penjualan/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Penjualan</a>
                <!-- Page Heading -->

                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <section class="content">
                <?php $this->view('messages') ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data penjualan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kode penjualan</th>
                                        <th class="text-center">Pembeli</th>
                                        <th class="text-center">Total Bayar</th>
                                        <th class="text-center">Sisa Bayar</th>
                                        <th class="text-center">Tanggal Penjualan</th>
                                        <th class="text-center">Tanggal Pengiriman</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="10%">Kode penjualan</td>
                                        <td>Pembeli</td>
                                        <td>Total Bayar</td>
                                        <td>Sisa Bayar</td>
                                        <td width="10%">Tanggal Penjualan</td>
                                        <td width="10%">Tanggal Pengiriman</td>
                                        <td>Status</td>
                                        <td width="14%" class="text-center">Aksi</td>
                                    </tr>
                                </tbody>

                                <!-- <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($row->result() as $key => $data) { ?>
                                        <tr>
                                            <td width="2%"><?= $no++ ?></td>
                                            <td><?= $data->nama_penjualan ?></td>
                                            <td class="text-center"><?= $data->jk ?></td>
                                            <td><?= $data->no_telp ?></td>
                                            <td><?= $data->alamat ?></td>
                                            <td class="text-center">
                                                <a href="<?= site_url('admin/penjualan/edit/' . $data->id_penjualan) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit</a>
                                                <a href="<?= site_url('admin/penjualan/delete/' . $data->id_penjualan) ?>" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus</a>

                                                <!-- <input type="hidden" name="id_penjualan" value="<?= $data->id_penjualan ?>">
                                    <button onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Hapus
                                    </button> -->

                                <!-- <td onclick="javascript : return confirm('Anda yakin menghapus data?')"><?php echo anchor('admin/pengguna/delete/' . $data->id_user) ?>,'<div class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></div></td> -->
                                <!-- <a href="#modalDel" data-toggle="modal" onclick="$('#modalDel #formDel').attr('action','<?= site_url('admin/pengguna/delete/' . $data->id_user) ?>')" class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></a></i> -->
                                <!-- </td> -->
                                <!-- </tr>
                            <?php } ?> 

                            </tbody> -->
                            </table>

                        </div>
                    </div>
                </div>

            </section>
            <!-- /.container-fluid -->
            <!-- End of Page Wrapper -->