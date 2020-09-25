<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <a href="#"><i class="fa fa-home"></i> Home</a>
          <span>Login</span>
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
        <div class="login-form">
          <h2>Login</h2>
          <?= $this->session->flashdata('pesan') ?>
          <?= $this->session->flashdata('message') ?>
          <form action="<?= site_url('auth/proses_login') ?>" method="post">
            <div class="group-input">
              <label for="email">Email *</label>
              <input type="text" name="email" value="<?= set_value('email') ?>" placeholder="Email...">
              <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="group-input">
              <label for="pass">Password *</label>
              <input type="password" name="pass" placeholder="Kata sandi...">
              <?= form_error('pass', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="group-input gi-check">
              <div class="gi-more">
                <!-- <label for="save-pass">
                  Save Password
                  <input type="checkbox" id="save-pass">
                  <span class="checkmark"></span>
                </label> -->
                <a href="#" class="forget-pass">Lupa Password ?</a>
              </div>
            </div>
            <button type="submit" class="site-btn login-btn">LOGIN</button>
          </form>
          <div class="switch-login">
            <a href="<?= site_url('home/register') ?>" class="or-login">Daftarkan Akun?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Register Form Section End -->