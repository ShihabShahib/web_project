<?php

session_start();

include"includes/db_connect.inc.php";

if(!isset($_SESSION["u_id"])){
    header("Location: login.php");
    }

$message_old = $message_match = $userid = $old_pass = $new_pass = $c_new_pass = $passInDB = $message = "";

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_pass_update']))){
    
    if(!empty($_POST['old_pass'])){
        $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
    }
    
    if(!empty($_POST['new_pass'])){
        $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
        $passToDB = password_hash($new_pass, PASSWORD_DEFAULT);
    }
    
    if(!empty($_POST['c_new_pass'])){
        $c_new_pass = mysqli_real_escape_string($conn, $_POST['c_new_pass']);
    }

    $type_check1 = substr_compare($_SESSION["u_id"],"01",8);
    $type_check2 = substr_compare($_SESSION["u_id"],"02",8);
    $type_check3 = substr_compare($_SESSION["u_id"],"03",8);
    $type_check4 = substr_compare($_SESSION["u_id"],"04",8);
    $userid = $_SESSION["u_id"];
    if($type_check1 == 0){
        $sqlGetPass = "SELECT adminpassword from `admin` where adminid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['adminpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            if($new_pass==$c_new_pass){
                $sql = "UPDATE `admin` SET `adminpassword`= '$passToDB' WHERE `adminid` = '$userid'";
                mysqli_query($conn, $sql);
                header("Location: manage_super_admin.php");
            }
            else{
                $message = "Password does not match!";
            }
        }
    }
    if($type_check2 == 0){
        $sqlGetPass = "SELECT adminpassword from `admin` where adminid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['adminpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            if($new_pass==$c_new_pass){
                $sql = "UPDATE `admin` SET `adminpassword`= '$passToDB' WHERE `adminid` = '$userid'";
                mysqli_query($conn, $sql);
                header("Location: manage_class.php");
            }
            else{
                $message = "Password does not match!";
            }
        }
    }
    if($type_check3 == 0){
        $sqlGetPass = "SELECT teacherpassword from `teacher` where teacherid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['teacherpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            if($new_pass==$c_new_pass){
                $sql = "UPDATE `teacher` SET `teacherpassword`= '$passToDB' WHERE `teacherid` = '$userid'";
                mysqli_query($conn, $sql);
                header("Location: manage_notes.php");
            }
            else{
                $message = "Password does not match!";
            }
        }
    }
    if($type_check4 == 0){
        $sqlGetPass = "SELECT studentpassword from `student` where studentid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['studentpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            if($new_pass==$c_new_pass){
                $sql = "UPDATE `student` SET `studentpassword`= '$passToDB' WHERE `studentid` = '$userid'";
                mysqli_query($conn, $sql);
                header("Location: notes.php");
            }
            else{
                $message = "Password does not match!";
            }
        }
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#old_pass').on('keyup', function(){
                $('#get_old_message').load('old_password_load.php',{old_pass: document.getElementById('old_pass').value});
            });
            $('#c_new_pass').on('keyup', function(){
                $('#get_match_message').load('match_password_load.php',{new_pass: document.getElementById('new_pass').value, c_new_pass: document.getElementById('c_new_pass').value});
            });
            
        });
    </script>
    <?php include('header.php'); ?>
        <div id="page_content">
            <div class="row">
                <aside>
                    <div id="nav_bar">
                        <div class="col-md-3" style="max-width: 400px;">
                            <div class="nav_menu">
                                <img src="img/teacher-06.png" alt="student_image"><br><br>
                                <label for="user_name"><?php echo $_SESSION["u_name"]; ?></label><br>
                                <label for="user_id"><?php echo $_SESSION["u_id"]; ?></label><br><br>
                                <ul style="list-style: none;  padding: 0; margin-top: 35px;">
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <section>
                    <div id="change_password_page">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Change Password</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Change Password" name="change_password" id="change_password" style="background-color: #a7cde8;">
                            </div>
                            <div class="change_password" id="change_password_form">
                                <form action="change_password.php" method="post">
                                    <table>
                                        <tr>
                                            <td><label for="">Current Password:</label></td>
                                            <td>
                                                <input type="text" name="old_pass" id="old_pass" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td id="get_old_message"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">New Password:</label></td>
                                            <td>
                                                <input type="text" name="new_pass" id="new_pass" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Confirm Password:</label></td>
                                            <td>
                                                <input type="text" name="c_new_pass" id="c_new_pass" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td id="get_match_message"></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <?php echo $message; ?>
                                    <br>
                                    <input type="submit" value="Update" name="man_pass_update">
                                    <br>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </section>
            </div>
        </div>
    <?php include('footer.php'); ?>
</body>
</html>