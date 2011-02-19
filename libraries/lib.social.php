<?php  
/**
 * SOCIAL LIBRARY
 * connects with all the social things
 * @package default
 * @author DAMS
 */
class Social
{	
	public function get_twitter( $twitter )
	{
		if ( empty( $twitter ) ) {
			$status = 'Taukah anda? dengan menambah account twitter perusahaan anda, 
			anda dapat menampilkan status terakhir perusahaan anda pada halaman depan profile?';
		}

		if ( !empty( $twitter ) ) {
			
			# twitter api xml url, http://php.net/manual/en/function.fopen.php
			$url = "http://twitter.com/users/show/$twitter.xml";
			
			# twitter is down or us connection is not good
			$fp = @fopen($url, 'r');
			if (!$fp) {
				$status = 'maaf, untuk saat ini koneksi jaringan kami sedang bermasalah, silahkan hubungi api@networks.co.id';
			}
			
			if ($fp) {
				
				# get xml from url http://php.net/manual/en/function.stream-get-contents.php
				# http://www.php.net/manual/en/function.simplexml-load-string.php
				$xml = simplexml_load_string(stream_get_contents($fp));
				fclose($fp);
				
				# get the status text from xml
				$status = $xml->status->text.' - '.strftime("%A, %d %B %Y at %X ",strtotime($xml->status->created_at)); 
			}
		}	
			
		return $status;
	}
	
	public function get_yahoo( $yahoo_id )
	{	
		if(preg_match("/([a-zA-Z0-9_\s]{6,30})@yahoo.com/", $yahoo_id, $matches))
		{
			$yahoo_id = $matches[1];
		}

		if ( empty( $yahoo_id ) ) {
			$status = 'Yahoo Messenger adalah salah satu IM ( instant messenger ) 
			yang paling banyak digunakan oleh masyarakat indonesia, anda dapat menampilkan status
			online dan offline anda pada halaman profile.';
		} else {
			$request = @file ("http://opi.yahoo.com/online?u=" . $yahoo_id . "&m=t");
			$connect = $request[0];
			$online = "$yahoo_id is ONLINE";
			
			if ($connect == $online) {
				$status = $yahoo_id . ' Sedang online.';
			} else {
				$status = 'Sedang tidak online.';
			}
		}
		return $status;
	}
	
	public function getYahooProfile( $username ){
		$request = @file ("http://opi.yahoo.com/online?u=" . $yahoo_id . "&m=t");
		$connect = $request[0];
		$online = "$yahoo_id is ONLINE";
			
		if ($connect == $online) {
			$status = $yahoo_id . ' Sedang online.';
		} else {
			$status = 'Sedang tidak online.';
		}
		return $status;
	}
	
	public function getTwitterProfile($twitter){
		if ( empty( $twitter ) ) {
			$status = '';
		}

		if ( !empty( $twitter ) ) {
			
			# twitter api xml url, http://php.net/manual/en/function.fopen.php
			$url = "http://twitter.com/users/show/$twitter.xml";
			
			# twitter is down or us connection is not good
			$fp = @fopen($url, 'r');
			if (!$fp) {
				$status = 'maaf, untuk saat ini koneksi jaringan kami sedang bermasalah, silahkan hubungi api@networks.co.id';
			}
			
			if ($fp) {
				
				# get xml from url http://php.net/manual/en/function.stream-get-contents.php
				# http://www.php.net/manual/en/function.simplexml-load-string.php
				$xml = simplexml_load_string(stream_get_contents($fp));
				fclose($fp);
				
				# get the status text from xml
				$status = $xml->status->text.' - '.strftime("%A, %d %B %Y at %X ",strtotime($xml->status->created_at)); 
			}
		}	
			
		return $status;		
	}
}


?>