<?php  

/**
 * Security Class
 * class that checks any data
 * and returns error if needed.
 * @package default
 * @author DAMS
 */

class Validation
{
	// bisa diganti protected
	public $errors;
	public function getErrors()
	{	
		if (sizeof($this->errors)) 
	    {
	        echo '<div id="red-error-box"><ul>';
	        echo '<li class="error-list clearfix">
	        <span id="num">-'.count($this->errors).'.</span><span id="description">' . $this->errors[0] . '</span></li>';
	        echo '</ul></div>';
	    }	
	}
	
	public function required( $value, $message )
	{
		if (empty($value)) {
			$this->errors[] = $message;
		}
		else 
		{ 
			return true; 
		}
	}
	
	public function range( $string, $options )
	{
		if ( strlen(htmlspecialchars_decode( $string ) ) < $options['min'] )
		{
			return false;
		}
		if ( strlen(htmlspecialchars_decode( $string ) ) > $options['max'] )
		{
			return false;
		}

	return true;						
	}
	
	public function regex( $value, $regex, $message )
	{
	    if (preg_match($regex, $value)) 
	    {    
	        return true;
	    }
	    else
	    {  
	        $this->errors[] = $message;
	    }	
	}
	
	public function f( $function, $message )
	{
		if ($function) {
			$this->errors[] = $message;
		} 
		else
		{
			return true;		
		}		
	}
	
	public function safe( $str ) 
	{
	    $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
	    $str = htmlentities($str, ENT_QUOTES, 'UTF-8');
	    
	    return $str;
	}
	
	public function image( $img, $message )
	{
		if (!empty($img['name']) && @getimagesize($img["tmp_name"]) == FALSE) {
			$this->errors[] = $message;
		} 
		else
		{
			return true;		
		}		
	}
	
	public function is_set( $value, $message )
	{
		if (!isset($value)) {
			$this->errors[] = $message;
		} 
		else
		{
			return true;		
		}			
	}
	function __construct()
	{
		
	}
}


?>