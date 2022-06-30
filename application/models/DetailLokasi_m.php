<?php 
class DetailLokasi_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_detail';
    $this->data['table_name'] = 'detail_lokasi';
  }

 
}

 ?>
