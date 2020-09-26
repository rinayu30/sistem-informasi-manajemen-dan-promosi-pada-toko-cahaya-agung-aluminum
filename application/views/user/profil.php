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
                    <div class="leave-comment">
                        <h4>Leave A Comment</h4>
                        <p>Our staff will call back later and answer your questions.</p>
                        <form action="#" class="comment-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Your name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Your email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Your message"></textarea>
                                    <button type="submit" class="site-btn">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ">
                <h4>Identitas Pengguna</h4><br>
                <form method="post" action="<?= site_url('dashboard/proses_identitas') ?>" class="checkout-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="nama">Nama Lengkap <span>*</span><?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?></label>
                            <input type="text" name="nama" value="<?= $this->fungsi->user_login()->nama_user ?>" disabled />
                        </div>

                        <div class="col-lg-12">
                            <label for="jk">Jenis Kelamin <span>*</span> <?= form_error('jk', '<small class="text-danger pl-3">', '</small>') ?>
                            </label>
                            <select name="jk" class="form-control">
                                <option value="">--Pilih--</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select><br>
                        </div>
                        <div class="col-lg-12">
                            <label for="notel">No WA/HP <span>*</span> <?= form_error('notel', '<small class="text-danger pl-3">', '</small>') ?>
                            </label>
                            <input type="number" name="notel" value="<?= set_value('notel') ?>" placeholder="Nomor WA/HP Anda...">
                        </div>
                        <div class="col-lg-12">
                            <label for="alamat">Alamat <span>*</span> <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                            </label><br>
                            <!-- <input type="text" name="alamat" value="<?= set_value('alamat') ?>" class="street-first"> -->
                            <textarea name="alamat" placeholder="Alamat lengkap Anda..." cols="59" rows="5" class="street-first"><?= set_value('alamat') ?></textarea>
                        </div>
                        <div class="col-lg-12">
                            <div class="order-btn text-center">
                                <br> <button type="submit" class="site-btn place-btn">edit profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>
<!-- Shopping Cart Section End -->