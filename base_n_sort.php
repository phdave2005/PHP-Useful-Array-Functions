<?php

  class base_n_sort {

    function group($arr, $base, $direction) {
	    $count = count($arr);
	    $masterArray = $keysArray = array();
	    $keyCount = 0;
	    $inserted = false;
	    for($i = 0; $i < $count; $i++) {
		    $thisLength = strlen((string)$arr[$i]);
		    if (!in_array((string)$thisLength, $keysArray)) {
			    $tempArray = array();
			    $minusOne = $keyCount - 1;
			    $masterArray[(string)$thisLength] = array($arr[$i]);
			    if ($keyCount === 0) {
				    $keysArray[] = $thisLength;
			    } else {
				    if ($direction === 'asc') {
					    for($j = 0; $j < $keyCount; $j++) {
						    if (!$inserted) {
							    if ($j !== $minusOne) {
								    if ($thisLength <= (int)$keysArray[$j]) {
									    $tempArray[] = $thisLength;
									    $inserted = true;
								    }
								    $tempArray[] = $keysArray[$j];
							    } else {
								    if ($thisLength <= (int)$keysArray[$j]) {
									    $tempArray[] = $thisLength;
									    $tempArray[] = $keysArray[$j];
								    } else {
								    	$tempArray[] = $keysArray[$j];
									    $tempArray[] = $thisLength;
								    }
							    }
						    } else {
							    $tempArray[] = $keysArray[$j];
						    }
					    }
				    } else if ($direction === 'desc') {
					    for($j = 0; $j < $keyCount; $j++) {
						    if (!$inserted) {
							    if ($j !== $minusOne) {
								    if ($thisLength >= (int)$keysArray[$j]) {
									    $tempArray[] = $thisLength;
									    $inserted = true;
								    }
								    $tempArray[] = $keysArray[$j];
							    } else {
								    if ($thisLength >= (int)$keysArray[$j]) {
									    $tempArray[] = $thisLength;
									    $tempArray[] = $keysArray[$j];
								    } else {
									    $tempArray[] = $keysArray[$j];
									    $tempArray[] = $thisLength;
								    }
							    }
						    } else {
							    $tempArray[] = $keysArray[$j];
						    }
					    }
				    } else {
					    throw new Exception('The order must be either ascending ("asc") or descending ("desc")');
				    }
				    $keysArray = $tempArray;
				    $inserted = false;
			    }
			    $keyCount++;
		    } else {
			    $thisArray = $masterArray[(string)$thisLength];
			    $thisArray[] = $arr[$i];
			    $masterArray[(string)$thisLength] = $thisArray;
		    }
	    }
	    //Now sort master array
	    for($i = 0; $i < $keyCount; $i++) {
		    $returnArray[(string)$keysArray[$i]] = $masterArray[(string)$keysArray[$i]];
	    }
	    return $this->sortMinis($returnArray, $base, $direction);;
    }

    function convertToDecimal($val, $base) {
	    $valLength = strlen($val);
	    $revVal = strrev((string)$val);
	    $convertedVal = 0;
	    for($i = 0; $i < $valLength; $i++) {
		    $convertedVal += ((int)$revVal[$i] !== 0) ? pow(($base * (int)$revVal[$i]), $i) : 0;
	    }
	    return $convertedVal;	
    }

    function sortMinis($masterArray, $base, $direction) {
	    $count = count($masterArray);
	    $sortedArray = array();
	    foreach($masterArray as $key=>$val) {
		    $thisCount = count($val);
		    $buildArray = array($val[0]);//the sorted array
		    $inserted = false;
		    for($j = 1; $j < $thisCount; $j++) {
			    $buildCount = count($buildArray);
			    $minusOne = $buildCount - 1;
			    $tempArray = array();
			    if ($direction === 'asc') {
				    for($k = 0; $k < $buildCount; $k++) {
					    if (!$inserted) {
						    $convertedVal = $this->convertToDecimal($val[$j], $base);
						    $convertedBuild = $this->convertToDecimal($buildArray[$k], $base);
						    if ($k !== $minusOne) {
							    if ($convertedVal <= $convertedBuild) {
								    $tempArray[] = $val[$j];
								    $inserted = true;
							    }
							    $tempArray[] = $buildArray[$k];
						    } else {
							    if ($convertedVal <= $convertedBuild) {
								    $tempArray[] = $val[$j];
								    $tempArray[] = $buildArray[$k];
							    } else {
								    $tempArray[] = $buildArray[$k];
								    $tempArray[] = $val[$j];	
							    }
						    }
					    } else {
						    $tempArray[] = $buildArray[$k];	
					    }
				    }
			    } else {
				    for($k = 0; $k < $buildCount; $k++) {
					    if (!$inserted) {
						    if ($k !== $minusOne) {
							    if ($val[$j] >= $buildArray[$k]) {
								    $tempArray[] = $val[$j];
								    $inserted = true;
							    }
							    $tempArray[] = $buildArray[$k];
						    } else {
							    if ($val[$j] >= $buildArray[$k]) {
								    $tempArray[] = $val[$j];
								    $tempArray[] = $buildArray[$k];
							    } else {
								    $tempArray[] = $buildArray[$k];
								    $tempArray[] = $val[$j];	
							    }
						    }
					    } else {
						    $tempArray[] = $buildArray[$k];	
					    }
				    }
			    }
			    $buildArray = $tempArray;
			    $inserted = false;
		    }
		    $sortedArray = array_merge($sortedArray, $buildArray);
	    }
	    return $sortedArray;
    }
  }
  
?>
