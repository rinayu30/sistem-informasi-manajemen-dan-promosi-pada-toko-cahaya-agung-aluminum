 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Pilih "Logout" jika ingin keluar</div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
         <a class="btn btn-danger" href="<?= site_url('auth/logout') ?>">Logout</a>
       </div>
     </div>
   </div>
 </div>
 <!-- Bootstrap core JavaScript-->
 <script src="<?php echo base_url() ?>asset/vendor/jquery/jquery.min.js"></script>

 <script src="<?php echo base_url() ?>asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?php echo base_url() ?>asset/vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?php echo base_url() ?>asset/js/sb-admin-2.min.js"></script>

 <!--data tables -->
 <script src="<?php echo base_url() ?>assets/datatables/jquery.dataTables.min.js"></script>
 <script src="<?php echo base_url() ?>assets/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- data tables -->
 <script src="<?php echo base_url() ?>js/demo/datatables-demo.js"></script>

 <!-- Page level plugins -->
 <script src="<?php echo base_url() ?>asset/vendor/chart.js/Chart.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="<?php echo base_url() ?>asset/js/demo/chart-area-demo.js"></script>
 <script src="<?php echo base_url() ?>asset/js/demo/chart-pie-demo.js"></script>
 <!-- Page level plugin JavaScript-->
 <!-- <script src="<?php echo base_url('asset/vendor/chart.js/Chart.min.js') ?>"></script> -->
 <script src="<?php echo base_url('asset/vendor/datatables/jquery.dataTables.js') ?>"></script>
 <script src="<?php echo base_url('asset/vendor/datatables/dataTables.bootstrap4.js') ?>"></script>

 <script src="<?php echo base_url() ?>asset/js/demo/datatables-demo.js"></script>

 <script src="<?php echo base_url() ?>asset/vendor/chosen/chosen.jquery.js" type="text/javascript"></script>

 <script>
   var select = $('.chosen-select')
   select.chosen()
 </script>

 <footer class="sticky-footer">
   <div class="container my-auto">
     <div class="copyright text-center my-auto">
       <span><strong> Copyright &copy; </strong>
         <?php echo SITE_NAME . " " . Date('Y') ?></span>
     </div>
   </div>
 </footer>

 </body>

 </html>