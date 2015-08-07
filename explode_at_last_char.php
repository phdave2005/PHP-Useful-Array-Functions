<?php
function explode_at_last_char($str, $needle) {
	
	if (is_array($str)) {
	    $output = "The first argument must be a string";
	} else if (is_null($str) || strlen($needle) == 0) {
	  	$output = "The needle must not be null nor empty";
	} else if (strpos($str, $needle) === false) {
		  $output = array($str);
	} else {
		  $str = (string)$str;//treat numbers as strings
		  $strLength = strlen($str);
		
		  $pos = strrpos($str, $needle);
		
		  $reassembledStr = '';
		  $explodeNeedle = '0';
		  $counter = 1;
			
		  while(strpos($str, $explodeNeedle) !== false) {
			
			    $explodeNeedle .= $counter;
			    $counter++;
		
		  }
			
			
		  for($i = 0; $i < $strLength; $i++) {
				
		      $reassembledStr .= ($i == $pos) ? $explodeNeedle : $str[$i];
					
		  }
			
	  	$output = explode($explodeNeedle, $reassembledStr);
	}
	
	return $output;
}

?>
