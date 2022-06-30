
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK. Pemilihan Laptop Metode SAW</title>

    <link rel="icon" href="<?=base_url();?>/logo.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?=base_url();?>" class="h4"><b>Sistem Pendukung Keputusan</b><br>Pemilihan Laptop Metode SAW</a>
    </div>
    <div class="card-body"> 
     <?= $this->session->flashdata('msg') ?>

     <center>
       <b>
      <p>Reset Password</p>
    </b>
     </center>
                          <form action="<?= base_url('lupapassword/proresreset')?>" method="Post" id="formadd3">  
                <input type="hidden" name="email" value="<?=$email?>">
         <div class="help-info" id="pesan2_pgw"> </div>
        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" id="pass1_pgw"  placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="help-info" id="pesan3_pgw"> </div>
        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password2" id="pass2_pgw" placeholder="Konfirmasi Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <center>  <input type="submit" class="btn btn-block bg-blue waves-effect" value="Submit" name="proses"> </center>
          </div>
          <!-- /.col -->
        </div>
      </form>
        <hr>
      <!-- /.social-auth-links -->

      <p class="mb-1">
       <center> <a href="<?=base_url('login');?>" style="color:red">Batal</a></center>
      </p> 
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>/assets/js/adminlte.min.js"></script>

<script>
$(document).ready(function(){
    
 
$("#formadd3").change(function(){ 

        var email = $("#email").val(); 
        var pass1 = $("#pass1_pgw").val();  
        var pass2 = $("#pass2_pgw").val();  
        var cek2 = 1;
        var cek3 = 1; 
 
   

          $.ajax({

                url:"<?php echo base_url(); ?>daftar/cekpass",
                method:"post", 
                data:{pass1:pass1},
                    success:function(data){ 
                     if (data != ""){ 
                      cek2 = 0 ;
                      $('#pesan2_pgw').html(data); 
                    }else {
                      $('#pesan2_pgw').html(data); 
                      cek2 = 1 ;
                    } 
                    if ( cek2== 0 || cek3 == 0) {
                     $(':input[type="submit"]').prop('disabled', true);
                  } else {
                     $(':input[type="submit"]').prop('disabled', false);
                  }
                }
             });
 
          $.ajax({

                url:"<?php echo base_url(); ?>daftar/cekpass2",
                method:"post", 
                data:{pass1:pass1,pass2:pass2},
                    success:function(data){
                     if (data != ""){ 
                      cek3 = 0;
                      $('#pesan3_pgw').html(data); 
                    }else {
                      $('#pesan3_pgw').html(data); 
                      cek3 = 1 ;
                    } 
                    if ( cek2== 0 || cek3 == 0) {
                     $(':input[type="submit"]').prop('disabled', true);
                  } else {
                     $(':input[type="submit"]').prop('disabled', false);
                  }

                 }
             });

          

            


        }); 


});
</script>

</body>
</html>
