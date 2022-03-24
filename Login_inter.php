<?php
/*
session_start(); //save username
if (isset($_SESSION["mySession"])) {
    header("location: ../../index.php");
}
*/
?>

<!DOCTYPE html>
<html>

<head>
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src='../script/login.js'></script>
</head>

<body>
    <header class="header">
        <a href="../../index.php" class="logo" href='#'>
            <i class="fas fa-plane"></i>
            Hotel Trivago </a>

        <nav class="navbar">

            <a href="Main Features/BestSeller/bestseller.php">Best Seller</a>
            <a href="Main Features/AllPackage/allpackage.php">All Package</a>
            <a href="Main Features/Contact_us/index.php">Contact Us</a>
            <a href="Main Features/AboutUs/aboutus.php">About Us</a>
        </nav>
    </header>

    <div id='forgetPassword' class='modal'>
        <div class='modalContent'>
            <a id='close' name='email' onclick='verification("close")'>&times</a>
            <p id='modalHeader'>Forget Password </p>
            <p>To reset your password, please provide your account email.</p>
            <div id='row'>
                <div id='column-1'>
                    <div id='modalLabel'>
                        Email
                        <div id='asterisk'>*</div>
                    </div>
                </div>
                <div id='column-2'>
                    <div class='modalInput'>
                        <input type='email' id='email' onfocusout='emailVerify()'>
                        <br />
                    </div>
                    <button id='modalSubmit' onclick="verification('submit')">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="loginbox">
        <img src="../img/person.png" class="hale">
        <h1>Login</h1>

        <form action='userlogin.php' method="post" id='login'>
            <p>Username</p>
            <input type="text" name="accountID" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <br>
            <input type="submit" name="submit" value="Login">
            <br>
            <a onclick="verification('open')" style='cursor: pointer;'>Forgot your password?</a><br>
            <a href="../Sign-up/Create_an_account.php">Create a new account</a>

            <?php
            /*
            if (isset($_SESSION["error"])) {
                $error = $_SESSION["error"];
                echo $error;
                unset($_SESSION["error"]);
            }
            */
            ?>
        </form>
    </div>
</body>

</html>