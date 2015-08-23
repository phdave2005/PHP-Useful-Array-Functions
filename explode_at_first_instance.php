<?php
function explode_at_first_instance($str, $delimiter) {
	
    $pos = strpos($str, $delimiter);
	
    if (is_array($str)) {
        $output = "The first argument must be a string";
    } else if (is_null($str) || strlen($delimiter) == 0) {
        $output = "The delimiter must not be null nor empty";
    } else if ($pos === false) {
        $output = array($str);
    } else {
        $str = (string)$str;//treat numbers as strings
        $strLength = strlen($str);
		
        $reassembledStr = '';
        $explodeDelimiter = '0';
			
	while(strpos($str, $explodeDelimiter) !== false) $explodeDelimiter .= $explodeDelimiter;
			
	for($i = 0; $i < $strLength; $i++) $reassembledStr .= ($i == $pos) ? $explodeDelimiter : $str[$i];
			
	$output = explode($explodeDelimiter, $reassembledStr);
    	
    }
	
    return $output;
}

?>
