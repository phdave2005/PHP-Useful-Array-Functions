<?php

class base_n_sort {
	public function __construct($sort_type) {
		if ($sort_type !== 'asc' && $sort_type !== 'desc') $sort_type = 'asc';
		$this->sort_function = ($sort_type === 'asc') ? 'asort' : 'rsort';
    }
	
	private function is_invalid_input($arr, $base) {
		$invalid = false;
		
		if ($base <= 0) {
			$invalid = 'Bases must be integers greater than zero';	
		} else {		
			foreach($arr as $a) {
				$split = str_split((string)$a);
				foreach($split as $s) {
					if ((int)$s >= $base) {
						$invalid = 'Data set cannot be mapped';
						break 2;
					}
				}
			}
		}
		
		return $invalid;
	}
	
	public function sort($arr, $base) {
		
		$invalid = $this->is_invalid_input($arr, $base);
		
		if (!$invalid) {
		
			$convert_base_n_to_decimal = function($val, $base) {
				$val_length = strlen($val);
				$rev_val = strrev((string)$val);
				$converted_val = 0;
				for($i = 0; $i < $val_length; $i++) {
					if ((int)$rev_val[$i] > 0) {
						$converted_val += pow($base, $i) * (int)$rev_val[$i];
					}
				}
				return $converted_val;	
			};
			
			$convert_decimal_to_base_n = function($val, $base) use(&$convert_decimal_to_base_n) {
				$valLength = strlen($val);
				$remainder = $val;
				$converted_val = '';
				for($i = 0; $i < $valLength; $i++) {
					if ($remainder < $base) {
						$converted_val .= $remainder;
						$remainder = null;
						break;
					} else {
						$floor = (int)floor($val / $base);
						if ($floor >= $base) {
							$floor = $convert_decimal_to_base_n($floor, $base);
						}
						$converted_val .= $floor;
						$remainder = $remainder % $base;
					}
				}
				
				if (isset($remainder)) $converted_val .= $remainder;
				
				return (int)$converted_val;	
			};
			
			$mapped = array_map(function ($el) use($convert_base_n_to_decimal, $base) {
				return $convert_base_n_to_decimal($el, $base);	
			}, $arr);
			
			$sort_function = $this->sort_function;
			$sort_function($mapped);
						
			$mapped = array_map(function ($el) use($convert_decimal_to_base_n, $base) {
				return $convert_decimal_to_base_n($el, $base);	
			}, $mapped);
			
		} else {
			echo $invalid;
			exit;
		}
				
		return $mapped;
	}
    
}

  
?>
