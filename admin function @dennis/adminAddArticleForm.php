<?php

    require_once 'connect.php';
    require 'userController.php';
    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] == 'customer') {
        header('location:index.php');
    }

    else {
        $role = $_SESSION['role'];
        $accountID = $_SESSION['accountID'];

        $articleTitle = $_POST['articleTitle'];
        $articleDesc = $_POST['articleDesc'];
        $articlePara1 = $_POST['articlePara1'];
        $articlePara2 = $_POST['articlePara2'];
        $addNews = new travelNews();
        $travelnews = $addNews->addNews($accountID, $articleTitle, $articleDesc, $articlePara1, $articlePara2);
        echo "<script>alert('New Article Added! Edit Your Article To Add Photos!');";
        echo "window.location.href='adminManageNews.php';";
        echo "</script>";

    }

    

?>
