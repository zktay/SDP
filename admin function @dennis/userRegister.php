<?php
    session_start();
    require_once "connect.php";
    require_once 'userController.php';

    $accountID = $_POST['accountID'];
    $password = $_POST['password'];

    $adminDetails = new sdpDatabase();
    $details = $adminDetails->userAccount("accounts", $accountID);

    // to check if email exist in database //
    if($details -> num_rows != 0) {
        echo "<script>alert('This email is taken. Please proceed to login!');";
        echo "window.location.href='login.php';</script>";
    }

    else {
        $sql1 = "INSERT INTO accounts (accountID, password, role) VALUES (?,?,?);";
        $stmt1 = $mysqli -> prepare($sql1);
        $accountID = $mysqli -> real_escape_string($_POST['accountID']);
        $role = 'customer';
        $password = $mysqli->real_escape_string($_POST['password']);
        $password = sha1($password);
        $stmt1 -> bind_param('sss', $accountID, $password, $role);

        $sql2 = "INSERT INTO customer (custName, custContact, custDOB, accountID) VALUES (?,?,?,?);";
        $stmt2 = $mysqli-> prepare($sql2);
        $custName = $mysqli-> real_escape_string($_POST['custName']);
        $custContact = $mysqli-> real_escape_string($_POST['custContact']);
        $custDOB = $mysqli-> real_escape_string($_POST['custDOB']);
        $stmt2 -> bind_param('ssss', $custName, $custContact, $custDOB, $accountID);


        if($stmt1 -> execute() && $stmt2 -> execute()) {
            $_SESSION['role'] = 'user';
            $_SESSION['accountID'] = $accountID;
            $_SESSION['customerID'] = $mysqli ->insert_id;
            echo "<script>alert('Welcome to SL Tourism!');";
            echo "window.location.href='cust.php';</script>";

            // echo "<script>alert('Welcome to SL Tourisms, ".$_POST['custName']."!')";
            // echo "window.location.href='cust.php';</script>";
        }
    }
    $mysqli->close();
    
?>