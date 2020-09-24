<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Keranjang saya</a>
                    <span>Pemesanan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form method="post" action="<?= site_url('dashboard/proses_pesanan') ?>" class="checkout-form">
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="<?= site_url('home/login') ?>" class="content-btn">Klik disini untuk Login agar pemesanan dapat dilakukan</a>
                    </div>
                    <h4>Identitas Pemesan</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="nama_lengkap">Nama Lengkap<span>*</span></label>
                            <input type="text" name="nama_lengkap" placeholder="Nama lengkap Anda..." required>
                        </div>

                        <div class="col-lg-6">
                            <label for="jk">Jenis Kelamin <span>*</span></label>
                            <select name="jk" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select><br>
                        </div>
                        <div class="col-lg-6">
                            <label for="notel">No WA/HP<span>*</span></label>
                            <input type="text" name="notel" placeholder="Nomor WA/HP Anda..." required>
                        </div>
                        <div class="col-lg-12">
                            <label for="alamat">Alamat Pemesan<span>*</span></label>
                            <input type="text" name="alamat" class="street-first" placeholder="Alamat lengkap Anda..." required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="place-order">

                        <h4>Total Pesanan</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Produk <span>Sub Total</span></li>
                                <?php
                                $no = 1;
                                foreach ($this->cart->contents() as $item) : ?>
                                    <li class="fw-normal"><?= $item['name'] ?> x <?= $item['qty'] ?> <span>Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></span></li>

                                <?php endforeach; ?>
                                <?php
                                $grand_tot = 0;
                                if ($keranjang = $this->cart->contents()) {
                                    foreach ($keranjang as $item) {
                                        $grand_tot = $grand_tot + $item['subtotal'];
                                    }
                                }
                                ?>
                                <li class="total-price">Total <span>Rp. <?= number_format($grand_tot, 0, ',', '.') ?></span></li>
                            </ul>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Buat Pesanan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->