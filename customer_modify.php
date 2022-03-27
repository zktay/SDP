<!DOCTYPE html>
<?php
    require("connect.php");
    include("header.php");
    $accID = $_SESSION['customerID'];
    $cusID = $_SESSION['customerID'];
    $sql_cus = "SELECT * FROM customer WHERE customerID = '$cusID'";
    $data = $mysqli -> query($sql_cus);
    $cus_info = $data -> fetch_assoc();
    
?>

<html lang="en">
    <head>
        <link rel="stylesheet" href="customer_modify.css">
        <script src="https://kit.fontawesome.com/4a8b676a62.js" crossorigin="anonymous"></script>
        
    </head>
    <body>
    <?php
    $cusPic = base64_encode($cus_info['customerPic']);
    echo ('
        <div class="main_container">
            <div class="top_container">
                <h1>My Account</h1>
            </div>
            <div class="btm_container">
                <div class="pic_container">
                    <div class="pic">
                        <img style="z-index: -1;" src="data:images/jpeg;base64,'. $cusPic .'" alt=""><span class="editPic"></span>
                        <button class="click-me" onclick ="editPic()"><span style="font-size:30px; font:bold;">EDIT PICTURE</span></button>
                        <div class="content" id="manPic">
                            <div class="title"><h1 class="manCat">Manage Picture</h1></div>
                            <div class="form_pic">
                            <form method="POST" ENCTYPE="multipart/form-data" action="cus_handler.php">
                                <input type="hidden" name ="id" value = "5">
                                <table >
                                    <tr>
                                        <div class="c_pic"><img id="output_image"><p class="no_pic">No Picture Chosen</p></div>
                                    </tr>
                                    <tr>
                                        <th>New Picture:</th>
                                    </tr>
                                    <tr>
                                        <td><input accept="image/png, image/jpeg, image/jpg" required type="file" style="width:100%; height:100%; padding-left:10px;" name="new_pic" id="new_pic" onchange="preview_image(event)"></td>
                                    </tr>
                                </table>
                                <div class = "BTNmid_p">
                                    <input style = "width :90px; margin-right: 5px; border:.5px black solid; border-radius:3px;" type = "button" value = "Back" onclick="closePic();">
                                    <input style = "width :90px; margin-left: 5px; border:.5px black solid; border-radius:3px;" type = "submit" value = "Submit">
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="info_grid">
                    <div class="info_grid_item_1">
                        <h1>Manage Username</h1>
                        <button class="edit" onclick="editUser()"><i class="fa-regular fa-pen-to-square fa-xl"></i></button>
                        <div class="manUser" id="manUser">
                            <div class="title1"><h1 class="manCat">Manage Username</h1></div>
                            <div class="conUser">
                                <div class="form1">
                                    <form method="POST" action ="cus_handler.php">
                                    <input type="hidden" name ="id" value = "1">
                                        <table >
                                            <tr>
                                                <th>Username:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input disabled style="width:100%; background-color:white;" value ='.$cus_info['custName'].'></td>
                                            </tr>
                                            <tr></tr>
                                            <tr>
                                                <th>New Username:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input required type="text" style="width:100%; height:100%;" name="new_user" id="new_user"></td>
                                            </tr>     
                                        </table>
                                            <div class = "BTNmid">
                                                <input style = "width: 90px; margin-right: 5px; border:.5px black solid; border-radius:3px;" type = "button" value = "Back" onclick="closeUser();">
                                                <input style = "width :90px; margin-left: 5px; border:.5px black solid; border-radius:3px;" type="submit" value = "Submit">
                                            </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="info_grid_item_2">
                        <h1>Manage Email</h1>
                        <button class="edit" onclick="editEmail()"><i class="fa-regular fa-pen-to-square fa-xl"></i></button>
                        <div class="manEmail" id="manEmail">
                            <div class="title1"><h1 class="manCat">Manage Email</h1></div>
                            <div class="conUser">
                                <div class="form1">
                                    <form method="POST" action ="cus_handler.php">
                                    <input type="hidden" name ="id" value = "2">
                                        <table >
                                            <tr>
                                                <th>Email:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input disabled style="width:100%; background-color:white;" value ='.$cus_info['accountID'].'></td>
                                            </tr>
                                            <tr></tr>
                                            <tr>
                                                <th>New Email:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input  required type="email" style="width:100%; height:100%;" name="new_email" id="new_email"></td>
                                            </tr>
                                            
                                        </table>
                                        <div class = "BTNmid">
                                            <input style = "width :90px; margin-right: 5px; border:.5px black solid; border-radius:3px;" type = "button" value = "Back" onclick="closeEmail();">
                                            <input style = "width :90px; margin-left: 5px; border:.5px black solid; border-radius:3px;" type = "submit" value = "Submit">
                                        </div>
                                    </form>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="info_grid_item_3">
                        <h1>Manage Password</h1>
                        <button class="edit" onclick="editPass();"><i class="fa-regular fa-pen-to-square fa-xl"></i></button>
                        <div class="manPass" id="manPass">
                            <div class="title1"><h1 class="manCat">Manage Password</h1></div>
                            <div class="conUser">
                                <div class="form1">
                                    <form method="POST" action ="cus_handler.php">
                                    <input type="hidden" name ="id" value = "3">
                                        <table >
                                            <tr>
                                                <th>Password:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input required type="password" name="cu_password"style="width:100%; background-color:white;" placeholder ="Current Password:"></td>
                                            </tr>
                                            <tr></tr>
                                            <tr>
                                                <th>New Password:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input required type="password" style="width:100%; height:100%;" id = "new_pass" name="new_pass"></td>
                                            </tr>
                                            <tr>
                                                <th>Confirmation Password:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input required type="password" style="width:100%; height:100%;" id = "con_pass" name="con_pass" onchange="checkPass()"></td>
                                            </tr>
                                            
                                        </table>
                                        <div class = "BTNmid">
                                            <input style = "width :90px; margin-right: 5px; border:.5px black solid; border-radius:3px;" type = "button" value = "Back" onclick="closePass();">
                                            <input style = "width :90px; margin-left: 5px; border:.5px black solid; border-radius:3px;" type = "submit" id="submit" value = "Submit" onclick = "">
                                        </div> 
                                    </form>
                                </div>
                              
                            </div>
                        </div>
                        
                    </div>
                    <div class="info_grid_item_4">
                        <h1>Manage Contact</h1>
                        <button class="edit" onclick="editContact();"><i class="fa-regular fa-pen-to-square fa-xl"></i></button>
                        <div class="manContact" id="manContact">
                            <div class="title1"><h1 class="manCat">Manage Contact</h1></div>
                            <div class="conUser">
                                <div class="form1">
                                    <form method="POST" action="cus_handler.php">
                                    <input type="hidden" name ="id" value = "4">
                                        <table >
                                            <tr>
                                                <th>Contact:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input disabled style="width:100%; background-color:white;" value ='.$cus_info['custContact'].'></td>
                                            </tr>
                                            <tr></tr>
                                            <tr>
                                                <th>New Contact:</th>
                                            </tr>
                                            <tr>
                                                <td class="td"><input required type="tel" style="width:100%; height:100%;" id = "new_con" name = "new_con" pattern="[0-9]{10,12}"></td>
                                            </tr>
                                            
                                        </table>
                                        <div class = "BTNmid">
                                            <input style = "width :90px; margin-right: 5px; border:.5px black solid; border-radius:3px;" type = "button" value = "Back" onclick="closeContact();">
                                            <input style = "width :90px; margin-left: 5px; border:.5px black solid; border-radius:3px;" type = "submit" value = "Submit" onclick = "">
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="nav_btm">
            <button class="button" style = "width :180px; margin-right: 5px; " onclick="window.location.href=\'index.php\'">Back</button>
            </div>
        </div>
        
    ')    
    ?>
    </body>
    <script src="popup.js"></script>
</html>