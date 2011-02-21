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
			$status = 'Twitter Profile';
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
		# get the yahoo id
		if(preg_match("/([a-zA-Z0-9_\s]{6,30})@yahoo.com/", $yahoo_id, $matches))
		{
			$yahoo_id = $matches[1];
		}

		if(empty($yahoo_id)) {
			$status = 'Yahoo Messenger';
		} 
		
		if(!empty($yahoo_id)) {
			$url = "http://opi.yahoo.com/online?u=" . $yahoo_id . "&m=t";
			$fp = @fopen($url, 'r');
	
			if (!$fp) {
				$status = 'maaf, untuk saat ini koneksi jaringan kami dengan Twitter sedang bermasalah, silahkan hubungi api@networks.co.id';
			}
	
			if ($fp) {	
				$content = stream_get_contents($fp);
				$online = "$yahoo_id is ONLINE";
				if ($content == $online) {
					$status = $yahoo_id . ' Sedang online.';
				} else {
					$status = 'Sedang tidak online.';
				}
			}
		}
		return $status;
	}
	
	public function getFacebookPageEdit($pageID,$limit = 1){
		if (empty($pageID)) {
			$message = 'Facebook Pages';
		}
		if (!empty($pageID)) {
			$url = "http://graph.facebook.com/". $pageID ."/feed?limit=$limit";
			$json = file_get_contents($url);
			$jsonData = json_decode($json);
			if (!empty($jsonData->data['0']->message)) {	
				$message = $jsonData->data['0']->message;    
			} else {
				$message = 'maaf, untuk saat ini koneksi jaringan kami dengan Facebook sedang bermasalah, silahkan hubungi api@networks.co.id';
			}
		}
	return $message;		
	}
	
	public function getYahooProfile( $yahoo_id ){
		$url = "http://opi.yahoo.com/online?u=" . $yahoo_id . "&m=t";
		$fp = @fopen($url, 'r');

		if (!$fp) {
			$status = 'maaf, untuk saat ini koneksi jaringan kami dengan Twitter sedang bermasalah, silahkan hubungi api@networks.co.id';
		}

		if ($fp) {	
			$content = stream_get_contents($fp);
			$online = "$yahoo_id is ONLINE";
			if ($content == $online) {
				$status = $yahoo_id . ' Sedang online.';
			} else {
				$status = 'Sedang tidak online.';
			}
		}
	return $status;
	}
	
	public function getTwitterProfile($twitter = NULL){
		# twitter api xml url, http://php.net/manual/en/function.fopen.php
		$url = "http://twitter.com/users/show/$twitter.xml";
			
		# twitter is down or us connection is not good
		$fp = @fopen($url, 'r');
		if (!$fp) {
			$status = 'maaf, untuk saat ini koneksi jaringan kami dengan Twitter sedang bermasalah, silahkan hubungi api@networks.co.id';
		}
			
		if ($fp) {	
			# get xml from url http://php.net/manual/en/function.stream-get-contents.php
			# http://www.php.net/manual/en/function.simplexml-load-string.php
			$xml = simplexml_load_string(stream_get_contents($fp));
			fclose($fp);
			
			# get the status text from xml
			$status = $xml->status->text.' - '.strftime("%A, %d %B %Y at %X ",strtotime($xml->status->created_at)); 
			}	
	return $status;		
	}
	
	public function getFacebookPageStatus($pageID = NULL, $limit = 1){
		$url = "http://graph.facebook.com/". $pageID ."/feed?limit=$limit";
		$json = file_get_contents($url);
		$jsonData = json_decode($json);
		if (!empty($jsonData->data['0']->message)) {	
			$message = $jsonData->data['0']->message;    
		} else {
			$message = 'maaf, untuk saat ini koneksi jaringan kami dengan Facebook sedang bermasalah, silahkan hubungi api@networks.co.id';
		}
	return $message;
	}
}


?>