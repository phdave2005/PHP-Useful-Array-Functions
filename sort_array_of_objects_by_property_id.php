<?php

class sort_array_of_objects_by_property_id {

    private function invalidate($arr, $property_name) {
        $invalid = false;
		
		if (!is_array($arr)) {
			$invalid = 'The sortable instance must be of type array.';
		} else {
            $property_exists = false;
			foreach($arr as $a) {
				if (is_object($a)) {
                    if (property_exists($a, $property_name)) {
                        $property_exists = true;
                    }
                } else {
                    $invalid = 'Array to be sorted must only contain objects.';    
                }
			}
            if (!$invalid && !$property_exists) {
                $invalid = 'Property not found in array of objects.';
            }
		}
		
		return $invalid;
    }
    
    private function sort_array($array_of_objects, $property_name, $sort_type) {
        $temp_array = array();
        $sorted_array = array();
		
		if ($sort_type === 'asc') {
			$sort_function = function ($arg) use($property_name) {
				extract($arg, EXTR_REFS);
				if ($int_val <= $min) {
                    array_unshift($temp_array, $int_val);
                    array_unshift($sorted_array, $arr);
                } elseif ($int_val >= $max) {
                    $temp_array[] = (int)$arr->$property_name;
                    $sorted_array[] = $arr;
                } else {
                    $counter = 0;
                    foreach($temp_array as $t) {
                        if ($int_val <= $t) {
                            $temp_array = array_merge(array_slice($temp_array, 0, $counter), $int_val, array_slice($temp_array, $counter));
                            $sorted_array = array_merge(array_slice($sorted_array, 0, $counter), $int_val, array_slice($sorted_array, $counter));
                            break;
                        }
                        $counter++;
                    }
                }
				
				return [$sorted_array, $temp_array];
			};
		} else {
			$sort_function = function ($arg) use($property_name) {
				extract($arg, EXTR_REFS);
				if ($int_val <= $min) {
                    $temp_array[] = (int)$arr->$property_name;
                    $sorted_array[] = $arr;
                } elseif ($int_val >= $max) {
                    array_unshift($temp_array, $int_val);
                    array_unshift($sorted_array, $arr);
                } else {
                    $counter = 0;
                    foreach($temp_array as $t) {
                        if ($int_val >= $t) {
                            $temp_array = array_merge(array_slice($temp_array, 0, $counter), $int_val, array_slice($temp_array, $counter));
                            $sorted_array = array_merge(array_slice($sorted_array, 0, $counter), $int_val, array_slice($sorted_array, $counter));
                            break;
                        }
                        $counter++;
                    }
                }
				
				return [$sorted_array, $temp_array];
			};
		}
        
        foreach($array_of_objects as $arr) {
            if (empty($temp_array)) {
                $temp_array[] = (int)$arr->$property_name;
                $sorted_array[] = $arr;
            } else {
                $min = min($temp_array);
                $max = max($temp_array);
                $int_val = (int)$arr->$property_name;
				
				$arg = array(
					'arr'		   => $arr,
					'min'	       => $min,
					'max' 		   => $max,
					'int_val' 	   => $int_val,
					'temp_array'   => &$temp_array,
					'sorted_array' => &$sorted_array,
				);
				
				list($sorted_array, $temp_array) = $sort_function($arg);
            }
        }
        
        return $sorted_array;
    }
    
    public function sort($arr = false, $property_name = false, $sort_type = 'asc') {
        $invalid = $this->invalidate($arr, $property_name);
        $sorted_array = $arr;
        if (!$invalid) {
         
            $count = count($arr);
            if ($count > 1) {
                $sorted_array = $this->sort_array($arr, $property_name, $sort_type);
            }
        
        } else {
            throw new Exception($invalid);
			exit;
        }
        
        return $sorted_array;
    }

}

?>
