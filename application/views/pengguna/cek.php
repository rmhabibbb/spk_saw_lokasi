 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cek Skor Lokasi Anda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('pengguna')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Cek Skor Lokasi Anda</li>
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
               Form Cek Skor Lokasi
              </div>
              <div class="card-body">

                 <?php if (isset($_GET['cek'])) { ?>

                  <?php 

                    $nilai = array();
                    $bobots = array();

                     foreach ($list_kriteria as $k) {
                      array_push($bobots, ($k->bobot_vektor/100));
                    }


                    foreach ($list_kriteria as $k) {
                     
                          if (isset($_GET['kriteria_'.$k->id_kriteria ])) {

                            if ($k->jenis_input == 'Option') {
                              array_push($nilai, $this->Bobot_m->get_row(['id_bobot' => $_GET['kriteria_'.$k->id_kriteria ]])->bobot);
                            }else{
                              $bobot = $this->Bobot_m->get_bobot($k->id_kriteria , $_GET['kriteria_'.$k->id_kriteria ]);
                              array_push($nilai, $bobot->bobot);
                            }
                           
                        }else{

                          array_push($nilai, 0);
                        }
                     
                    }

                    $R = array();
                    $i = 0;
                    foreach ($list_kriteria as $k) { 
                      $d = 0 ;
                      if ($k->tipe == 'Benefit') { 
                        if ($nilai[$i] == 0) {
                          $d = 0;
                        }else{
                          $d = number_format($nilai[$i]/max($nilai),2);
                        }
                      }else{
                        if ($nilai[$i] == 0) {
                          $d = 0;
                        }else{
                          $d = min($nilai)/$nilai[$i]; 
                        }
                      } 
                      array_push( $R, floatval($d));
                      $i++;
                    }
                    

                    
                      $i = 0; 
                      $nilai_akhir = 0;
                      for ($i=0; $i < sizeof($bobots) ; $i++) { 
                        $nilai_akhir = $nilai_akhir + ($bobots[$i] * $R[$i]); 
                      }  



                  ?>
 
                         
                            <h3><center><b>Skor : <?=$nilai_akhir?></b> dari 1 </center></h3> 
                            <hr>
                          
                            <a href="<?= base_url('pengguna/cek')?>">
                              <input  type="submit" class="btn bg-blue btn-block "  name="cek" value="Cek Lokasi Baru">  
                            </a>
                          <br><br>
                   



                 <?php }else { ?>
                  <form action="<?= base_url('pengguna/cek')?>" method="get"  >   

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                 
                                 <?php foreach ($list_kriteria as $kriteria): ?>   
                                  <tr>
                                        <th><?=$kriteria->nama_kriteria?></th>
                                        <td>
                                        <?php if ($kriteria->jenis_input == 'Option') { ?>
                                        
                                            <select class="form-control" required  name="kriteria_<?=$kriteria->id_kriteria?>">
                                                <option value="">- Pilih -</option> 
                                                <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                                  <?php foreach ($list_param as $row2): ?>  
                                                    <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                                  <?php endforeach; ?> 
                                             </select> 
                                        <?php    }else { ?>
                                             <input type="number" name="kriteria_<?=$kriteria->id_kriteria?>"  class="form-control" min="0" required >
                                        <?php } ?>
                                        </td>
                                    </tr>
                                 <?php endforeach; ?> 
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue btn-block "  name="cek" value="Cek Lokasi">  <br><br>
                  
                            <?php echo form_close() ?> 
                 <?php } ?>
          </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div> 