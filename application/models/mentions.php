<?php  

class ModelMentions extends Models
{
	// ambil dari konfigurasi database tertentu
	// agar lebih mudah dapat ditaro disini
	public $database = 'application';
	
	function add($data){
		$data = $this->insert('mentions',$data);
		return $data;
	}
}

?>