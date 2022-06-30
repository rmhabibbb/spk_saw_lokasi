 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lokasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Kelola Data Lokasi</li>
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

                  <a    href="<?=base_url('admin/proseslokasi')?>"><button class="btn bg-blue">Tambah Lokasi</button></a>
                  <br><br>

                <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>   
                            <th>ID Lokasi</th> 
                            <th>Foto Lokasi</th> 
                            <th>Nama Lokasi</th> 
                            <th>Alamat</th>
                            <th>Telepon</th>   
                            <th>Email</th>  
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_lokasi as $row): ?> 
                          <tr>    
                              <td><?=$row->id_lokasi?>  </td> 
                              <td><img src="<?=base_url()?>/assets/<?=$row->thumbnail_foto?>" width="100px">  </td> 
                              <td><?=$row->nama_lokasi?>  </td> 
                              <td> <?=$row->alamat?></td>   
                              <td><?=$row->telepon?>  </td>  
                              <td><?=$row->email?>  </td>  
                              
                               <td>
                                  <a href="<?=base_url('admin/lokasi/'.$row->id_lokasi)?>"> 
                                    <button class="btn bg-blue ">
                                      Lihat Detail
                                    </button>
                                  </a>

                                  <a data-toggle="modal" data-target="#delete-<?=$row->id_lokasi?>"  href=""><button class="btn bg-red">Hapus</button></a>
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


<?php $i = 1; foreach ($list_lokasi as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_lokasi?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data laptop?</center></h4> 
                           
                        </div> <center><span style="color :red"><i>Semua data yang terkait dengan ID Lokasi : [<?=$row->id_lokasi?>], akan dihapus.</i></span></center>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/proseslokasi')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_lokasi?>" name="id_lokasi">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
<?php endforeach; ?>