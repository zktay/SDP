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
                <form id="registerForm" class="flex-fs" action="userRegister.php" method="POST">
                    <div>
                        <label for="#username">Email: </label><br>
                        <input type="email" name="accountID" placeholder="abc@mail.com" required>
                    </div>
                    <br>
                    <div>
                        <label for="#password">Password: </label><br>
                        <input type="password" name="password" required>
                    </div>
                    <br>
                    <div>
                        <label for="#contact">Contact Number: </label><br>
                        <input type="number" name="custContact" required>
                    </div>
                    <br>
                    <div>
                        <label for="#contact">Full Name: </label><br>
                        <input type="text" name="custName" required>
                    </div>
                    <br>
                    <div>
                        <label for="#dob">Date of Birth: </label><br>
                        <input type="date" name="custDOB" required>
                    </div>
                    <br>
                    <div>
                        <input type="submit" id="registerBtn" class="btnHover: name="registerBtn" value="SIGN UP">
                    </div>

                </form>
            </div>
        </main>
    </body>

        <?php
            require_once "mainFooter.php";
        ?>
</html>