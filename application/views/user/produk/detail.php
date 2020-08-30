<div class="span12 gallery-single">

    <div class="row">
        <?php foreach ($row->result() as $key => $data) : ?>
            <div class="span6">
                <img src="<?php echo base_url('uploads/produk/' . $data->gambar) ?>" class="card-img-top">
            </div>
            <div class="span6">
                <h2>Detail Produk</h2>
                <p class="lead"><?= $data->nama_produk ?></p>
                <p class="lead">
                    <div class="btn btn-sm btn-success">Rp. <?= number_format($data->harga_jual, 0, ',', '.') ?></div>
                </p>
                <ul class="project-info">
                    <li>
                        <h6>Kategori:</h6> <?php echo $data->nama_kategori ?>
                    </li>
                    <li>
                        <h6>Keterangan:</h6> <?php echo $data->detail ?>
                    </li>

                </ul>
            <?php endforeach; ?>
            <!-- <button class="btn btn-inverse pull-left" type="button"></button> -->
            <a href="<?= site_url('dashboard/tambah_keranjang/' . $data->kd_produk) ?>" onclick="return confirm('Tambahkan item ke keranjang?')" class="btn btn-inverse pull-left">
                <i class="icon-cart"></i> Tambah ke Keranjang</a>
            <a href="<?= site_url('dashboard/produk') ?>" class="btn btn-sm pull-right">
                <i class="icon-arrow-left"></i> Kembali</a>

            </a>
            </div>
    </div>

</div><!-- End gallery-single-->

</div><!-- End container row -->

</div> <!-- End Container -->