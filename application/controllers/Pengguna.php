<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pengguna extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 2))
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
      $this->data['content'] = 'pengguna/dashboard';
      $this->template($this->data,'pengguna');
}

public function cari()
{ 
      
      $this->data['list_kriteria'] = $this->Kriteria_m->get();
      if ($this->POST('cari')) {

      $saw = $this->Lokasi_m->saw();

       

        $temp = array();
        foreach ($saw['hasil_akhir'] as $a) {
          $nilai = array();
          foreach ($this->data['list_kriteria'] as $k) { 
             $penilaian = $this->DetailLokasi_m->get_row(['id_lokasi' => $a['id_lokasi'], 'id_kriteria' => $k->id_kriteria]);
              
              array_push($nilai, $penilaian->id_bobot);

          }

          $data = [ 
            'poin' => 0,
            'id_lokasi' => $a['id_lokasi'],
            'nilai' => $nilai,
            'nilai_akhir' => $a['nilai_akhir']
          ];

          array_push($temp, $data);
        }


        
        
 
        for ($i=0; $i < sizeof($temp) ; $i++) {  
          $j = 0;
          foreach ($this->data['list_kriteria'] as $k) { 


              if ($this->POST('kriteria_'.$k->id_kriteria )) {
                if ($k->jenis_input == 'Option') {
                  if ($temp[$i]['nilai'][$j] == $this->POST('kriteria_'.$k->id_kriteria )) {
                    $temp[$i]['poin']++;
                  }
                }else{

                  $bobot = $this->Bobot_m->get_bobot($k->id_kriteria , $this->POST('kriteria_'.$k->id_kriteria ));
                  
                  $cek = $this->DetailLokasi_m->get_num_row(['id_kriteria' => $k->id_kriteria, 'id_lokasi' => $temp[$i]['id_lokasi'], 'id_bobot' => $bobot->id_bobot]);
                  if ($cek == 1) {
                    $temp[$i]['poin']++;
                  }
                }
                

                $j++;
              }
            }
             
        } 
 

        rsort($temp);
        $this->data['list_lokasi'] = $temp;  
      }else{

        $this->data['list_lokasi'] = array(); 
      }
      

      $this->data['title']  = 'Cari Lokasi'; 
      $this->data['index'] = 1;
      $this->data['content'] = 'pengguna/cari';
      $this->template($this->data,'pengguna');
}

public function cek()
{  
      $this->data['list_kriteria'] = $this->Kriteria_m->get();
      $this->data['title']  = 'Cek Skor Lokasi Anda'; 
      $this->data['index'] = 2 ;
      $this->data['content'] = 'pengguna/cek';
      $this->template($this->data,'pengguna');
}

// KELOLA SPK
    public function spk(){
      
      $saw = $this->Laptop_m->saw();

      $this->data['list_laptop'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'pengguna/spk';
      $this->template($this->data,'pengguna');
    }

    
// KELOLA SPK
  
 
public function lokasi(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['lokasi'] = $this->Lokasi_m->get_row(['id_lokasi' => $kd]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = $this->data['lokasi']->nama_lokasi;
        $this->data['index'] = 0;
        $this->data['content'] = 'pengguna/detaillokasi';
        $this->template($this->data,'pengguna');
      }else{
        redirect('pengguna');
        exit();
      }
      
      
    } 



public function laptopanda(){
      
      if ($this->Laptop_m->get_num_row(['kd_laptop' => $this->data['profil']->id_pengguna]) == 0) {
        $this->data['title']  = 'Laptop Anda';
        $this->data['index'] = 1;
        $this->data['content'] = 'pengguna/laptop';
        $this->template($this->data,'pengguna');
      }else{
        $this->data['laptop'] = $this->Laptop_m->get_row(['kd_laptop' => $this->data['profil']->id_pengguna]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = 'Laptop Anda';
        $this->data['index'] = 1;
        $this->data['content'] = 'pengguna/laptop2';
        $this->template($this->data,'pengguna');
      }
  
        
 
      
      
    } 


public function proseslaptop(){


      if ($this->POST('tambah')) {
        $kd_laptop = $this->data['profil']->id_pengguna; 
        if ($this->Laptop_m->get_num_row(['kd_laptop' => $kd_laptop]) != 0) { 
          $this->flashmsg('Kode Laptop telah digunakan!', 'warning');
          redirect('pengguna/proseslaptop/');
          exit();    
        } 


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
          $this->upload($id_foto, 'laptop/','foto');   
        }else{
          $id_foto = 'default';
        }
 

        $c1 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k1')])->keterangan;
        $c2 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k2')])->keterangan;
        $c3 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k3')])->keterangan;

        $data = [ 
          'kd_laptop' => $this->data['profil']->id_pengguna, 
          'merk' => $this->POST('merk'), 
          'tipe_laptop' => $this->POST('tipe_laptop'), 
          'keterangan' => $this->POST('keterangan'),   
          'prosessor' => $c1,   
          'ram' => $c2,   
          'vga' => $c3,   
          'hardisk' => $this->POST('k4'),   
          'screen' => $this->POST('k5'),   
          'battery' => $this->POST('k6'),   
          'harga' => $this->POST('k7'),   
          'rate1' => $this->POST('rate1'),   
          'rate2' => $this->POST('rate2'),   
          'rate3' => $this->POST('rate3'),   
          'rate4' => $this->POST('rate4'),   
          'rate5' => $this->POST('rate5'),   
          'rate6' => $this->POST('rate6'),   
          'rate7' => $this->POST('rate7'),    
          'post_by' => $this->data['profil']->email,    
          'foto' => 'laptop/'.$id_foto.'.jpg'
        ];

        $this->Laptop_m->insert($data);

        $c1 = $this->POST('k1'); 
        $c2 = $this->POST('k2'); 
        $c3 = $this->POST('k3'); 

        $list = $this->Bobot_m->get(['id_kriteria' => 4]); 
        foreach ($list as $k) {
          if ($this->POST('k4') >= $k->min && $this->POST('k4') <= $k->max) {
            $c4 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 5]); 
        foreach ($list as $k) {
          if ($this->POST('k5') >= $k->min && $this->POST('k5') <= $k->max) {
            $c5 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 6]); 
        foreach ($list as $k) {
          if ($this->POST('k6') >= $k->min && $this->POST('k6') <= $k->max) {
            $c6 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 7]); 
        foreach ($list as $k) {
          if ($this->POST('k7') >= $k->min && $this->POST('k7') <= $k->max) {
            $c7 = $k->id_bobot;
          }
        }

        $this->Penilaian_m->insert(['id_kriteria' => 1,'kd_laptop' => $kd_laptop,'id_bobot' => $c1]);
        $this->Penilaian_m->insert(['id_kriteria' => 2,'kd_laptop' => $kd_laptop,'id_bobot' => $c2]);
        $this->Penilaian_m->insert(['id_kriteria' => 3,'kd_laptop' => $kd_laptop,'id_bobot' => $c3]);
        $this->Penilaian_m->insert(['id_kriteria' => 4,'kd_laptop' => $kd_laptop,'id_bobot' => $c4]);
        $this->Penilaian_m->insert(['id_kriteria' => 5,'kd_laptop' => $kd_laptop,'id_bobot' => $c5]);
        $this->Penilaian_m->insert(['id_kriteria' => 6,'kd_laptop' => $kd_laptop,'id_bobot' => $c6]);
        $this->Penilaian_m->insert(['id_kriteria' => 7,'kd_laptop' => $kd_laptop,'id_bobot' => $c7]);
        
        $nilais = [$c1, $c2, $c3, $c4, $c5, $c6, $c7];

         
        $list_spec = $this->Spec_m->get();
        $list_kriteria = $this->Kriteria_m->get();

        foreach ($list_spec as $l) { 

          $z = 0;
         foreach ($list_kriteria as $k) {
            $min = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->min_bobot;
            $max = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->max_bobot;

            $nilai = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria,'kd_laptop' => $kd_laptop])->id_bobot;

              if ($nilai >= $min && $nilai <= $max) {
                $z++;
              }
          }

          if ($z == 6) {
            $this->SpecLaptop_m->insert(['kd_laptop' => $kd_laptop,'id_spesifikasi' => $l->id_spesifikasi]);
          }
        } 



        $this->flashmsg('Terima kasih, Data Laptop anda berhasil ditambah!', 'success');
        redirect('pengguna/laptopanda/');
        exit();

      }

      if ($this->POST('edit')) {
        $kd_laptop = $this->POST('kd_laptop'); 
        $kd_laptop_x = $this->POST('kd_laptop'); 
        if ($this->Laptop_m->get_num_row(['kd_laptop' => $kd_laptop]) != 0 && $kd_laptop != $kd_laptop_x) { 
          $this->flashmsg('Kode Laptop telah digunakan!', 'warning');
          redirect('pengguna/proseslaptop/');
          exit();    
        } 
 
        $fotolama = $this->Laptop_m->get_row(['kd_laptop' => $kd_laptop_x])->foto;
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
          $this->upload($id_foto, 'laptop/','foto');    
          $this->Laptop_m->update($kd_laptop_x,['foto' => 'laptop/'.$id_foto.'.jpg']);

        }
 
        $c1 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k1')])->keterangan;
        $c2 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k2')])->keterangan;
        $c3 = $this->Bobot_m->get_row(['id_bobot' => $this->POST('k3')])->keterangan;


        $data = [ 
          'kd_laptop' => $this->POST('kd_laptop'), 
          'merk' => $this->POST('merk'), 
          'tipe_laptop' => $this->POST('tipe_laptop'), 
          'keterangan' => $this->POST('keterangan'),
          'prosessor' => $c1,   
          'ram' => $c2,   
          'vga' => $c3,   
          'hardisk' => $this->POST('k4'),   
          'screen' => $this->POST('k5'),   
          'battery' => $this->POST('k6'),   
          'harga' => $this->POST('k7'),
          'rate1' => $this->POST('rate1'),   
          'rate2' => $this->POST('rate2'),   
          'rate3' => $this->POST('rate3'),   
          'rate4' => $this->POST('rate4'),   
          'rate5' => $this->POST('rate5'),   
          'rate6' => $this->POST('rate6'),   
          'rate7' => $this->POST('rate7'),    
          'post_by' => $this->data['profil']->email
        ];

        $this->Laptop_m->update($kd_laptop_x,$data);

        $this->Penilaian_m->delete_by(['kd_laptop' => $kd_laptop]);
        $c1 = $this->POST('k1'); 
        $c2 = $this->POST('k2'); 
        $c3 = $this->POST('k3'); 

        $list = $this->Bobot_m->get(['id_kriteria' => 4]); 
        foreach ($list as $k) {
          if ($this->POST('k4') >= $k->min && $this->POST('k4') <= $k->max) {
            $c4 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 5]); 
        foreach ($list as $k) {
          if ($this->POST('k5') >= $k->min && $this->POST('k5') <= $k->max) {
            $c5 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 6]); 
        foreach ($list as $k) {
          if ($this->POST('k6') >= $k->min && $this->POST('k6') <= $k->max) {
            $c6 = $k->id_bobot;
          }
        }

        $list = $this->Bobot_m->get(['id_kriteria' => 7]); 
        foreach ($list as $k) {
          if ($this->POST('k7') >= $k->min && $this->POST('k7') <= $k->max) {
            $c7 = $k->id_bobot;
          }
        }

        $this->Penilaian_m->insert(['id_kriteria' => 1,'kd_laptop' => $kd_laptop,'id_bobot' => $c1]);
        $this->Penilaian_m->insert(['id_kriteria' => 2,'kd_laptop' => $kd_laptop,'id_bobot' => $c2]);
        $this->Penilaian_m->insert(['id_kriteria' => 3,'kd_laptop' => $kd_laptop,'id_bobot' => $c3]);
        $this->Penilaian_m->insert(['id_kriteria' => 4,'kd_laptop' => $kd_laptop,'id_bobot' => $c4]);
        $this->Penilaian_m->insert(['id_kriteria' => 5,'kd_laptop' => $kd_laptop,'id_bobot' => $c5]);
        $this->Penilaian_m->insert(['id_kriteria' => 6,'kd_laptop' => $kd_laptop,'id_bobot' => $c6]);
        $this->Penilaian_m->insert(['id_kriteria' => 7,'kd_laptop' => $kd_laptop,'id_bobot' => $c7]);
        
        $nilais = [$c1, $c2, $c3, $c4, $c5, $c6, $c7];

        $list_spec = $this->Spec_m->get();
        $list_kriteria = $this->Kriteria_m->get();
        $this->SpecLaptop_m->delete_by(['kd_laptop' => $kd_laptop]);
        foreach ($list_spec as $l) { 

          $z = 0;
         foreach ($list_kriteria as $k) {
            $min = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->min_bobot;
            $max = $this->DetailSpec_m->get_row(['id_spesifikasi' => $l->id_spesifikasi, 'id_kriteria' => $k->id_kriteria])->max_bobot;

            $nilai = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria,'kd_laptop' => $kd_laptop])->id_bobot;

              if ($nilai >= $min && $nilai <= $max) {
                $z++;
              }
          }

          if ($z == 6) {
            $this->SpecLaptop_m->insert(['kd_laptop' => $kd_laptop,'id_spesifikasi' => $l->id_spesifikasi]);
          }
        } 


        $this->flashmsg('Data laptop anda berhasil disimpan!', 'success');
        redirect('pengguna/laptopanda/');
        exit();

      }

    
 
    } 

  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 7;
        $this->data['content'] = 'pengguna/profil';
        $this->template($this->data,'pengguna');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) { 
            $this->flashmsg('Email telah digunakan!', 'warning');
            redirect('pengguna/profil');
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
          redirect('pengguna/profil');
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
              redirect('pengguna/profil');
              exit();
            }else{
              redirect('pengguna/profil');
              exit(); 
            }
         } 
        elseif ($this->POST('hapusfoto')) { 
 
              @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto)); 
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/default.jpg']);
              $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
              redirect('pengguna/profil');
              exit();
            
         } 
          elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('pass1')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('pengguna/profil');
            exit();    
          }  

          else{

          redirect('pengguna/profil');
          exit();
          }

    }
 

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>
