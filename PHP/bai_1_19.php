<?php
$so_n = 100;

for($i = 2; $i <= $so_n; $i++){
    //echo '<br/>' . $i . '<br/>';
    $flag = 0;
    for($j = 2; $j < $i; $j++){
        
        if($i % $j == 0){
            $flag = 1;
        }
        //echo $j . ' - ' . $flag .'<br/>';
    }
    

    if($flag == 0){
        echo $i . ' ';
    }
}
?>