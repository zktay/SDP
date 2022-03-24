<?php 
    session_start();
    require_once 'connect.php';
    require_once 'userController.php';

    $accountID = $mysqli->real_escape_string($_POST['accountID']);
    $password = $mysqli ->real_escape_string($_POST['password']);
    $password = sha1($password);

    $adminDetails = new sdpDatabase();
    $details = $adminDetails->userAccount("accounts", $accountID);

    if ($details ->num_rows!=1) 
    {
        session_destroy();
        echo "<script>alert('Wrong credentials');";
        echo "window.location.href='login.php';</script>";
    }
    else
    {
        $row = $details->fetch_assoc();
        if ($row['status'] != 'active') {
            session_destroy();
            echo "<script>alert('Account deactivated or banned \\nPlease get in touch with us via our Contact Us Page!');";
            echo "window.location.href='index.php';</script>";
        }
        else {
            $_SESSION['role'] = $row['role'];
        
        $_SESSION['accountID'] = $row['accountID'];
        $accountID = $_SESSION['accountID'];

        switch ($_SESSION['role']) {
            case 'customer':
                $column = 'customerID';
                $table = 'customer';

                $sql = "SELECT $column FROM $table WHERE accountID = '$accountID'";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION['customerID'] = $row['customerID'];
                echo "<script>alert('Successful Login');";
                echo "window.location.href='customer.php';</script>";
                break;

            case 'support':
                $column = 'custSupportID';
                $table = 'custsupport';

                $sql = "SELECT $column FROM $table WHERE accountID = '$accountID'";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION['custSupportID'] = $row['custSupportID'];
                echo "<script>alert('Successful Login');";
                echo "window.location.href='custSupport.php';</script>";
                break;

            case 'admin':
                $column = 'adminID';
                $table = 'admin';

                $sql = "SELECT $column FROM $table WHERE accountID = '$accountID'";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION['adminID'] = $row['adminID'];
                echo "<script>alert('Successful Login');";
                echo "window.location.href='admin.php';</script>";
                break;
            }
        }
    }
    $mysqli->close();
?>