 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">SPK. Metode SAW</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('pengguna')?>">Beranda</a></li>
              <li class="breadcrumb-item active">SPK. Metode SAW</li>
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
              <div class="card-header">
              
              </div>
              <div class="card-body">

               
                              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>   
                                                  <th>No.</th>
                                                  <th>Foto </th>
                                                  <th>Nama Lokasi </th> 
                                                  <th>Alamat</th>   
                                                  <th>Telepon</th>   
                                                  <th>Skor</th>
                                                  <th>Aksi</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_lokasi as $row): ?> 
                                            <?php $lokasi = $this->Lokasi_m->get_row(['id_lokasi' => $row['id_lokasi']]); ?>
                                                <tr>   
                                                    <td><?=$i++?> </td>  
                                                    <td><img src="<?=base_url()?>/assets/<?=$lokasi->thumbnail_foto?>" width="100px">  </td> 
                                                    <td> <?=$lokasi->nama_lokasi?>  </td> 
                                                    <td><?=$lokasi->alamat?> </td>
                                                    <td><?=$lokasi->telepon?> </td>

                                                    <td><?= $row['nilai_akhir'] ?>  </td>  
                                                     <td>
                                                        <a href="<?=base_url('pengguna/lokasi/'.$lokasi->id_lokasi)?>"> 
                                    <button class="btn bg-blue ">
                                      Lihat Detail
                                    </button>
                                  </a>
                                                     </td>
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
          </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 

 <div class="modal fade" id="tambah">
        <div class="modal-dialog tambah">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cari Laptop</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('customer/index')?>" method="Post"  >   

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                 
                                    <?php $i= 1; foreach ($list_kriteria as $row): ?>  
 
                                <tr>
                                    <th><?=$row->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  name="c<?=$row->id_kriteria?>">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php  endforeach; ?>
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue btn-block "  name="cari" value="Cari">  <br><br>
                  
                            <?php echo form_close() ?> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
