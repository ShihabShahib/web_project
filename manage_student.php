<?php

session_start();

include"includes/db_connect.inc.php";

if(!isset($_SESSION["u_id"])){
    header("Location: login.php");
}
else{
    $userid = $_SESSION["u_id"];
    $type_check2 = substr_compare($userid,"02",8);
    if($type_check2 != 0){
        session_unset();
        header("Location: login.php");
    }
} 

$new_student_id1 = $new_student_id2 = $new_student_id3 = $create_student_id = $message = $class_id = $class_name_edit = $password_edit = $confirm_password_edit = $selectstudent_id_edit = $student_name_edit = $passToDB = $section_name_edit = $student_blood_edit = $student_mobile_edit = $selectstudent_id_edit = $student_mobile_create = "";

$sqlCheckStudent = "SELECT * FROM `student` WHERE studentid LIKE '________04' ORDER BY `studentid` DESC LIMIT 1";
$result = mysqli_query($conn, $sqlCheckStudent);
while($row = mysqli_fetch_assoc($result)){
    $create_student_id = $row['studentid'];
}
list($new_student_id1, $new_student_id2, $new_student_id3) = explode('-',$create_student_id);

$new_student_id2 = sprintf('%04d', $new_student_id2 + 1);;

$new_student_id = $new_student_id1."-".$new_student_id2."-".$new_student_id3;

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_student_create']))){

    if(!empty($_POST['class_student_create'])){
        $class_student_create = mysqli_real_escape_string($conn, $_POST['class_student_create']);
    }
    
    if(!empty($_POST['student_id_create'])){
        $student_id_create = mysqli_real_escape_string($conn, $_POST['student_id_create']);
    }
    
    if(!empty($_POST['section_name_create'])){
        $section_name_create = mysqli_real_escape_string($conn, $_POST['section_name_create']);
    }
    
    if(!empty($_POST['student_name_create'])){
        $student_name_create = mysqli_real_escape_string($conn, $_POST['student_name_create']);
    }

    if(!empty($_POST['password_create'])){
        $password_create = mysqli_real_escape_string($conn, $_POST['password_create']);
        $passToDB = password_hash($password_create, PASSWORD_DEFAULT);
    }
    
    if(!empty($_POST['confirm_password_create'])){
        $confirm_password_create = mysqli_real_escape_string($conn, $_POST['confirm_password_create']);
    }

    if(!empty($_POST['student_blood_create'])){
        $student_blood_create = mysqli_real_escape_string($conn, $_POST['student_blood_create']);
    }

    if(!empty($_POST['student_mobile_create'])){
        $student_mobile_create = mysqli_real_escape_string($conn, $_POST['student_mobile_create']);
    }

    $sql = "SELECT `classid` FROM `class` WHERE `classnumber` = '$class_student_create'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    if($password_create == $confirm_password_create){
        $sql = "INSERT INTO `student`(`studentid`, `studentname`, `studentpassword`, `classid`, `sectionid`, `studentbloodgroup`, `studentmobile`) VALUES ('$student_id_create','$student_name_create','$passToDB','$class_id','$section_name_create','$student_blood_create','$student_mobile_create')";
        mysqli_query($conn, $sql);
        $sql2 = "INSERT INTO `user` (`userid`) VALUES ('$new_student_id');";
        mysqli_query($conn, $sql2);
    }
    else{
        $message = "Passwords do not match!";
    }

    $sqlCheckStudent = "SELECT * FROM `student` WHERE studentid LIKE '________04' ORDER BY `studentid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckStudent);
    while($row = mysqli_fetch_assoc($result)){
        $create_student_id = $row['studentid'];
    }
    list($new_student_id1, $new_student_id2, $new_student_id3) = explode('-',$create_student_id);

    $new_student_id2 = sprintf('%04d', $new_student_id2 + 1);;

    $new_student_id = $new_student_id1."-".$new_student_id2."-".$new_student_id3;
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_student_update']))){
    
    if(!empty($_POST['class_name_edit'])){
        $class_name_edit = mysqli_real_escape_string($conn, $_POST['class_name_edit']);
    }
    
    if(!empty($_POST['section_name_edit'])){
        $section_name_edit = mysqli_real_escape_string($conn, $_POST['section_name_edit']);
    }
    
    if(!empty($_POST['selectstudent_id_edit'])){
        $selectstudent_id_edit = mysqli_real_escape_string($conn, $_POST['selectstudent_id_edit']);
    }
    
    if(!empty($_POST['student_name_edit'])){
        $student_name_edit = mysqli_real_escape_string($conn, $_POST['student_name_edit']);
    }

    if(!empty($_POST['password_edit'])){
        $password_edit = mysqli_real_escape_string($conn, $_POST['password_edit']);
        $passToDB = password_hash($password_edit, PASSWORD_DEFAULT);
    }
    
    if(!empty($_POST['confirm_password_edit'])){
        $confirm_password_edit = mysqli_real_escape_string($conn, $_POST['confirm_password_edit']);
    }

    if(!empty($_POST['student_blood_edit'])){
        $student_blood_edit = mysqli_real_escape_string($conn, $_POST['student_blood_edit']);
    }

    if(!empty($_POST['student_mobile_edit'])){
        $student_mobile_edit = mysqli_real_escape_string($conn, $_POST['student_blood_edit']);
    }

    $sql = "SELECT `classid` FROM `class` WHERE `classnumber` = '$class_name_edit'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    if($password_edit == $confirm_password_edit){
        $sql = "UPDATE `student` SET `studentid`='$selectstudent_id_edit',`studentname`='$student_name_edit',`studentpassword`='$passToDB',`classid`='$class_id',`sectionid`='$section_name_edit',`studentbloodgroup`='$student_blood_edit',`studentmobile`='$student_mobile_edit' WHERE `studentid` = '$selectstudent_id_edit'";
        mysqli_query($conn, $sql);
    }
    else{
        $message = "Passwords do not match!";
    }

}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_student_delete']))){

    if(!empty($_POST['class_name_edit'])){
        $class_name_edit = mysqli_real_escape_string($conn, $_POST['class_name_edit']);
    }
    
    if(!empty($_POST['section_name_edit'])){
        $section_name_edit = mysqli_real_escape_string($conn, $_POST['section_name_edit']);
    }
    
    if(!empty($_POST['selectstudent_id_edit'])){
        $selectstudent_id_edit = mysqli_real_escape_string($conn, $_POST['selectstudent_id_edit']);
    }

    $sql = "DELETE FROM `student` WHERE `studentid` = '$selectstudent_id_edit'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM `user` WHERE `userid` = '$selectstudent_id_edit'";
    mysqli_query($conn, $sql);

    $sqlCheckStudent = "SELECT * FROM `student` WHERE studentid LIKE '________04' ORDER BY `studentid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckStudent);
    while($row = mysqli_fetch_assoc($result)){
        $create_student_id = $row['studentid'];
    }
    list($new_student_id1, $new_student_id2, $new_student_id3) = explode('-',$create_student_id);

    $new_student_id2 = sprintf('%04d', $new_student_id2 + 1);;

    $new_student_id = $new_student_id1."-".$new_student_id2."-".$new_student_id3;
}

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>School Dashboard</title>
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
            function create_student(){
                document.getElementById('edit_student_form').style.display = 'none';
                document.getElementById('create_student_form').style.display = 'block';
                document.getElementById('edit_student').style.backgroundColor = '#fff';
                document.getElementById('create_student').style.backgroundColor = '#a7cde8';
            }
            function edit_student(){
                document.getElementById('create_student_form').style.display = 'none';
                document.getElementById('edit_student_form').style.display = 'block';
                document.getElementById('edit_student').style.backgroundColor = '#a7cde8';
                document.getElementById('create_student').style.backgroundColor = '#fff';
            }
            $(document).ready(function(){
                $('#class_student_select').on('change', function(){
                    $('#get_section_create').load('create_student_section_load.php',{class_name: document.getElementById('class_student_select').value});
                });
                $('#class_name_edit').on('change', function(){
                    $('#get_section_edit').load('edit_student_section_load.php',{class_name: document.getElementById('class_name_edit').value});
                    $('#get_student_edit').load('edit_student_student_load.php',{class_name: document.getElementById('class_name_edit').value});
                });
                $('#edit_student_form').on('change','#selectstudent_id_edit_2', function(){
                    $('#get_student_name').load('edit_student_name_load.php',{student_id: document.getElementById('selectstudent_id_edit_2').value});
                    $('#get_student_blood').load('edit_student_blood_load.php',{student_id: document.getElementById('selectstudent_id_edit_2').value});
                    $('#get_student_mobile').load('edit_student_mobile_load.php',{student_id: document.getElementById('selectstudent_id_edit_2').value});
                });
            });
            $(function() {
                $('#man_student_update').click(function() {
                    $("#password_edit").prop('required', true);
                    $("#password_super_edit").prop('required', true);
                });
                $('#man_student_delete').click(function() {
                    $("#password_edit").prop('required', false);
                    $("#confirm_password_edit").prop('required', false);
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
                                    <li><a href="manage_class.php">Manage Classes</a></li>
                                    <li><a href="manage_course.php">Manage Courses</a></li>
                                    <li><a href="manage_teacher.php">Manage Teachers</a></li>
                                    <li><a href="manage_student.php">Manage Students</a></li>
                                    <li><a href="sample.html">Manage Routine</a></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <section>
                    <div id="manage_student">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Manage Students</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Edit Student" name="edit_student" id="edit_student" style="background-color: #a7cde8;" onclick="edit_student()">
                                <input type="button" value="Create Student" name="create_student" id="create_student" onclick="create_student()"> 
                            </div>
                            <div class="edit_student" id="edit_student_form">
                                <form action="manage_student.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                 <select name="class_name_edit" id="class_name_edit" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    <option value="Play">Play</option>
                                                    <option value="Nursery">Nursery</option>
                                                    <option value="KG">KG</option>
                                                    <option value="One">One</option>
                                                    <option value="Two">Two</option>
                                                    <option value="Three">Three</option>
                                                    <option value="Four">Four</option>
                                                    <option value="Five">Five</option>
                                                    <option value="Six">Six</option>
                                                    <option value="Seven">Seven</option>
                                                    <option value="Eight">Eight</option>
                                                    <option value="Nine">Nine</option>
                                                    <option value="Ten">Ten</option>
                                                    <option value="Eleven">Eleven</option>
                                                    <option value="Twelve">Twelve</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select Section:</label></td>
                                            <td id="get_section_edit">
                                                <select name="section_name_edit" required>
                                                    <option value="" selected disabled>Select Section</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select Student:</label></td>
                                            <td id="get_student_edit">
                                                <select name="selectstudent_id_edit" required>
                                                    <option value="" selected disabled>Select Student</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Student Name:</label></td>
                                            <td id="get_student_name"><input type="text" name="student_name_edit" required></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Password:</label></td>
                                            <td><input type="text" name="password_edit" id="password_edit"></td> 
                                        </tr>
                                        <tr>
                                            <td><label for="">Confirm Password:</label></td>
                                            <td><input type="text" name="confirm_password_edit" id="confirm_password_edit"></td> 
                                        </tr>
                                        <tr>
                                            <td><label for="">Blood Group:</label></td>
                                            <td id="get_student_blood"> 
                                                <select name="student_blood_edit" required>
                                                    <option value="" selected disabled>Select Group</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Mobile:</label></td>
                                            <td id="get_student_mobile"><input type="tel" name="student_mobile_edit"></td> 
                                        </tr>
                                    </table>
                                    <br>
                                    
                                    <input type="submit" value="Update" name="man_student_update" id="man_student_update">
                                    <input type="submit" value="Delete" name="man_student_delete" id="man_student_delete">
                                </form>
                            </div>
                            <div class="create_student" id="create_student_form" style="display: none;">
                                <form action="manage_student.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td style="min-width: 150px;"><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_student_create" id="class_student_select" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    <option value="Play">Play</option>
                                                    <option value="Nursery">Nursery</option>
                                                    <option value="KG">KG</option>
                                                    <option value="One">One</option>
                                                    <option value="Two">Two</option>
                                                    <option value="Three">Three</option>
                                                    <option value="Four">Four</option>
                                                    <option value="Five">Five</option>
                                                    <option value="Six">Six</option>
                                                    <option value="Seven">Seven</option>
                                                    <option value="Eight">Eight</option>
                                                    <option value="Nine">Nine</option>
                                                    <option value="Ten">Ten</option>
                                                    <option value="Eleven">Eleven</option>
                                                    <option value="Twelve">Twelve</option>
                                                </select>
                                            </td>
                                            <td style="min-width: 100px;"></td>
                                            <td style="min-width: 170px;"><label for="">Student ID:</label></td>
                                            <td>
                                                <input type="text" name="student_id_create" value="<?php echo $new_student_id; ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select Section:</label></td>
                                            <td id="get_section_create">
                                                <select name="section_name_create" required>
                                                    <option value="" selected disabled>Select Section</option>
                                                </select>
                                            </td>
                                            <td style="width: 20%;"></td>
                                            <td><label for="">Student Name:</label></td>
                                            <td>
                                                <input type="text" name="student_name_create" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label for="">Password:</label></td>
                                            <td><input type="text" name="password_create"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label for="">Confirm Password:</label></td>
                                            <td><input type="text" name="confirm_password_create"></td> 
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label for="">Blood Group:</label></td>
                                            <td>
                                                <select name="student_blood_create" required>
                                                    <option value="" selected disabled>Select Group</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label for="">Mobile:</label></td>
                                            <td><input type="tel" name="student_mobile_create"></td> 
                                        </tr>
                                    </table>
                                    <?php echo $message;?>
                                    
                                    <input type="submit" value="Create" name="man_student_create">
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