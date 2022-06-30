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
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/lokasi')?>">Kelola Data Lokasi</a></li>
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
                                                 <input type="file" name="foto" class="form-control"  >
                                                 
                                             </div> 

                                             <div class="col-md-8">
                                                 <label class="control-label">Nama Lokasi</label>
                                                 <input type="text" name="nama_lokasi" class="form-control" placeholder="Masukkan Nama lokasi"  required value="<?=$lokasi->nama_lokasi?>" >
                                                 <br>
                                                 <label class="control-label">Telepon</label>
                                                 <input type="text" name="telepon" class="form-control" placeholder="Masukkan Telepon"  required value="<?=$lokasi->telepon?>" >
                                                 <br>
                                                  <label class="control-label">Alamat</label>
                                                 <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" ><?=$lokasi->alamat?></textarea>
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

                                            <select class="form-control"  required name="kriteria_<?=$kriteria->id_kriteria?>">
                                                <option value="">- Pilih -</option> 
                                                <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                                  <?php foreach ($list_param as $row2): ?>  
                                                    <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                                  <?php endforeach; ?> 
                                             </select> 

                                          <?php    }else { ?>
                                          <?php $bobot = $this->DetailLokasi_m->get_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) ?>
                                            <select class="form-control"  required name="kriteria_<?=$kriteria->id_kriteria?>">
                                                <option value="<?=$bobot->id_bobot?>"><?=$this->Bobot_m->get_row(['id_bobot' => $bobot->id_bobot])->keterangan?></option> 
                                                <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                                  <?php foreach ($list_param as $row2): ?>  
                                                    <?php if ($bobot->id_bobot != $row2->id_bobot) { ?> 
                                                    <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                                    <?php } ?>
                                                  <?php endforeach; ?> 
                                             </select> 


                                          <?php } ?>
                                        
                                            
                                        <?php    }else { ?>
                                           <?php if ($this->DetailLokasi_m->get_num_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) == 0) { ?>

                                             <input type="number" name="kriteria_<?=$kriteria->id_kriteria?>" required class="form-control" min="0"  >

                                          <?php    }else { ?>

                                          <?php $bobot = $this->DetailLokasi_m->get_row(['id_kriteria' => $kriteria->id_kriteria, 'id_lokasi' => $lokasi->id_lokasi]) ?>
                                          <input type="number" name="kriteria_<?=$kriteria->id_kriteria?>" required class="form-control" min="0"  value="<?=$bobot->keterangan?>">
                                          <?php } ?>

                                        <?php } ?>
                                        </td>
                                    </tr>
                                 <?php endforeach; ?> 
                                 
                               
                            </table>
                           
                                      
                              
                            <input  type="submit" class="btn bg-blue btn-block "  name="edit" value="Edit">  <br><br>
                             <?php echo form_close() ?> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 