
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK. Pencarian Lokasi Cafe yang Strategis Metode SAW</title>

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
      <a href="<?=base_url();?>" class="h4"><b>Sistem Pendukung Keputusan</b><br>Pencarian Lokasi Cafe yang Strategis Metode SAW</a>
    </div>
    <div class="card-body"> 
     <?= $this->session->flashdata('msg') ?>
     <center>
       <b>
      <p>Form Pendaftaran</p>
    </b>
     </center>
                          <form action="<?= base_url('daftar')?>" method="Post" id="formadd3"> 

        
        <div class="input-group mb-3">
              <input type="text" class="form-control" name="nama_depan"   placeholder="Nama Depan" required value="<?php
                                if(isset($_COOKIE['nama_depan_temp'])) {echo $_COOKIE['nama_depan_temp'];}
                            ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>


        <div class="input-group mb-3">
              <input type="text" class="form-control" name="nama_belakang"   placeholder="Nama Belakang" required value="<?php
                                if(isset($_COOKIE['nama_belakang_temp'])) {echo $_COOKIE['nama_belakang_temp'];}
                            ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>


        <div class="help-info" id="pesan1_pgw"> </div>
        <div class="input-group mb-3">
             <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus value="<?php
                                if(isset($_COOKIE['email_temp'])) {echo $_COOKIE['email_temp'];}
                            ?>" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-at"></span>
            </div>
          </div>
        </div>
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



          <div class="form-group" style="margin-bottom: 2px">
                    <label for="exampleInputEmail1">Jenis Kelamin</label><br>
                    <input name="jk" type="radio" id="jk1" <?php if (isset($_COOKIE['jk']) && $_COOKIE['jk']== "Laki - Laki") {echo "checked";}?>  value="Laki - Laki" required /> 
              <label  for="jk1">Laki - Laki</label>
              <input name="jk" type="radio" id="jk2" <?php if (isset($_COOKIE['jk']) && $_COOKIE['jk'] == "Perempuan") {echo "checked";}?>  value="Perempuan" required />
              <label  for="jk2">Perempuan</label>                  
          </div> 
          

          <div class="form-group" >

                    <label for="exampleInputEmail1">Tanggal Lahir</label><br>
              <input type="date" class="form-control" name="tanggal_lahir"   required value="<?php
                                if(isset($_COOKIE['tanggal_lahir_temp'])) {echo $_COOKIE['tanggal_lahir_temp'];}
                            ?>" >
          
        </div>
        
        <div class="input-group mb-3">
              <input type="text" class="form-control" name="no_telp"   placeholder="Nomor Handphone" required value="<?php
                                if(isset($_COOKIE['no_telp'])) {echo $_COOKIE['no_telp'];}
                            ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>


        
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <input type="submit" name="daftar" value="Daftar " class="btn btn-primary btn-block"> 
          </div>
          <!-- /.col -->
        </div>
      </form>
        <hr>
      <!-- /.social-auth-links -->
 
      <p class="mb-0">
        <a href="<?=base_url('login');?>" class="text-center">Sudah punya akun ? Login disini</a>
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
        var cek1 = 1;
        var cek2 = 1;
        var cek3 = 1; 
 
          $.ajax({

                url:"<?php echo base_url(); ?>daftar/cekemail",
                method:"post", 
                data:{email:email},
                    success:function(data){     
                    if (data != ""){ 
                      cek1 = 0 ;
                      $('#pesan1_pgw').html(data); 
                    }else {
                      $('#pesan1_pgw').html(data); 
                      cek1 = 1 ;
                    }  
                  if (cek1 == 0 || cek2== 0 || cek3 == 0) {
                     $(':input[type="submit"]').prop('disabled', true);
                  } else {
                     $(':input[type="submit"]').prop('disabled', false);
                  }
                }
             });

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
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
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
                    if (cek1 == 0 || cek2== 0 || cek3 == 0) {
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
