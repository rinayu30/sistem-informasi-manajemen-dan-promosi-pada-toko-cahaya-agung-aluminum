<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title">Kategori</h4>
                    <ul class="filter-catagories">
                        <?php foreach ($categories as $cat) { ?>
                            <li><a href="<?= site_url('dashboard/kategori/' . $cat->id_kategori) ?>"><?= $cat->nama_kategori ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <?= $this->session->flashdata('message') ?>
                <div class="product-list">
                    <div class="row">
                        <?php foreach ($row->result() as $key => $data) :

                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <?php if ($data->gambar != null) { ?>
                                            <img src="<?= base_url('uploads/produk/' . $data->gambar) ?>" style="height:20em;width:20em" alt="">
                                        <?php } ?>
                                        <ul>
                                            <li class="w-icon active"><a href="<?= site_url('dashboard/tambah_keranjang/' . $data->kd_produk) ?>">+ <i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a href="<?= site_url('dashboard/detail/' . $data->kd_produk) ?>">Detail Produk</a></li>
                                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?= $data->nama_kategori ?></div>
                                        <a href="<?= site_url('dashboard/detail/' . $data->kd_produk) ?>">
                                            <h5> <?= $data->nama_produk ?></h5>
                                        </a>
                                        <div class="product-price">
                                            Rp. <?= number_format($data->harga_jual, 0, ',', '.') ?>
                                            <!-- <span>$35.00</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>
                </div>
                <!-- <div class="loading-more">
                     <i class="icon_loading"></i>
                     <a href="#">
                         Loading More
                     </a>
                 </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->