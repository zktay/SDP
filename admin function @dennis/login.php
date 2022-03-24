<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8"
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel="stylesheet" href="style/index.css">
        <link rel="tab icon" href="images/logo-placeholder.png">
    </head>

    <body>
        <?php
            require_once "mainHeader.php";
        ?>

        <main>
            <div id="login" class="login">
                <form id="loginForm" class="flex-fs" action="userLogin.php" method="POST">
                    <div>
                        <label for="#username">Username: </label><br>
                        <input type="email" name="accountID" placeholder="abc@mail.com" required>
                    </div>
                    <br>
                    <div>
                        <label for="#password">Password: </label><br>
                        <input type="password" name="password" required>
                    </div>
                    <br>
                    <div>
                        <input type="submit" id="submitLogin" class="btnHover" name="submitLogin" value="LOGIN">
                        &nbsp;&nbsp;
                        <a href="register.php">Register Here!</a>
                    </div>

                </form>
            </div>
        </main>
    </body>

        <?php
            require_once "mainFooter.php";
        ?>
</html>