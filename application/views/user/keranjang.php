<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <a href="#">Keranjang saya</a>
                    <span>Detail Keranjang</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th class="p-name">Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($this->cart->contents() as $item) : ?>
                                <tr>
                                    <td class="cart-pic first-row"> <img src="<?= base_url('uploads/produk/' . $item['gbr']) ?>" style="width : 100px"></td>
                                    <td class="cart-title first-row">
                                        <h5><?= $item['name'] ?></h5>
                                    </td>
                                    <td class="p-price first-row">Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <!-- <div class="pro-qty"> -->
                                            <?= $item['qty'] ?>
                                            <!-- </div> -->
                                        </div>
                                    </td>
                                    <td class="total-price first-row">Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="cart-buttons">
                            <a href="<?= site_url('home/produk') ?>" class="primary-btn continue-shop">Lanjut Belanja</a>
                            <a href="<?= site_url('home/hapus_keranjang') ?>" onclick="return confirm('Anda yakin menghapus daftar keranjang?')" class="primary-btn up-cart">Hapus Keranjang</a>
                        </div>

                    </div>
                    <div class="col-lg-4 offset-lg-2">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="cart-total">Total <span>Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></span></li>
                            </ul>
                            <a href="<?= site_url('home/pemesanan') ?>" class="proceed-btn">Proses Pesanan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->