<?php
define ( "RECAPTCHA_API_SERVER", "http://api.recaptcha.net" );
define ( "RECAPTCHA_API_SECURE_SERVER", "https://api-secure.recaptcha.net" );
# kalo socet error ganti ke google.com
define ( "RECAPTCHA_VERIFY_SERVER", "api-verify.recaptcha.net" );
# define("RECAPTCHA_VERIFY_SERVER", "173.194.36.104");
# define("RECAPTCHA_VERIFY_SERVER", "www.google.com");


class ReCaptcha {
	private static $publickey = '6Lcmsr4SAAAAAD7WZYfUn9RaSTprVApBSSc0b9Av';
	private static $privatekey = '6Lcmsr4SAAAAAAa11gc6jqKQjlultzG1tWxGNzE4';
	
	// translasi dan custum theme disini ya nanti
	public static function redhook() {
		return "
		<script type='text/javascript'>
		 var RecaptchaOptions = {
		    custom_translations : {
            play_again : 'Ulangi Audio',
            cant_hear_this : 'Unduh Audio',
		},
		    theme : 'custom',
		     custom_theme_widget: 'recaptchaplugin'
		 };
		</script>
		";
	}
	public static function qsencode($data) {
		$req = "";
		foreach ( $data as $key => $value )
			$req .= $key . '=' . urlencode ( stripslashes ( $value ) ) . '&';
		
		// Cut the last '&'
		$req = substr ( $req, 0, strlen ( $req ) - 1 );
		return $req;
	}
	
	public static function http_post($host, $path, $data, $port = 80) {
		
		$req = self::qsencode ( $data );
		
		$http_request = "POST $path HTTP/1.0\r\n";
		$http_request .= "Host: $host\r\n";
		$http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
		$http_request .= "Content-Length: " . strlen ( $req ) . "\r\n";
		$http_request .= "User-Agent: recaptcha/PHP\r\n";
		$http_request .= "\r\n";
		$http_request .= $req;
		
		$response = '';
		if (false == ($fs = @fsockopen ( $host, $port, $errno, $errstr, 10 ))) {
			die ( 'Could not open socket' );
		}
		
		fwrite ( $fs, $http_request );
		
		while ( ! feof ( $fs ) )
			$response .= fgets ( $fs, 1160 ); // One TCP-IP packet
		fclose ( $fs );
		$response = explode ( "\r\n\r\n", $response, 2 );
		
		return $response;
	}
	
	public static function get_html($error = null, $use_ssl = false) {
		$pubkey = self::$publickey;
		
		if ($use_ssl) {
			$server = RECAPTCHA_API_SECURE_SERVER;
		} else {
			$server = RECAPTCHA_API_SERVER;
		}
		
		$errorpart = "";
		if ($error) {
			$errorpart = "&amp;error=" . $error;
		}
		
		// nanti di aktifkan
		echo self::redhook ();
		echo "<style type='text/css'>
		#recaptchaplugin p,#recaptchaplugin a{  font-family: verdana;
    font-size: 10px;
    padding: 5px;}
    <!-- #recaptcha_image > img{    height: 70px;
    width: 235px; -->}

		#recaptchalink1,#recaptchalink2{background: none repeat scroll 0 0 #444444;
		        background: none repeat scroll 0 0 #FFF4CB;
    			padding: 2px;}
    	#recaptcha_response_field{margin-top: 20px;direction: ltr;}</style>
    	";
		echo '<div class="clearfix" id="recaptchaplugin" style="display:none;">';
		
		#captcha image start
		echo '<p class="recaptcha_only_if_image">masukan <strong>kedua kata</strong> dibawah, <strong>dipisahkan dengan spasi</strong>. jika tidak terbaca, anda dapat <a id="recaptchalink1" class="recaptcha_only_if_text" href="#recaptchalink1" onclick="Recaptcha.reload();">menganti kata</a>
    	tersebut atau gunakan <a id="recaptchalink2" class="recaptcha_only_if_image" href="#recaptchalink2" onclick="javascript:Recaptcha.switch_type(\'audio\');">captcha audio</a>.</p>';
		
		#captcha audio start
		echo '<p class="recaptcha_only_if_audio">masukan <strong>kedua</strong> kata atau angka yang anda dengarkan. jika tidak terdengar,anda dapat <a id="recaptchalink1" class="recaptcha_only_if_audio" href="#recaptchalink1" onclick="Recaptcha.reload();">menganti kata</a> atau kembali ke
    	<a id="recaptchalink2" class="recaptcha_only_if_audio" href="#recaptchalink2" onclick="javascript:Recaptcha.switch_type(\'image\');"> captcha tulisan</a>.</p>';
		echo '</div>';
		echo '<div id="recaptcha_image"></div>';
		echo '<input type="text" name="recaptcha_response_field" class="textinput" id="recaptcha_response_field" value="">';
		
		return '<script type="text/javascript" src="' . $server . '/challenge?k=' . $pubkey . $errorpart . '"></script>
		<noscript>
	  		<iframe src="' . $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
	  		<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
	  		<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
		</noscript>';
	}
	
	public static function check_answer($extra_params = array()) {
		$privkey = self::$privatekey;
		
		$remoteip = $_SERVER ["REMOTE_ADDR"];
		$challenge = $_POST ["recaptcha_challenge_field"];
		$response = $_POST ["recaptcha_response_field"];
		
		if ($remoteip == null || $remoteip == '') {
			die ( "For security reasons, you must pass the remote ip to recaptcha" );
		}
		
		//discard spam submissions
		if ($challenge == null || strlen ( $challenge ) == 0 || $response == null || strlen ( $response ) == 0) {
			$recaptcha_response = new ReCaptchaResponse ();
			
			$recaptcha_response->is_valid = false;
			$recaptcha_response->error = 'incorrect-captcha-sol';
			return $recaptcha_response;
		}
		
		$response = self::http_post ( RECAPTCHA_VERIFY_SERVER, "/verify", array ('privatekey' => $privkey, 'remoteip' => $remoteip, 'challenge' => $challenge, 'response' => $response ) + $extra_params );
		
		$answers = explode ( "\n", $response [1] );
		$recaptcha_response = new ReCaptchaResponse ();
		if (trim ( $answers [0] ) == 'true') {
			$recaptcha_response->is_valid = true;
		} else {
			$recaptcha_response->is_valid = false;
			$recaptcha_response->error = $answers [1];
		}
		return $recaptcha_response;
	}
}

class ReCaptchaResponse {
	var $is_valid;
	var $error;
}

