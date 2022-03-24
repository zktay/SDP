<!DOCTYPE html>
<?php
    require("connect.php");
    include("header.php");
    //include("session.php");
    $cusID = $_SESSION['customerID'];
    $sql = "SELECT p.pDuration, p.packageID, r.customerID, p.pName, r.reserDate, py.trxnDateTime, py.trxnAmount FROM packages p INNER JOIN reservations r ON p.packageID = r.packageID INNER JOIN payments py ON r.reserID = py.reserID WHERE r.customerID = '$cusID'";
    $data = $mysqli -> query($sql);
?>
<html lang="en">
    <head>
        <script src="https://kit.fontawesome.com/4a8b676a62.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="history_payment.css">
    </head>
    <body>
        <div class="main_container">
            <div class="top_container">
                <h1>History Payment</h1>
            </div>
            <div class="btm_container">
                <div class="history_payment_content">
                    <div class="table_content">
                        <table id="historypayment">
                        <tr>
                            <th colspan="4">Package Name<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableHistory(0)"></i></th>
                            <th colspan="1">Package Duration<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableHistory(1)"></i></th>
                            <th colspan="1">Amount<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableHistory(2)"></i></th>
                            <th colspan="1">Payment Date<i class='fas fa-sort' style="margin-left:10px;" onclick="sortTableHistory(3)"></i></th>
                            <th colspan="1">View Invoice</th>
                        </tr>
                        <?php
                        for ($i = 0; $result = $data -> fetch_assoc(); $i++){
                            echo('
                            <tr>
                                <td colspan="4">'. $result['pName']. '</td>
                                <td colspan="1">'. $result['pDuration'].' days</td>
                                <td colspan="1"> RM '. $result['trxnAmount'].'</td>
                                <td colspan="1">'. $result['trxnDateTime'].'</td>
                                <td colspan="1"><a href="invoice.php?packID='.$result['packageID'].'" target="_blank"><button class ="button_invoice"><span>View Invoice</span></button></a></td>
                            </tr>');
                        }
                        ?>
                        </table>
                    </div>
                </div>    
            </div>
            <script src="sort.js"></script>
        </div>
        ?>
    </body>
</html>

