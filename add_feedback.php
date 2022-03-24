<!DOCTYPE html>
<?php
    include("header.php");
    $id = $_POST['packageID'];
    require("connect.php");
    $sql = "SELECT r.CustomerID, p.pName, r.reserID, r.reserDate, py.trxnDateTime, py.trxnAmount, pk.photo FROM packages p INNER JOIN reservations r ON p.packageID = r.packageID INNER JOIN payments py ON r.reserID = py.reserID INNER JOIN packagephoto pk ON p.packageID= pk.packageID WHERE p.packageID = '$id'";
    $p_data = $mysqli -> query($sql);
    $result = $p_data -> fetch_assoc();
    $cusPic = base64_encode($result['photo']);
?>
<html lang="en">
    <head>
        <script src="https://kit.fontawesome.com/4a8b676a62.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="add_feedback.css">
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
                    <form method="POST" action="rating.php">
                        <input hidden name ="pID" value ="'.$id.'">
                        <input hidden name="rID" value="'.$result['reserID'].'">
                        <textarea placeholder="FeedBack" class="feedbackbox" maxlength="1000" id="word-count-input" name="feedback"></textarea>
                        <div class="wordlimit" id="the-count_comment">
                                <span id="character-count">0</span>
                                <span> /1000</span>
                        </div>
                        </div>
                        <div class="info_grid_item_4">
                        <h1>
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5"/>
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4"/>
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3"/>
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2"/>
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1"/>
                                <label for="star1" title="text">1 star</label>
                              </div>
                      </h1>
                    </div>
                </div>
            </div>
            <div class="nav_btm">
                <input class="button" style = "width :90px; margin-right: 5px;" onclick="window.location.href=\'customer_feedback.php\'" value="Back">
                <input class="button" style = "width :90px; margin-left: 5px;" type="submit" value="Submit">
            </div>
            </form>
        </div>
        
        ')?>
        <script src="wordlimit.js">
        
        </script>
    </body>
</html>