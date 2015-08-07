# PHP-Useful-Array-Functions
I will create a series of array functions which are all intended to be useful for developers; these functions will be created as I encounter, in my own development work, functionality I wish existed in PHP but does not currently exist.

The first function created for this purpose is a function which explodes at positions specified by the developer. An array is returned as long as the first argument is a string or number and the second argument is an array. The array is an array of positions in the string at which to explode. If the array count is greater than the string length, the function will return an error message.
