<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'customer') {
        header('location:index.php');
    }

    require_once 'userController.php';
    

    $newsID = intval($_POST['newsID']);

    $accountID = $_SESSION['accountID'];
    $editNews = new travelNews();
    $newsQuery = $editNews->specificNews($newsID);
    $newsResult = $newsQuery->fetch_assoc();
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['changeStatus'])) {
        
        $status = $newsResult['status'];
        $toChangeStatus = $editNews->changeNewsStatus($newsID, $status); 
    }
    
    else if (isset($_POST['deleteNews'])) {
        $status = '';
        $toChangeStatus = $editNews->changeNewsStatus($newsID, $status);
    }

    else if (isset($_POST['backOnePage'])) {
        header("location: adminManageNews.php");
    }
    
    else if (isset($_POST['editNews'])) {
        $title = $newsResult['title'];
        $desc = $newsResult['newsDesc'];
        $para1 = $newsResult['paragraph1'];
        $para2 = $newsResult['paragraph2'];
        
        $photo = $editNews->getPhoto($newsID);
        
        }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['articleSubmit'])) {
        require_once 'connect.php';
        $id = $_POST['newsID'];
        $newTitle = $_POST['articleTitle'];
        $newDesc = $_POST['articleDesc'];
        $newPara1 = $_POST['articlePara1'];
        $newPara2 = $_POST['articlePara2'];
        $updateNews = $editNews->updateNews($id, $newTitle, $newDesc, $newPara1, $newPara2);

        $newImageCnt = count($_FILES['articlePhoto']['tmp_name']);
        if ($newImageCnt != 0) {
            for ($i=0;$i<$newImageCnt;$i++) {
                $image = $_FILES['articlePhoto']['tmp_name'][$i];
                if ($image != "") {
                    $newImage = file_get_contents($image);
                    $photoSQL = "INSERT INTO newsphoto (newsID, photo) VALUES (?,?);";
                    $stmt1 = $mysqli->prepare($photoSQL);
                    $stmt1 -> bind_param("ss", $id, $newImage);
                    $stmt1 -> execute();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ='UTF-8'> 
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>SL Tourism | Your One-Stop Centre</title>
        <link rel='stylesheet' href='style/adminManageNews.css?v=8'>
        <link rel='tab icon' href='images/logo-placeholder.png'>
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
            <div class = 'hiddenNewsBox' id = 'hiddenNewsBox'>
                <form class ='editNewsForm' action ='adminEditNews.php' enctype='multipart/form-data' method = 'post'>
                    <div class = 'nameLabel'>
                        Article Title
                    </div>

                    <div class = 'nameInput'>
                        <input type='text' name='articleTitle' id = 'articleTitle' value = '<?php echo $title?>'>
                    </div>

                    <div class = 'nameLabel'>
                        Description
                    </div>

                    <div class = 'nameInput'>
                        <textarea name='articleDesc' id = 'articleDesc'><?php echo $desc?></textarea>
                    </div>

                    <div class = 'nameLabel'>
                        Article Paragraph 1
                    </div>

                    <div class = 'nameInput'>
                        <textarea name='articlePara1' id = 'articlePara1' value = ''><?php echo $para1?></textarea>
                    </div>

                    <div class = 'nameLabel'>
                        Article Paragraph 2
                    </div>

                    <div class = 'nameInput'>
                        <textarea name='articlePara2' id = 'articlePara2' value = ''><?php echo $para2?></textarea>
                    </div>

                    <div class = 'nameLabel'>
                        Photos
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
                                echo '<span class="dot" onclick="currentImage($i)"></span>';
                            }
                            ?>
                        </div>
                        
                        <div class = 'nameLabel'>
                            Add Photos
                        </div>
                        <div class = 'nameInput'>
                            </br>
                            <input type='file' name='articlePhoto[]' id = 'articlePhoto'>
                        </div>
                        
                    </div>

                    <div id = 'nameButtons'>
                        <input type='hidden' name = 'newsID' id = 'newsID' value = <?php echo $newsID;?>>
                        <input type='submit' name='articleSubmit' id = 'articleSubmit' value ='Submit'>
                        <input type='reset' name='articleReset' id = 'articleReset' value ='Reset'>
                    </div>
                </form>
            </div>
        </div>
       
        </main>
        
 <?php 
 require_once 'mainFooter.php';
 ?>

 <script src = "script/adminEditNews.js"></script>
    </body>

</html>