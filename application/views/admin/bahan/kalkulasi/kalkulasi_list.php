<section class="content">
    <div class="container-fluid">
        <?php $this->view('messages') ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Harga Produk</h6>
            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width=2%>No</th>
                                <th class="text-center" width=30%>Kode Produk</th>
                                <th class="text-center">Harga Jual</th>
                                <th class="text-center">Harga Modal</th>
                                <th class="text-center" width=20%>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($row->result() as $key => $data) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td value="<?= $data->kd_produk ?>"><?= $data->kd_produk ?> | <?= $data->nama_produk ?></td>
                                    <td class="text-right">Rp. <?= number_format($data->harga_jual, 0, ',', '.') ?></td>
                                    <td class="text-right">Rp. <?= number_format($data->harga_modal, 0, ',', '.') ?></td>
                                    <td class="text-center" width=20%>
                                        <a href="<?= site_url('admin/kalkulasi/rincianbahan/' . $data->kd_produk) ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-search-plus"></i> Detail</a>
                                        <!-- <a href="<?= site_url('admin/kalkulasi/detail/' . $data->id_kalkulasi) ?>" onclick="return confirm('Anda yakin membatalkan data bahan?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Batal</a> -->
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <br>
                    <!-- <button type="button" id="btn-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus yang ditandai</button> -->
                </div>
            </div>
        </div>


    </div>
</section>