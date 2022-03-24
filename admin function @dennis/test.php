<?php 
    require_once 'connect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['formSubmit'])) {
        $newImageCnt = count($_FILES['testPhoto']['tmp_name']);
            if ($newImageCnt != 0) {
                for ($i=0;$i<$newImageCnt;$i++) {
                    $image = $_FILES['testPhoto']['tmp_name'][$i];
                    if ($image != "") {
                        $newImage = file_get_contents($image);
                        $packageID = '1';
                        $photoSQL = "INSERT INTO packagephoto (packageID, photo) VALUES (?,?);";
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
    <form action = "test.php" method="post" enctype="multipart/form-data">
        <input type='file' name = 'testPhoto[]' id = 'testPhoto'>
        <input type='submit' name = 'formSubmit' id = 'formSubmit'>
    </form>
</html>