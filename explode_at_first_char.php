<?php
function explode_at_first_char($str, $needle) {
	
    $pos = strpos($str, $needle);
	
    if (is_array($str)) {
        $output = "The first argument must be a string";
    } else if (is_null($str) || strlen($needle) == 0) {
        $output = "The needle must not be null nor empty";
    } else if ($pos === false) {
        $output = array($str);
    } else {
        $str = (string)$str;//treat numbers as strings
        $strLength = strlen($str);
		
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
