<?php 
    session_start();
    //clear the value inside
    session_unset();
    //destroy the whole session
    session_destroy();
    header("location: Login_inter.php");
