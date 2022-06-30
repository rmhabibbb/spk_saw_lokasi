  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?=base_url()?>/assets/<?=$profil->foto?>"
                       alt="User profile picture" style="width: 180px; height: 180px">
                </div>

                <br>
                <a data-toggle="modal" data-target="#tambah"  href="" class="btn btn-primary btn-block"><b>Ganti Foto</b></a>
                <?php if ($profil->foto != 'foto/default.jpg' && $profil->foto != 'foto/default-l.jpg' && $profil->foto != 'foto/default-p.jpg') { ?> 
                  <a data-toggle="modal" data-target="#hapus"  href=""  class="btn bg-red btn-block"><b>Hapus Foto</b></a>
                <?php } ?>
                <hr>

                <a data-toggle="modal" data-target="#ganti" class="btn btn-primary btn-block"><b>Ganti Password</b></a>
  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->  
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card"> 
              <div class="card-body">
                 
                  <?php echo form_open_multipart('admin/proses_edit_profil');?>
                       <input type="hidden" name="email_x" value="<?=$profil->email?>" /> 
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" placeholder="Email" value="<?=$profil->email?>" />
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Nama Depan</label>
                        <div class="col-sm-10">
                          <input type="text" name="nama_depan" class="form-control" placeholder="Nama Depan" value="<?=$profil->nama_depan?>" />
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Nama Belakang</label>
                        <div class="col-sm-10">
                          <input type="text" name="nama_belakang" class="form-control" placeholder="Nama Belakang" value="<?=$profil->nama_belakang?>" />
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input name="jk" type="radio" id="jk1" <?php if ($profil->jk== "Laki - Laki") {echo "checked";}?>  value="Laki - Laki" required /> 
                            <label  for="jk1">Laki - Laki</label>
                            <input name="jk" type="radio" id="jk2" <?php if ($profil->jk== "Perempuan") {echo "checked";}?>  value="Perempuan" required />
                            <label  for="jk2">Perempuan</label>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                          <input type="date" name="tanggal_lahir" class="form-control" " value="<?=$profil->tanggal_lahir?>" />
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                          <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" value="<?=$profil->no_telp?>" />
                        </div>
                      </div>  
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <input type="submit" class="btn btn-primary" value="Simpan" name="edit"> 
                        </div>
                      </div>
                    </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="tambah">
        <div class="modal-dialog tambah">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Foto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <?= form_open_multipart('admin/proses_edit_profil/') ?>   

                        <input type="file" name="foto" required>  
                  
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 

                        <input  type="submit" class="btn btn-primary"  name="uploadfoto" value="Upload">  

                            <?php echo form_close() ?> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

   <div class="modal fade" id="hapus">
        <div class="modal-dialog hapus">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Foto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <?= form_open_multipart('admin/proses_edit_profil/') ?>   
            <p style="color: red" >foto akan diganti dengan foto default</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 

                        <input  type="submit" class="btn bg-red"  name="hapusfoto" value="Hapus">  

                            <?php echo form_close() ?> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

   <div class="modal fade" id="ganti">
        <div class="modal-dialog ganti">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <form action="<?= base_url('admin/proses_edit_profil')?>" method="Post" id="editform2"> 
                           
                          <div class="help-info" id="pesan4_ks"> </div>
                          <div class="input-group mb-3">
                                              <input  type="password" class="form-control" name="passlama" id="passlama" placeholder="Password Lama" required>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>
                          <div class="help-info" id="pesan2_ks"> </div>
                          <div class="input-group mb-3">
                                              <input type="password" class="form-control" name="pass1" id="pass1_ks" placeholder="Password baru" required>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>

                          <div class="help-info" id="pesan3_ks"> </div>
                          <div class="input-group mb-3">
                                              <input   type="password" class="form-control" name="pass2"  id="pass2_ks"  placeholder="Konfirmasi Password Baru" required>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>
                         
                            
                  
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 

                        <input  type="submit" class="btn btn-primary"  name="edit2" value="Simpan"> 

                            <?php echo form_close() ?>   
 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>