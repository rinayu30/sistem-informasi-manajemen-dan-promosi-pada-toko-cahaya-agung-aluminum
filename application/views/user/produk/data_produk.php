<div class="container-fluid">
    <div class="row text-center">
        <?php foreach ($row->result() as $key => $data) : ?>
            <div class="row clearfix">
                <ul class="gallery-post-grid holder">
                    <!-- Gallery Item 1 -->
                    <li class="span3 gallery-item " data-type="illustration">
                        <span class="gallery-hover-4col hidden-phone hidden-tablet">
                            <span class="gallery-icons">
                                <!-- <a href="img/gallery/gallery-img-1-full.jpg" class="item-zoom-link lightbox" title="Custom Illustration" data-rel="prettyPhoto"></a> -->
                                <a href="<?= site_url('dashboard/detail/' . $data->kd_produk) ?>" class="item-details-link"></a>
                            </span>
                        </span>
                        <?php if ($data->gambar != null) { ?>
                            <img src="<?= base_url('uploads/produk/' . $data->gambar) ?>" alt="Gallery" height="70%">
                        <?php } ?>
                        <span class="project-details text-center"><?= $data->nama_produk ?><br>
                            <?= $data->detail ?></span>
                    </li>
                </ul>
            </div>
        <?php endforeach; ?>

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