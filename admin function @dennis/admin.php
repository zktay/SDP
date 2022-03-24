<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
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
        <link rel="stylesheet" href="style/admin.css">
        <link rel="tab icon" href="images/logo-placeholder.png">
    </head>
    <body>
        <?php require_once 'adminHeader.php';?>
        
        <main>
        <div class='flexWrapper'>
            <div class="admin_property">
                <section class = 'flex-c-c' id="greeting">
                    
                    <script>
                        var currentDate= new Date();
                        var currentHour = currentDate.getHours();
                        var displayGreetings;

                        if (currentHour < 12) {
                            displayGreetings = "Good Morning!<br> Welcome!";
                        }
                        else if (currentHour <17) {
                            displayGreetings = "Good Afternoon!<br> Welcome!";
                        }
                        else if (currentHour <= 23) {
                            displayGreetings = "Good Evening!<br> Welcome!";
                        }

                        document.getElementById('greeting').innerHTML = displayGreetings;
                    </script>
                   
                </section>
            </div>

            <div class="custGridContainer">
                <div class="custGridItem">
                    <input type="button" id= "gridButton" onclick="location.href='';" value="My Account">
                    &nbsp;&nbsp;
                    <input type="button" id= "gridButton"  onclick="location.href='';" value="Manage User">
                    &nbsp;&nbsp;
                    <input type="button" id= "gridButton" onclick="location.href='';" value="Manage Package">
                    &nbsp;&nbsp;
                </div>  
                <div class="custGridItem">
                    <input type="button" id= "gridButton" onclick="location.href='adminManageFeedback.php';" value="Manage Feedback">
                    &nbsp;&nbsp;
                    <input type="button" id= "gridButton" onclick="location.href='adminManageTicket.php';" value="Manage Tickets">
                    &nbsp;&nbsp;
                    <input type="button" id= "gridButton" onclick="location.href='adminManageNews.php';" value="Manage Travel News">
                    &nbsp;&nbsp;
                </div>             
            </div>
        </div>
        </main>
        <?php require_once 'mainFooter.php';?>
    </body>
</html>
