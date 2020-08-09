<?php $this->load->view('templates_adm/header') ?>
<?php $this->load->view('templates_adm/sidebar') ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Kategori</h1><br />
        <a href="<?= site_url('admin/kategori') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
        <!-- Page Heading -->

        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <section class="content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form <?= ucfirst($page) ?> Kategori</h6>
            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-4 offset-4">
                            <form action="<?= site_url('admin/kategori/proses') ?>" method="post">
                                <div class="form-group">
                                    <label for="nama">Nama kategori*</label>
                                    <input type="hidden" name="id" value="<?= $row->id_kategori ?>">
                                    <input type="text" name="nama" value="<?= $row->nama_kategori ?>" class="form-control" required>

                                </div>

                                <br>

                                <div class="form-group text-center">
                                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                    <button type="submit" name="<?= $page ?>" class="btn btn-success btn-sm">Simpan</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
</div>
</section>
<!-- /.container-fluid -->
<!-- End of Page Wrapper -->
<?php $this->load->view('templates_adm/footer') ?>