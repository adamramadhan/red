<?php  
$text = "helloworld @awdawd @hellowlrd wadawdawd @awdawd";


function get_comment($text){
	$hello = explode(" ", $text);

	#return the usernames
	foreach ($hello as $text) {
		if (strstr($text, '@')) {
			$usernames[] = $text;
		}
	}	
	return $usernames;
}

function render_comment($text){
	$hello = explode(" ", $text);

	#return the usernames
	foreach ($hello as $text) {
		if (strstr($text, '@')) {
			$usernames[] = '<a href="/'.$text.'">$text</a>';
		}
	}	
	return $usernames;
}


var_dump(render_comment($text));
?>