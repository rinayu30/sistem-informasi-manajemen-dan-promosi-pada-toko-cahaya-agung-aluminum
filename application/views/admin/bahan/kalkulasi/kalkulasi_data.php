        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-gray-800">Hitung Harga Produk</h1><br />
                <!-- <a href="<?= site_url('admin/kalkulasi/') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data</a> -->
                <!-- Page Heading -->

                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>
            <section class="content">
                <?php $this->view('messages') ?>
                <div class="container">
                    <div class="card-header py-3">
                        <!-- <h6 class="m-0 font-weight-bold text-primary">Form <?= ucfirst($page) ?> Hitung</h6> -->
                    </div>
                    <!-- Outer Row -->
                    <div class="row justify-content-left">
                        <div class="col-lg-4 justify-content-left">
                            <div class="card shadow mb-4 card-header py-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><label for="kode">Kode Produk*</label></h6>
                                </div>
                                <div class="card-body">
                                    <div class="box-body table-responsive">
                                        <div class="form-group ">

                                            <select id="kd_produk" class="form-control" name="kd_produk" required>
                                                <option value="" selected hidden>---Pilih---</option>
                                                <?php
                                                $db = $this->db->get('produk');
                                                foreach ($db->result() as $rw) {
                                                ?>
                                                    <option value="<?php echo $rw->kd_produk; ?>">
                                                        <?php echo $rw->kd_produk; ?> <?php echo $rw->nama_produk; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 justify-content-right">
                            <div class="card shadow mb-4 card-header py-3">
                                <div class="card-body">
                                    <div class="box-body table-responsive">
                                        <form action="<?= site_url('admin/kalkulasi/proses') ?>" method="post">
                                            <div class="form-group ">
                                                <label for="nama" class="m-0 font-weight-bold text-primary">Jenis Bahan*</label>
                                                <input type="text" name="nama" class="form-control" required>
                                            </div>
                                            <div class="form-group ">
                                                <label for="nama" class="m-0 font-weight-bold text-primary">Nama Bahan*</label>
                                                <input type="text" name="nama" class="form-control" required>
                                            </div>

                                            <div class="form-group text-right">
                                                <button type="submit" name="" class="btn btn-success btn-sm"><i class="fas fa-plus fa-sm"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 justify-content-right">
                            <div class="card shadow mb-4 card-header py-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><label for="kode">Harga Modal Produk </label></h6>
                                </div>
                                <div class="">
                                    <div class="card-body">
                                        <div class="box-body table-responsive">
                                            <div class="form-group ">
                                                <!-- <label for="nama" class="m-0 font-weight-bold text-primary">Jenis Bahan*</label> -->
                                                <input type="text" name="nama" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Harga Bahan dari Produk</h6>
                        </div>
                        <div class="card-body">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th width=2%>No</th>
                                            <th class="text-center">Nama Bahan</th>
                                            <th class="text-center">Banyak</th>
                                            <th class="text-center">Ukuran Aluminium</th>
                                            <th class="text-center">Ukuran Panjang</th>
                                            <th class="text-center">Ukuran Lebar</th>
                                            <th class="text-center">Jumlah Bahan</th>
                                            <th class="text-center">Harga/satuan</th>
                                            <th class="text-center">Jumlah Harga</th>
                                            <th class="text-center" width=30%>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td width=2%>1</td>
                                        <td class="text-center">Nama Bahan</td>
                                        <td class="text-center">Banyak</td>
                                        <td class="text-center">Ukuran Aluminium</td>
                                        <td class="text-center">Ukuran Panjang</td>
                                        <td class="text-center">Ukuran Lebar</td>
                                        <td class="text-center">Jumlah Bahan</td>
                                        <td class="text-center">Harga/satuan</td>
                                        <td class="text-center">Jumlah Harga</td>
                                        <td class="text-center" width=30%>
                                            <a href="" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Edit</a>
                                            <a href="" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus</a>

                                        </td>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </section>
            <!-- /.container-fluid -->
            <!-- End of Page Wrapper
  <?= site_url('admin/kalkulasi/edit/' . $data->id_kalkulasi) ?>
  <?= site_url('admin/klakulasi/delete/' . $data->id_kalkulasi) ?>
   -->

            <!-- <script type="text/javascript">

function validasi_form_input(form){
  if (form.kd_produk.value == ""){
    alert("Kode Produk Masih Kosong!");
    form.kd_produk.focus();
    return (false);
  }
  
return (true);
}

// function validasi_selesai(form){
//   if (form.nama_pelanggan.value == ""){
//     alert("Nama Pelanggan Masih Kosong!");
//     form.nama_pelanggan.focus();
//     return (false);
//   }

  
// return (true);
// }

	  function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
    }
 
</script> -->