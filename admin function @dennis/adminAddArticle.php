<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'customer') {
        header('location:index.php');
    }
?>

<?php 
    include('connect.php');
    $accountID = $_SESSION['accountID'];
    $adminID = $_SESSION['adminID'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel="stylesheet" href="style/adminManageNews.css?v=8">
        <link rel="tab icon" href="images/logo-placeholder.png">
    </head>

    <body>
    <?php 
        if ($_SESSION['role'] == 'support') {
            require_once 'custSupportHeader.php';
        } 
        else {
            require_once 'adminHeader.php'; 
        }
    ?> <!--change to admin header-->
        <main>
        <div class='flexWrapper'>
            <div class="ticketDashboard flex-c-c">
                Add Article
            </div>

            <form class ='' action ='adminAddArticleForm.php' enctype="multipart/form-data" method = 'post'>
                <div class = 'nameLabel'>
                    Article Title
                </div>

                <div class = 'nameInput'>
                    <input type='text' name='articleTitle' id = 'articleTitle' placeholder = 'Enter Article Title Here!'>
                </div>

                <div class = 'nameLabel'>
                    Description
                </div>

                <div class = 'nameInput'>
                    <textarea name='articleDesc' id = 'articleDesc' placeholder = 'Enter Article Description Here!'></textarea>
                </div>

                <div class = 'nameLabel'>
                    Article Paragraph 1
                </div>

                <div class = 'nameInput'>
                    <textarea name='articlePara1' id = 'articlePara1' placeholder = 'Enter First Paragraph Here!'></textarea>
                </div>

                <div class = 'nameLabel'>
                    Article Paragraph 2
                </div>

                <div class = 'nameInput'>
                    <textarea name='articlePara2' id = 'articlePara2' placeholder = 'Enter Second Paragraph Here!'></textarea>
                </div>

                <div id = 'nameButtons'>
                    <input type='submit' name='articleSubmit' id = 'articleSubmit' value ='Submit'>
                    <input type='reset' name='articleReset' id = 'articleReset' value ='Reset'>
                </div>
            </form>
        </div>
        </main>
        <?php require_once 'mainFooter.php';?>
    </body>
</html>