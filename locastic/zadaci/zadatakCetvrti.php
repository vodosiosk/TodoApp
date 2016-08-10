<?php
include_once 'utility.php';

$myArray = array_map('intval', explode(',', $_POST['array-txt']));

//$myArray = array(33, 4, 61, 2, 14, 37, 9);

echo "The minimum value is: " . myMinimumValue($myArray);

function myMinimumValue($array) {
	$min = $array[0];
	$size = numberOfElements($array);

	for($i = 0; $i < $size; $i++) {
    	if($array[$i] < $min)
    		$min = $array[$i];
	}
	return $min;		
}
?>