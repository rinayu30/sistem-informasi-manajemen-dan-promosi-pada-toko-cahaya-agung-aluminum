        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Pengguna</h1><br />
            <a href="<?= site_url('admin/pengguna/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-plus fa-sm"></i> Tambah Data</a>
            <!-- Page Heading -->

            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>
          <section class="content">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
              </div>
              <div class="card-body">
                <div class="box-body table-responsive">
                  <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Kontak</th>
                        <th>Level</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($row->result() as $key => $data) { ?>
                        <tr>
                          <td width=2%><?= $no++ ?></td>
                          <td class="text-center"><?= $data->nama_user ?></td>
                          <td class="text-center"><?= $data->username ?></td>
                          <td class="text-center"><?= $data->email ?></td>
                          <td class="text-center"><?= $data->no_telp ?></td>
                          <td class="text-center">
                            <?php if ($data->level == '1') { ?>
                              <span class="badge badge-primary">Admin</span>
                              </a>
                            <?php } else if ($data->level == '2') { ?>
                              <span class="badge badge-success">Karyawan</span>
                            <?php } else { ?>
                              <span class="badge badge-danger">Pengunjung</span>

                            <?php } ?>


                          </td>

                          <td colspan="3" class="text-center">
                            <form action="<?= site_url('admin/pengguna/delete') ?>" method="post">

                              <a href="<?= site_url('admin/pengguna/edit/' . $data->id_user) ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit</a>

                              <input type="hidden" name="id_user" value="<?= $data->id_user ?>">
                              <button onclick="return confirm('Anda yakin menghapus data?')" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Hapus
                              </button>
                            </form>
                            <!-- <td onclick="javascript : return confirm('Anda yakin menghapus data?')"><?php echo anchor('admin/pengguna/delete/' . $data->id_user) ?>,'<div class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></div></td> -->
                            <!-- <a href="#modalDel" data-toggle="modal" onclick="$('#modalDel #formDel').attr('action','<?= site_url('admin/pengguna/delete/' . $data->id_user) ?>')" class ="btn btn-danger btn-sm" ><i class="fa fa-trash"></a></i> -->
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>
          <!-- Modal delete-->
          <div class="modal fade" id="modal-item">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Yakin akan menghapus data ini?</h4>
                </div>
                <div class="modal-footer">
                  <form action="" id="formDel" method="post">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger btn-sm">Ya</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
          <!-- End of Page Wrapper -->