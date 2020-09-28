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
        <?= $this->session->flashdata('pesan') ?>
        <?= $this->session->flashdata('pesan1') ?>

        <form method="post" action="<?= site_url('dashboard/proses_pesanan') ?>" class="checkout-form">
            <div class="row">
                <div class="onset-lg-1 col-lg-7 ">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Alamat Pengiriman</h4>
                            <p>Isi kolom dibawah jika ingin menggunakan alamat baru
                                <br>
                                Atau biarkan kosong jika alamat sesuai dengan profile</p>
                            <div class="col-lg-12">
                                <!-- <input type="text" name="alamat" value="<?= set_value('alamat') ?>" class="street-first"> -->
                                <textarea name="alamat" placeholder="Biarkan kosong jika tidak ingin mengganti alamat..." cols="59" rows="5" class="street-first"><?= set_value('alamat') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
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