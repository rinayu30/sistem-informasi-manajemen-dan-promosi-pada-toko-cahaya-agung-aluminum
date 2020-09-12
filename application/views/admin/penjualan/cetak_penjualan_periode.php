<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Penjualan Periode</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <!-- <img src="assets/images/sekolah.png" style="position: absolute; width: 90px; height: auto;"> -->
    <table style="width: 100%;">
        <tr>
            <td><img src="#" style=" width: 90px; height: auto;"></td>
            <td align="center">
                <span style="font-size: 25px; line-height: 1.3; font-weight: bold;">
                    TOKO CAHAYA AGUNG ALUMINIUM PEKANBARU</span>
                <span style="font-size: 20px; line-height: 1.3;">

                    <br>Jl. Garuda Sakti No.Km 2,5, Simpang Baru, Kec. Tampan </span>
                <span style="font-size: 20px; line-height: 1.3;">
                    <br>Kota Pekanbaru, Riau 28295</span>
                <span style="font-size: 20px; line-height: 1.3;">
                    <br>Kontak: (+62) 8127 774 130</span>
            </td>
            <!-- <td><img src="assets/images/logo2.JPG" style=" width: 90px; height: auto;"></td> -->
        </tr>
    </table>

    <hr class="line-title">
    <center>
        <p><span style="font-size: 16px;  font-weight: bold;">LAPORAN PENJUALAN PER PERIODE</span></p>
    </center><br><br>
    <table>
        <tr style="font-size: 14px; font-weight: bold">
            <?php $tanggal1 = $_POST['tanggal1'];  ?>
            <?php $tanggal2 = $_POST['tanggal2'];  ?>
            <td>Tanggal</td>
            <td> : <i><?php echo $_POST['tanggal1'] ?><b> s/d </b><?php echo $_POST['tanggal2'] ?></i>
            </td>
        </tr>
    </table>
    <br><br>
    <table class="table table-bordered table-striped" id="dataTable" width="100%" border=1 cellspacing="0">
        <thead>
            <tr class="text-center">
                <th>No Faktur</th>
                <th>Pembeli</th>
                <th>Tanggal Penjualan</th>
                <th>Total Bayar</th>
                <th>Uang Muka</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            $total = 0;
            foreach ($record as $key => $data) { ?>
                <tr>
                    <td width=2%><?= $data->kd_penjualan ?></td>
                    <td class="text-center" value="<?= $data->id_pembeli ?>"><?= $data->nama_pembeli ?></td>
                    <td class="text-center" width=10%><?= $data->tgl_penjualan ?></td>
                    <td class="text-center">Rp. <?= number_format($data->tot_bayar, 0, ',', '.') ?></td>
                    <td class="text-center">Rp. <?= number_format($data->dp_awal, 0, ',', '.') ?></td>
                    <td class="text-center">Rp. <?= number_format($data->sisa, 0, ',', '.') ?></td>
                </tr>
            <?php
                $total = $total + $data->total_bayar;
                // $jml = $jml + $data->jml;
            } ?>
            <tr>
                <td align="center" colspan="3"><b>Total</b></td>
                <td colspan="3" align="left">Rp.<?php echo number_format($total) ?></td>
            </tr>

        </tbody>

    </table>
    <table style="font-weight: bold;" align="right">
        <tr>
            <td><br><br><br><br><br><br></td>
            <td>Pekanbaru,<?php $date = date('d-m-Y');
                            echo $date;
                            ?> <br><br>Dibuat oleh,<br></td>
        </tr>
        <tr>
            <td><br><br><br><br><br><br><br><br></td>
            <!-- <td height="100"><?php echo $this->session->userdata('nama'); ?></td> -->

        </tr>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br>
</body>


</html>