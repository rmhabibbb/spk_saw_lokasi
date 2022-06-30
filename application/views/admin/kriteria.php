 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kriteria</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Kelola Data Kriteria</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         <div class="card"> 
              <!-- /.card-header -->
                        
              <div class="card-body">

                        <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-blue text-white">Tambah Kriteria</button></a> 
                        <br><br>
                <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>   
                            <th>No</th> 
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>   
                            <th>Tipe</th>   
                            <th>Jenis Input</th>   
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                          <tr>   
                              <td><?=$i++?> </td>  
                              <td><?=$row->nama_kriteria?>  </td> 
                              <td> <?=$row->bobot_vektor?>%</td>   
                              <td><?=$row->tipe?>  </td>  
                              <td><?=$row->jenis_input?>  </td>  
                               <td>
                                  <a href="<?=base_url('admin/kriteria/'.$row->id_kriteria)?>"> 
                                    <button class="btn bg-blue text-white">
                                      Lihat
                                    </button>
                                  </a>
                                   <a data-toggle="modal" data-target="#delete-<?=$row->id_kriteria?>"  href=""><button class="btn bg-red text-white">Hapus</button></a>
                               </td>        
                          </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>


 
 <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah Kriteria</center></h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('admin/kriteria')?>" method="Post"  >  
                         
                                 <table class="table table-bordered"> 
                                        <tr>   
                                            <th>Nama Kriteria</th> 
                                            <th>
                                               <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria" required autofocus >
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Bobot Vektor </th> 
                                            <th>
                                               <input type="number" min="1" class="form-control" name="bobot" placeholder="Masukkan Bobot Vektor Kriteria (%)" required autofocus >
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Tipe</th> 
                                            <th>
                                                 <input name="tipe" type="radio" id="tipe1"   value="Benefit" required /> 
                                                  <label  for="tipe1">Benefit</label>
                                                  <input name="tipe" type="radio" id="tipe2"   value="Cost" required />
                                                  <label  for="tipe2">Cost</label>
                                            </th>  
                                        </tr> 
                                        <tr>   
                                            <th>Jenis Input</th> 
                                            <th>
                                                 <input name="jenis" type="radio" id="jenis1"   value="Option" required /> 
                                                  <label  for="jenis1">Option</label>
                                                  <input name="jenis" type="radio" id="jenis2"   value="Number" required />
                                                  <label  for="jenis2">Number</label>
                                            </th>  
                                        </tr> 
                                </table>
                         
                        <input  type="submit" class="btn bg-primary btn-block text-white"  name="tambah" value="Tambah">  <br><br>
                  
                            <?php echo form_close() ?> 
                        </div> 
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
</div> 


<?php $i = 1; foreach ($list_kriteria as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_kriteria?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data kriteria?</center></h4> 
                           
                        </div>
                        <center><span style="color :red"><i>Semua data yang terkait dengan <?=$row->nama_kriteria?> akan dihapus.</i></span></center>
                        <div class="modal-body"> 
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/kriteria')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_kriteria?>" name="id_kriteria">  
                                        <input  type="submit" class="btn bg-red btn-block text-white "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block text-white" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
<?php endforeach; ?>