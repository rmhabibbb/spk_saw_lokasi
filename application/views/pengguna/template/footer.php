  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer"> 
   <center> Sistem Pendukung Keputusan Pencarian Lokasi Cafe yang Strategis Metode SAW</center>
    <div class="float-right d-none d-sm-inline-block"> 
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?=base_url();?>assets/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?=base_url();?>assets/plugins/chart.js/Chart.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url();?>assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url();?>assets/js/pages/dashboard3.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


      <script>
$(document).ready(function(){
   $("#editform2").change(function(){ 

        var pass = $("#passlama").val(); 
        var pass1 = $("#pass1_ks").val();  
        var pass2 = $("#pass2_ks").val(); 
        var cek1 = 1;
        var cek2 = 1;
        var cek3 = 1; 
        
        $.ajax({

                url:"<?php echo base_url(); ?>pengguna/cekpasslama",
                method:"post", 
                data:{pass},
                    success:function(data){ 
                     if (data != ""){ 
                      cek1 = 0 ;
                      $('#pesan4_ks').html(data); 
                    }else {
                      $('#pesan4_ks').html(data); 
                      cek1 = 1 ;
                    } 
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[name="edit2"]').prop('disabled', true);
                  } else {
                     $(':input[name="edit2"]').prop('disabled', false);
                  }
                }
             });


          $.ajax({

                url:"<?php echo base_url(); ?>pengguna/cekpass",
                method:"post", 
                data:{pass1:pass1},
                    success:function(data){ 
                     if (data != ""){ 
                      cek2 = 0 ;
                      $('#pesan2_ks').html(data); 
                    }else {
                      $('#pesan2_ks').html(data); 
                      cek2 = 1 ;
                    } 
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[name="edit2"]').prop('disabled', true);
                  } else {
                     $(':input[name="edit2"]').prop('disabled', false);
                  }
                }
             });
 
          $.ajax({

                url:"<?php echo base_url(); ?>pengguna/cekpass2",
                method:"post", 
                data:{pass1:pass1,pass2:pass2},
                    success:function(data){
                     if (data != ""){ 
                      cek3 = 0;
                      $('#pesan3_ks').html(data); 
                    }else {
                      $('#pesan3_ks').html(data); 
                      cek3 = 1 ;
                    } 
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[name="edit2"]').prop('disabled', true);
                  } else {
                     $(':input[name="edit2"]').prop('disabled', false);
                  }

                 }
             });

          

            


        }); 


});
</script>
</body>
</html>
