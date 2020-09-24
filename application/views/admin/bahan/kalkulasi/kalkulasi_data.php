<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Form Hitung Harga Produk</h1><br />
        <!-- Page Heading -->
        <a href="<?= site_url('admin/produk') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="box-body table-responsive justify-content-center">
                <form action="<?php echo base_url('admin/bahan_perabot/proses_bahan') ?>" method="post" onsubmit="return validasi_form_input(this)">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Jenis Bahan*</label>
                            <script>
                                $(document).ready(function() {
                                    var sportslist = [
                                        ""
                                    ];
                                    $("#id_jenis").select2({
                                        data: sportslist
                                    });
                                });
                            </script>
                            <select name="jenis_bahan" id="jenis_bahan" onChange="opsi(this)" class="form-control" required>
                                <option value="0">--Pilih--</option>
                                <?php foreach ($data->result() as $row) : ?>
                                    <option value="<?php echo $row->id_jenis; ?>"><?php echo $row->nama_jenis; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Nama Bahan*</label>
                            <script>
                                $(document).ready(function() {
                                    var sportslist = [
                                        ""
                                    ];
                                    $("#id_item").select2({
                                        data: sportslist
                                    });
                                });
                            </script>
                            <select name="item" id="id_item" class="item form-control" required>
                                <option value="0">--Pilih--</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ukuran">Ukuran *<small> (Isi jika bahan tidak memiliki dimensi)</small></label>
                            <input type="number" min="1" name="ukuran" id="ukuran" value="<?= set_value('ukuran') ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ukuran_p">Ukuran Panjang*<small> (Isi jika bahan memiliki dimensi)</small></label>
                            <input type="number" min="-1" name="ukuran_p" id="ukuran_p" value="<?= set_value('ukuran_p') ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ukuran_l">Ukuran Lebar* <small> (Isi jika bahan memiliki dimensi)</small></label>
                            <input type="number" min="-1" name="ukuran_l" id="ukuran_l" value="<?= set_value('ukuran_l') ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="banyak">Banyak *</label>
                            <input type="number" min="1" name="banyak" value="<?= set_value('banyak') ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="harga_s">Harga/Satuan *<small>(Jika ada bahan yang sama, harga harus sama)</small></label>
                            <input type="number" min="1" name="harga_s" value="<?= set_value('harga_s') ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label"><br></label>
                            <div class="form-group">
                                <button type="submit" name="tambah_bahan" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus fa-sm">
                                    </i> Tambahkan
                                </button>

                            </div>
                        </div>
                </form><br>

            </div>
        </div>
    </div>
</div>



<!-- Begin Page Content -->

<section class="content">
    <?php $this->view('messages') ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Harga Bahan dari Produk</h6>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive">
                <form method="post" action="<?php echo base_url('admin/kalkulasi/bulk_delete') ?>" id="form-delete">
                    <table class="table table-bordered table-striped" id="table1">
                        <thead>
                            <tr>
                                <th width=2%><input type="checkbox" id="check-all"></th>
                                <th class="text-center" width=15%>Nama Bahan</th>
                                <th class="text-center">Banyak</th>
                                <th class="text-center">Ukuran Aluminium</th>
                                <th class="text-center">Ukuran Panjang</th>
                                <th class="text-center">Ukuran Lebar</th>
                                <th class="text-center">Jumlah Bahan</th>
                                <th class="text-center">Harga/satuan</th>
                                <th class="text-center" width=15%>Sub Total</th>
                                <th class="text-center" width=20%>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($bahanperabot as $data) { ?>
                                <tr>
                                    <td><input type='checkbox' class='check-item' name='id_bahan[]' value="<?= $data->id_bahan ?>"></td>
                                    <td class="text-center" value="<?= $data->id_item ?>"><?= $data->nama_item ?></td>
                                    <td class="text-center"><?= $data->banyak ?></td>
                                    <td class="text-center"><?= $data->ukuran ?></td>
                                    <td class="text-center"><?= $data->uk_panjang ?></td>
                                    <td class="text-center"><?= $data->uk_lebar ?></td>
                                    <td class="text-center"><?= $data->jumlah ?></td>
                                    <td class="text-center"><?= number_format($data->harga_satuan, 0, ',', '.') ?></td>
                                    <td class="text-center"><?= number_format($data->jumlah_harga, 0, ',', '.') ?></td>
                                    <td class="text-center" width=20%>
                                        <a href="<?= site_url('admin/kalkulasi/delete/' . $data->id_bahan) ?>" onclick="return confirm('Anda yakin membatalkan data bahan?')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Batal</a>

                                    </td>
                                </tr>
                            <?php $no++;
                                $total = $total + $data->jumlah_harga;
                            } ?>

                            <tr class="gradeA">
                                <td colspan="8" align="center">T O T A L</td>
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
        <form action="<?php echo base_url('admin/kalkulasi/selesai_hitung') ?>" method='post' onsubmit="return validasi_hitung(this)">

            <div class="row justify-content-left">
                <div class="col-lg-6 justify-content-left">
                    <div class="card shadow mb-4 card-header py-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><label for="kd_produk">Kode Produk*</label></h6>
                        </div>
                        <div class="card-body" style="height: 100px;">
                            <div class="box-body table-responsive">
                                <div class="form-group ">
                                    <select id="kd_produk" class="form-control" name="kd_produk">
                                        <option value="" selected hidden>---Pilih---</option>
                                        <?php
                                        $db = $this->db->query("SELECT * FROM produk where updated='1'");
                                        // $db = $this->db->get('produk');
                                        // $this->db->where('updated' == '1');
                                        foreach ($db->result() as $data) {
                                        ?>
                                            <option value="<?php echo $data->kd_produk; ?>">
                                                <?php echo $data->kd_produk; ?> &emsp;
                                                <?php echo $data->nama_produk; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 justify-content-right">

                    <div class="card shadow mb-4 card-header py-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><label for="persentase"><small>(Masukkan persentase keuntungan : 1-100)</small></label></h6>
                        </div>
                        <div class="card-body" style="height: 100px;">
                            <div class="box-body table-responsive">
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <input type="number" min="1" name="persentase" class="form-control">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <input type="submit" name="hitung" value="Hitung Harga" class="btn btn-success btn-sm">
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
</script>
<script src="<?php echo base_url('asset/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/vendor/jquery/jquery-2.2.3.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#jenis_bahan').change(function() {
            var id = $(this).val();
            $.ajax({
                // url : "<?= base_url(); ?>admin/kalkulasi/get_item",
                url: "<?php echo base_url(); ?>admin/kalkulasi/get_item",
                method: "POST",
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id_item + '">' + data[i].nama_item + '</option>';
                    }
                    $('.item').html(html);

                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        $("#check-all").click(function() { // Ketika user men-cek checkbox all
            if ($(this).is(":checked")) // Jika checkbox all diceklis
                $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
            else // Jika checkbox all tidak diceklis
                $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
        });

        $("#btn-delete").click(function() { // Ketika user mengklik tombol delete
            var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi

            if (confirm) // Jika user mengklik tombol "Ok"
                $("#form-delete").submit(); // Submit form
        });
    });
</script>
<script type="text/javascript">
    function validasi_form_input(form) {
        if (form.jenis_bahan.value == "") {
            alert("Jenis Bahan masih kosong!");
            form.jenis_bahan.focus();
            return (false);
        } else if (form.item.value == "") {
            alert("Item Bahan masih kosong!");
            form.item.focus();
            return (false);
        } else if (form.banyak.value == "") {
            alert("Field Banyak masih kosong!");
            form.item.focus();
            return (false);
        } else if (form.harga_s.value == "") {
            alert("Field Harga Bahan masih kosong!");
            form.item.focus();
            return (false);
        } else {
            return (true);
        }
    }
</script>
<script type="text/javascript">
    function validasi_hitung(form) {
        if (form.kd_produk.value == "") {
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
<script type="text/javascript">
    function opsi(value) {
        var st = $("#jenis_bahan").val();
        if (st == "9") {
            document.getElementById("ukuran_p").disabled = true;
            document.getElementById("ukuran_l").disabled = true;
            document.getElementById("ukuran").disabled = false;

        } else if (st == "8" || st == "7" || st == "3") {
            document.getElementById("ukuran").disabled = true;
            document.getElementById("ukuran_p").disabled = false;
            document.getElementById("ukuran_l").disabled = false;

        } else {
            document.getElementById("ukuran_p").disabled = true;
            document.getElementById("ukuran_l").disabled = true;
            document.getElementById("ukuran").disabled = true;

        }
    }
</script>