 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cari Lokasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('pengguna')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Cari Lokasi</li>
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
                <a data-toggle="modal" data-target="#tambah"  href=""><button class="btn btn-primary  btn-block  btn-sm">Cari Lokasi </button></a>
                 
              </div>
              <div class="card-body">

                  <?php if (sizeof($list_lokasi) != 0) { ?>
                    
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
                                            <?php if ($row['poin'] != 0) { ?>
                                              
                                            
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
                                            <?php }  endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>

                                <?php  } ?> 
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
              <h4 class="modal-title">Cari Lokasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('pengguna/cari')?>" method="Post"  >   

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                 
                                 <?php foreach ($list_kriteria as $kriteria): ?>   
                                  <tr>
                                        <th><?=$kriteria->nama_kriteria?></th>
                                        <td>
                                        <?php if ($kriteria->jenis_input == 'Option') { ?>
                                        
                                            <select class="form-control"   name="kriteria_<?=$kriteria->id_kriteria?>">
                                                <option value="">- Pilih -</option> 
                                                <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                                  <?php foreach ($list_param as $row2): ?>  
                                                    <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                                  <?php endforeach; ?> 
                                             </select> 
                                        <?php    }else { ?>
                                             <input type="number" name="kriteria_<?=$kriteria->id_kriteria?>"  class="form-control" min="0"  >
                                        <?php } ?>
                                        </td>
                                    </tr>
                                 <?php endforeach; ?> 
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
