<?php
    include ('connect.php');
    include ('session.php');
    $cusID = $_SESSION['customerID'];
    $rate = $_POST['rate'];
    $pID = $_POST['pID'];
    echo ($pID);
    $rID = $_POST['rID'];
    echo ($rID);
    $feedback = $_POST['feedback'];
    $feedbacktime = date('Y-m-d h:i:s', time());
    $sql = "INSERT INTO reviews(reserID, review, reviewDateTime, rate) VALUES ('$rID','$feedback','$feedbacktime','$rate')";
    $sql1 = "UPDATE reservations SET reserStatus = 'done' WHERE `packageID` = '$pID' AND `customerID` = '$cusID'";
    if(!mysqli_query($mysqli, $sql)){
        echo '<script>';
        echo 'alert ("Unknown Error!");';
        echo 'window.location.href = "customer_feedback.php";';
        echo '</script>';
    }
    else{
        $run1 = $mysqli -> query($sql1);
        echo ("<script> alert('Review Added!');");
        echo (" window.location.href = 'customer_feedback.php';");
        echo ("</script>");
    }
?>