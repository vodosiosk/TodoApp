<?php
include_once 'utility.php';

//$aString = "ravjkjkparijztet";
//$bString = "jkjaspari";

$aString = $_POST['a-txt'];
$bString = $_POST['b-txt'];

echo "Najduzi zajednicki substring je: " . longestCommonSubstring($aString, $bString);
echo "<div id='zadaci-btn' class='btn btn-primary '>Back to zadaci</div>";


function longestCommonSubstring($a, $b) {
	
	$aSize = numberOfCharacters($a);
	$bSize = numberOfCharacters($b);



	for($i = 0; $i <= $aSize; $i++) {
		$lcsMatrix[$i][0] = 0;
	}

	for($i = 0; $i <= $bSize; $i++) {
		$lcsMatrix[0][$i]=0;
	}

	for($i = 1; $i <= $aSize; $i++) {
    	for($j = 1; $j <= $bSize; $j++) {
    		if($a[$i-1] == $b[$j-1]) {
    			$lcsMatrix[$i][$j] = $lcsMatrix[$i-1][$j-1] + 1;
    		} else {
    			$lcsMatrix[$i][$j] = 0;
    		}
    	}
	}

	$result = -1;

	for($i = 0; $i <= $aSize; $i++) {
    	for($j = 0; $j <= $bSize; $j++) {
    		if($lcsLength < $lcsMatrix[$i][$j]) {
    			$lcsLength = $lcsMatrix[$i][$j];
    			$iLcs = $i;
    			$jLcs = $j;
    		}
    	}
    }

    $lcs=" ";
    while($lcsLength > 0) {
    	$iLcs--;
    	$jLcs--;
    	$lcsLength = $lcsMatrix[$iLcs][$jLcs];
    	$lcs[$lcsLength] = $a[$iLcs];
    	
    }   
    return $lcs;
}
?>