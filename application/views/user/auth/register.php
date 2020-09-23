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
              <form action="#">
                <div class="group-input">
                  <label for="nama">Nama Lengkap *</label>
                  <input type="text" name="nama">
                </div>
                <div class="group-input">
                  <label for="username">Username *</label>
                  <input type="text" name="username">
                </div>
                <div class="group-input">
                  <label for="pass">Password *</label>
                  <input type="text" name="pass">
                </div>
                <div class="group-input">
                  <label for="con-pass">Konfirmasi Password *</label>
                  <input type="text" name="con-pass">
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