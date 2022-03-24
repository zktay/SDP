<?php 
    class sdpDatabase {
        protected $server = 'localhost';
        protected $user = 'root';
        protected $password = '';
        protected $db = 'sdp';
        protected $dbcon;

        function __construct() 
        {
            $this ->dbcon=mysqli_connect($this->server, $this->user, $this->password,$this->db);    
        }

        function __destruct()
        {
            mysqli_close($this->dbcon);
        }

        function userAccount ($table, $id) 
        {
            $accountSQL = "SELECT * FROM $table WHERE accountID = '$id';";
            $acc = mysqli_query($this->dbcon, $accountSQL);
            return $acc;
        }

        

        function joinTable ($table1, $table2, $pk1, $pk2)
                {
                    $joinSQL = "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$pk1 = $table2.$pk2;";
                    $newJoinSQL = mysqli_query($this->dbcon, $joinSQL);
                    return $newJoinSQL; 
                }
    }

    class adminControl extends sdpDatabase {

        function changeStatus() {
            $id = intval($_POST['id']);
            
            $inquirySQL = "SELECT * FROM inquiries WHERE ticketID = '$id'";
            $result = mysqli_query($this->dbcon, $inquirySQL);
            $rowResult = $result ->fetch_assoc();

            $status = $rowResult['ticketStatus'];

            if ($status == 'closed') {
                echo "<script>alert('Ticket is already closed!');";
                echo "window.location.href='adminManageTicket.php';</script>";
            }
            else {
                $statusSQL = "UPDATE inquiries SET ticketStatus = 'closed' WHERE ticketID = '$id'";
                if (mysqli_query($this->dbcon, $statusSQL)) {
                    echo "<script>alert('Status changed to closed!');";
                    echo "window.location.href='adminManageTicket.php';</script>";
                }
            }
        }
    }

    class inquiryControl extends sdpDatabase {
        
        function inquiries ()
        {
            $inquirySql = "SELECT * FROM inquiries";
            $inquiry = mysqli_query($this->dbcon, $inquirySql);
            return $inquiry;
        }
        
        function inquiriesExtend($filter, $filterOption) {
            $inquirySQL = "SELECT * FROM inquiries WHERE $filter = '$filterOption';";
            $inquiry = mysqli_query($this->dbcon, $inquirySQL);
            return $inquiry;
        }

        function inquiriesOrStatement($filter) {
            $inquirySQL = "SELECT * FROM inquiries WHERE fName = '$filter' OR email = '$filter';";
            $inquiry = mysqli_query($this->dbcon, $inquirySQL);
            return $inquiry;
        }
    }

    class travelNews extends sdpDatabase {

        function findNews ($filter) {
            $newsSQL = "SELECT * FROM travelnews WHERE title = '$filter';";
            $newsSQLBind = mysqli_query($this->dbcon, $newsSQL);
            return $newsSQLBind;
        }

        function checkNews () {
            $newsSQL = "SELECT * FROM travelnews WHERE status != 'deleted'";
            $newsSQLBind = mysqli_query($this->dbcon, $newsSQL);
            return $newsSQLBind;
        }

        function searchNews ($filter) {
            $newsSQL = "SELECT * FROM travelnews WHERE title = '$filter' AND status != 'deleted';";
            $newsSQLBind = mysqli_query($this->dbcon, $newsSQL);
            return $newsSQLBind;
        }

        function specificNews ($id) {
            $newsSQL = "SELECT * FROM travelnews WHERE newsID = '$id'";
            $newsSQLBind = mysqli_query($this->dbcon, $newsSQL);
            return $newsSQLBind;
        }

        function getPhoto ($id) {
            $newsPhotoSQL = "SELECT newsPhotoID,photo FROM newsPhoto n INNER JOIN travelnews t ON n.newsID = t.newsID WHERE n.newsID = '$id'";
            $newsPhotoSQLBind = mysqli_query($this->dbcon, $newsPhotoSQL);
            return $newsPhotoSQLBind;
        }

        function addNews($user, $title, $description, $para1, $para2) {
            $status = 'inactive';
            $addNewsSQL = "INSERT INTO travelnews (user, title, newsDesc, paragraph1, paragraph2, status)
                            VALUES (?,?,?,?,?,?)";
            $stmt1 = mysqli_prepare($this->dbcon, $addNewsSQL);
            $stmt1->bind_param('ssssss', $user, $title, $description, $para1, $para2, $status);
            $stmt1->execute();

        }

        function changeNewsStatus($id,$status) {
            if ($status == 'active') {
                $newStatus = 'inactive';
            }
            else if ($status == 'inactive') {
                $newStatus = 'active';
            }
            else {
                $newStatus = 'deleted';
            }

            $changeStatus = "UPDATE travelnews SET status = '$newStatus' WHERE newsID = '$id'";
            if (mysqli_query($this->dbcon, $changeStatus)) {
                if ($newStatus == 'inactive') {
                    echo "<script>alert('Status successfully changed from active to inactive!');";
                    echo "window.location.href = 'adminManageNews.php';";
                    echo "</script>";
                }
                else if ($newStatus == 'active') {
                    echo "<script>alert('Status successfully changed from inactive to active!');";
                    echo "window.location.href = 'adminManageNews.php';";
                    echo "</script>";
                }
                else if ($newStatus=='deleted') {
                    echo "<script>alert('Article has been deleted.');";
                    echo "window.location.href = 'adminManageNews.php';";
                    echo "</script>";
                }
                else {
                    echo "<script>alert('There has been an error. Please try again later.');";
                    echo "window.location.href = 'adminManageNews.php';";
                    echo "</script>";
                }
            }
        }

        function updateNews($newsID, $newTitle, $newDesc, $newPara1, $newPara2) {
            $updateNews = "UPDATE travelnews SET title='$newTitle', newsDesc='$newDesc', paragraph1 = '$newPara1', paragraph2 = '$newPara2' WHERE newsID = '$newsID';";
            if (mysqli_query($this->dbcon, $updateNews)) {
                echo "<script>alert('Article has been updated!');";
                echo "window.location.href = 'adminManageNews.php';";
                echo "</script>";
            }
        }
    }

    class feedback extends sdpDatabase { //implement the function in review table // 
        function getReview() {
            $getReviewSQL = "SELECT r.reviewID, r.review, r.reviewDateTime, r.status, r.rate, res.bookingStatus, res.reserDate, pac.pName, cus.custName, acc.accountID FROM reviews r 
            INNER JOIN reservations res ON r.reserID = res.reserID 
            INNER JOIN packages pac ON res.packageID = pac.packageID 
            INNER JOIN customer cus ON res.customerID = cus.customerID
            INNER JOIN accounts acc ON cus.accountID = acc.accountID;";
            
            $getReviewSQLBind = mysqli_query($this->dbcon, $getReviewSQL);
            
            return $getReviewSQLBind;

        }

        function searchReview($filter) {
            $searchReview = "SELECT r.reviewID, r.review, r.reviewDateTime, r.rate, r.status, res.bookingStatus, res.reserDate, pac.pName, cus.custName, acc.accountID FROM reviews r 
            INNER JOIN reservations res ON r.reserID = res.reserID 
            INNER JOIN packages pac ON res.packageID = pac.packageID 
            INNER JOIN customer cus ON res.customerID = cus.customerID 
            INNER JOIN accounts acc ON cus.accountID = acc.accountID 
            WHERE pac.pName = '$filter' OR cus.custName = '$filter' OR acc.accountID = '$filter';";

            $searchReviewBind = mysqli_query($this->dbcon, $searchReview);
            return $searchReviewBind;
        }

        function reviewDetail($id) {
            $getReviewSQL = "SELECT r.reviewID, r.review, r.reviewDateTime, r.rate,r.status,  res.bookingStatus, res.reserDate, pac.pName, cus.custName, acc.accountID FROM reviews r 
            INNER JOIN reservations res ON r.reserID = res.reserID 
            INNER JOIN packages pac ON res.packageID = pac.packageID 
            INNER JOIN customer cus ON res.customerID = cus.customerID
            INNER JOIN accounts acc ON cus.accountID = acc.accountID
            WHERE reviewID = '$id';";
            
            $getReviewSQLBind = mysqli_query($this->dbcon, $getReviewSQL);
            
            return $getReviewSQLBind;
        }

        function updateReviewStatus($id) {
            $updateReviewSQL = "UPDATE reviews SET status = 'inactive' WHERE reviewID = $id;";
            if (mysqli_query($this->dbcon, $updateReviewSQL)) {
                echo "<script>alert('Review has been removed!');";
                echo "window.location.href = 'adminManageFeedback.php';";
                echo "</script>";
            }
        }

        function dieReview($id) {
            $removeReview = "SELECT r.status FROM reviews r 
            INNER JOIN reservations res ON r.reserID = res.reserID 
            WHERE r.reserID = '$id';";

            $sqlBind = mysqli_query($this->dbcon, $removeReview);
            $result = $sqlBind-> fetch_assoc();
            $status = $result['status'];

            if ($status == 'active') {
                $updateReview = "UPDATE reviews r SET status = 'inactive' WHERE r.reserID = '$id';";
                if (mysqli_query($this->dbcon, $updateReview)) {
                    echo "<script>alert('Article has been updated!');";
                    echo "window.location.href = 'adminManageNews.php';";
                    echo "</script>";
            }

        }
    }
    }

?>