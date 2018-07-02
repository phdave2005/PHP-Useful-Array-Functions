<?php

class base_n_sort {
	public function __construct($sort_type) {
		if ($sort_type !== 'asc' && $sort_type !== 'desc') $sort_type = 'asc';
		$this->sort_function = ($sort_type === 'asc') ? 'asort' : 'rsort';
    }
	
	private function is_invalid_input($arr, $base) {
		$invalid = false;
		
		if (!is_array($arr)) {
			$invalid = 'The sortable instance must be of type array.';
		} elseif (!is_numeric($base) || ($base <= 0) || !ctype_digit($base)) {
			$invalid = 'Bases must be integers greater than zero.';
		} else {
			foreach($arr as $a) {
				$split = str_split((string)$a);
				foreach($split as $s) {
					if ((int)$s >= $base) {
						$invalid = 'Data set cannot be mapped.';
						break 2;
					}
				}
			}
		}
		
		return $invalid;
	}
	
	public function sort($arr = false, $base = false) {
		
		$invalid = $this->is_invalid_input($arr, $base);
		
		if (!$invalid) {
		
			$mapped = array_map(function ($el) use($base) {
				return (int)base_convert((int)$el, $base, 10);
			}, $arr);
			
			$sort_function = $this->sort_function;
			$sort_function($mapped);
						
			$mapped = array_map(function ($el) use($base) {
				return (int)base_convert((int)$el, 10, $base);
			}, $mapped);
			
		} else {
			throw new Exception($invalid);
			exit;
		}
				
		return $mapped;
	}    
}
  
?>
