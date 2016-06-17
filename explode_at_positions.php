<?php

function explode_at_positions($str, $positionArray) {
	
    $positionCount = count($positionArray);
	
    if (is_array($str) || is_null($str)) {
        throw new Exception("The first argument must be a string");
    } else if ($positionCount == 0) {
        throw new Exception("The position array must not be empty");
    } else {
        $str = (string)$str; // treat numbers as strings
        $strLength = strlen($str);
		
        if ($positionCount > $strLength) {
            throw new Exception("The array contains more positions than there are characters in the string");
        } else {
            $reassembledStr = '';
            $explodeNeedle = "0";
            $counter = 1;
			
            while(strpos($str, $explodeNeedle) !== false) {
				
                $explodeNeedle .= $counter;
	        $counter++;
				
	    }
			
	    for($i = 0; $i < $strLength; $i++) $reassembledStr .= (in_array($i, $positionArray)) ? $explodeNeedle : $str[$i];
			
	    return explode($explodeNeedle, $reassembledStr);
        }
    }
}

?>
