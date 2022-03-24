<?php
    session_start();
    $bank = $_POST['bank'];
    $nameOnCard = $_POST['NameOnCard'];
    include("connect.php");
    //$_SESSION["qty"] = array();
    $temp1 = $_SESSION['qty'];
    $sub = $_SESSION['sub'][0];
    $cusID = $_POST['id'];
    $sql = "SELECT * FROM cart where customerID='$cusID'";
    $bookingStatus = "completed";
    $bookingDateTime = date('Y-m-d h:i:s', time());
    $reserDate = date('Y-m-d', time());
    $data = $con -> query($sql);
    foreach($temp1 as $key => $value){
        echo gettype($temp1);
        for ($i = 0; $result = $data -> fetch_assoc(); $i++){
            echo gettype($result);
        //    $customerID = $result['customerID'];
        //    $packageID = $result['packageID'];
        //    $quantity = $value;
        //    $reviewStat = "empty";
        //    echo ("customerID" .$customerID);
        //    echo ("packageID" .$packageID);
        //    echo ("quantity" .$quantity);
        //    echo ("review" .$reviewStat);
        //    //$sql = $con -> query("INSERT INTO `reservations`(`packageID`, `customerID`, `bookingStatus`, `reserDate`, `bookingDateTime`, `reviewStat`, `quantity`) VALUES ('$packageID','$customerID', '$bookingStatus', '$reserDate', '$bookingDateTime', '$reviewStat', '$quantity');");
        //    //$sql_1 = $con -> query("SELECT re.reserID FROM reservations re INNER JOIN packages p ON p.packageID = re.packageID WHERE re.packageID = $packageID");
        //    //$sqli1 = $sql_1 -> fetch_assoc();
        //    //$result1 = $con -> query("INSERT INTO `payments`(`reserID`, `cCardBank`, `cCardName`, `trxnDateTime`, `trxnAmount`) VALUES ('$sqli1','$bank','$nameOnCard','$bookingDateTime','$sub')");
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
    //$result = $con -> query("DELETE FROM cart WHERE customerID=$customerID");
    //
    //mysqli_close($con); //close database connection
    //header('Location: cart.php'); //redirect the page to view.php page
?>