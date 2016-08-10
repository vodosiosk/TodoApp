<?php
//$dir = 'C:\Program Files\xampplite\htdocs\locastic';
$dir = $_POST['path-txt'];


recursiveFolderSearch($dir);
echo "<div id='zadaci-btn' class='btn btn-primary '>Back to zadaci</div>";


function recursiveFolderSearch($dir) {

    foreach(scandir($dir) as $d) {

        if(!is_dir("$dir/$d")) {
            echo "$d<br>";
        } else if($d != '.' && $d != '..') {
            echo "$d<br>";            
            recursiveFolderSearch("$dir/$d");
        }
    }
}
?>