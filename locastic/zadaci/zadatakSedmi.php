<?php
threesAndFives();

function threesAndFives() {
	for($i = 1; $i <= 100; $i++) {
        $output="";
        if($i % 3 != 0 && $i % 5 != 0) {
            $output = $i;
        } else {
            if($i % 3 == 0)
                $output = "LOCA";
            if($i % 5 == 0)
                $output .= "STIC";
        } 
		echo "$output </br>";
	}
}
?>