    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text">
              <a href="#"><i class="fa fa-home"></i> Home</a>
              <span>Register</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <div class="register-form">
              <h2>Daftar Akun</h2>
              <form action="<?= site_url('auth/proses_register') ?>" method="post">
                <div class="group-input">
                  <label for="nama">Nama Lengkap *</label>
                  <input type="text" name="nama" value="<?= set_value('nama') ?>" placeholder="Nama lengkap...">
                  <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="group-input">
                  <label for="email">Email *</label>
                  <input type="text" name="email" value="<?= set_value('email') ?>" placeholder="Email...">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="group-input">
                  <label for="pass">Password *</label>
                  <input type="password" name="pass" placeholder="Password...">
                  <?= form_error('pass', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="group-input">
                  <label for="passconf">Konfirmasi Password *</label>
                  <input type="password" name="passconf" placeholder="Ulangi Password...">
                  <?= form_error('passconf', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <button type="submit" class="site-btn register-btn">DAFTAR</button>
              </form>
              <div class="switch-login">
                <a href="<?= site_url('home/login') ?>" class="or-login"> Login?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Register Form Section End -->