<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Toko Cahaya Agung Aluminium - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary1">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6 justify-content-center">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Toko Cahaya Agung Aluminium</h1>
                  </div>
                  <?= $this->session->flashdata('pesan') ?>
                  <form class="user" action="<?= site_url('auth/proses') ?>" method="post">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nama pengguna..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Kata sandi..." required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary form-control">
                      Login
                    </button>
                    <hr>
                    <div class="text-center">
                      <a href="<?= site_url('auth/register') ?>">Belum punya akun? Daftar sekarang</a>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>asset/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>asset/js/sb-admin-2.min.js"></script>

</body>

</html>