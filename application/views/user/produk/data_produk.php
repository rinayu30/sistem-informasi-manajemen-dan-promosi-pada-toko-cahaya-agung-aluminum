<div class="container">
    <div class="row">

        <div class="row clearfix">
            <ul class="gallery-post-grid holder">
                <!-- Gallery Item 1 -->
                <?php foreach ($row->result() as $key => $data) : ?>
                    <div class="card body">
                        <li class="span3 gallery-item">
                            <span class="gallery-hover-4col hidden-phone hidden-tablet">
                                <span class="gallery-icons">
                                    <div class="progress progress-warning ">
                                        <div class="bar" style="width: 100%"> Rp. <?= number_format($data->harga_jual, 0, ',', '.') ?></div>

                                    </div>
                                </span>
                            </span>
                            <?php if ($data->gambar != null) { ?>
                                <img src="<?= base_url('uploads/produk/' . $data->gambar) ?>" style="height:250px; width :inherit">
                            <?php } ?>
                            <span class="project-details" style="width :initial">
                                <a href="<?= site_url('dashboard/detail/' . $data->kd_produk) ?>" class="btn btn-normal btn-sm lead">
                                    <?= $data->nama_produk ?></a>
                                <a href="<?= site_url('dashboard/tambah_keranjang/' . $data->kd_produk) ?>" class="btn btn-normal btn-sm lead">
                                    Tambah ke Keranjang</a>
                            </span>
                        </li>
                    </div>

                <?php endforeach; ?>
            </ul>
        </div>


    </div>
</div>
<!-- Pagination -->
<div class="pagination">
    <ul>
        <li class="active"><a href="#">Prev</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div>
</div>