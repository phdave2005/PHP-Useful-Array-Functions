<?php

function multi_delimiter_explode($str, $delimiterArray) {
	
    $arrayCount = count($delimiterArray);
	  $str = (string)$str; // treat numbers as strings
    $strLength = strlen($str);
	
    if (is_array($str) || is_null($str) || $strLength == 0) {
        $output = "The first argument must be a string of length greater than zero";
    } else if (!is_array($delimiterArray) || $arrayCount == 0) {
        $output = "The second argument must be an array with at least one member";
	  } else {
	  
		    $explodeDelimiter = '0';
		    $counter = 1;
		    while(strpos($str, $explodeDelimiter) !== false) {
            $explodeDelimiter .= $counter;
	          $counter++;
	      }
		
		    $substituteStr = str_replace($delimiterArray, $explodeDelimiter, $str);
		
	      $output = explode($explodeDelimiter, $substituteStr);;
		
    }
    
    return $output;
    
}
