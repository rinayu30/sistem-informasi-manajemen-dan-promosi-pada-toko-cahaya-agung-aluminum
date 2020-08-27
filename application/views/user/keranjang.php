<div class="container-fluid">
    <h4>Detail Keranjang</h4>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub-Total</th>
        </tr>
        <?php
        $no = 1;
        foreach ($this->cart->contents() as $item) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['qty'] ?></td>
                <td>Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"> </td>
            <td colspan="1" style="font-size: 12pt;"><b>T O T A L</b> </td>
            <td style="font-size: 11pt;"><b>Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></b></td>
        </tr>
    </table>
    <div class="pull-right">
        <a href="<?= site_url('dashboard/hapus_keranjang') ?>" onclick="return confirm('Anda yakin menghapus daftar keranjang?')">
            <div class="btn btn-sm btn-danger">Hapus Keranjang</div>
        </a>
        <a href="<?= site_url('dashboard/produk') ?>">
            <div class="btn btn-sm btn-primary">Lanjut Belanja</div>
        </a>
        <a href="<?= site_url('dashboard/pembayaran') ?>">
            <div class="btn btn-sm btn-success">Pembayaran</div>
        </a>
    </div>
    <br><br><br />

</div>
</div>