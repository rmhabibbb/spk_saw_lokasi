<?php 
class Lokasi_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_lokasi';
    $this->data['table_name'] = 'lokasi';
  }


  public function get_extra(){

    $this->db->select('MAX(kualitas_bahan) AS c1,MAX(harga) AS c2,MAX(waktu_pengerjaan) AS c3,MAX(komunikasi) AS c4   ');
    return $this->db->get('penilaian')->row();
    
  }

  public function get_sum($id){

    $this->db->select('id_vendor, avg(kualitas_bahan) AS c1,avg(harga) AS c2,avg(waktu_pengerjaan) AS c3,avg(komunikasi) AS c4   ');
    $this->db->where('id_vendor' , $id);
    return $this->db->get('penilaian')->row();
    
  }

  public function saw(){
    $nilai_awal = array(); 
    $list_lokasi = $this->Lokasi_m->get();
    $list_kriteria = $this->Kriteria_m->get();


   
      foreach ($list_lokasi as $l) {

      $nilai = array(); 
        foreach ($list_kriteria as $k) {
          if ($this->DetailLokasi_m->get_num_row(['id_lokasi' => $l->id_lokasi, 'id_kriteria' => $k->id_kriteria]) != 0) {
            $id_bobot = $this->DetailLokasi_m->get_row(['id_lokasi' => $l->id_lokasi, 'id_kriteria' => $k->id_kriteria])->id_bobot;
            array_push($nilai, $this->Bobot_m->get_row(['id_bobot' => $id_bobot])->bobot);
          }else{

            array_push($nilai, 0);
          }
        }
        $data = [
          'id_lokasi' => $l->id_lokasi,
          'nilai' => $nilai
        ];
        array_push($nilai_awal, $data);
      }






      $i = 0;
      $c_temp = array();
      foreach ($list_kriteria as $k) {
        array_push($c_temp,  $i++); 
      } 

      $i = 0;$j = 0;
      foreach ($list_kriteria as $k) {
        $d = array();
        foreach ($nilai_awal as $v) {
          
            array_push($d,  $v['nilai'][$i]); 
        }
        $c_temp[$j] = $d;
        $i++;
        $j++;
      } 


      
      


      $R = array();
      foreach ($nilai_awal as $v) { 
        $nilai = array();
        $i = 0; 
        foreach ($list_kriteria as $k) { 
          $d = 0 ;
          if ($k->tipe == 'Benefit') { 
            if ($v['nilai'][$i] == 0) {
              $d = 0;
            }else{
              $d = number_format($v['nilai'][$i]/max($c_temp[$i]),2);
            }
          }else{
            if ($v['nilai'][$i] == 0) {
              $d = 0;
            }else{
              $d = min($c_temp[$i])/$v['nilai'][$i]; 
            }
          } 
          array_push($nilai, $d);
          $i++;
        }
        $data = [
          'id_lokasi' => $v['id_lokasi'],
          'nilai' => $nilai 
        ]; 
        array_push($R, $data);
      }


      
      

      $bobot = array();

      foreach ($list_kriteria as $k) {
        array_push($bobot, ($k->bobot_vektor/100));
      }



      $V = array();
      $i = 0;
      foreach ($R as $v) { 
        $nilai_akhir = 0;
        for ($i=0; $i < sizeof($bobot) ; $i++) { 
          $nilai_akhir = $nilai_akhir + ($bobot[$i]*$v['nilai'][$i]); 
        } 
        $data = [
          'nilai_akhir' => number_format($nilai_akhir , 4) , 
          'id_lokasi' => $v['id_lokasi'] 
        ];

        array_push($V, $data);
      }

      

 
      $this->data['hasil'] = $V; 
      rsort($V);  
      $this->data['nilai_awal'] = $nilai_awal; 
      $this->data['matrik_r'] = $R;
      $this->data['hasil_akhir'] = $V; 
      return $this->data;
  }
}

 ?>
