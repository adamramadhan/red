<?php

class Comments extends Application
{
	function Render($text,$modeluser){

		preg_match_all("/=([a-zA-Z0-9_]+)/", $text, $usernames);
		foreach ($usernames[1] as $username) {
			$check = $modeluser->getDataComments($username);
			if (!empty($check)) {
				$database[$username] = array(
					'role' => $check['role'],
					'name' => $check['name'] );
			}
		}
		/*$database = array('helloworld','netcoid');*/
		# \1 blm kepake. munkin nanti pake sekarang pake warna dulu
		foreach ($database as $username => $values) {
			var_dump($username);
			switch ($values['role']) {
				case '5':
					$text = preg_replace('/=('.$username.')/', '<a class="u" href="'.strtolower('\1').'">*'.$values['name'].'</a>', $text);
					break;

				case '0':
					$text = preg_replace('/=('.$username.')/', '<a class="u" href="'.strtolower('\1').'">~'.$values['name'].'</a>', $text);
					break;
				
				default:
				var_dump($text);
				case '5':
					$text = preg_replace('/=('.$username.')/', '<a class="u" href="'.strtolower('\1').'">'.$values['name'].'</a>', $text);
					break;
			}
			#$text = preg_replace('/('.$dbusername.')/', '<a class="u" href="\1">\1</a>', $text);
		}

		return $text;
	}

	function Unrender($text){
		$text = preg_replace('/<a class="u" href="([a-zA-Z0-9_]{6,20})">([a-zA-Z0-9_]{6,20})<\/a>/', '\1', $text);
		return $text;
	}
}

?>