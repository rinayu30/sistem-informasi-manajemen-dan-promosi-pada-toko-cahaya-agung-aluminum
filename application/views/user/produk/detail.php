<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <a href="#">Produk</a>
                    <span>Detail</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<div class="container">
    <div class="row">
        <?php foreach ($row->result() as $key => $data) : ?>
            <div class="col-lg-6">
                <div class="product-details">
                    <div class="pd-title">
                        <span>Gambar Produk</span>
                        <div class="pd-desc">
                            <img src="<?php echo base_url('uploads/produk/' . $data->gambar) ?>" class="card-img-top">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="product-details">
                    <div class="pd-title">
                        <br>
                        <span>
                            <h4><?= $data->nama_produk ?></h4>
                        </span>
                    </div>

                    <div class="pd-desc">
                        <p><span>Deskripsi :</span> <?php echo $data->detail ?></p>
                        <h4>Rp. <?= number_format($data->harga_jual, 0, ',', '.') ?></h4>
                    </div>
                    <ul class="pd-tags">
                        <li><span>Kategori :</span> <?php echo $data->nama_kategori ?></li>
                    </ul>

                </div>
                <div class="order-btn">
                    <a href="<?= site_url('dashboard/tambah_keranjang/' . $data->kd_produk) ?>" onclick="return confirm('Tambahkan item ke keranjang?')" class="site-btn place-btn pd-cart">Tambah ke Keranjang</a>
                    <a href="<?= site_url('home/produk') ?>" class="site-btn place-btn">Kembali</a>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</div>

</div>
</div>
</div>
</section>
<!-- Product Shop Section End -->