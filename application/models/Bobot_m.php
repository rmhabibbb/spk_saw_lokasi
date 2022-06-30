<?php 
class Bobot_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_bobot';
    $this->data['table_name'] = 'bobot_kriteria';
  }

  	public function get_bobot($k, $x){
  		$query = $this->db->query('SELECT * FROM `bobot_kriteria` WHERE '. $x . ' >= min and '. $x . ' <= max and id_kriteria = '. $k);  
		return $query->row();
			
	}
}

 ?>
