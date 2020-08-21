<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Hitung Harga Produk</h1><br />
        <!-- <a href="<?= site_url('admin/kalkulasi/') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Tambah Data</a> -->
        <!-- Page Heading -->

        <a href="<?= site_url('admin/produk') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label class="control-label">Jenis Bahan*</label>

                        <select name="jenis_bahan" id="jenis_bahan" class="form-control">
                            <option value="0">--Pilih--</option>
                            <?php foreach ($data->result() as $row) : ?>
                                <option value="<?php echo $row->id_jenis; ?>"><?php echo $row->nama_jenis; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group col-md-5">
                        <label class="control-label">Nama Bahan*</label>
                        <select name="item" class="item form-control">
                            <option value="0">--Pilih--</option>
                        </select>

                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label"></label>
                        <div class="form-group">
                            <button type="submit" name="tambah_bahan" class="btn btn-success btn-sm"><i class="fas fa-plus fa-sm"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Begin Page Content -->

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
                            <h6 class="m-0 font-weight-bold text-primary"><label for="kd_produk">Kode Produk*</label></h6>
                        </div>
                        <div class="card-body" style="height: 100px;">
                            <div class="box-body table-responsive">
                                <div class="form-group ">
                                    <form action="<?php echo base_url('admin/kalkulasi/hitung_harga') ?>" method='post' onsubmit="return validasi_selesai(this)">
                                        <select id="kd_produk" class="form-control" name="kd_produk" required>
                                            <option value="" selected hidden>---Pilih---</option>
                                            <?php
                                            $db = $this->db->get('produk');
                                            foreach ($db->result() as $data) {
                                            ?>
                                                <option value="<?php echo $data->kd_produk; ?>">
                                                    <?php echo $data->kd_produk; ?> &emsp;
                                                    <?php echo $data->nama_produk; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                </div>
                                <td align="right"><input type="submit" value="Hitung Harga" class="btn btn-success btn-sm">

                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-4 justify-content-center">

                    <div class="card shadow mb-4 card-header py-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><label for="id_jenis"><small>(Masukkan persentase keuntungan)</small></label></h6>
                        </div>
                        <div class="card-body" style="height: 100px;">
                            <div class="box-body table-responsive">

                                <form action="<?= site_url('admin/kalkulasi/proses') ?>" method="post">

                                    <div class="row">
                                        <div class="form-group col-md-9">
                                            <select id="id_jenis" class="form-control" name="id_jenis" required>
                                                <option value="" selected hidden>---Pilih---</option>
                                                <?php
                                                $db = $this->db->get('jenis_bahan');
                                                foreach ($db->result() as $row) {
                                                ?>
                                                    <option value="<?php echo $row->id_jenis; ?>">
                                                        <?php echo $row->nama_jenis; ?>
                                                    </option>
                                                <?php } ?>
                                            </select> </div>
                                        <div class="form-group  col-md-3 text-right">
                                            <button type="submit" name="tambah_bahan" class="btn btn-success btn-sm"><i class="fas fa-plus fa-sm"></i></button>
                                        </div>
                                    </div>
                            </div>



                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 justify-content-right">
                    <div class="card shadow mb-4 card-header py-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><label for="harga_jual">Harga Jual Produk </label></h6>
                        </div>
                        <div class="">
                            <div class="card-body" style="height: 100px;">
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

        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Bahan Produk</h6>
            </div>
            <div class="card-body">
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="id_item">Nama Bahan *</label>
                            <select id="id_item" class="form-control" name="id_item" required>
                                <option value="" selected hidden>---Pilih---</option>
                                <!-- <?php
                                        $db = $this->db->get('item');
                                        foreach ($db->result() as $rw) {
                                        ?>
                                            <option value="<?php echo $rw->id_item; ?>">
                                                <?php echo $rw->nama_item; ?>
                                            </option>
                                        <?php } ?> -->
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#jenis').change(function() {
                                        var id = $(this).val();
                                        // var id = {
                                        //     id_jenis: $("#id_jenis").val()
                                        // };
                                        $.ajax({
                                            method: "POST",
                                            url: "<?= base_url(); ?>admin/kalkulasi/get_item_byjenis",

                                            data: {
                                                id: id
                                            },
                                            async: false,
                                            dataType: 'json',
                                            success: function(array) {
                                                var html = '';
                                                // var i;
                                                for (let index = 0; index < array.length; index++) {
                                                    html += '<option value=' + array[index].id_item + '>' + array[index].nama_item + '</option>';
                                                }
                                                $('.item').html(html);

                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ukuran">Ukuran *<small> (Isi jika bahan tidak memiliki dimensi)</small></label>
                            <input type="number" min="1" name="ukuran" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ukuran_p">Ukuran Panjang*<small> (Isi jika bahan memiliki dimensi)</small></label>
                            <input type="number" min="-1" name="ukuran_p" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ukuran_l">Ukuran Lebar* <small> (Isi jika bahan memiliki dimensi)</small></label>
                            <input type="number" min="-1" name="ukuran_l" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="banyak">Banyak *</label>
                            <input type="number" min="1" name="banyak" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6 justify-content-right">
                            <label for="harga_s">Harga/Satuan *</label>
                            <input type="number" min="1" name="harga_s" class="form-control" required>
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
                            foreach ($bahan as $b) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td class="text-center"><?php echo $b->$nama_bahan ?></td>
                                    <td class="text-center"><?php echo $b->$banyak ?></td>
                                    <td class="text-center"><?php echo $b->$ukuran ?></td>
                                    <td class="text-center"><?php echo $b->$uk_panjang ?></td>
                                    <td class="text-center"><?php echo $b->$uk_lebar ?></td>
                                    <td class="text-center"><?php echo $b->$jumlah ?></td>
                                    <td class="text-center"><?php echo $b->$harga_satuan ?></td>
                                    <td class="text-center"><?php echo $b->$jumlah_harga ?></td>
                                    <td class="text-center" width=20%>
                                        <a href="" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit</a>
                                        <a href="<?= site_url('admin/kalkulasi/delete/' . $b->id_bahan) ?>" onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Batal</a>

                                    </td>
                                </tr>
                            <?php $total = $total + ($r->jumlah_jual * $r->harga_jual);
                                $no++;
                            } ?>
                            <tr class="gradeA">
                                <td colspan="8" align="center">T O T A L</td>
                                <td>Rp. <?php echo number_format($total, 2); ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.container-fluid -->
    <!-- End of Page Wrapper
   <?= site_url('admin/kalkulasi/edit/' . $data->id_kalkulasi) ?> -->



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
                            html += '<option>' + data[i].nama_item + '</option>';
                        }
                        $('.item').html(html);

                    }
                });
            });
        });
    </script>