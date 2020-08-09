<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Detail Produk
        </div>
        <div class="card-body">
        <?php foreach ($produks as $produk):?>
            <div class="row">
                <div class="col-md-4">
                <img src="<?php echo base_url('uploads/produk/'.$produk->gambar) ?>" class ="card-img-top">
                </div>
                <div class="col-md-8">
                <table class="table">
                <tr>
                <td>Nama Produk</td>
                <td><strong><?php echo $produk->nama_produk?></strong></td>
                </tr>
                <!-- <tr>
                <td>Harga Modal</td>
                <td><strong><div class="btn btn-sm btn-success">Rp. <?php echo number_format($produk->harga_modal, 0,',','.') ?></div></strong></td>
                </tr>
                <tr>
                <td> Harga Jual</td>
                <td><strong><div class="btn btn-sm btn-success">Rp. <?php echo number_format($produk->harga_jual, 0,',','.') ?></div></strong></td>
                </tr> -->
                <tr>
                <td> Kategori</td>
                <td><strong><?php echo $produk->kategori ?></strong></td>
                </tr>
                <tr>
                <td> Keterangan</td> 
                <td> <?php echo $produk->detail ?> </td>  
                </tr>
                </table>
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>

</div>