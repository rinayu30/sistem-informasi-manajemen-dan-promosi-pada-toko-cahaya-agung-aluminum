        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Produk</h1><br />
                <a href="<?= site_url('admin/produk/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Tambah Data</a>
                <!-- Page Heading -->

                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>
            <section class="content">
                <?php $this->view('messages') ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data produk</h6>
                    </div>
                    <div class="card-body">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode produk</th>
                                        <th>Nama produk</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <!-- <th class="text-center">Keterangan</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    foreach ($row->result() as $key => $data) { ?>
                                        <tr>
                                            <td width="2%" class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $data->kd_produk ?></td>
                                            <td><?= $data->nama_produk ?></td>
                                            <td>
                                                <?php if ($data->gambar != null) { ?>
                                                    <img src="<?= base_url('uploads/produk/' . $data->gambar) ?>" style="width : 80px">
                                                <?php } ?>
                                            </td>
                                            <td class="text-center"><?= $data->stok ?></td>
                                            <td class="text-center"><?= $data->nama_kategori ?></td>
                                            <!-- <td><?= $data->detail ?></td> -->
                                            <td class="text-center">
                                                <a href="<?= site_url('admin/produk/detail/' . $data->kd_produk) ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-search-plus"></i> Detail</a>
                                                <a href="<?= site_url('admin/produk/edit/' . $data->kd_produk) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit</a>
                                                <a href="<?= site_url('admin/produk/delete/' . $data->kd_produk) ?>" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus</a>


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

            <!-- <div class="modal fade" id="modal-detail">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered no-margin">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Kode Produk</th>
                                        <td><span id="kd_produk"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <td><span id="namaproduk"></span> </td>
                                    </tr>
                                    <tr>
                                        <th>Gambar</th>
                                        <td><span id="gambar"></span> </td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td><span id="stok"></span> </td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td><span id="kategori"></span> </td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td><span id="keterangan"></span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $(document).on('click', '#set_dtl', function() {
                        var kdproduk = $(this).data('kdproduk');
                        var namaproduk = $(this).data('namaproduk');
                        var gambar = $(this).data('gambar');
                        var stok = $(this).data('stok');
                        var kategori = $(this).data('kategori');
                        var keterangan = $(this).data('detail');
                        $('#kdproduk').text(kd_produk);

                    })

                })
            </script> -->



            <!-- End of Page Wrapper -->