<!DOCTYPE html>
<?php
    include("header.php");
    $id = $_GET['id'];
    require("connect.php");
    $sql = "SELECT re.rate, r.CustomerID, p.pName, r.reserDate, py.trxnDateTime, py.trxnAmount, pk.photo, re.review, re.reviewDateTime FROM packages p INNER JOIN reservations r ON p.packageID = r.packageID INNER JOIN payments py ON r.reserID = py.reserID INNER JOIN packagephoto pk ON p.packageID= pk.packageID INNER JOIN reviews re on re.reserID = r.reserID WHERE p.packageID = '$id'";
    $p_data = $mysqli -> query($sql);
    $result = $p_data -> fetch_assoc();
    $cusPic = base64_encode($result['photo']);
    
    
?>
<html lang="en">
    <head>
        <script src="https://kit.fontawesome.com/4a8b676a62.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="review_feedback.css">
    </head>
    <body>
        <?php
        echo ('
        <div class="main_container">
            <div class="top_container">
                <h1>Feedback</h1>
            </div>
            <div class="btm_container">
                <div class="pic_container">
                    <div class="pic">
                        <img src="data:images/jpeg;base64,'. $cusPic .'" alt="">
                    </div>     
                </div>
                <div class="info_grid">
                    <div class="info_grid_item_1">
                        <h1>'. $result['pName'].'</h1>
                    </div>
                    <div class="info_grid_item_2">
                        <h1>'.$result['reserDate'].'</h1>
                    </div>
                    <div class="info_grid_item_3">
                        <textarea disabled placeholder="'.$result['review'].'" class="feedbackbox" maxlength="1000" id="word-count-input"></textarea>
                        </div>
                        <div class="info_grid_item_4">
                        <h1>');
                        if ($result['rate'] == 1){
                            echo ('
                                <div class="rate">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>');
                        } else if($result['rate'] == 2){
                            echo ('
                                <div class="rate">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>');
                        }else if($result['rate'] == 3){
                            echo ('
                                <div class="rate">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>');
                        }else if($result['rate'] == 4){
                            echo ('
                                <div class="rate">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                </div>');
                        }else if($result['rate'] == 5){
                            echo ('
                                <div class="rate">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>');
                        }
                        echo ('
                      </h1>
                    </div>
                </div>
            </div>
            <div class="nav_btm">
                <button class="button" style = "width :180px; margin-right: 5px; " onclick="window.location.href=\'customer_feedback.php\'">Back</button>
            </div>
        </div>
        
        ')?>
        <script src="wordlimit.js">
        </script>
    </body>
</html>