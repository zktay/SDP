<?php
    session_start();
    $_SESSION["qty"] = array();
    $temp = $_REQUEST["qty"];
    $temp1 = explode(',',$temp);
    $temp2 = $_REQUEST["sub"];
    $temp2 = explode('&&', $temp2);
    $_SESSION["sub"] = $temp2; 
    foreach ($temp1 as $key){
        array_push($_SESSION['qty'], $key);
    }
?>
