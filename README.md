# PHP-Useful-Array-Functions
I will create a series of array functions which are all intended to be useful for developers; these functions will be created as I encounter, in my own development work, functionality I wish existed in PHP but does not currently exist.

The first function created for this purpose is a function which explodes at positions specified by the developer. An array is returned as long as the first argument is a string or number and the second argument is an array, thus the function takes the form: explode_at_positions($str, $arr). The array is an array of positions in the string at which to explode. If the array count is greater than the string length, the function will return an error message.

The functions explode_at_first_instance() and explode_at_last_instance() are similar. Both functions explode a string via a specific delimiter. However, the former function will explode only at the first instance of the delimiter (regardless of whether or not the delimiter is present elsewhere in the string), whereas the latter function does the same but only at the last instance of the delimiter in the string. Both functions take 2 arguments, a string (could also be a number but numbers will be forced to be strings) and a delimiter.

The function multi_delimiter_explode() will explode a string at any location in a string where there is a match for one or more delimiters. The function takes 2 arguments (a string, which could also be a number that will be forced to be a string, and an array of delimiters), and the second array must not be associative. The delimiters will have priority from left to right acrosss the string.

The class base_n_sort requires 3 argument: the array of values, the base (e.g. 10) as an integer, and the sort type ("asc" or "desc").
