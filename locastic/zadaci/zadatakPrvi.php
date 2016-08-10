<?php
include_once 'utility.php';

$myString = $_POST['palindrome-txt'];

echo isPalindrome($myString) ? $myString . " je palindrom" : $myString . " - nije palindrom";

function isPalindrome($fString) {

    $length = numberOfCharacters($fString);
    $endChar = $length - 1;

	$j = 0;

	for($i = $endChar; $i >= 0; $i--) {
		$bString[$j] = $fString[$i];		
		$j++;
	}

	for($i = 0; $i < $length; $i++) {
		if($fString[$i] != $bString[$i])
			return false;
	}
	return true;
}
?>