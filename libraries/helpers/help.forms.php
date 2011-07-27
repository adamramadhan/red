<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Forms {	
	function textinput($name, $label, $options = array()) {
		
		$params = '';
		foreach ( $options as $key => $value ) {
			$params .= " $key = '$value'";
		}
		
		echo '<label for="' . $name . '">' . $label . '</label>
		<input name="' . $name . '" type="text" id="input-' . $name . '" ' . $params . ' />';
	}
	
	function textarea($name, $label, $options = array()) {

		if (! isset ( $options ['value'] )) {
			$options ['value'] = NULL;
		}
		$params = '';
		foreach ( $options as $key => $value ) {
			if ($key !== 'value') {
				$params .= " $key = '$value'";
			}
		}

		echo '
		<label for="' . $name . '">' . $label . '</label>
		<textarea name="' . $name . '" id="textarea-' . $name . '" ' . $params . ' >' . $options ['value'] . '</textarea>';
	}
	
	function fileinput($name, $label, $options = array()) {
		
		$params = '';
		foreach ( $options as $key => $value ) {
			$params .= " $key = '$value'";
		}
		
		echo '<label for="' . $name . '">' . $label . '</label>
		<input name="' . $name . '" type="file"  id="input-' . $name . '" ' . $params . ' />';
	}
}

?>