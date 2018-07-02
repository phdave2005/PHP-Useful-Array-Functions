<?php
function explode_at_first_instance($str = false, $delimiter = false) {
		
    if (is_array($str) || is_object($str) || is_null($str) || is_bool($str)) {
        throw new Exception("The first argument must be a string");
    } else if (strlen($delimiter) === 0) {
        throw new Exception("The delimiter must not be null nor empty");
    } else {
	$pos = strpos($str, $delimiter);
    	if ($pos === false) {
	    $output = array($str);
    	} else {
        	$str = (string)$str;//treat numbers as strings
        			
        	$pre = substr($str, 0, $pos);
		$post = substr($str, $pos + strlen($str));
			
		$output = [$pre, $post];    	
    	}
	
    	return $output;
    }
}

?>
