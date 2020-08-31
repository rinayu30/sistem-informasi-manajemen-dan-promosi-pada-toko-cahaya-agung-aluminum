<section class="content">
    <div class="container-fluid">
        <a href="<?= site_url('admin/kalkulasi/tampilHarga') ?>" class="btn btn-primary btn-sm"><i class="fa fa-undo fa-sm"></i> Kembali</a>
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
                                foreach ($row->result() as $key => $data) { ?>
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
                                            <!-- <a href="#" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit</a> -->
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
    </div>
</section>