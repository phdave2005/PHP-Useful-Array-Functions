<?php

class base_n_sort {

	public function __construct($sort_type) {
		if ($sort_type !== 'asc' && $sort_type !== 'desc') $sort_type = 'asc';
		$this->for_loop_group = "group_" . $sort_type;
		$this->for_loop_sort = "sort_" . $sort_type;
    }

	function group_asc($tempArray, $keyCount, $minusOne, $thisLength, $keysArray) {
		$inserted = false;
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
		return $tempArray;
	}
	
	function group_desc($tempArray, $keyCount, $minusOne, $thisLength, $keysArray) {
		$inserted = false;
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
		return $tempArray;
	}

	function sort($arr, $base) {
		$count = count($arr);
		$masterArray = $keysArray = array();
		$keyCount = 0;
		for($i = 0; $i < $count; $i++) {
			$thisLength = strlen((string)$arr[$i]);
			if (!in_array((string)$thisLength, $keysArray)) {
				$tempArray = array();
				$minusOne = $keyCount - 1;
				$masterArray[(string)$thisLength] = array($arr[$i]);
				if ($keyCount === 0) {
					$keysArray[] = $thisLength;
				} else {
					$keysArray = $this->{$this->for_loop_group}($tempArray, $keyCount, $minusOne, $thisLength, $keysArray);
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
		
		return $this->sortMinis($returnArray, $base);
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
    
    function sort_asc($buildArray, $val, $base, $thisCount) {
    	$inserted = false;
    	for($j = 1; $j < $thisCount; $j++) {
			$buildCount = count($buildArray);
			$minusOne = $buildCount - 1;
			$tempArray = array();
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
		    $buildArray = $tempArray;
		}
    	return $buildArray;
    }
    
    function sort_desc($buildArray, $val, $base, $thisCount) {
    	$inserted = false;
    	for($j = 1; $j < $thisCount; $j++) {
			$buildCount = count($buildArray);
			$minusOne = $buildCount - 1;
			$tempArray = array();
			for($k = 0; $k < $buildCount; $k++) {
				if (!$inserted) {
					$convertedVal = $this->convertToDecimal($val[$j], $base);
					$convertedBuild = $this->convertToDecimal($buildArray[$k], $base);
					if ($k !== $minusOne) {
						if ($convertedVal >= $convertedBuild) {
							$tempArray[] = $val[$j];
							$inserted = true;
						}
						$tempArray[] = $buildArray[$k];
					} else {
						if ($convertedVal >= $convertedBuild) {
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
		    $buildArray = $tempArray;
		}
    	return $buildArray;
    }

    function sortMinis($masterArray, $base) {
	    $sortedArray = array();
	    foreach($masterArray as $key=>$val) {
		    $sortedArray = array_merge($sortedArray, $this->{$this->for_loop_sort}(array($val[0]), $val, $base, count($val)));
	    }
	    return $sortedArray;
    }
}
  
?>
