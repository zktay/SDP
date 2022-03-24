<!DOCTYPE html>
<?php
    include("connect.php");
    session_start();
    $cusID = $_SESSION['customerID'];
    $sql = "SELECT custName, custContact FROM customer";
    $sql = $mysqli -> query($sql);
    $result = $sql -> fetch_assoc();
?>
<html class="bgcolor font" >
<head><link rel="shortcut icon" type="emoji" href="../Title.png"/> 
    <link href="payment.css" rel="stylesheet" type="text/css" />
    <title>Payment</title>
</head>
    <body>
    <br>
    <br>
    <br>
    <div class="blur-box">
    <center>Do Not Refresh or Close this Tab</center>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class = "payment">
        <div class="payment-box">
            <form method = "POST" action = "cart_handler.php">
            <table cellpadding="0" cellspacing ="5" width = "400px">
                <tr>
                    <th colspan = "2" align = "left">Name:</th>
                </tr>
                <tr>
                    <td colspan = "2"><input class = "FTextbox" type = "text" value="<?php echo ($result['custName']); ?>" name = "name" disabled></td>
                </tr>
                <tr>
                    <th colspan = "2" align="left">Phone Number:</th>
                </tr>
                <tr>
                    <td colspan = "2"><input class = "FTextbox" type = "tel" name = "Phone" value ="<?php echo($result['custContact']); ?>" id = "phone" disabled></td>
                </tr>
                <tr>
                    <th align = "left">Name On Card:</th>
                    <th align = "left">Bank:</th>
                </tr>
                <tr>
                    <td colspan = ""><input class = "FTextbox" type = "text" name = "NameOnCard" required = "required" pattern="^((?:[A-Za-z]+ ?){1,3})$"></td>
                    <td align="center">
                        <select name = "bank" required = "required" value = "Bank:" id = "bank" class = "selectbox">
                            <option value ="Default">Please Select</option>
                            <option value="Maybank">Maybank</option>
                            <option value="Public">Public Bank</option>
                            <option value="HongLeong">Hong Leong Bank</option>
                            <option value="RHB">RHB Bank</option>
                            <option value="CIMB">CIMB</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <th colspan = "2" align="left">Card Information:</th>
                </tr>
                <tr>
                    <td colspan = "2"><input class = "FTextbox" type = "tel" name = "cardinfo" required = "required" placeholder="Card Number:" pattern="[0-9]{14,16}"></td>
                </tr>
                <tr>
                    <td><input class = "FTextbox" type = "date" name = "CardExpire" required = "required" placeholder="Expire Date:"></td>
                    <td><input class = "FTextbox" type = "text" name = "CVC" required = "required" placeholder="CVC:" pattern="[0-9]{3}"></td>
                </tr>
                <tr>
                    <th align = "left">Email:</th>
                </tr>
                <tr>
                    <td colspan="2"><input class = "FTextbox" type = "text" name = "email" id = "email" required = "required" placeholder = "Email:"></td>
                </tr>
            </table>
            
        </div>      
    </div>
    <br>
    <?php
        $id = $_GET['id'];
    echo('
    <div class = "BTNmid">
        <input hidden name ="id" value="'.$id.'">
        <input style = "width :90px; margin-right: 5px;" type = "button" value = "Back" onclick="history.back();">
        <a href="cart_handler.php"><input style = "width :90px; margin-left: 5px;" type = "submit" value = "Pay Now"></a>
    </div>
    </form> 
    ');?>
    <script src="payment.js">
    </script>
</body>
</html>