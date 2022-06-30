 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <?= $this->session->flashdata('msg') ?>
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Detail Perhitungan SAW</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Beranda</a></li>
             <li class="breadcrumb-item active">Detail Perhitungan SAW</li>
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
           <h3>1. Nilai Awal</h3>
           <div class="table-responsive">
             <table class="table table-bordered table-striped">
               <thead>
                 <tr>
                   <th>Nama Lokasi </th>

                   <?php $i = 1;
                    foreach ($list_kriteria as $row) : ?>
                     <th><?= $row->nama_kriteria ?></th>
                   <?php endforeach; ?>
                 </tr>
               </thead>
               <tbody>
                 <?php $i = 1;
                  foreach ($nilai_awal as $row) : ?>
                   <?php $lokasi = $this->Lokasi_m->get_row(['id_lokasi' => $row['id_lokasi']]); ?>
                   <tr>
                     <td><?= $lokasi->nama_lokasi ?> </td>

                     <?php
                      for ($i = 0; $i < sizeof($row['nilai']); $i++) {
                        echo '<td>' .  $row['nilai'][$i] . '</td>  ';
                      }
                      ?>

                   </tr>
                 <?php endforeach; ?>
               </tbody>
             </table>
           </div>
           <hr>

           <h3>2. Normalisasi Matrik R</h3>
           <div class="table-responsive">
             <table class="table table-bordered table-striped">
               <thead>
                 <tr>
                   <th>Nama lokasi </th>
                   <?php $i = 1;
                    foreach ($list_kriteria as $row) : ?>
                     <th><?= $row->nama_kriteria ?></th>
                   <?php endforeach; ?>
                 </tr>
               </thead>
               <tbody>
                 <?php $i = 1;
                  foreach ($matrik_r as $row) : ?>
                   <?php $lokasi = $this->Lokasi_m->get_row(['id_lokasi' => $row['id_lokasi']]); ?>
                   <tr>
                     <td><?= $lokasi->nama_lokasi ?> </td>
                     <?php
                      for ($i = 0; $i < sizeof($row['nilai']); $i++) {
                        echo '<td>' .  $row['nilai'][$i] . '</td>  ';
                      }
                      ?>

                   </tr>
                 <?php endforeach; ?>
               </tbody>
             </table>
           </div>
           <hr>
           <h3>3. Hasil Akhir </h3>
           <div class="table-responsive">
             <table class="table table-bordered table-striped">
               <thead>
                 <tr>
                   <th>ID Lokasi </th>
                   <th>Nama Lokasi </th>
                   <th>Nilai Akhir</th>
                 </tr>
               </thead>
               <tbody>
                 <?php $i = 1;
                  foreach ($list_lokasi as $row) : ?>
                   <?php $lokasi = $this->Lokasi_m->get_row(['id_lokasi' => $row['id_lokasi']]); ?>
                   <tr>

                     <td><?= $lokasi->id_lokasi ?> </td>
                     <td><?= $lokasi->nama_lokasi ?> </td>
                     <td><?= $row['nilai_akhir'] ?> </td>

                   </tr>
                 <?php endforeach; ?>
               </tbody>
             </table>
           </div>
           <h3>4. Perangkingan</h3>
           <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                 <tr>
                   <th>Peringkat</th>
                   <th>ID Lokasi </th>
                   <th>Nama Lokasi </th>
                 </tr>
               </thead>
               <tbody>
                 <?php $i = 1;
                  foreach ($list_lokasi2 as $row) : ?>
                   <?php $lokasi = $this->Lokasi_m->get_row(['id_lokasi' => $row['id_lokasi']]); ?>
                   <tr>
                     <td><?= $i++ ?></td>
                     <td><?= $lokasi->id_lokasi ?> </td>
                     <td><?= $lokasi->nama_lokasi ?> </td>

                   </tr>
                 <?php endforeach; ?>
               </tbody>
             </table>
           </div>
         </div>
       </div>
       <!-- /.container-fluid -->
     </div>
     <!-- /.content -->
   </div>
 </div>