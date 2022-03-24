<?php 
    include("session.php");
    include("connect.php");
    //$_GET[‘id’] — Get the integer value from id parameter in URL.
    //intval() will returns the integer value of a variable
    $id = $_GET['id'];
    $result = mysqli_query($mysqli,"DELETE FROM cart WHERE cartID = '$id'");
    mysqli_close($mysqli); //close database connection
    header('Location: cart.php'); //redirect the page to view.php page
?>