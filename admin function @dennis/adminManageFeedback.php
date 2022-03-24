<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'customer' ) {
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel="stylesheet" href="style/adminManageFeedback.css?v=1">
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
                    Manage User Feedback
                </div>

                <div class='searchBar flex-c-c'>
                    <form action = '' method = 'post'>
                        <label style='margin-left:10px;'>Search: </label>
                        &nbsp;
                        <input class='searchInput' name='filterInput' type='text' placeholder='Enter detail to search..'>
                        &nbsp;
                        <button type = 'submit' class='filterBtn' id='searchBtn' name='searchBtn'>Go</button>
                    </form>
                </div>

                <div class='mainBox'>
                <?php 
                    require_once 'userController.php';
                    $feedback = new feedback();
                    $filter = '';

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['searchBtn'])) {
                        $filter = $_POST['filterInput'];

                        if ($filter != '') {
                            $review = $feedback->searchReview($filter);
                        }
                        else {
                            $review = $feedback->getReview();
                        }
                    }
                    else {
                        $review = $feedback->getReview();
                    }

                    
                    

                    $validate = $review->num_rows;
                    if ($validate != 0) {
                        while ($fetchNews = $review->fetch_assoc()) {
                            $id = $fetchNews['reviewID'];
                            $writtenReview = $fetchNews['review'];
                            $rating = $fetchNews['rate'];
                            $ratingDT = $fetchNews['reviewDateTime'];
                            $bookingStatus = $fetchNews['bookingStatus'];
                            $reserDate = $fetchNews['reserDate'];
                            $packageName = $fetchNews['pName'];
                            $customerName = $fetchNews['custName'];

                            echo "<a href='adminViewFeedback.php?id=$id'><div class = 'subBox flex-c-c flex-col'>";
                            echo "<div class= 'box flex-c-c'>";
                            echo "<div class = 'placer'>";
                            echo "Package Name";
                            echo "</div>";
                            echo "<div class = 'output'>";
                            echo "&nbsp;$packageName";
                            echo "</div>";
                            echo "</div>";

                            echo "<div class='box flex-c-c'>";
                            echo "<div class = 'placer'>";
                            echo "Customer Name";
                            echo "</div>";
                            echo "<div class='output'>";
                            echo "&nbsp;$customerName";
                            echo "</div>";
                            echo "</div>";

                            echo "<div class='box flex-c-c'>";
                            echo "<div class = 'placer'>";
                            echo "Reservation Date";
                            echo "</div>";
                            echo "<div class='output'>";
                            echo "&nbsp;$reserDate";
                            echo "</div>";
                            echo "</div>";

                            echo "</div></a>";
                        }
                    }
                    else {
                        echo "<div class='flex-c-c'>There are no reviews just yet!</div>";
                    }
                    
                ?>
                    

                </div>
            </div>
        </main>
        <?php require_once 'mainFooter.php';?>
    </body>
</html>