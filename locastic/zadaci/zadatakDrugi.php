<?php
$a = $_POST['a-num'];
$b = $_POST['b-num'];

echo "$a to the power of $b is: " . exponentiate($a, $b);

function exponentiate($n, $m) {
	$x = 1;
	for($i = 0; $i < $m; $i++) {
    	$x = $x * $n;
	}
	return $x;	
}
?>