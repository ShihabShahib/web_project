<?php

session_start();

include"includes/db_connect.inc.php";

$message = $user_id = "";


if(isset($_POST['old_pass'])){
    $old_pass = $_POST['old_pass'];

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
            $message = "Password OK!";
        }
        else{
            $message = "Password does not match!";
        }
    }
    if($type_check2 == 0){
        $sqlGetPass = "SELECT adminpassword from `admin` where adminid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['adminpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            $message = "Password OK!";
        }
        else{
            $message = "Password does not match!";
        }
    }
    if($type_check3 == 0){
        $sqlGetPass = "SELECT teacherpassword from `teacher` where teacherid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['teacherpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            $message = "Password OK!";
        }
        else{
            $message = "Password does not match!";
        }
    }
    if($type_check4 == 0){
        $sqlGetPass = "SELECT studentpassword from `student` where studentid = '$userid'";
        $result = mysqli_query($conn, $sqlGetPass);
        while($row = mysqli_fetch_assoc($result)){
            $passInDB = $row['studentpassword'];
        }
        if(password_verify($old_pass,$passInDB)){
            $message = "Password OK!";
        }
        else{
            $message = "Password does not match!";
        }
    }    
    

}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <label for=""><?php echo $message; ?></label>
</body>
</html>