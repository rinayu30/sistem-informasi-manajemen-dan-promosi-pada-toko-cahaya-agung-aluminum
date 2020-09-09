<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h5 mb-0 text-gray-800">Penjualan</h1><br /> -->
        <!-- <a href="<?= site_url('admin/penjualan') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a> -->
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
                                <select id="kd_produk" class="form-control" name="kd_produk" required>
                                    <option value="" selected hidden>---Pilih---</option>
                                    <?php
                                    $db = $this->db->get('produk');
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
                                <input type="number" id="jumlah" min="0" name="jumlah" value="<?= $row->jumlah ?>" class="form-control">
                            </div>


                    </div>
                    <div class="col-md-5 justify-content-right">
                        <div class="form-group">
                            <label for="kode">Nomor Penjualan</label>
                            <input type="text" name="kode" value="<?= $row->kd_penjualan ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pej"></label>
                            <input type="date" name="tgl_pej" class="form-control" hidden>
                        </div>
                        <!-- <div class="form-group">
                            <label for="uang_dp">Uang Muka</label>
                            <input type="number" id="uang" min="0" name="uang_dp" value="<?= $row->dp_awal ?>" class="form-control">

                        </div> -->

                        <!-- <div class="form-group">
                                <label for="harga_jual">Harga Jual <small>(Rp)</small></label>
                                <input type="number" id="harga_jual" name="harga_jual" value="<?= number_format($row->harga_jual, 0, ',', '.')  ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Total Bayar <small>(Rp)</small></label>
                                <input type="text" id="bayar" name="bayar" value="<?= $row->tot_bayar ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="sisa">Sisa Bayar <small>(Rp)</small></label>
                                <input type="text" id="sisa" name="sisa" value="<?= $row->sisa ?>" class="form-control" readonly>
                            </div> -->
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <button type="submit" name="tambah_jual" class="btn btn-success btn-sm">Simpan</button>
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
                                        <select id="pembeli" class="form-control" name="pembeli" required>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 justify-content-center">

                        <div class="card shadow mb-4 card-header py-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><label for="uang_m"><small>(Masukkan uang dp jika ada) | (Masukkan tanggal penjualan)</small></label></h6>
                            </div>
                            <div class="card-body" style="height: 100px;">
                                <div class="box-body table-responsive">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <!-- value="<?= $row->dp_awal ?>"  -->
                                            <input type="number" min="1" name="uang_m" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label for="tgl_pej">Tanggal Penjualan</label>value="<?= $row->tgl_penjualan ?>" -->
                                            <input type="date" name="tgl_pej" class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
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
<!-- /.container-fluid -->
<!-- End of Page Wrapper -->
<script src="<?php echo base_url('asset/vendor/jquery/jquery.min.js'); ?>"></script>

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