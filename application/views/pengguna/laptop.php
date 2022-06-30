 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Tambah Laptop</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/laptop')?>">Laptop</a></li>
              <li class="breadcrumb-item active">Form Tambah Laptop</li>
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

                   <?= form_open_multipart('customer/proseslaptop/') ?>
    
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row"> 

                                             <div class="col-md-4">
                                                 <label class="control-label">Foto</label>
                                                 <input type="file" name="foto" class="form-control"  >
                                                 
                                             </div> 
                                             <div class="col-md-4">
                                                 <label class="control-label">Merek</label>
                                                 <input type="text" name="merk" class="form-control" placeholder="Masukkan Merek"  required  >
                                                 
                                             </div> 
                                             <div class="col-md-4">
                                                 <label class="control-label">Tipe Laptop</label>
                                                 <input type="text" name="tipe_laptop" class="form-control" placeholder="Masukkan Tipe Laptop"  required  >
                                                 
                                             </div> 
                                         </div> 

                                   </div>
                                 </div>
  
                            </fieldset> 
                            <table class="table table-bordered "> 
                              <tr>
                                  <th>Kriteria</th>
                                  <th>Keterangan</th>
                                  <th>Rate (1-5)</th>
                              </tr>
                              <tr>
                                    <td>Prosessor</td>
                                    <td>
                                        <select class="form-control"  required name="k1">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 1]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                    <td>
                                        <input type="number" required min="1" max="5" name="rate1" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>

                                <tr>
                                    <td>RAM (GB)</td>
                                    <td>
                                        <select class="form-control"  required name="k2">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 2]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>

                                    <td>
                                        <input type="number" required min="1" max="5" name="rate2" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>
                                <tr>
                                    <td>VGA</td>
                                    <td>
                                        <select class="form-control"  required name="k3">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => 3]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>

                                    <td>
                                        <input type="number" required min="1" max="5" name="rate3" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Hardisk (GB)</td>
                                    <td>
                                        <input type="number" name="k4" required class="form-control" min="100"  >
                                    </td>

                                    <td>
                                        <input type="number" required min="1" max="5" name="rate4" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Screen (inch)</td>
                                    <td>
                                        <input type="number" name="k5" required class="form-control" min="1" step="any"  >
                                    </td>

                                    <td>
                                        <input type="number" required min="1" max="5" name="rate5" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Battery (cell)</td>
                                    <td>
                                        <input type="number" name="k6" required class="form-control" min="1"  >
                                    </td>

                                    <td>
                                        <input type="number" required min="1" max="5" name="rate6" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga (Rupiah)</td>
                                    <td>
                                        <input type="number" name="k7" required class="form-control" min="1"  >
                                    </td>

                                    <td>
                                        <input type="number" required min="1" max="5" name="rate7" class="form-control" placeholder="(1-5)">
                                    </td>
                                </tr>
                            </table>
                                        
                                      
                              
                            <input  type="submit" class="btn bg-blue btn-block "  name="tambah" value="Submit">  <br><br>
                             <?php echo form_close() ?> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 