<div class="container-fluid">
    <a href="<?= site_url('admin/produk') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            Detail Produk
        </div>
        <div class="card-body">
            <?php foreach ($row->result() as $key => $data) : ?>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('uploads/produk/' . $data->gambar) ?>" class="card-img-top">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <td>Nama Produk</td>
                                <td><strong><?php echo $data->nama_produk ?></strong></td>
                            </tr>
                            <tr>
                                <td>Harga Modal</td>
                                <td><strong>
                                        <a href="<?= site_url('admin/produk/add_harga') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus fa-sm"></i> Tambahkan Harga</a>

                                        <div class="btn btn-sm btn-success">Rp. <?php echo number_format($data->harga_modal, 0, ',', '.') ?></div>
                                    </strong></td>
                            </tr>
                            <tr>
                                <td> Harga Jual</td>
                                <td><strong>
                                        <div class="btn btn-sm btn-success">Rp. <?php echo number_format($data->harga_jual, 0, ',', '.') ?></div>
                                    </strong></td>
                            </tr>
                            <tr>
                                <td> Kategori</td>
                                <td><strong><?php echo $data->nama_kategori ?></strong></td>
                            </tr>
                            <tr>
                                <td> Keterangan</td>
                                <td> <?php echo $data->detail ?> </td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>