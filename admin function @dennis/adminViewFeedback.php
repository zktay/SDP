<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'customer') {
        header('location:index.php');
    }

    $reviewID = intval($_GET['id']);

    require_once 'userController.php';
    $feedback = new feedback();

    $newReview = $feedback->reviewDetail($reviewID);
    $newReviewDetail = $newReview->fetch_assoc();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel="stylesheet" href="style/adminViewFeedback.css?v=3">
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

                <div class='articleButton '>
                    <form action='' class='articleForm' method='post'>
                        <input type='submit' class='addButton' name='backOnePage' id='backOnePage' value = 'Back'>
                        <input type='submit' class='addButton' name='changeStatus' id='changeStatus' value = 'Change Status'>
                    </form>
                </div>

                <div class ='mainBox'>

                    <?php 

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['backOnePage'])) {
                            header("location:adminManageFeedback.php");
                        }
                        else if (isset($_POST['changeStatus'])) {
                            $updateReview = $feedback->updateReviewStatus($reviewID);
                        }

                        $writtenReview = $newReviewDetail['review'];
                        $rating = $newReviewDetail['rate'];
                        $ratingDT = $newReviewDetail['reviewDateTime'];
                        $bookingStatus = $newReviewDetail['bookingStatus'];
                        $reserDate = $newReviewDetail['reserDate'];
                        $packageName = $newReviewDetail['pName'];
                        $customerName = $newReviewDetail['custName'];
                        $reviewStatus = $newReviewDetail['status'];
                        
                        echo "<div class = 'subBox flex-c-c flex-sa-c'>";
                        echo "<div class='flex-col'>";
                        echo "<div class = 'box flex-c-c'>";
                        echo "<div class= 'placer'>";
                        echo "Package Name";
                        echo "</div>";
                        echo "<div class = 'output'>";
                        echo "$packageName";
                        echo "</div>";
                        echo "</div>";

                        echo "<br>";

                        echo "<div class = 'box flex-c-c'>";
                        echo "<div class= 'placer'>";
                        echo "Customer Name";
                        echo "</div>";
                        echo "<div class = 'output'>";
                        echo "$customerName";
                        echo "</div>";
                        echo "</div>";

                        echo "<br>";

                        echo "<div class = 'box flex-c-c'>";
                        echo "<div class= 'placer'>";
                        echo "Reservation Date";
                        echo "</div>";
                        echo "<div class = 'output'>";
                        echo "$reserDate";
                        echo "</div>";
                        echo "</div>";

                        

                        echo "</div>";

                        echo "<div>";

                        echo "<div class = 'box flex-c-c'>";
                        echo "<div class= 'placer'>";
                        echo "Status";
                        echo "</div>";
                        echo "<div class = 'output'>";
                        echo "$reviewStatus";
                        echo "</div>";
                        echo "</div>";

                        echo "<br>";

                        echo "<div class = 'box flex-c-c'>";
                        echo "<div class= 'placer'>";
                        echo "Review";
                        echo "</div>";
                        echo "<div class = 'output'>";
                        echo "$writtenReview";
                        echo "</div>";
                        echo "</div>";

                        echo "<br>";

                        echo "<div class = 'box flex-c-c'>";
                        echo "<div class= 'placer'>";
                        echo "Rating";
                        echo "</div>";
                        echo "<div class = 'output'>";
                        echo "$rating/5";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "</div>";
                    ?> 
                                  
            </div>

        </main>
        <?php require_once 'mainFooter.php';?>
    </body>
</html>