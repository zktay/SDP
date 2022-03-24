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
        <link rel="stylesheet" href="style/adminManageTicket.css?v=1">
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
                Manage Tickets/Inquiries
            </div>

            <div class='searchBar flex-c-c'>
                <form action = 'adminManageTicket.php' method = 'post'>
                    <label style='margin-left:10px;'>Search: </label>
                    &nbsp;
                    <input class='searchInput' name='filterInput' type='text' placeholder='Enter detail to search..'>
                    &nbsp;
                    <select id='filter' class='filterBox' name='filterOption' required>
                        <option value = 'all'>Select One:</option>
                        <option value = 'email'>Email</option>
                        <option value = 'fName'>Name</option>
                    </select>
                    &nbsp;
                    <button type = 'submit' class='filterBtn' id='searchBtn' name='searchBtn'>Go</button>
                </form>
            </div>

            <div class = "ticketContent flex-c-c">
                    <?php //search bar php//
                        $inquiries = new inquiryControl();
                        
                        $filter = '';

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['searchBtn'])) {
                            $filterInput = $_POST['filterInput'];
                            $filter = $_POST['filterOption'];
                        }
                        else {
                            $inquiryDetails = $inquiries->inquiries();
                        }
                        
                        if ($filter == 'email' && $filterInput != '') {
                            $inquiryDetails = $inquiries->inquiriesExtend($filter, $filterInput);
                        }
                        else if ($filter == 'fName' && $filterInput != '') {
                            $inquiryDetails = $inquiries -> inquiriesExtend($filter, $filterInput);
                        }
                        else if ($filter == 'all' && $filterInput != '') {
                            $inquiryDetails = $inquiries->inquiriesOrStatement($filterInput);
                        }
                        else {
                            $inquiryDetails = $inquiries->inquiries();
                        }

                        $validate = $inquiryDetails -> num_rows;
                        if ($validate != 0) {
                            echo "<table id='ticketTable' width='1600px'>";
                            echo "<tr>";
                                echo "<th onclick='sortTable(0)'>Name</th>";
                                echo "<th onclick = 'sortTable(1)'>Type</th>";
                                echo "<th onclick = 'sortTable(2)'>Status</th>";
                                echo "<th onclick = 'sortTable(3)'>Date/Time Received</th>";
                                echo "<th>Contact Number</th>";
                                echo "<th>Email</th>";
                                echo "<th>Action</th>";
                            echo "</tr>";

                            while ($ticket = $inquiryDetails -> fetch_assoc()) {
                                $ticketID = $ticket['ticketID'];
                                $ticketStatus = $ticket['ticketStatus'];
                                $fname = $ticket['fName'];
                                $contact = $ticket['contact'];
                                $email = $ticket['email'];
                                $type = $ticket['type'];
                                $message = $ticket['message'];
                                $addInfo = $ticket['addInfo'];
                                $datetime = $ticket['ticketDateTime'];

                                echo "<tr>";
                                
                                echo "<td>";
                                echo $fname;
                                echo "</td>";

                                echo "<td>";
                                echo $type;
                                echo "</td>";
                                
                                echo "<td>";
                                echo $ticketStatus;
                                echo "</td>";

                                echo "<td>";
                                echo $datetime;
                                echo "</td>";

                                echo "<td>";
                                echo $contact;
                                echo "</td>";

                                echo "<td>";
                                echo $email;
                                echo "</td>";

                                echo "<td>";

                                echo "<button class= 'actionButton' id = '$ticketID' onclick='ticketOverlay(this.id)'>Close Ticket</button>";
                                echo "<form action = 'adminManageTicket.php' method = 'post'>"; 
                                    echo "<input type='hidden' id = 'submitFeedbackID' name = 'submitFeedbackID' value ='$ticketID'>";
                                    echo "<input type='submit' class= 'actionButton' name = 'submitFeedback' value = 'View Details'>";
                                echo "</form>";

                                echo "</td>";

                                echo "</tr>";
                            }
                        }
                        else {
                            echo "There are no records available!";
                        }
                        
                    ?>

                <div id="vpGreyOut" onclick="backToNormal()"></div>

                <div id = 'ticketOverlay' class = 'flex-sa-c'>
                    <div class='overlayTitle'>Close Ticket?</div>
                        <form action = 'adminManageTicket.php' class='flex-c-c' method='post'>
                            <input type='hidden' id= 'ticketID' name='id' value = ''>
                            <!-- <input type='submit' id= 'closeTicket' class = 'overlayBtn ' name = 'closeTicket' value = 'Yes'> -->
                            <button type = 'submit' class = 'overlayBtn' id = 'closeTicket' name='closeTicket'>Yes</button>
                            &nbsp;&nbsp;                          
                        </form>
                        <button class= 'overlayBtn' onclick='backToNormal()'>No</button>
                </div>

                <?php //for action buttons//
                    $adminFeedback = new adminControl();
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['closeTicket'])) {
                        $adminFeedback->changeStatus();
                    }

                    $inquiryFeedback = new inquiryControl();
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submitFeedback'])) {
                        $id = intval($_POST['submitFeedbackID']);
                        $feedback = $inquiryFeedback->inquiriesExtend('ticketID', $id);
                        while ($result = $feedback->fetch_assoc()) {
                            $title = $result['message'];
                            $info = $result['addInfo'];
                            echo "<div id = 'feedbackOverlay' class = 'flex-sa-c'>

                            <div class='overlayTitle'>Ticket Details</div>
                                <div class='flex-c-c'>Title: $title</div>
                                <div class='flex-c-c'>Info: $info</div>
                                <button class = 'overlayBtn' onclick='returnToContent()'>Exit</button>
                            </div>";
                        }
                        

                    }
                ?>

                </table>
            </div>
        </div>
        </main>
        
        <?php require_once 'mainFooter.php'?> <!--change to admin footer-->
        <script src = "script/manageTicket.js"></script>
    </body>