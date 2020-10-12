<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Item</h1><br />
        <a href="<?= site_url('admin/item/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data</a>
        <!-- Page Heading -->

        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Item</h6>
            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <form method="post" action="<?php echo base_url('admin/item/bulk_delete') ?>" id="form-delete">

                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th width=2%><input type="checkbox" id="check-all"></th>

                                    <th class="text-center">Nama Item</th>
                                    <th class="text-center">Jenis bahan</th>
                                    <th class="text-center">Stok bahan</th>
                                    <th class="text-center" width=30%>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><input type='checkbox' class='check-item' name='id_item[]' value="<?= $data->id_item ?>"></td>
                                        <td><?= $data->nama_item ?></td>
                                        <td class="text-center"><?= $data->nama_jenis ?></td>
                                        <td class="text-center"><?= $data->nama_item == 'upah' || $data->nama_item == 'lain-lain' ? '-' : $data->stok ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('admin/item/edit/' . $data->id_item) ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Edit</a>
                                            <a href="<?= site_url('admin/item/delete/' . $data->id_item) ?>" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus</a>




                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table><br>
                        <button type="button" id="btn-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus yang ditandai</button>
                    </form><br>
                </div>
            </div>
        </div>
    </section>
    <!-- /.container-fluid -->
    <!-- End of Page Wrapper -->
    <script src="<?php echo base_url('asset/vendor/jquery/jquery.min.js'); ?>"></script>

    <script>
        $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
            $("#check-all").click(function() { // Ketika user men-cek checkbox all
                if ($(this).is(":checked")) // Jika checkbox all diceklis
                    $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
                else // Jika checkbox all tidak diceklis
                    $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
            });

            $("#btn-delete").click(function() { // Ketika user mengklik tombol delete
                var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi

                if (confirm) // Jika user mengklik tombol "Ok"
                    $("#form-delete").submit(); // Submit form
            });
        });
    </script>