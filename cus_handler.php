<?php
include("connect.php");
session_start();
$accoundID = $_SESSION['customerID'];
$cusid = intval($_GET['cusid']);
$id = intval($_GET['id']);
$accID = $_GET['name'];

if ($id == 1){
    $new_user = $_POST['new_user'];
    $new_user_sql = "UPDATE customer SET custName = '$new_user' WHERE customerID = '$cusid'";
    $sql = $mysqli -> query($new_user_sql);
    echo '<script>';
    echo 'alert ("Username Changed!");';
    echo 'window.location.href = "customer_modify.php";';
    echo '</script>';
}else if ($id == 2){
    $new_email = $_POST['new_email'];
    $new_email_sql = "UPDATE customer SET accountID = '$new_email' WHERE customerID = '$cusid'";
    $new_email_sql1 = "UPDATE accounts SET accountID = '$new_email' WHERE accountID = '$accoundID";
    if(!mysqli_query($mysqli, $new_email_sql)){
        echo '<script>';
        echo 'alert ("Email has been taken!");';
        echo 'window.location.href = "customer_modify.php";';
        echo '</script>';
    }
    else{
        $temp = $mysqli -> query($new_email_sql1);
        echo ("
        <script> alert('Email sucessfully change!');
        window.location.href = 'customer_modify.php';
        </script>");
    }
    mysqli_close($mysqli);
}else if ($id == 3){
    $con_pass = $_POST['con_pass'];
    $new_pass_sql = "UPDATE accounts SET password = '$con_pass_sql' WHERE accountID = '$accID'";
    $sql = $mysqli -> query($new_pass_sql);
    echo '<script>';
    echo 'alert ("Password Changed!");';
    echo 'window.location.href = "customer_modify.php";';
    echo '</script>';
}else if ($id == 4){
    $new_con = $_POST['new_con'];
    $new_con_sql = "UPDATE customer SET custContact = '$new_con' WHERE customerID = '$cusid'";
    $sql = $mysqli -> query($new_con_sql);
    echo '<script>';
    echo 'alert ("Contact number Changed!");';
    echo 'window.location.href = "customer_modify.php";';
    echo '</script>';
}else if ($id == 5){
    $image = $_FILES['new_pic']['tmp_name'];
    $name = $_FILES['new_pic']['name'];
    $image = base64_encode(file_get_contents($image));
    $image = addslashes(file_get_contents($_FILES['new_pic']['tmp_name']));
    $new_pic = "UPDATE customer SET customerPic = '$image' WHERE customerID = '$cusid'";
    if(!mysqli_query($mysqli, $new_pic)){
        echo '<script>';
        echo 'alert ("Server took too long to response, picture is not uploaded.");';
        echo 'window.location.href = "customer_modify.php";';
        echo '</script>';
    }
    else{
        $temp = $mysqli -> query($new_pic);
        echo '<script>';
        echo 'alert ("Profile Pic Changed!");';
        echo 'window.location.href = "customer_modify.php";';
        echo '</script>';
}
    }
    $sql = $mysqli -> query($new_pic);
    
?>