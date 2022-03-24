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
    $newsID = intval($_GET['id']);

    $travelnews = new travelNews();
    $news = $travelnews -> specificNews($newsID);
    $newNews = $news ->fetch_assoc();
    $photo = $travelnews->getPhoto($newsID);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel="stylesheet" href="style/adminManageNews.css?v=9">
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
        ?>
        <main>
            <div class='flexWrapper'>
                <div class="ticketDashboard flex-c-c">
                    <?php 
                        $title = $newNews['title'];
                        $status = $newNews['status'];
                        echo $title;
                        echo " ";
                        echo "(", $status, ")";
                    ?>
                </div>

                <div class='articleButton '>
                    <form action='adminEditNews.php' class='articleForm' method='post'>
                        <input type='hidden' class='addButton' name='newsID' value=<?php echo "$newsID"?>>
                        <input type='submit' class='addButton' name='backOnePage' id='backOnePage' value = 'Back'>
                        <input type='submit' class='addButton' name='changeStatus' id='changeStatus' value = 'Change Status'>
                        <input type='submit' class='addButton' name='editNews' id='editNews' value = 'Edit Article'>
                        <input type='submit' class='addButton' name='deleteNews' id='deleteNews' value = 'Delete Article'>
                    </form>
                </div>

                <div class = 'photoInput'>
                        <div class ='slideshowContainer flex-c-c'>
                            
                                <?php 
                                    $validate = $photo ->num_rows;
                                    if ($validate!=0) {
                                        
                                        while ($photoResult = $photo->fetch_assoc()) {
                                            $photoID = $photoResult['newsPhotoID'];
                                            $photoSlide = 'data:image/jpg;base64,'.base64_encode($photoResult['photo']);
                                            echo '<div class = "mySlides fade"> <img src = "'.$photoSlide.'"></div>';
                                        }
                                        
                                    }
                                    else {
                                        echo "There are no photos yet.</br></br>";
                                    }

                                    echo   '<a class="prev" onclick="nextImage(-1)">&#10094;</a>
                                            <a class="next" onclick="nextImage(1)">&#10095;</a>
                                            </div>
                                            <br>';
                                ?>
                        </div>
                        <div style="text-align:center">
                            <?php 
                            for ($i = 1; $i<=$validate; $i++) {
                                echo '<span class="dot" onclick="currentSlide($i)"></span>';
                            }
                            ?>
                        </div>
    
                <div class='newsBox '>
                    <?php 
                        $para1 = $newNews['paragraph1'];
                        $para2 = $newNews['paragraph2'];

                        if ($para1 && $para2 != null) {
                            echo "<div class='indent'>";
                            echo "<p>$para1</p>";
                            echo "</div>";
                            echo "</br></br>";
                            echo "<div class='indent'>";
                            echo "<p>$para2</p>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
           
        </main>
        <?php require_once 'mainFooter.php'?>;
        <script src="script/adminEditNews.js"></script>
    </body>
