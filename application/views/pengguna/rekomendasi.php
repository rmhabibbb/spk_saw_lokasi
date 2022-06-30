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
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
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
                <a data-toggle="modal" data-target="#tambah"  href=""><button class="btn btn-primary btn-block  btn-sm">Cari Laptop </button></a>
                 
                 
              </div>
              <div class="card-body">

                  <?php if ($index_spek == -1): ?> 
                      <button type="button" class="btn btn-primary btn-sm">Rekomendasi</button> 
                  <?php else: ?>
                    <a href="<?= base_url('customer/rekomendasi')?>"> 
                      <button type="button" class="btn btn-outline-primary btn-sm">Rekomendasi</button>
                    </a>
                  <?php endif; ?> 

                  <?php if ($index_spek == 0): ?> 
                      <button type="button" class="btn btn-primary btn-sm">Semua</button> 
                  <?php else: ?>
                    <a href="<?= base_url('customer')?>"> 
                      <button type="button" class="btn btn-outline-primary btn-sm">Semua</button>
                    </a>
                  <?php endif; ?> 

                      <?php   foreach ($list_spesifikasi as $row): ?>  
                        <input type="hidden" name="id_spesifikasi" value="<?=$row->id_spesifikasi?>" >
                        <?php if ($index_spek == $row->id_spesifikasi): ?> 
                      <button type="button" class="btn btn-primary btn-sm"><?=$row->nama_spesifikasi?></button>
                    
                      <?php else: ?>
                       <a href="<?= base_url('customer/?id_spek='.$row->id_spesifikasi)?>"> 
                      <button type="button" class="btn btn-outline-primary btn-sm"><?=$row->nama_spesifikasi?></button>
                    </a>
                      <?php endif; ?>    
                      <?php endforeach; ?>
                  <br><br>
                              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>   
                                                  <th>No.</th>
                                                  <th style="width: 10%">Kode Laptop</th> 
                                                  <th style="width: 20%">Foto </th>
                                                  <th>Laptop </th> 
                                                  <th>Kategori</th> 
                                                  <th>Rate</th> 
                                                  <th>Aksi</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_rekomendasi as $row): ?> 
                                            <?php $laptop = $this->Laptop_m->get_row(['kd_laptop' => $row->kd_laptop]); ?>
                                                <tr>   
                                                    <td><?=$i++?></td>
                                                    <td><?=$laptop->kd_laptop?> </td>  
                                                    <td><img src="<?=base_url()?>/assets/<?=$laptop->foto?>" width="100%">  </td> 
                                                    <td><a href="<?=base_url('admin/laptop/'.$laptop->kd_laptop)?>"><?=$laptop->merk?> - <?=$laptop->tipe_laptop?> </a> 


                                                    </td>  
                                                    <td>

                                                       <?php 
                                                          $list_spek = $this->SpecLaptop_m->get(['kd_laptop' => $laptop->kd_laptop]);
                                                          $n = sizeof($list_spek);

                                                          if ($n == 0) {
                                                            echo "-";
                                                          }else{
                                                            foreach ($list_spek as $s) {
                                                              echo '- ' , $this->Spec_m->get_row(['id_spesifikasi' => $s->id_spesifikasi])->nama_spesifikasi . '<br>';
                                                            }
                                                          }
                                                        ?>
                                                     </td> 
                                                     <td>
                                                      <center>
                                                    <?php 

                                                      $n = $this->Laptop_m->get_star($laptop->kd_laptop);
                                                      echo '('.number_format($n,2).')<br>';
                                                      for ($x=0; $x < $n ; $x++) { 
                                                        echo '<i class="nav-icon fas fa-star"></i>';
                                                      }
                                                    ?>
                                                    </center>
                                                     </td> 
                                                     <td>
                                                        <a href="<?=base_url('customer/laptop/'.$laptop->kd_laptop)?>"> 
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
