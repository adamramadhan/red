<?php
/**
 * Google MAP API
 * -------------
 * by Adam Ramadhan
 * TYPE : ENGINE ( GLOBAL )
 * @copyright	Copyright (c) 2009-2010 DAMSnetworks INDONESIA.
 * @license		http://en.wikipedia.org/wiki/Proprietary_software    Proprietary license
 * @author		Adam Ramadhan
 * @version		0.0.1
 * @todo 		well it display none if the address is wrong but beware change the size if you change the image type like
 * 				png to jpeg or etc.	<?php display_map($data['company']['address'],language('COMPANY_MAP'),	'445x280'); ?>
 */

class googlemaps
{
	private $address;
	private $language;
	private $size;
	private $path;
	
	function init( $array )
	{
		$this->size = $array['size'];
		$this->address = $array['address'];
		$this->language = $array['language'];
		if (!empty($array['path'])) {	
			$this->path = $array['path'];
		}
	}

	# size, address
	function show(){
		// kalo ga ada filenya harus ngefecth	

		$target = curl_init( 'http://maps.google.com/maps/api/staticmap?center=' . urlencode($this->address) . '&zoom=14&size=' . $this->size  . '&sensor=false&markers=icon:http://chart.apis.google.com/chart%3Fchst%3Dd_map_spin%26chld%3D1%257C0%257Cfff%257C11%257C_%257CHere|'. 
		urlencode($this->address));
	   
	   	curl_setopt( $target, CURLOPT_RETURNTRANSFER, true );
		curl_exec( $target );	
		$header_size = curl_getinfo( $target, CURLINFO_HEADER_SIZE);
		curl_close( $target );
			
			if ( $header_size == 256 ) {
				return FALSE;
			} else {
				$url = 'http://maps.google.com/maps/api/staticmap?center=' . urlencode($this->address). '&zoom=16&size=' .$this->size . '&sensor=false&markers=icon:http://chart.apis.google.com/chart%3Fchst%3Dd_map_spin%26chld%3D1%257C0%257Cfff%257C11%257C_%257C' . 
		   		$this->language . '|' . urlencode($this->address);
				$map = '<img src="' .$url. '" alt="'. $this->address .'" />';  
				echo $map;
				return true;
			}
	}

	# sama save
	function display( $uid )
	{
		$path = $this->path .'/'. $uid;
		$image = "/staticmap.png";
		$fullpath = $path . $image;
		
		// kalo ga ada filenya harus ngefecth
		if (!file_exists($fullpath)) {
	
		$target = curl_init( 'http://maps.google.com/maps/api/staticmap?center=' . urlencode($this->address) . '&zoom=14&size=' . $this->size  . '&sensor=false&markers=icon:http://chart.apis.google.com/chart%3Fchst%3Dd_map_spin%26chld%3D1%257C0%257Cfff%257C11%257C_%257CHere|'. 
		urlencode($this->address));
	   
	   	curl_setopt( $target, CURLOPT_RETURNTRANSFER, true );
		curl_exec( $target );	
		$header_size = curl_getinfo( $target, CURLINFO_HEADER_SIZE);
		curl_close( $target );
			
			if ( $header_size == 256 ) {
				return FALSE;
			} else {
				$url = 'http://maps.google.com/maps/api/staticmap?center=' . urlencode($this->address). '&zoom=16&size=' .$this->size . '&sensor=false&markers=icon:http://chart.apis.google.com/chart%3Fchst%3Dd_map_spin%26chld%3D1%257C0%257Cfff%257C11%257C_%257C' . 
		   		$this->language . '|' . urlencode($this->address);
				
		   		//mkdir($path);
		   		file_put_contents($fullpath,file_get_contents($url)); 
		   		chmod($fullpath,0644);  
			}	
		}

		// kalo ada ya ambil dari storage
		if(file_exists($fullpath)){
			$savepath = '/www-static/storage/'.$uid.'/staticmap.png';
			$map = '<img src="' .$savepath. '" alt="'. $this->address .'" />';
			echo $map;
		}	
	}
}

?>