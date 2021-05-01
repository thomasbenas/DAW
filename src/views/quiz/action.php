<?php 
    $total = 0;
    foreach ($_POST as $key => $value){
        var_dump($key);
        if ($key != "submit")
        $total += $value;
    }
    echo "$total";
?>