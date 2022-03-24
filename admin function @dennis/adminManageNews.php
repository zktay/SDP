<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'customer') {
        header('location:index.php');
    }
?>

<?php 
    include('connect.php');
    require_once 'userController.php';
    $accountID = $_SESSION['accountID'];
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel="stylesheet" href="style/adminManageNews.css?v=3">
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
                Manage Travel News
            </div>

            <div class='search_add flex-sb-c'>
                <div class='searchBar flex-c-c'>
                    <form action = 'adminManageNews.php' method = 'post'>
                        <label style='margin-left:10px;'>Search: </label>
                        &nbsp;
                        <input class='searchInput' name='filterInput' type='text' placeholder='Enter detail to search..'>
                        &nbsp;
                        <button type = 'submit' class='filterBtn' id='searchBtn' name='searchBtn'>Go</button>
                    </form>
                </div>

                <button class = 'addButton' onclick='window.location.href="adminAddArticle.php"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Article&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </div>

            <?php 

            ?>

            <div class='mainBox'>
                <?php 
                    // $news = $travelnews->checkNews();
                    $travelnews = new travelNews();
                    $filter = '';

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['searchBtn'])) {
                        $filter = $_POST['filterInput'];
                        if ($filter != '') {
                            $news = $travelnews->searchNews($filter);
                        }
                        else {
                            $news = $travelnews->checkNews();
                        }
                    }
                    else {
                        $news = $travelnews->checkNews();

                    }
                    $validate = $news->num_rows;
                    if ($validate!=0) {
                       while ($newNews = $news->fetch_assoc()) {
                        
                            $title = $newNews['title'];
                            $desc = $newNews['newsDesc'];
                            $id = $newNews['newsID'];

                            echo "<a href='adminViewNews.php?id=$id'><div class = 'subBox flex-c-c flex-col'>";
                            echo "<div class= 'titleBox flex-c-c'>";
                            echo "<div class = 'placer'>";
                            echo "Title";
                            echo "</div>";
                            echo "<div class = 'output'>";
                            echo "&nbsp;$title";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='box flex-c-c'>";
                            echo "<div class = 'placer'>";
                            echo "Description";
                            echo "</div>";
                            echo "<div class='output'>";
                            echo "&nbsp;$desc";
                            echo "</div>";
                            echo "</div>";
                            echo "</div></a>";
                        } 
                    }
                    else {
                        
                        echo "<div class ='flex-c-c'>";
                        echo "</br>";
                        echo "</div>";

                        echo "<div class ='flex-c-c'>";
                        echo "There are no articles found!";
                        echo "</div>";
                        
                    }
            ?>
            </div>
        </main>

        <?php require_once 'mainFooter.php'?> <!--change to admin footer-->
    </body>