<?php

function explode_at_positions($str = false, $positionArray = array()) {
	
    $positionCount = count($positionArray);	
	
    if (is_array($str) || is_object($str) || is_null($str) || is_bool($str)) {
        throw new Exception("The first argument must be a string");
    } else if ($positionCount === 0) {
        throw new Exception("The position array must not be empty");
    } else {
        $str = (string)$str; // treat numbers as strings
        $strLength = strlen($str);
		
        if ($positionCount > $strLength) {
            throw new Exception("The array contains more positions than there are characters in the string");
        } else {
            
			$firstPiece = substr($str, 0, $positionArray[0]);	
			$pieces = array($firstPiece);

			$counter = 0;
			for($i = $positionArray[0]; $i < $strLength; $i++) {
				if (in_array($i, $positionArray)) {
					$len = isset($positionArray[$counter + 1]) ? $positionArray[$counter + 1] - $positionArray[$counter] : $strLength - $positionArray[$counter];
					$pieces[] = substr($str, $i, $len);
					$counter++;
				}
			}

			return $pieces;
        }
    }
}

?>
