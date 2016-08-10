<?php
include_once 'utility.php';

$myArray = array_map('intval', explode(',', $_POST['array-txt']));

//$myArray = array(2, 1, 4, 7, 1, 2, 6, 8);

similarSumGroups($myArray, 3);

function similarSumGroups($array, $num) {
    $descArr = mySort($array, true);
    $size = numberOfElements($array);

    for ($i = 0; $i < $num; $i++) {
        $group[$i][0] = $descArr[$i];
        $groupSum[$i] = $descArr[$i];
        
    }
    
    for($i = $num; $i < $size; $i++) {

        $min = minimumValue($groupSum);

        for($j = 0; $j < $num; $j++) {
            if($groupSum[$j] == $min) {
                $groupSum[$j] += $descArr[$i];
                $group[$j][numberOfElements($group[$j])] = $descArr[$i];
                break;
            }
        }
    }

    for($i = 0; $i < numberOfElements($groupSum); $i++) {
        for($j = 0; $j < $num; $j++) {
            echo $group[$i][$j];
            if($j < $num - 1 && $group[$i][$j + 1] != null)
                echo ", ";
        }
        echo " - $groupSum[$i]<br>";
    }
}
?>