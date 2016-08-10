<?php
threesAndFives();
echo "<div id='zadaci-btn' class='btn btn-primary '>Back to zadaci</div>";

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