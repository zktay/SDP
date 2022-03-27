<?php
include("connect.php");
session_start();
$cusid = $_SESSION['customerID'];
$sql = "SELECT accountID FROM customer WHERE customerID = '$cusid'";
$sql = $mysqli-> query($sql);
$result = $sql -> fetch_assoc();
$accoundID = $result['accountID'];
$sql_pass = "SELECT password FROM accounts WHERE accountID = '$accoundID'";
$sql_pass = $mysqli ->query($sql_pass);
$result = $sql_pass -> fetch_assoc();
$id = intval($_POST['id']);

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
    $new_email_sql1 = "UPDATE accounts SET accountID = '$new_email' WHERE accountID = '$accoundID'";
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
    $cu_pass=$_POST["cu_password"];
    $en_cu_pass = sha1($cu_pass);
    $old_pass = $result['password'];
    $con_pass = $_POST['con_pass'];
    $en_con_pass = sha1($con_pass);
    if ($en_cu_pass == $old_pass){
        $new_pass_sql = "UPDATE accounts SET password = '$en_con_pass' WHERE accountID = '$accoundID'";
        $sql = $mysqli -> query($new_pass_sql);
        echo '<script>';
        echo 'alert ("Password Changed!");';
        echo 'window.location.href = "customer_modify.php";';
        echo '</script>';
    }else{
        echo '<script>';
        echo 'alert("Current Password incorrect");';
        echo 'window.location.href = "customer_modify.php";';
        echo '</script>';
    }
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
    
    
?>