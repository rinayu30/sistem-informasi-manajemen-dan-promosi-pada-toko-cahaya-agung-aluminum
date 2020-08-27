<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="btn btn-sm btn-success">
                <?php
                $grand_tot = 0;
                if ($keranjang = $this->cart->contents()) {
                    foreach ($keranjang as $item) {
                        $grand_tot = $grand_tot + $item['subtotal'];
                    }
                    echo "<h6>Total belanja Anda : Rp. " . number_format($grand_tot, 0, ',', '.') . "</h6>";
                }
                ?>
            </div><br><br>
            <h5>Masukkan data pengiriman dan pembayaran</h5>
            <form method="post" action="<?= site_url('dashboard/proses_pesanan') ?>">
                <div class="form-group">
                    <label for="nama_lengkap">Nama</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama lengkap Anda..." required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" placeholder="Alamat lengkap Anda..." required>
                </div>
                <div class="form-group">
                    <label for="notel">No Telpon</label>
                    <input type="text" name="notel" placeholder="Nomor Telepon Anda..." required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama lengkap Anda..." required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama lengkap Anda..." required>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>

</div>
</div>