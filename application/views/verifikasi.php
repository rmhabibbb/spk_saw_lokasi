
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
      <p>Verifikasi Kode</p>
    </b>
     </center>
                <?php echo form_open('lupapassword/proses') ?> 
                <input type="hidden" name="email" value="<?=$email?>">
            <div class="row">
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="first" type="text" name="k1" class="form-control" style="text-align: center;">
              </div>
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="second" type="text" name="k2" class="form-control" style="text-align: center;">
              </div>
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="third" type="text" name="k3" class="form-control" style="text-align: center;">
              </div>
              <div class="col-sm-3 col-md-3">
                 <input onkeypress='validate(event)' maxlength="1" id="fourth" type="text" name="k4" class="form-control" style="text-align: center;">
              </div> 
            </div>
            <br>
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <center>  <input type="submit" class="btn btn-block bg-blue waves-effect" value="Verifikasi" name="proses"> </center>
          </div>
          <!-- /.col -->
                        <br>
                        <br>
                        <center>kirim ulang kode verifikasi anda ?  <span style="color : red" id="bataswaktu"></span><span style="color : blue" id="kirimulang"></span></center> 
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
  

   
<!-- jQuery -->
<script src="<?=base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>/assets/js/adminlte.min.js"></script>

    <script type="text/javascript" src="<?=base_url();?>/assets/js/jquery.autotab.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#first').autotab({ target: '#second', format: 'numeric' });
        $('#second').autotab({ target: '#third', format: 'numeric', previous: '#first' });
        $('#third').autotab({ target: '#fourth', previous: '#third', format: 'numeric' });
    });
    </script>


    <script type="text/javascript">


        function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
    </script>


<script>
// Set the date we're counting down to

<?php $next_date = date('M j, Y H:i:s', strtotime($_SESSION['waktu_kirimulang'] .' +2 minutes')); ?>
var countDownDate = new Date("<?=$next_date?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("bataswaktu").innerHTML =   minutes + " : " + seconds ;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("bataswaktu").innerHTML = "<a href='<?=base_url('lupapassword/kirimkodeulang')?>'>Kirim </a>";
  }
}, 1000);
</script>
</body>

</html>