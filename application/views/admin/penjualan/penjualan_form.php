<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h5 mb-0 text-gray-800">Penjualan</h1><br /> -->
        <a href="<?= site_url('admin/penjualan/daftar_penjualan') ?>" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-hand-holding-usd"></i> Lihat Daftar Penjualan</a>
        <!-- Page Heading -->
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form <?= ucfirst($page) ?> Penjualan</h6>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-5 offset-1 justify-content-left">
                        <form action="<?= site_url('admin/penjualan/proses') ?>" method="post">
                            <div class="form-group">
                                <label for="kd_produk">Kode Produk*</label>
                                <select data-placeholder="Produk" id="kd_produk" type="search" class="form-control form-control-sm chosen-select" name="kd_produk" required>
                                    <option value="">--Pilih--</option>
                                    <?php
                                    $db = $this->db->where('updated', '0')->get('produk');
                                    foreach ($db->result() as $data) {
                                    ?>
                                        <option value="<?php echo $data->kd_produk; ?>">
                                            <?php echo $data->kd_produk; ?>&emsp;:&emsp;
                                            <?php echo $data->nama_produk; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" id="jumlah" min="0" name="jumlah" value="<?= $row->jumlah ?>" class="form-control form-control-sm">
                            </div>


                    </div>
                    <div class="col-md-5 justify-content-right">
                        <div class="form-group">
                            <label for="kode">Nomor Penjualan</label>
                            <input type="text" name="kode" value="<?= $row->kd_penjualan ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pej"></label>
                            <input type="date" name="tgl_pej" class="form-control form-control-sm" hidden>
                        </div>

                        <div class="form-group ">
                            <button type="submit" name="tambah_jual" class="btn btn-success btn-sm">Tambah</button>
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>

                        </div>
                    </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <section class="content">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <form method="post" action="<?php echo base_url('admin/penjualan/bulk_delete') ?>" id="form-delete">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width=2%><input type="checkbox" id="check-all"></th>
                                    <th class="text-center" width=15%>Nama Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center" width=15%>Sub Total</th>
                                    <th class="text-center" width=20%>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;

                                foreach ($detail as $data) { ?>
                                    <tr>
                                        <td><input type='checkbox' class='check-item' name='id_detail[]' value="<?= $data->id_detail ?>"></td>
                                        <td width="20%" class="text-center" value="<?= $data->kd_produk ?>"><?= $data->nama_produk ?></td>
                                        <td class="text-center"><?= $data->jumlah ?></td>
                                        <td class="text-center"><?= number_format($data->harga_jual, 0, ',', '.') ?></td>
                                        <td class="text-center"><?= number_format($data->subtotal, 0, ',', '.') ?></td>
                                        <td class="text-center" width=20%>
                                            <!-- <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit</a> -->
                                            <a href="<?= site_url('admin/penjualan/delete/' . $data->id_detail) ?>" onclick="return confirm('Anda yakin membatalkan item penjualan?')" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Batal</a>

                                        </td>
                                    </tr>

                                <?php
                                    $total = $total + $data->subtotal;
                                }
                                ?>


                                <tr class="gradeA">
                                    <td colspan="4" align="center">T O T A L</td>
                                    <td>Rp. <?php
                                            echo number_format($total, 0, ',', '.'); ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <button type="button" id="btn-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus yang ditandai</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="container">
            <!-- Outer Row -->
            <?php $this->view('messages') ?>
            <form action="<?php echo base_url('admin/penjualan/selesai_hitung') ?>" method='post' onsubmit="return validasi_hitung();">

                <div class="row justify-content-left">
                    <div class="col-lg-6 justify-content-left">
                        <div class="card shadow mb-4 card-header py-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><label for="pembeli">Nama pembeli*</label></h6>
                            </div>
                            <div class="card-body" style="height: 100px;">
                                <div class="box-body table-responsive">
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <select id="pembeli" class="form-control form-control-sm" name="pembeli" required>
                                                    <option value="" selected hidden>---Pilih---</option>
                                                    <?php
                                                    $db = $this->db->get('pembeli');
                                                    foreach ($db->result() as $data) {
                                                    ?>
                                                        <option value="<?php echo $data->id_pembeli; ?>">
                                                            <?php echo $data->nama_pembeli; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="<?= site_url('admin/pembeli/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-plus fa-sm"></i></a>

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 justify-content-center">

                        <div class="card shadow mb-4 card-header py-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><label for="uang_m"><small>(Uang dp jika ada / dibayar) | (Masukkan tanggal penjualan)</small></label></h6>
                            </div>
                            <div class="card-body" style="height: 100px;">
                                <div class="box-body table-responsive">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <!-- value="<?= $row->dp_awal ?>"  -->
                                            <input type="number" min="1" id="uang_m" name="uang_m" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <!-- <label for="tgl_pej">Tanggal Penjualan</label>value="<?= $row->tgl_penjualan ?>" -->
                                            <input type="date" name="tgl_pej" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="submit" name="hitung" value="Selesai" class="btn btn-success btn-sm">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

</div>
</section>
</div>
<!-- End of Page Wrapper -->
<script src="<?php echo base_url('asset/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/vendor/jquery/jquery-2.2.3.min.js') ?>"></script>
<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        $("#check-all").click(function() { // Ketika user men-cek checkbox all
            if ($(this).is(":checked")) // Jika checkbox all diceklis
                $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
            else // Jika checkbox all tidak diceklis
                $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
        });

        $("#btn-delete").click(function() { // Ketika user mengklik tombol delete
            var confirm = window.confirm("Apakah Anda yakin ingin menghapus item penjualan yang ditandai?"); // Buat sebuah alert konfirmasi

            if (confirm) // Jika user mengklik tombol "Ok"
                $("#form-delete").submit(); // Submit form
        });
    });
</script>
<script type="text/javascript">
    function validasi_hitung(form) {
        <?php
        $min = $this->db->query("select_sum('subtotal')");
        ?>
        if (form.uang_m.value == "") {
            alert("Kode Produk masih kosong!");
            form.kd_produk.focus();
            return (false);
        } else if (form.persentase.value == "") {
            alert("Angka Persentase keuntungan masih kosong!");
            form.persentase.focus();
            return (false);
        } else {
            return (true);
        }
    }
</script>