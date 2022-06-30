<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 1))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m'); 
    $this->load->model('register_m');   
    $this->load->model('Bobot_m');           
    $this->load->model('Kriteria_m');   
    $this->load->model('Lokasi_m');   
    $this->load->model('DetailLokasi_m');   
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 
     
      $saw = $this->Lokasi_m->saw();

      $this->data['list_lokasi'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 0;
      $this->data['content'] = 'admin/dashboard';
      $this->template($this->data,'admin');
}

// KELOLA SPK
    public function spk(){
      
      $saw = $this->Lokasi_m->saw();

      $this->data['list_laptop'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'admin/spk';
      $this->template($this->data,'admin');
    }

    public function detailspk(){
      
      $saw = $this->Lokasi_m->saw();

      $this->data['list_kriteria'] = $this->Kriteria_m->get();  
      $this->data['nilai_awal'] = $saw['nilai_awal'];  
      $this->data['matrik_r'] = $saw['matrik_r']; 
      $this->data['list_lokasi'] = $saw['hasil'];
      $this->data['list_lokasi2'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Detail Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'admin/detailspk';
      $this->template($this->data,'admin');
    }
// KELOLA SPK

// KELOLA KRITERA ----------------------------------------------------------------------------

    public function kriteria(){
      if ($this->POST('tambah')) {     
        $data = [   
          'nama_kriteria' => $this->POST('nama_kriteria') , 
          'bobot_vektor' => $this->POST('bobot') , 
          'tipe' => $this->POST('tipe') , 
          'jenis_input' => $this->POST('jenis') 
        ];
        $this->Kriteria_m->insert($data); 
        $id = $this->Kriteria_m->get_row(['nama_kriteria' => $this->POST('nama_kriteria')])->id_kriteria; 

        $this->flashmsg('KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'.$id);
        exit();    
      }  

      if ($this->POST('edit')) { 
        $data = [    
          'nama_kriteria' => $this->POST('nama_kriteria') , 
          'bobot_vektor' => $this->POST('bobot') , 
          'tipe' => $this->POST('tipe') , 
          'jenis_input' => $this->POST('jenis') 
        ];

        $this->Kriteria_m->update($this->POST('id_kriteria'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) { 
        $id_kriteria = $this->POST('id_kriteria'); 
        $this->Kriteria_m->delete($id_kriteria); 
        $this->flashmsg('Kriteria berhasil dihapus!', 'success');
        redirect('admin/kriteria/');
        exit();    
      } 
       

      if ($this->uri->segment(3)) {
        if ($this->Kriteria_m->get_num_row(['id_kriteria' => $this->uri->segment(3)]) == 1) {
          $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->uri->segment(3)]);   
          $this->data['list_sub'] = $this->Bobot_m->get(['id_kriteria' => $this->uri->segment(3) ]);     
 
           
          $this->data['title']  = 'Kelola Kriteria - '.$this->data['kriteria']->nama_kriteria .'';
          $this->data['index'] = 4;
          $this->data['content'] = 'admin/detailkriteria';
          $this->template($this->data,'admin'); 
        }else {
          redirect('sekretariat/kriteria');
          exit();
        }
      }

     
      else {
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  


        $this->data['title']  = 'Kelola Data Kriteria';
        $this->data['index'] = 4;
        $this->data['content'] = 'admin/kriteria';
        $this->template($this->data,'admin');
      }
    } 

    public function bobot(){
      if ($this->POST('tambah')) {   
        $data = [   
          'keterangan' => $this->POST('ket'), 
          'bobot' => $this->POST('nilai'),
          'min' => $this->POST('min'), 
          'max' => $this->POST('max'), 
          'id_kriteria' => $this->POST('id_kriteria') 
        ];
        $this->Bobot_m->insert($data);
 
        $this->flashmsg('BOBOT KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'. $this->POST('id_kriteria'));
        exit();    
      }  

      if ($this->POST('edit')) { 
         $data = [   
          'keterangan' => $this->POST('ket'), 
          'min' => $this->POST('min'), 
          'max' => $this->POST('max'), 
          'bobot' => $this->POST('nilai') 
        ];

        $this->Bobot_m->update($this->POST('id_bobot'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) {   
        $this->Bobot_m->delete($this->POST('id_bobot'));
        $this->flashmsg('DATA BOBOT KRITERA BERHASIL DIHAPUS!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      }  
    } 
     
// KELOLA KRITERIA ---------------------------------------------------------------------
 

// KELOLA LOKASI 

    public function lokasi(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['lokasi'] = $this->Lokasi_m->get_row(['id_lokasi' => $kd]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = $this->data['lokasi']->nama_lokasi .' - Kelola Data Lokasi';
        $this->data['index'] = 2;
        $this->data['content'] = 'admin/detaillokasi';
        $this->template($this->data,'admin');
      }else{
        $this->data['list_lokasi'] = $this->Lokasi_m->get();  
        $this->data['title']  = 'Kelola Data Lokasi';
        $this->data['index'] = 2;
        $this->data['content'] = 'admin/lokasi';
        $this->template($this->data,'admin');
      }
      
      
    } 

    public function proseslokasi(){


      if ($this->POST('tambah')) {
        

        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 11 ; $j++) {
            $id_foto .= rand(0,9);
          } 
          $this->upload($id_foto, 'lokasi/','foto');   
        }else{
          $id_foto = 'default';
        }
  
        $data = [ 
          'nama_lokasi' => $this->POST('nama_lokasi'), 
          'telepon' => $this->POST('telepon'), 
          'alamat' => $this->POST('alamat'),  
          'email' => $this->data['profil']->email,    
          'thumbnail_foto' => 'lokasi/'.$id_foto.'.jpg'
        ];

        $this->Lokasi_m->insert($data);

        $id = $this->db->insert_id();

        $list_kriteria = $this->Kriteria_m->get();

        foreach ($list_kriteria as $k) {
          if ($k->jenis_input == 'Option') {
            $data = [
              'id_lokasi' => $id,
              'id_kriteria' => $k->id_kriteria,
              'id_bobot' => $this->POST('kriteria_'.$k->id_kriteria),
              'keterangan' => NULL
            ];
          }else{

            $bobot = $this->Bobot_m->get_bobot($k->id_kriteria, $this->POST('kriteria_'.$k->id_kriteria));



            $data = [
              'id_lokasi' => $id,
              'id_kriteria' => $k->id_kriteria,
              'id_bobot' => $bobot->id_bobot,
              'keterangan' => $this->POST('kriteria_'.$k->id_kriteria)
            ];
          }
          $this->DetailLokasi_m->insert($data);

        }




        $this->flashmsg('Data lokasi berhasil ditambah!', 'success');
        redirect('admin/lokasi/'.$id);
        exit();

      }

      if ($this->POST('edit')) {
        $id_lokasi = $this->POST('id_lokasi');  
       
        $fotolama = $this->Lokasi_m->get_row(['id_lokasi' => $id_lokasi])->thumbnail_foto;
        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 11 ; $j++) {
            $id_foto .= rand(0,9);
          } 
          @unlink(realpath(APPPATH . '../assets/' . $fotolama));
          $this->upload($id_foto, 'lokasi/','foto');    
          $this->Lokasi_m->update($id_lokasi,['thumbnail_foto' => 'lokasi/'.$id_foto.'.jpg']);

        }
 
       

        $data = [ 
          'nama_lokasi' => $this->POST('nama_lokasi'), 
          'telepon' => $this->POST('telepon'), 
          'alamat' => $this->POST('alamat'),  
          'email' => $this->data['profil']->email 
        ];

        $this->Lokasi_m->update($id_lokasi,$data);

        $this->DetailLokasi_m->delete_by(['id_lokasi' => $id_lokasi]);
        $list_kriteria = $this->Kriteria_m->get();

        foreach ($list_kriteria as $k) {
          if ($k->jenis_input == 'Option') {
            $data = [
              'id_lokasi' => $id_lokasi,
              'id_kriteria' => $k->id_kriteria,
              'id_bobot' => $this->POST('kriteria_'.$k->id_kriteria),
              'keterangan' => NULL
            ];
          }else{

            $bobot = $this->Bobot_m->get_bobot($k->id_kriteria, $this->POST('kriteria_'.$k->id_kriteria));



            $data = [
              'id_lokasi' => $id_lokasi,
              'id_kriteria' => $k->id_kriteria,
              'id_bobot' => $bobot->id_bobot,
              'keterangan' => $this->POST('kriteria_'.$k->id_kriteria)
            ];
          }
          $this->DetailLokasi_m->insert($data);

        }

        $this->flashmsg('Data lokasi berhasil disimpan!', 'success');
        redirect('admin/lokasi/'.$id_lokasi);
        exit();

      }

      if ($this->POST('hapus')) {
        $this->Lokasi_m->delete($this->POST('id_lokasi'));
        $this->flashmsg('Data lokasi berhasil dihapus!', 'success');
        redirect('admin/lokasi');
        exit();

      } 


      $this->data['list_kriteria'] = $this->Kriteria_m->get();  
      $this->data['title']  = 'Tambah Data Lokasi';
      $this->data['index'] = 2;
      $this->data['content'] = 'admin/form-tambahlokasi';
      $this->template($this->data,'admin');
      
    } 
// KELOLA LOKASI 


 
// Kelola Customer 
    public function pengguna(){
      
 
        $this->data['list_pengguna'] = $this->login_m->get(['role' => 2]);   
        $this->data['title']  = 'Kelola Data Pengguna';
        $this->data['index'] = 5;
        $this->data['content'] = 'admin/pengguna';
        $this->template($this->data,'admin');
   
    } 

// Kelola Customer 


  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 7;
        $this->data['content'] = 'admin/profil';
        $this->template($this->data,'admin');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) { 
            $this->flashmsg('Email telah digunakan!', 'warning');
            redirect('admin/profil');
            exit();
          }

             $data = [ 
              'nama_depan' => $this->POST('nama_depan'),
              'nama_belakang' => $this->POST('nama_belakang'),
              'email' => $this->POST('email'),
              'jk' => $this->POST('jk'),
              'no_telp' => $this->POST('no_telp'),
              'tanggal_lahir' => $this->POST('tanggal_lahir') 
            ];

            $this->login_m->update($this->POST('email_x') , $data);

            
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('admin/profil');
          exit();

          }

        elseif ($this->POST('uploadfoto')) {
           if ($_FILES['foto']['name'] !== '') { 
              $files = $_FILES['foto'];
              $_FILES['foto']['name'] = $files['name'];
              $_FILES['foto']['type'] = $files['type'];
              $_FILES['foto']['tmp_name'] = $files['tmp_name'];
              $_FILES['foto']['size'] = $files['size'];

              $id_foto = rand(1,9);
              for ($j=1; $j <= 11 ; $j++) {
                $id_foto .= rand(0,9);
              } 

              if ($this->data['profil']->foto != 'foto/default.jpg' && $this->data['profil']->foto != 'foto/default-l.jpg' && $this->data['profil']->foto != 'foto/default-p.jpg') {
                @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
              }
              $this->upload($id_foto, 'foto/','foto');    
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/'.$id_foto.'.jpg']);
              $this->flashmsg('Foto Profil berhasil diupload!', 'success');
              redirect('admin/profil');
              exit();
            }else{
              redirect('admin/profil');
              exit(); 
            }
         } 
        elseif ($this->POST('hapusfoto')) { 
 
              @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto)); 
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/default.jpg']);
              $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
              redirect('admin/profil');
              exit();
            
         } 
          elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('pass1')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('admin/profil');
            exit();    
          }  

          else{

          redirect('admin/profil');
          exit();
          }

    }
 

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>
