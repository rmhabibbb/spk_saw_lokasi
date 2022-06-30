 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$lokasi->nama_lokasi?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('pengguna')?>">Beranda</a></li> 
              <li class="breadcrumb-item active"><?=$lokasi->nama_lokasi?> </li>
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

                   <?= form_open_multipart('admin/proseslokasi/') ?>
                    <input type="hidden" name="id_lokasi"  required value="<?=$lokasi->id_lokasi?>" >
                                                 
                            <fieldset> 
                              
 
                                <div class="form-group">

                                    <div class="form-line">
                                        <div class="row">
                                          <div class="col-md-4">
                                                 <label class="control-label">Foto</label><br>
                                                 <img src="<?=base_url()?>/assets/<?=$lokasi->thumbnail_foto?>" width="100%">  
                                                 
                                             </div> 

                                             <div class="col-md-8">
                                                 <label class="control-label">Nama Lokasi</label>
                                                 <br><?=$lokasi->nama_lokasi?>
                                                 <br><br>
                                                 <label class="control-label">Telepon</label>
                                                  <br><?=$lokasi->telepon?>
                                                 <br><br>
                                                  <label class="control-label">Alamat</label>
                                                  <br><?=$lokasi->alamat?>
                                                 <br><br>
                                             </div> 

                                         </div> 
                                   </div>
                                 </div>
                            </fieldset> 
                             <table class="table table-bordered "> 
                                <?php foreach ($list_kriteria as $kriteria): ?>   
                                  <tr>
                                        <th><?=$kriteria->nama_kriteria?></th>
                                        <td>
                                        <?php if ($kriteria->jenis_input == 'Option') { ?>

                                          <?php if ($this->DetailLokasi_m->get_num_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) == 0) { ?>

                                           -

                                          <?php    }else { ?>
                                          <?php $bobot = $this->DetailLokasi_m->get_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) ?>
                                           <?=$this->Bobot_m->get_row(['id_bobot' => $bobot->id_bobot])->keterangan?>


                                          <?php } ?>
                                        
                                            
                                        <?php    }else { ?>
                                           <?php if ($this->DetailLokasi_m->get_num_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) == 0) { ?>

                                            -

                                          <?php    }else { ?>

                                          <?php $bobot = $this->DetailLokasi_m->get_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) ?>
                                         <?=$bobot->keterangan?>
                                          <?php } ?>

                                        <?php } ?>
                                        </td>
                                    </tr>
                                 <?php endforeach; ?> 
                                 
                               
                            </table>
                            
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 