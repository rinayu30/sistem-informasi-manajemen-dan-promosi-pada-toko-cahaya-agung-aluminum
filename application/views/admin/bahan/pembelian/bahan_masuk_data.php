        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Bahan Masuk</h1><br />
                <a href="<?= site_url('admin/bahan_masuk/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data</a>
                <!-- Page Heading -->

                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>
            <section class="content">
                <?php $this->view('messages') ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Bahan Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <!-- <th width=2%>No</th> -->
                                        <th class="text-center">Kode Pembelian</th>
                                        <th class="text-center">Tanggal Beli</th>
                                        <th class="text-center">Pemasok</th>
                                        <th class="text-center">Nama Item</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Harga Satuan</th>
                                        <th class="text-center">Total Harga</th>
                                        <th class="text-center" width=20%>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    foreach ($row->result() as $key => $data) { ?>
                                        <tr>
                                            <!-- <td><?= $no++ ?></td> -->
                                            <td class="text-center"><?= $data->id_bmasuk ?></td>
                                            <td class="text-center" width="13%"><?= $data->tgl_beli ?></td>
                                            <td class="text-center" width="13%"><?= $data->nama_pemasok ?></td>
                                            <td class="text-center"><?= $data->nama_item ?></td>
                                            <td class="text-center"><?= $data->jumlah ?></td>
                                            <td class="text-center">
                                                <?php switch ($data->satuan) {
                                                    case 1:
                                                        echo "batang";
                                                        break;
                                                    case 2:
                                                        echo "pcs";
                                                        break;
                                                    case 3:
                                                        echo "box";
                                                        break;
                                                    case 4:
                                                        echo "cm";
                                                        break;
                                                    case 5:
                                                        echo "m";
                                                        break;
                                                    case 6:
                                                        echo "ft2";
                                                        break;
                                                } ?>
                                            </td>
                                            <td class="text-center"><?= $data->harga_satuan ?></td>
                                            <td class="text-center"><?= $data->total_harga ?></td>
                                            <td class="text-center" width="20%">
                                                <a href="<?= site_url('admin/bahan_masuk/edit/' . $data->id_bmasuk) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit</a>
                                                <a href="<?= site_url('admin/bahan_masuk/delete/' . $data->id_bmasuk) ?>" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus</a>

                                                <!-- <input type="hidden" name="id_item" value="<?= $data->id_item ?>">
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
            </section>
            <!-- /.container-fluid -->
            <!-- End of Page Wrapper -->