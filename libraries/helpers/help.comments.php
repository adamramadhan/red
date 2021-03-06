<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Comments extends Application {
	function InsertMentions($cid, $usernames, $modelmentions) {
		#create query one.
		foreach ( $usernames as $username => $data ) {
			$q [] = '("' . $data ['uid'] . '", "' . $cid . '", 0)';
		}
		
		$modelmentions->add ( $q );
		return true;
	}
	
	function Render($text, $modeluser, &$getusernames) {
		
		preg_match_all ( "/=([a-zA-Z0-9_]+)/", $text, $usernames );
		foreach ( $usernames [1] as $username ) {
			$check = $modeluser->getDataComments ( $username );
			if (! empty ( $check )) {
				$database [$username] = array ('role' => $check ['role'], 'name' => $check ['name'], 'uid' => $check ['uid'] );
			}
		}
		
		// updateing getusernames above
		$getusernames = $database;
		
		/*$database = array('helloworld','netcoid');*/
		# \1 blm kepake. munkin nanti pake sekarang pake warna dulu
		foreach ( $database as $username => $values ) {
			switch ($values ['role']) {
				case '1' :
					$text = preg_replace ( '/=(' . $username . ')/', '<a class="u" href="/' . strtolower ( '\1' ) . '">' . $values ['name'] . ' &#x2714;</a>', $text );
					break;

				case '5' :
					$text = preg_replace ( '/=(' . $username . ')/', '<a class="u" href="/' . strtolower ( '\1' ) . '">*' . $values ['name'] . '</a>', $text );
					break;
				
				case '0' :
					$text = preg_replace ( '/=(' . $username . ')/', '<a class="u" href="/' . strtolower ( '\1' ) . '">' . $values ['name'] . '</a>', $text );
					break;
				
				default :
					$text = preg_replace ( '/=(' . $username . ')/', '<a class="u" href="/' . strtolower ( '\1' ) . '">' . $values ['name'] . '</a>', $text );
					break;
			}
		
		#$text = preg_replace('/('.$dbusername.')/', '<a class="u" href="\1">\1</a>', $text);
		}
		
		return $text;
	}
	
	function Unrender($text) {
		$text = preg_replace ( '/<a class="u" href="([a-zA-Z0-9_]{6,20})">([a-zA-Z0-9_]{6,20})<\/a>/', '\1', $text );
		return $text;
	}
}

?>