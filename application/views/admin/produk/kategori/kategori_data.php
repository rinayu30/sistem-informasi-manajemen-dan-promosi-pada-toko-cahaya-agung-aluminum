        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Kategori</h1><br />
                <a href="<?= site_url('admin/kategori/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data</a>
                <!-- Page Heading -->

                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>
            <section class="content">
                <?php $this->view('messages') ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data kategori</h6>
                    </div>
                    <div class="card-body">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th width=2%>No</th>
                                        <th width=50% class="text-center">Nama kategori</th>
                                        <th class="text-center" width=30%>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    foreach ($row->result() as $key => $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->nama_kategori ?></td>
                                            <td class="text-center">
                                                <a href="<?= site_url('admin/kategori/edit/' . $data->id_kategori) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit</a>
                                                <a href="<?= site_url('admin/kategori/delete/' . $data->id_kategori) ?>" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus</a>

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
            </section>
            <!-- /.container-fluid -->
            <!-- End of Page Wrapper -->