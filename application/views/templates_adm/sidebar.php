<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text  mx-1 mt-2">
          <img class="img-profile" src="http://localhost/tokocahayaagung/assets_user/img/gallery/caa3.svg" style="width:8em;height:8em">
        </div>
      </a>
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <!-- <div class="sidebar-brand-text  mx-1 mb-2 mt-2">
          <img class="img-profile rounded-circle" src="http://localhost/tokocahayaagung/assets_user/img/gallery/caa3.svg" style="width:5em;height:5em">
        </div><br> -->
        <div class="sidebar-brand-text mx-1 mb-2 ">Toko Cahaya Agung Aluminium</div><br>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('admin/dashboard') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        <h6 align="center">MENU</h6>
      </div>
      <hr class="sidebar-divider my-1">
      <!-- Nav Item - Pages Collapse Menu -->
      <!-- Divider -->
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('admin/produk') ?>">
          <i class="fas fa-fw fa-database"></i>
          <span>Produk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('admin/bahan_masuk') ?>">
          <i class="fas fa-fw fa-inbox"></i>
          <span>Pembelian</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('admin/penjualan') ?>">
          <i class="fas fa-fw fa-hand-holding-usd"></i>
          <span>Penjualan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('admin/pembeli') ?>">
          <i class="fas fa-fw fa-address-card"></i>
          <span>Pembeli</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('admin/pemasok') ?>">
          <i class="fas fa-fw fa-people-carry"></i>
          <span>Pemasok</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= site_url('admin/penjualan/laporan_b') ?>"><i class="fas fa-fw fa-folder"></i> Laporan Pembatalan</a>
            <a class="collapse-item" href="<?= site_url('admin/penjualan/laporan') ?>"><i class="fas fa-fw fa-folder"></i> Laporan Penjualan</a>
            <a class="collapse-item" href="<?= site_url('admin/bahan_masuk/laporan') ?>"><i class="fas fa-fw fa-folder"></i> Laporan Bahan Masuk</a>
          </div>
        </div>
      </li>
      <?php if ($this->fungsi->user_login()->level == 1) { ?>
        <hr class="sidebar-divider my-3">
        <div class="sidebar-heading">
          <h6 align="center">PENGATURAN</h6>
        </div>
        <hr class="sidebar-divider my-1">
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Bahan Perabot</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?= site_url('admin/jenis') ?>"><i class="fas fa-fw fa-folder"></i> Jenis Bahan</a>
              <a class="collapse-item" href="<?= site_url('admin/item') ?>"><i class="fas fa-fw fa-folder"></i> Item Bahan</a>
              <a class="collapse-item" href="<?= site_url('admin/kalkulasi') ?>"><i class="fas fa-fw fa-folder"></i> Kalkulasi Harga</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('admin/kategori') ?>">
            <i class="fas fa-fw fa-inbox"></i>
            <span>Kategori Produk</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('admin/pengguna') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span></a>
        </li>

      <?php } ?>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin/pengaturan') ?>">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pengaturan</span></a>
      </li> -->

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white1 topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="sidebar-brand-text mx-1 mb-2 ">
              <!-- <input type="text" class="form-control bg-light border-0 small" placeholder="" aria-label="Search" aria-describedby="basic-addon2"> -->
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>


              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if ($this->fungsi->user_login()->nama_user) { ?>
                  <span class="mr-2 d-none d-lg-inline font-weight-bold text-gray-600 medium ">Selamat Datang <?= ucfirst($this->fungsi->user_login()->nama_user) ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal1">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>

              </div>
              <!-- <?php } else { ?>
                <a class="dropdown-item" href="<?= site_url('auth/login') ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Login
                </a>
              <?php } ?> -->
              <!-- Dropdown - User Information -->
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->