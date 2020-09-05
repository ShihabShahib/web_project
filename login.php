<?php

session_start();

include"includes/db_connect.inc.php";

$user_name = $user_id = $user_pass = $sqlUserCheck = $result = $rowCount = $message = $passInDB = $user_type = $type_check1 = $type_check2 = $type_check3 = $type_check4 = $sqlGetPass = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['u_id'])){
        $user_id = mysqli_real_escape_string($conn, $_POST['u_id']);
    }
    if(!empty($_POST['u_pass'])){
        $user_pass = mysqli_real_escape_string($conn, $_POST['u_pass']);
    }

    $sqlUserCheck = "SELECT userid FROM user WHERE userid = '$user_id'";
    $result = mysqli_query($conn, $sqlUserCheck);
    $rowCount = mysqli_num_rows($result);

    if($rowCount < 1){
        $message = "User does not exist!";
    }
    else{
        $type_check1 = substr_compare($user_id,"01",8);
        $type_check2 = substr_compare($user_id,"02",8);
        $type_check3 = substr_compare($user_id,"03",8);
        $type_check4 = substr_compare($user_id,"04",8);
        if($type_check1 == 0){
            $sqlGetPass = "SELECT adminpassword from `admin` where adminid = '$user_id'";
            $result = mysqli_query($conn, $sqlGetPass);
            while($row = mysqli_fetch_assoc($result)){
                $passInDB = $row['adminpassword'];
            }
            if(password_verify($user_pass,$passInDB)){
                header("Location: manage_super_admin.php");
                $_SESSION["u_id"] = $user_id;
                $_SESSION["u_name"] = "Super Admin";
            }
            else{
                $message = "Password does not match!";
            }
        }
        if($type_check2 == 0){
            $sqlGetPass = "SELECT adminpassword from `admin` where adminid = '$user_id'";
            $result = mysqli_query($conn, $sqlGetPass);
            while($row = mysqli_fetch_assoc($result)){
                $passInDB = $row['adminpassword'];
            }
            if(password_verify($user_pass,$passInDB)){
                header("Location: manage_class.php");
                $_SESSION["u_id"] = $user_id;
                $_SESSION["u_name"] = "School Admin";
            }
            else{
                $message = "Password does not match!";
            }
        }
        if($type_check3 == 0){
            $sqlGetPass = "SELECT teachername, teacherpassword from `teacher` where teacherid = '$user_id'";
            $result = mysqli_query($conn, $sqlGetPass);
            while($row = mysqli_fetch_assoc($result)){
                $passInDB = $row['teacherpassword'];
                $user_name = $row['teachername'];
            }
            if(password_verify($user_pass,$passInDB)){
                header("Location: manage_notes.php");
                $_SESSION["u_id"] = $user_id;
                $_SESSION["u_name"] = $user_name;
            }
            else{
                $message = "Password does not match!";
            }
        }
        if($type_check4 == 0){
            $sqlGetPass = "SELECT studentname, studentpassword from `student` where studentid = '$user_id'";
            $result = mysqli_query($conn, $sqlGetPass);
            while($row = mysqli_fetch_assoc($result)){
                $passInDB = $row['studentpassword'];
                $user_name = $row['studentname'];
            }
            if(password_verify($user_pass,$passInDB)){
                header("Location: notes.php");
                $_SESSION["u_id"] = $user_id;
                $_SESSION["u_name"] = $user_name;
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
    <title>Login-SMS</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body style=" background-color: #9999ff;">
    <header>
        <div id="header">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0px;">
                    <div class="logo_image" style="padding-right: 0;">
                        <img src="img/logo.png" alt="logo_image">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div id="login_module">
            <div class="row justify-content-center" style="margin: 0;">
                <div class="col-md-3 align-self-center" style="padding-right: 0px;">
                    <div class="login_image">
                        <img src="img/login_image.png" alt="login_image">
                    </div>
                </div>
                <div class="col-md-3 align-self-center" style="padding-left: 0px;">
                    <div class="login_form">
                        <form action="login.php" method="post">
                            <h3>SCHOOL</h3><br>
                            <h4>LOGIN</h4><br><br>
                            <label for="id">ID</label><br>
                            <input type="text" name="u_id" placeholder="XX-XXXX-XX" value="<?php echo $user_id; ?>"><br><br>
                            <label for="password">Password</label><br>
                            <input type="password" name="u_pass" placeholder="#########"><br><br>
                            <label for=""><?php echo $message; ?></label>
                            <br>
                            <input type="submit" value="LOGIN">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div id="footer">
            <div class="row" style="margin: 0; padding-bottom: 0px; height: 80px;">
                <div class="col-md-12" style="padding-right: 0px; padding-bottom: 0px; height: 80px">
                    <div class="footer_text">
                        <p>Developed by WebTech Group 3</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>