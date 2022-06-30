 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Beranda</h1>
          </div><!-- /.col --> 
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
       <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$this->Lokasi_m->get_num_row([''])?></h3>

                <p>Data Lokasi</p>
              </div>
              <div class="icon">
                <i class="fas fa-map-marker"></i>
              </div>
              <a href="<?=base_url('admin/lokasi')?>" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$this->Kriteria_m->get_num_row([''])?></h3>

                <p>Kriteria</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <a href="<?=base_url('admin/kriteria')?>" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$this->login_m->get_num_row(['role' => 2])?></h3>

                <p>Data Pengguna</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?=base_url('admin/pengguna')?>" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <!-- ./col -->
        </div> 
        <div class="card"> 
               
              <div class="card-header">
                Hasil Perhitungan Metode SAW
              </div>
              <div class="card-body">
                 <a    href="<?=base_url('admin/detailspk')?>"><button class="btn btn-primary">Detail Perhitungan</button></a>
                          <br>
                          <br>
                              <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>   
                                                  <th>Peringkat</th> 
                                                  <th>Foto </th>
                                                  <th>Nama Lokasi </th> 
                                                  <th>Alamat</th>   
                                                  <th>Telepon</th>   
                                                  <th>Nilai</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_lokasi as $row): ?> 
                                            <?php $lokasi = $this->Lokasi_m->get_row(['id_lokasi' => $row['id_lokasi']]); ?>
                                                <tr>   
                                                    <td><?=$i++?> </td>  
                                                    <td><img src="<?=base_url()?>/assets/<?=$lokasi->thumbnail_foto?>" width="100px">  </td> 
                                                    <td><a href="<?=base_url('admin/lokasi/'.$lokasi->id_lokasi)?>"><?=$lokasi->nama_lokasi?>  </a> </td> 
                                                    <td><?=$lokasi->alamat?> </td>
                                                    <td><?=$lokasi->telepon?> </td>

                                                    <td><?= $row['nilai_akhir'] ?>  </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
          </div>
      </div>
 
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>