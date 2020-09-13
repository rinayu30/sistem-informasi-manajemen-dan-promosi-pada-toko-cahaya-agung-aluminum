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
    </table><br>
<h3 align="center">Laporan Penjualan</h3> <br><br>

	<table align="center" class="table table-bordered" id="dataTable" width="100%" border=1 cellspacing="0">
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
					
                        foreach ($record as $data) {
					 ?>
						<tr>
                            <td width=2%><?= $data->kd_penjualan ?></td>
                            <td class="text-center" value="<?= $data->id_pembeli ?>"><?= $data->nama_pembeli ?></td>
                            <td class="text-center" width=10%><?= $data->tgl_penjualan ?></td>
                            <td class="text-center">Rp. <?= number_format($data->tot_bayar, 0, ',', '.') ?></td>
                            <td class="text-center">Rp. <?= number_format($data->dp_awal, 0, ',', '.') ?></td>
                            <td class="text-center">Rp. <?= number_format($data->sisa, 0, ',', '.') ?></td>
                        </tr>
						<?php }?>
						
					</tbody>
					<!-- <tr >				
						<td align="center" colspan="4"><b>Total</b></td>
						<td align="center"><?php echo $jml ?></td>		
						<td  colspan="1">Rp.<?php echo number_format($total) ?></td>
					</tr> -->
				
				</table>
               
    