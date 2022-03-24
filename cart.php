<!DOCTYPE html>
<?php
    //session_start();
    //include("session.php");
    include("header.php");
    require("connect.php");
    if(isset($_SESSION['customerID'])){
        $cusID = $_SESSION['customerID'];
        $sql = "SELECT c.cartID, c.customerID, pkp.photo, pPrice, pDesc, p.pName, p.pDuration, p.packageID FROM packages p INNER JOIN packagephoto pkp ON p.packageID = pkp.packageID INNER JOIN cart c ON c.packageID = p.packageID WHERE c.customerID = '$cusID'";
        $data = $mysqli -> query($sql);
        $sql1 = "SELECT c.cartID, p.packageID FROM packages p INNER JOIN cart c ON c.packageID = p.packageID WHERE c.customerID = '$cusID'";
        $count = "SELECT count(*) FROM packages p INNER JOIN packagephoto pkp ON p.packageID = pkp.packageID INNER JOIN cart c ON c.packageID = p.packageID WHERE c.customerID = '$cusID'";
        $count = $mysqli -> query($count);
        $count = $count -> fetch_assoc();
        $count = $count['count(*)'];
        $data1 = $mysqli -> query($sql);
        $temp = $data1 -> fetch_assoc();
        $subtotal = 0;
        $quantity = 1;
        $temp1 = 0;
    }
    
?>

<html>
    <head>
        <link rel="stylesheet" href="cart.css">
        <script src="https://kit.fontawesome.com/4a8b676a62.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            echo('<div class="main_container">');
            if(isset($_SESSION['customerID'])){
                if( $count == 0) {
                        echo('
                        <div class="empty_cart">
                            <p>Empty Cart!</p>
                        </div>
                        ');
                }else{
                    for ($i = 0; $result = $data -> fetch_assoc(); $i++){
                            $pic = base64_encode($result['photo']);
                            $subtotal = $quantity * $result['pPrice'] + $subtotal;
                            echo ('
                                <div class="cart_content">
                                    <div class="cart_pic_container">
                                        <div class="cart_pic">
                                            <img src="data:images/jpeg;base64,'. $pic .'" alt="" id="cart_pic">
                                        </div>
                                    </div>
                                    <div class="cart_info_container">
                                        <div class="cart_name">
                                            <h1>'. $result['pName'].'</h1>
                                        </div>
                                        <div class="cart_info">
                                            <h2>'. $result['pDesc'].'</h2>
                                        </div>
                                        <div class="cart_duration_container">
                                            <h2>Quantity:</h2>
                                            <button class="minus" onclick="decrease('.$result["cartID"].'), subtotal('.$result["cartID"].', \'minus\'), data_flow()"><i class="fa-solid fa-circle-minus"></i></button>
                                            <input disabled name = "quantity" class="duration"  min="1" value="'. $quantity.'" id = "quantity['.$result['cartID'].']" onclick = "">
                                            <button class="increase" onclick="increase('.$result["cartID"].'), subtotal('.$result["cartID"].', \'add\'), data_flow()"><i class="fa-solid fa-circle-plus"></i></button>
                                        </div>
                                    </div>  
                                    <div class="cart_total">
                                        <div class="price_quantity">
                                            <input class = "price" id="price['.$result['cartID'].']" value ="RM '. $result['pPrice'].'">
                                            <p class ="quantity_box">
                                                <span style="font-size:14px;">x</span>
                                                <input disabled id="quantity1['.$result['cartID'].']" value="'.$quantity.'" style="width:24px; font-size:24px; background-color:white;">
                                            </p>
                                        </div>
                                        <a href="removeCart.php?id='.$result["cartID"].'"><button class="remove" onClick="return confirm(\'Confirm Remove?\')" >Remove</button></a>
                                    </div>
                                </div>
                            ');
                            $subtotal = $subtotal + $temp1;
                        }  
                }
            }else{
                echo('
                    <div class="empty_cart">
                        <p>Please Login!</p>
                    </div>
                ');
            }
        echo ('</div>');
        echo('
                <div class="sum_box_container">
                    <div class="sum_box_sub">
                        <h1>Subtotal</h1>');
                        if(isset($_SESSION['customerID'])){
                            echo ('<input class ="subtotal" id="subtotal" value="RM '.$subtotal.'">');
                        }else{
                            echo ('<input class ="subtotal" id="subtotal" value="RM 0">');
                        }
                    echo('
                    </div>
                    <br>
                    <br>
                    <br>
                    <p><h2>All payment is calculated taxes and service tax.</h2></p>
                    <br>
                    <br>
                    <br>');          
                    if(isset($_SESSION['customerID'])){
                        echo('
                    <a href="payment.php?id='.$cusID.'"><button class="button" style="margin-top:0px;"><span>Checkout</span></button></a>
                    <div class="sum_box_pic">
                        <img src="pngkit_visa-mastercard-logo-png_9100446.png" width="449px" height="120px">
                    </div>');
                    }else{
                        echo('
                    <a href = "signup.php"> <button class="button" style="margin-top:0px;" onlick="signup();"><span>Checkout</span></button></a>
                    <div class="sum_box_pic">
                        <img src="pngkit_visa-mastercard-logo-png_9100446.png" width="449px" height="120px">
                    </div>');
                    }
            echo('        
                </div>
            </div>
            
        ');?>
    </body>
    <script src="cart.js">
    </script>
</html>