<?php
include_once 'utility.php';

$array = array_map('intval', explode(',', $_POST['array-txt']));

//$array = array(17, 23, 2, 23, 18, 18, 2, 5, 1, 5, 17, 5);


echo "The most frequent element is: " . highestFrequencyElement($array);
echo "<div id='zadaci-btn' class='btn btn-primary '>Back to zadaci</div>";

function highestFrequencyElement($arr) {

	$arr = mySort($arr);

	$maxFreq = 0;
	$currentFreq = 0;
	$maxFreqElem = $arr[0];
	$currentElem = $arr[0];
	$size = numberOfElements($arr);

	for($i = 0; $i < $size; $i++) {
		if($arr[$i] == $currentElem) {
			$currentFreq++;
		}
		else {
			if($currentFreq > $maxFreq) {
				$maxFreq = $currentFreq;
				$maxFreqElem = $arr[$i-1];
			}

			$currentElem = $arr[$i];
			$currentFreq = 1;			
		}    	
	}

	return $maxFreqElem;		
}
?>