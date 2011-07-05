<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Forms {
	function input($name, $type, $label, $value = null, $title = null) {
		switch ($type) {
			case 'textarea' :
				echo '<label for="' . $name . '">' . $label . '</label><textarea id="textarea-' . $name . '"" title="' . $title . '" name="' . $name . '" cols="17" rows="5">' . $value . '</textarea>';
				break;
			case 'file' :
				echo '<label for="' . $name . '">' . $label . '</label>
				<input type="file" size="11" name="' . $name . '" " id="input-' . $name . '" value="' . $value . '" />';
				break;
			case 'password' :
				echo '<label for="' . $name . '">' . $label . '</label>
			  	<input type="' . $type . '" autocomplete="off" class="textinput" name="' . $name . '" class="textinput" id="input-' . $name . '" title="' . $title . '" value="' . $value . '" />';
				break;
			case 'disabled' :
				echo '<label for="' . $name . '">' . $label . '</label>
			  	<input type="' . $type . '" disabled="disabled" class="textinput" readonly="readonly" name="' . $name . '" 
			  	id="input-disabled-' . $name . '" title="' . $title . '" value="' . $value . '" />';
				break;
			default :
				echo '<label for="' . $name . '">' . $label . '</label>
			  	<input type="' . $type . '" name="' . $name . '" class="textinput" id="input-' . $name . '" title="' . $title . '" value="' . $value . '" />';
				break;
		}
	}
	
	function textinput($name, $label, $options = array()) {
		
		$params = '';
		foreach ( $options as $key => $value ) {
			$params .= " $key = '$value'";
		}
		
		echo '<label for="' . $name . '">' . $label . '</label>
		<input name="' . $name . '" type="textinput" id="input-' . $name . '" ' . $params . ' />';
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