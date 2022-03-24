<!DOCTYPE html>
<?php
    require("connect.php");
    //require("session.php");
    include("header.php");
    //if(isset($_SESSION['customerID'])){
    //    $cusID = $_SESSION['customerID'];
    //    $sql_cus = "SELECT customerID FROM customer WHERE accountID = $cusID";
    //    $get_cusID = $con -> query($sql_cus);
    //}
    $get_cusID = $_SESSION['customerID'];
    $sql = "SELECT p.pDuration, r.reserStatus, p.packageID, r.customerID, p.pName, r.reserDate, py.trxnDateTime, py.trxnAmount FROM reservations r  INNER JOIN packages p ON r.packageID = p.packageID INNER JOIN payments py ON r.reserID = py.reserID WHERE r.customerID = '$get_cusID'";
    $data = $mysqli -> query($sql);

?>




<html lang="en">
    <head>
        <script src="https://kit.fontawesome.com/4a8b676a62.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="customer_feedback.css">
    </head>
    <body>
        <div class="main_container">
            <div class="top_container">
                <h1>Feedback</h1>
            </div>
            <div class="btm_container">
                <div class="table_content">
                <table id="Feedbacklist">
                    <tr>
                        <th colspan="4">Package Name<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableFeedback(0)"></i></th>
                        <th colspan="1">Reservation Duration<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableFeedback(1)"></i></th>
                        <th colspan="1">Amount<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableFeedback(2)"></i></th>
                        <th colspan="1">Payment Date<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableFeedback(3)"></i></th>
                        <th colspan="1">Status<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableFeedback(4)"></i></th>
                    </tr>
                    <?php 

                    for ($i = 0; $result = $data -> fetch_assoc(); $i++){
                        echo ('
                            <tr>
                                <td colspan="4">'. $result['pName']. '</td>
                                <td colspan="1">'. $result['pDuration'].' days</td>
                                <td colspan="1">RM '. $result['trxnAmount'].'</td>
                                <td colspan="1">'. $result['trxnDateTime'].'</td>
                                <form method="post" action ="add_feedback.php">
                                    <input name="packageID" type="hidden" value ="'.$result['packageID'].'">
                                
                        ');
                        if ($result['reserStatus'] == "empty"){
                            echo('<td colspan="1"><button id ="packID" type="submit" class ="button_empty" onclick=""><span>Add Review</span></button></a></td>
                        </tr>');
                        }else if($result['reserStatus'] == "done"){
                            echo('<td colspan="1"><button id ="packID" class ="button_done" type="button" onclick="window.location.href=\'review_feedback.php?id='.$result['packageID'].'\'"=><span>Done</span></button></a></td>
                        </tr>');
                        }
                        echo('</form>');
                        
                        
                    }
                    ?>
                </table>
            </div> 
            </div>
        </div>
        <script src="sort.js"></script>
    </body>
</html>