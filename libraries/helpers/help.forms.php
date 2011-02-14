<?php

class Forms
{
	function input($name, $type, $lable, $value = null) 
	{
		switch ($type) 
	    {
		    case 'textarea':
		        echo "<label for='$name'>$lable</label><textarea id='textarea-$name' name='$name' cols='17' rows='5'>$value</textarea>";
		    break;
		    case 'file':
		        echo '<label for="' . $name . '">' . $lable . '</label>
				<input type="file" size="11" name="' . $name . '" " id="input-' . $name . '" value="' . $value . '" />';
		    break;
		    case 'password':
		        echo '<label for="' . $name . '">' . $lable . '</label>
			  	<input type="' . $type . '" autocomplete="off" class="textinput" name="' . $name . '" class="textinput" id="input-' . $name . '" value="' . $value . '" />';
		    break;
		    case 'disabled':
		        echo '<label for="' . $name . '">' . $lable . '</label>
			  	<input type="' . $type . '" disabled="disabled" class="textinput" readonly="readonly" name="' . $name . '" 
			  	id="input-disabled-' . $name . '" value="' . $value . '" />';
		    break;
		    default:
				echo '<label for="' . $name . '">' . $lable . '</label>
			  	<input type="' . $type . '" name="' . $name . '" class="textinput" id="input-' . $name . '" value="' . $value . '" />';
		    break;
	    }	 	
	}
}

?>