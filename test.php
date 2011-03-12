<?php  
$text = "helloworld @helloworld @netcoid wadawdawd @awdawd";


function get_usernames($text){
	$hello = explode(" ", $text);

	#return the usernames
	foreach ($hello as $text) {
		if (strstr($text, '@')) {
			$usernames[] = $text;
		}
	}	
	return $usernames;
}

# next simbol
function render_comment($text){
	$usernames = get_usernames($text);

	/* get database 
	foreach ($usernames as $username) {
		$check = $database->get($username);
		if (!empty($check)) {
			$database[] = $username;
		}
	}
	*/

	$database = array('helloworld','netcoid');
	# \1 blm kepake. munkin nanti pake sekarang pake warna dulu
	foreach ($database as $dbusername) {
		$text = preg_replace('/(.)('.$dbusername.')/', '<a class="u" href="\2">\2</a>', $text);
	}

	return $text;
}

# jangan satu2 pake array
function unrender_comment($text){
	$text = preg_replace('/<a class="u" href="([a-zA-Z0-9_]{6,20})">([a-zA-Z0-9_]{6,20})<\/a>/', '\1', $text);
	return $text;
}

var_dump(render_comment($text));
echo render_comment($text)."<br/>";
$comments = array(render_comment($text),render_comment($text));
var_dump(unrender_comment($comments));
?>


	function get_usernames($text){
		$hello = explode(" ", $text);

		#return the usernames
		foreach ($hello as $text) {
			if (strstr($text, '@')) {
				$usernames[] = substr($text, 1);
			}
		}	
		return $usernames;
	}