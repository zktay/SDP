<?php
    session_start();
    $customerID1 = $_SESSION['customerID'];
    $bank = $_POST['bank'];
    $nameOnCard = $_POST['NameOnCard'];
    include("connect.php");
    //$_SESSION["qty"] = array();
    $temp1 = $_SESSION['qty'];
    $sub = $_SESSION['sub'][0];
    //$cusID = $_POST['id'];
    $sql = "SELECT * FROM cart where customerID='$customerID1'";
    $bookingStatus = "completed";
    $bookingDateTime = date('Y-m-d h:i:s', time());
    //$reserDate = date('Y-m-d', time());
    $data = $mysqli -> query($sql);
    foreach($temp1 as $key => $value){
        for ($i = 0; $result = $data -> fetch_assoc(); $i++){
            $reserDate = $result['reservationDate'];
            $customerID = $result['customerID'];
            $packageID = $result['packageID'];
            $quantity = $temp1[$i];
            $reviewStat = "empty";
            //echo ($packageID);
            //echo (" customerID=" .$customerID);
            //echo ("\n");
            //echo (" packageID=" .$packageID);
            //echo ("\n");
            //echo (" quantity=" .$quantity);
            //echo ("\n");
            //echo (" review=" .$reviewStat);
            //echo (":");
            $sql = $mysqli -> query("INSERT INTO `reservations`(`packageID`, `customerID`, `bookingStatus`, `reserDate`, `bookingDateTime`, `reserStatus`, `quantity`) VALUES ('$packageID','$customerID', '$bookingStatus', '$reserDate', '$bookingDateTime', '$reviewStat', '$quantity');");
            //echo ($mysqli -> error);
            $sql_1 = $mysqli -> query("SELECT re.reserID FROM reservations re INNER JOIN packages p ON p.packageID = re.packageID WHERE re.packageID = $packageID");
            $sqli1 = $sql_1 -> fetch_assoc();
            $sqli1 = $sqli1['reserID'];
            //echo ($sqli1);
        }
    }
    
    //for ($i = 0; $result = $data -> fetch_assoc(); $i++){
    //    $customerID=$result['customerID'];
    //    $packageID = $result['packageID'];
    //    $quantity = $result['quantity'];
    //    $quantity = $_POST['quantity'];
    //    $reviewStat = "empty";
    //    echo ($quantity);
    //    //$sql = $con -> query("INSERT INTO `reservations`(`packageID`, `customerID`, `bookingStatus`, `reserDate`, `bookingDateTime`, `reviewStat`, `quantity`) VALUES ('$packageID','$customerID', '$bookingStatus', '$reserDate', '$bookingDateTime', '$reviewStat', '$quantity');");
    //}
    $result1 = $mysqli -> query("INSERT INTO `payments`(`reserID`, `cCardBank`, `cCardName`, `trxnDateTime`, `trxnAmount`) VALUES ('$sqli1','$bank','$nameOnCard','$bookingDateTime','$sub')");
    $result = $mysqli -> query("DELETE FROM cart WHERE customerID=$customerID1");
    
    mysqli_close($mysqli); //close database connection
    header('Location: cart.php'); //redirect the page to view.php page
?>