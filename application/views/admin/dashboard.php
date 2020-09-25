<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Stok Produk</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                <?php
                $db = $this->db->get('produk');
                $query = $this->db->query("select sum(stok) as total from produk")->result();
                foreach ($query as $rw) {
                  echo number_format($rw->total, 0, ',', '.');
                }
                ?>
              </div>

            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-database fa-2x text-gray-300"></i>
            </div>
          </div><br>
          <div class="col mr-2 align-items-right">
            <span class="float-right">
              <div class="h6 mb-0 font-weight-italic text-gray-800">
                <a href="<?php echo site_url('admin/produk') ?>"><i class="fas fa-angle-right"></i> Detail</a>
              </div>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pembelian</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                Rp.

                <?php
                $db = $this->db->get('bahan_masuk');
                $query = $this->db->query("select sum(total_harga) as total from bahan_masuk")->result();
                foreach ($query as $rw) {
                  echo number_format($rw->total, 0, ',', '.');
                }

                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div><br>
          <div class="col mr-2 align-items-right">
            <span class="float-right">
              <div class="h6 mb-0 font-weight-italic text-gray-800">
                <a href="<?php echo site_url('admin/bahan_masuk/laporan') ?>"><i class="fas fa-angle-right"></i> Detail</a>
              </div>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penjualan</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">Rp.

                <?php
                $db = $this->db->get('penjualan');
                $query = $this->db->query("select sum(tot_bayar) as total from penjualan")->result();
                foreach ($query as $rw) {
                  echo number_format($rw->total, 0, ',', '.');
                }

                ?>
              </div>

              <!-- <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-hand-holding-usd fa-2x text-gray-300"></i>
            </div>
          </div><br>
          <div class="col mr-2 align-items-right">
            <span class="float-right">
              <div class="h6 mb-0 font-weight-italic text-gray-800">
                <a href="<?php echo site_url('admin/penjualan/laporan') ?>"><i class="fas fa-angle-right"></i> Detail</a>
              </div>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">User </div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                <?php
                $db = $this->db->get('user');
                $query = $this->db->query("select count(id_user) as total from user")->result();
                foreach ($query as $rw) {
                  echo number_format($rw->total, 0, ',', '.');
                }

                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
            </div>
          </div><br>
          <div class="col mr-2 align-items-right">
            <span class="float-right">
              <div class="h6 mb-0 font-weight-italic text-gray-800">
                <a href="<?php echo site_url('admin/pengguna') ?>"><i class="fas fa-angle-right"></i> Detail</a>
              </div>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>