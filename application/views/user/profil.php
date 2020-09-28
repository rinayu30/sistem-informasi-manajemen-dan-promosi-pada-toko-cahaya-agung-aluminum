<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="<?= site_url('home') ?>"><i class="fa fa-home"></i> Home</a>
                    <a href="<?= site_url('home/profile') ?>">My Profile</a>
                    <span>Identitas Pengguna</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-form">
                    <div class="leave-comment ">
                        <h4>Selamat Datang <?= $this->fungsi->user_login()->nama_user ?> di website Toko Cahaya Agung Aluminium </h4>
                        <p><br>
                            Silahkan lengkapi data Anda, jika masih ada yang kosong pada form disamping</p>
                        <p>Identitas tersebut akan kami gunakan untuk keperluan pengiriman produk ke lokasi Anda <br><br><small>Klik tombol <i class="fa fa-edit fa-lg"></i> untuk mengubah informasi data diri </small> </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 ">
                <!-- <h4>Identitas Pengguna
                    <button type="submit" id="edit" class="btn btn-default btn-lg"><i class="fa fa-edit" onChange="opsi(this)"></i></button></h4><br> -->
                <h4>Identitas Pengguna
                    <!-- <button type="submit" id="edit" class="btn btn-default btn-lg"><i class="fa fa-edit" onclick="enable_text(this.checked)"></i></button></h4><br> -->
                    <a href="<?= base_url("/home/profile" . ($showEdit ? "" : "?show_edit=1")) ?>" class="btn btn-default btn-lg"><i class="fa fa-edit"></i></a>
                    <form method="post" action="<?= site_url('dashboard/proses_identitas') ?>" class="checkout-form">
                        <div class="row">
                            <?php foreach ($row as $key => $data) :

                            ?>
                                <div class="col-lg-12">
                                    <label for="nama">Nama Lengkap <span>*</span><?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?></label>
                                    <input type="text" name="nama" class="form-control" value="<?= $this->fungsi->user_login()->nama_user ?>" <?= !$showEdit ? "disabled" : "" ?> />
                                </div>

                                <div class="col-lg-12">
                                    <label for="jk">Jenis Kelamin <span>*</span> <?= form_error('jk', '<small class="text-danger pl-3">', '</small>') ?>
                                    </label>
                                    <select name="jk" class="form-control" <?= !$showEdit ? "disabled" : "" ?>>
                                        <option value="">--Pilih--</option>
                                        <option value="L" <?= $data->jk == 'L' ? "selected" : '' ?>>Laki-laki</option>
                                        <option value="P" <?= $data->jk == 'P' ? "selected" : '' ?>>Perempuan</option>
                                    </select><br>
                                </div>
                                <div class="col-lg-12">
                                    <label for="notel">No WA/HP <span>*</span> <?= form_error('notel', '<small class="text-danger pl-3">', '</small>') ?>
                                    </label>
                                    <input <?= !$showEdit ? "disabled" : "" ?> class="form-control" type="number" name="notel" value="<?= $data->no_telp ?>" placeholder="Nomor WA/HP Anda...">
                                </div>
                                <div class="col-lg-12">
                                    <label for="alamat">Alamat <span>*</span> <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                                    </label><br>
                                    <!-- <input type="text" name="alamat" value="<?= set_value('alamat') ?>" class="street-first"> -->
                                    <textarea <?= !$showEdit ? "disabled" : "" ?> name="alamat" placeholder="Alamat lengkap Anda..." class="form-control" cols="59" rows="5" class="street-first"><?= $data->alamat ?>"</textarea>
                                </div>
                            <?php
                            endforeach; ?>
                            <div class="col-lg-12">
                                <?php if ($showEdit) { ?>
                                    <div class="order-btn text-center" id="button">
                                        <br> <button type="submit" class="site-btn place-btn">Simpan</button>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </form>
            </div>

        </div>

    </div>
</section>
<!-- Shopping Cart Section End -->
<script type="text/javascript">
    function opsi(value) {
        var st = $("#edit").val();
        document.getElementById("jk").disabled = false;
        document.getElementById("notel").disabled = false;
        document.getElementById("alamat").disabled = false;
        document.getElementById("edit").visible = true;



    }
</script>