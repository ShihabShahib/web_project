<?php

session_start();

include"includes/db_connect.inc.php";

if(!isset($_SESSION["u_id"])){
    header("Location: login.php");
}
else{
    $userid = $_SESSION["u_id"];
    $type_check1 = substr_compare($userid,"01",8);
    if($type_check1 != 0){
        session_unset();
        header("Location: login.php");
    }
} 

$query = $result = $admin_id = $admin_name = $admin_school_id_edit = $password = $c_password = $passToDB = $sql = $sql2 = $message = $row = $create_admin_id = $new_admin_id = $new_admin_id1 = $new_admin_id2 = $new_admin_id3 = "";

$sqlCheckSchool = "SELECT * FROM `admin` WHERE adminid LIKE '________02' ORDER BY `adminid` DESC LIMIT 1";
$result = mysqli_query($conn, $sqlCheckSchool);
while($row = mysqli_fetch_assoc($result)){
    $create_admin_id = $row['adminid'];
}
list($new_admin_id1, $new_admin_id2, $new_admin_id3) = explode('-',$create_admin_id);

$new_admin_id2 = sprintf('%04d', $new_admin_id2 + 1);;

$new_admin_id = $new_admin_id1."-".$new_admin_id2."-".$new_admin_id3;

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_school_update']))){

    if(!empty($_POST['admin_school_id_edit'])){
        $admin_id = mysqli_real_escape_string($conn, $_POST['admin_school_id_edit']);
    }
    
    if(!empty($_POST['name_school_edit'])){
        $admin_name = mysqli_real_escape_string($conn, $_POST['name_school_edit']);
    }

    if(!empty($_POST['password_school_edit'])){
        $password = mysqli_real_escape_string($conn, $_POST['password_school_edit']);
        $passToDB = password_hash($password, PASSWORD_DEFAULT);
    }

    if(!empty($_POST['c_password_school_edit'])){
        $c_password = mysqli_real_escape_string($conn, $_POST['c_password_school_edit']);
    }

    if($password == $c_password){
        $sql = "UPDATE `admin` SET `adminname` = '$admin_name', `adminpassword` = '$passToDB' WHERE `adminid` = '$admin_id'";
        mysqli_query($conn, $sql);
    }
    else{
        $message = "Passwords do not match!";
    }
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_school_create']))){
    
    if(!empty($_POST['name_school_create'])){
        $admin_name = mysqli_real_escape_string($conn, $_POST['name_school_create']);
    }

    if(!empty($_POST['password_school_create'])){
        $password = mysqli_real_escape_string($conn, $_POST['password_school_create']);
        $passToDB = password_hash($password, PASSWORD_DEFAULT);
    }

    if(!empty($_POST['c_password_school_create'])){
        $c_password = mysqli_real_escape_string($conn, $_POST['c_password_school_create']);
    }

    if($password == $c_password){
        $sql = "INSERT INTO `admin` (adminid, adminpassword, adminname) VALUES ('$new_admin_id', '$passToDB', '$admin_name');";
        mysqli_query($conn, $sql);
        $sql2 = "INSERT INTO `user` (`userid`) VALUES ('$new_admin_id');";
        mysqli_query($conn, $sql2);
    }
    else{
        $message = "Passwords do not match!";
    }

    $sqlCheckSchool = "SELECT * FROM `admin` WHERE adminid LIKE '________02' ORDER BY `adminid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckSchool);
    while($row = mysqli_fetch_assoc($result)){
        $create_admin_id = $row['adminid'];
    }
    list($new_admin_id1, $new_admin_id2, $new_admin_id3) = explode('-',$create_admin_id);

    $new_admin_id2 = sprintf('%04d', $new_admin_id2 + 1);;

    $new_admin_id = $new_admin_id1."-".$new_admin_id2."-".$new_admin_id3;
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_school_delete']))){

    if(!empty($_POST['admin_school_id_edit'])){
        $admin_school_id_edit = mysqli_real_escape_string($conn, $_POST['admin_school_id_edit']);
    }

    $sql = "DELETE FROM `admin` WHERE `adminid` = '$admin_school_id_edit'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM `user` WHERE `userid` = '$admin_school_id_edit'";
    mysqli_query($conn, $sql);

    $sqlCheckSchool = "SELECT * FROM `admin` WHERE adminid LIKE '________02' ORDER BY `adminid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckSchool);
    while($row = mysqli_fetch_assoc($result)){
        $create_admin_id = $row['adminid'];
    }
    list($new_admin_id1, $new_admin_id2, $new_admin_id3) = explode('-',$create_admin_id);

    $new_admin_id2 = sprintf('%04d', $new_admin_id2 + 1);;

    $new_admin_id = $new_admin_id1."-".$new_admin_id2."-".$new_admin_id3;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Dashboard</title>
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
        function update(x){
            document.getElementById('admin_school_id').value = x;
        }
        function create_admin(){
            document.getElementById('edit_school_form').style.display = 'none';
            document.getElementById('create_school_form').style.display = 'block';
            document.getElementById('edit_school').style.backgroundColor = '#fff';
            document.getElementById('create_school').style.backgroundColor = '#a7cde8';
        }
        function edit_admin(){
            document.getElementById('create_school_form').style.display = 'none';
            document.getElementById('edit_school_form').style.display = 'block';
            document.getElementById('edit_school').style.backgroundColor = '#a7cde8';
            document.getElementById('create_school').style.backgroundColor = '#fff';
        }
        $(function() {
            $('#man_school_update').click(function() {
                $("#name_school_edit").prop('required', true);
                $("#password_school_edit").prop('required', true);
                $("#c_password_school_edit").prop('required', true);
            });
            $('#man_school_delete').click(function() {
                $("#name_school_edit").prop('required', false);
                $("#password_school_edit").prop('required', false);
                $("#c_password_school_edit").prop('required', false);
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
                            <img src="img/student-06.png" alt="student_image"><br><br>
                            <label for="user_name"><?php echo $_SESSION["u_name"]; ?></label><br>
                            <label for="user_id"><?php echo $_SESSION["u_id"]; ?></label><br><br>
                            <ul style="list-style: none;  padding: 0; margin-top: 35px;">
                                <li><a href="manage_super_admin.php">Manage Super Admin</a></li>
                                <li><a href="manage_school_admin.php">Manage School Admin</a></li>
                                <li><a href="sample.html">Sign-in Restriction</a></li>
                                <li><label for="" style="visibility: hidden;">a</label></li>
                                <li><label for="" style="visibility: hidden;">a</label></li>
                                <li><label for="" style="visibility: hidden;">a</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <section>
                <div id="manage_staff">
                    <div class="col-md-1"></div>
                    <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                        <h3>Manage School Admin</h3><br><br>
                        <div class="man_type">
                            <input type="button" value="Edit School Admin" name="edit_school" id="edit_school" style="background-color: #a7cde8;" onclick="edit_admin()">
                            <input type="button" value="Create School Admin" name="create_school" id="create_school" onclick="create_admin()"> 
                        </div>
                        <div class="man_super" id="edit_school_form">
                            <form action="manage_school_admin.php" method="post">
                                <label for="">Select:</label>
                                <select name="" onchange="update(this.value)">
                                    <option value="" selected disabled>Select Admin</option>
                                    <?php
                                    $query = "select * from `admin`";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)){
                                        if(substr_compare($row['adminid'],"02",8)==0){
                                    ?>
                                    <option value="<?php echo $row['adminid'];?>"><?php echo $row['adminid'];?></option>
                                    <?php
                                    }}
                                    ?>
                                </select><br><br>
                                <table>
                                    <tr>
                                        <td style="font-weight: 500;">Admin Id:</td>
                                        <td><input type="text" id="admin_school_id" name="admin_school_id_edit" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500;">Name:</td>
                                        <td><input type="text" name="name_school_edit" id="name_school_edit"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500;">Password:</td>
                                        <td><input type="text" name="password_school_edit" id="password_school_edit"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500;">Confirm Password:</td>
                                        <td><input type="text" name="c_password_school_edit" id="c_password_school_edit"></td>
                                    </tr>
                                </table>
                                <br>
                                <?php echo $message;?>
                                <br>
                                <input type="submit" value="Update" name="man_school_update" id="man_school_update">
                                <input type="submit" value="Delete" name="man_school_delete" id="man_school_delete">
                            </form>
                        </div>
                        <div class="man_school" id="create_school_form" style="display: none;">
                        <form action="manage_school_admin.php" method="post">
                                <br>
                                <table>
                                    <tr>
                                        <td style="font-weight: 500;">Admin Id:</td>
                                        <td><input type="text" name="admin_school_id" value="<?php echo $new_admin_id; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500;">Name:</td>
                                        <td><input type="text" name="name_school_create"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500;">Password:</td>
                                        <td><input type="text" name="password_school_create"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500;">Confirm Password:</td>
                                        <td><input type="text" name="c_password_school_create"></td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                                <input type="submit" value="Create" name="man_school_create">
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