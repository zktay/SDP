<!DOCTYPE html>
<?php
    require("connect.php");
    $cusID = 1;
    $sql = "SELECT c.cartID, c.customerID, pkp.photo, c.quantity, pPrice, pDesc, p.pName, p.pDuration, p.packageID FROM packages p INNER JOIN packagephoto pkp ON p.packageID = pkp.packageID INNER JOIN cart c ON c.packageID = p.packageID WHERE c.customerID = '$cusID'";
    $data = $con -> query($sql);
    $data1 = $con -> query($sql);
    $subtotal = 0;
    $temp = $data1 -> fetch_assoc();
    $temp1 = 0;
?>

<html>
    <head>
        <link rel="stylesheet" href="cart.css">
    </head>
    <body>
        <?php
        if(isset($_SESSION['mySession'])){
            echo('<div class="main_container">');
            for ($i = 0; $result = $data -> fetch_assoc(); $i++){
                $pic = base64_encode($result['photo']);;
                $subtotal[$i] = $result['quantity'][$i] * $result['pPrice'][$i];
                echo ('
                <div class="main_container">
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
                                <input type="number" name = "quantity" class="duration" min = "1" value="'. $result['quantity'].'" id = "quantity" onclick = "quantity_var()">
                            </div>
                        </div>  
                        <div class="cart_total">
                            <div class="price_quantity">
                                <p class = "price" id="id">RM '. $result['pPrice'].'</p>
                                <p class ="quantity" id="quantity">
                                    <span style="font-size:14px;">x</span>
                                    <span>'. $result['quantity'].'</span>
                                </p>
                            </div>
                            <a href="removeCart.php?id='.$result["cartID"].'"><button class="remove" onClick="return confirm(\'Confirm Remove?\')" >Remove</button></a>
                        </div>
                    </div>
                </div>
                ');
                $subtotal = $subtotal + $subtotal;
            }
        echo ('</div');
        }else{
            echo('<div class="main_container">');
            for ($i = 0; $result = $data -> fetch_assoc(); $i++){
                $pic = base64_encode($result['photo']);;
                $subtotal = $result['quantity'] * $result['pPrice'] + $subtotal;
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
                                <input type="number" name = "quantity" class="duration" min = "1" value="'. $result['quantity'].'" id = "quantity" onclick = "quantity_var()">
                            </div>
                        </div>
                        <div class="cart_total">
                            <div class="price_quantity">
                                <p class = "price" id="id">RM '. $result['pPrice'].'</p>
                                <p class ="quantity" id="quantity">
                                    <span style="font-size:14px;">x</span>
                                    <span>'. $result['quantity'].'</span>
                                </p>
                            </div>
                            <a href="removeCart.php?id='.$result["cartID"].'"><button class="remove" onClick="return confirm(\'Confirm Remove?\')" >Remove</button></a>
                        </div>
                    </div>
                <form method="POST" action="cart_handler.php">
                ');
                $subtotal = $subtotal + $temp1;
            }
        echo ('</div>');
        }
        echo('
                <div class="sum_box_container">
                    <div class="sum_box_sub">
                        <h1>Subtotal</h1>
                        <p class="subtotal">RM '.$subtotal.'</p>
                    </div>
                    <br>
                    <br>
                    <br>
                    <p><h2>All payment is calculated taxes and service tax.</h2></p>
                    <br>
                    <br>
                    <br>');          
                    // ifset
                    echo('
                    <a href="payment.php?id='.$temp['customerID'].'"><button class="button" style="margin-top:0px;"><span>Checkout</span></button></a>
                    <div class="sum_box_pic">
                        <img src="pngkit_visa-mastercard-logo-png_9100446.png" width="449px" height="120px">
                    </div>
                </div>
            </div>
        ');?>
    </body>
</html>