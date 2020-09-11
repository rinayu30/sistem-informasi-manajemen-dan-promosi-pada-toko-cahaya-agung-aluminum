<table border=0 align="center" width="90%">
    <tr>
        <!-- <td width="5%"><img src="assets_user/img/gallery/caa2.svg" width="80"></td> -->
        <td colspan="2" width="90%">

            <h4 align="center"> <b>TOKO CAHAYA AGUNG ALUMINIUM</b></h4><br>
            <<b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan,
                Kota Pekanbaru, Riau 28295
                Kontak : (+62) 8127 774 130
        </td>
    </tr>
    <tr>
        <td colspan="3">=============================================================================</td>
    </tr>
</table><br>
<h4 align="center"> <b>LAPORAN PEMBELIAN BAHAN</b></h4><br>
<?php $tanggal1 = $_POST['tanggal1'];  ?>
<?php $tanggal2 = $_POST['tanggal2'];  ?>
<i><b>Tanggal : </b>
    <?php echo $_POST['tanggal1'] ?><b> s/d </b><?php echo $_POST['tanggal2'] ?>
</i><br><br>
<table class="table table-bordered table-striped" id="dataTable" width="100%" border=1 cellspacing="0">
    <thead>
        <tr class="text-center">
            <th>Kode</th>
            <th>Pemasok</th>
            <th>Tanggal Beli</th>
            <th>Nama Bahan</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tanggal1 =  $this->input->post('tanggal1');
        $tanggal2 =  $this->input->post('tanggal2');

        $total = 0;
        $jumlah = 0;
        foreach ($laporan->result() as $key => $data) { ?>

            <tr class="text-center">
                <td><?= $data->id_bmasuk ?></td>
                <td value="<?= $data->id_pemasok ?>"><?= $data->nama_pemasok ?></td>
                <td> <?= $data->tgl_beli ?></td>
                <td value="<?= $data->id_item ?>"><?= $data->nama_item ?></td>
                <td><?= $data->jumlah ?></td>
                <td>Rp. <?= number_format($data->harga_satuan, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($data->total_harga, 0, ',', '.') ?></td>

            </tr>
        <?php
            $total = $total + $data->total_harga;
            $jumlah = $jumlah + $data->jumlah;
        } ?>

    </tbody>
    <tr>
        <td align="center" colspan="5"><b>Total</b></td>
        <td colspan="1" align="center"><?php echo $jumlah ?></td>
        <td colspan="1">Rp. <?= number_format($total, 0, ',', '.') ?></td>

    </tr>
</table>
<br><br>
<div class="row">
    <div class="col-md-6 justify-content-right">

        <p align="right">
            Pekanbaru, <?php $date = date('d-m-Y');
                        echo $date;
                        ?><br>
            Mengetahui,
            <br><br><br><br>
            <!-- <?php echo $this->session->userdata('nama'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
        </p>
    </div>
    <div class="col-md-6 justify-content-left"></div>
</div>