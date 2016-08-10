<?php
function numberOfElements($obj) {	
	$cnt = 0;
	foreach($obj as $element) {		
		$cnt++;
	}
	return $cnt;
}

function numberOfCharacters($str) {
	$cnt = 0;	
	while($str[$cnt] != null) {
		$cnt++;
	}
	return $cnt;
}

function mySort($arr, $desc = false) {
	$size = numberOfElements($arr);
	
	if(!$desc) {
		for($i=0; $i<$size; $i++) {
			for($j=0; $j<$size-1-$i; $j++) {
				if($arr[$j+1] < $arr[$j]) {
					mySwap($arr, $j, $j+1);
				}			
			}
		}
	} else {
		for($i=0; $i<$size; $i++) {
			for($j=0; $j<$size-1-$i; $j++) {
				if($arr[$j+1] > $arr[$j]) {
					mySwap($arr, $j, $j+1);
				}			
			}
		}
	}
	
	return $arr;
}

function mySwap(&$arr, $a, $b) {
	$temp = $arr[$a];
	$arr[$a] = $arr[$b];
	$arr[$b] = $temp;
}

function minimumValue($array) {
	$min = $array[0];
	$size = numberOfElements($array);

	for($i = 0; $i < $size; $i++) {
    	if($array[$i] < $min)
    		$min = $array[$i];
	}
	return $min;		
}
?>