<?php include("session.php");?>
<header class="header">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" />
<link rel="stylesheet" href="header.css">
            <a href="index.php" class="logo" href='#'>
                <i class="fas fa-plane"></i>
                Hotel Trivago </a>
    
            <nav class="navbar">
    
                <a href="Main Features/Package/bestseller.php">Best Seller</a>
                <a href="Main Features/Package/bestvalue.php">Best Value</a>
                <a href="Main Features/Package/allpackage.php">All Package</a>
                <a href="Main Features/Package/LimitedTime.php">Limited Time</a>
            </nav>
    
            <div id='loginBox'>
                <div class='cart'>
                    <a href='cart.php'>
                        <div class="fas fa-shopping-cart" id="cart-btn">
                            <input type='text' id='cartItemQuantity' value='<?php /*echo $cartQuantity*/ ?>' onclick="location.href='#'" readonly>
                        </div>
                    </a>
                </div>
                <?php
                if(isset($_SESSION['customerID'])){
                    echo (
                    "<i class='fas fa-user fa-2x' ><ul class='user-dropdown'>
                    <li><i class='fas fa-cog'></i><a href='customer_modify.php'><b><span class='title'> ACCOUNT</span></b></a></li>
                    <li><i class='fas fa-cog'></i><a href='history_payment.php'><b><span class='title'> HISTORY PAYMENT</span></b></a></li>
                    <li><i class='fas fa-cog'></i><a href='customer_feedback.php'><b><span class='title'> ADD REVIEW</span></b></a></li>
                    <li><i class='fas fa-power-off'></i><a href='logout.php'><b><span class='title'> LOGOUT</span></b></a></li>
                </ul></i>");
                    
                    } 
                else{
                    echo ("
                    <button onclick=\"window.location='Login_inter.php';\" class='btn-1' ><b>LOGIN</b></button>
                    ");
                    }
                ?>
            </div>
        </header>