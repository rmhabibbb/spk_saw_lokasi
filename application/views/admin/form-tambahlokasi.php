 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Tambah Lokasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/lokasi')?>">Kelola Data Lokasi</a></li>
              <li class="breadcrumb-item active">Form Tambah Lokasi</li>
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
    
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row">
                                             <div class="col-md-4">
                                                 <label class="control-label">Nama Lokasi</label>
                                                 <input type="text" name="nama_lokasi" class="form-control" placeholder="Masukkan Nama Lokasi"  required  >
                                                 
                                             </div> 
                                             <div class="col-md-4">
                                                 <label class="control-label">Telepon</label>
                                                 <input type="text" name="telepon" class="form-control" placeholder="Masukkan Telepon"  required  >
                                                 
                                             </div>  
                                              <div class="col-md-4">
                                                 <label class="control-label">Foto</label>
                                                 <input type="file" name="foto" class="form-control"  >
                                                 
                                             </div> 
                                         </div> 

                                   </div>
                                 </div>
 
                                <div class="form-group">

                                    <div class="form-line">
                                        <div class="row">
                                            
                                             <div class="col-md-12">
                                                 <label class="control-label">Alamat</label>
                                                 <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" ></textarea>
                                                 
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
                                        
                                            <select class="form-control"  required name="kriteria_<?=$kriteria->id_kriteria?>">
                                                <option value="">- Pilih -</option> 
                                                <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                                  <?php foreach ($list_param as $row2): ?>  
                                                    <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                                  <?php endforeach; ?> 
                                             </select> 
                                        <?php    }else { ?>
                                             <input type="number" name="kriteria_<?=$kriteria->id_kriteria?>" required class="form-control" min="0"  >
                                        <?php } ?>
                                        </td>
                                    </tr>
                                 <?php endforeach; ?> 
                                 
                               
                            </table>
                                        
                                      
                              
                            <input  type="submit" class="btn bg-blue btn-block "  name="tambah" value="Tambah">  <br><br>
                             <?php echo form_close() ?> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 