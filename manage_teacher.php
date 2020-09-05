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

$message = $class_id = "";

$sqlCheckTeacher = "SELECT * FROM `teacher` WHERE teacherid LIKE '________03' ORDER BY `teacherid` DESC LIMIT 1";
$result = mysqli_query($conn, $sqlCheckTeacher);
while($row = mysqli_fetch_assoc($result)){
    $create_teacher_id = $row['teacherid'];
}
list($new_teacher_id1, $new_teacher_id2, $new_teacher_id3) = explode('-',$create_teacher_id);

$new_teacher_id2 = sprintf('%04d', $new_teacher_id2 + 1);;

$new_teacher_id = $new_teacher_id1."-".$new_teacher_id2."-".$new_teacher_id3;

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_teacher_create']))){

    if(!empty($_POST['class_teacher_create'])){
        $class_teacher_create = mysqli_real_escape_string($conn, $_POST['class_teacher_create']);
    }
    
    if(!empty($_POST['teacher_id_create'])){
        $teacher_id_create = mysqli_real_escape_string($conn, $_POST['teacher_id_create']);
    }
    
    if(!empty($_POST['section_name_create'])){
        $section_name_create = mysqli_real_escape_string($conn, $_POST['section_name_create']);
    }
    
    if(!empty($_POST['teacher_name_create'])){
        $teacher_name_create = mysqli_real_escape_string($conn, $_POST['teacher_name_create']);
    }
    
    if(!empty($_POST['subject_name_create'])){
        $subject_name_create = mysqli_real_escape_string($conn, $_POST['subject_name_create']);
    }
    
    if(!empty($_POST['password_create'])){
        $password_create = mysqli_real_escape_string($conn, $_POST['password_create']);
        $passToDB = password_hash($password_create, PASSWORD_DEFAULT);
    }
    
    if(!empty($_POST['confirm_password_create'])){
        $confirm_password_create = mysqli_real_escape_string($conn, $_POST['confirm_password_create']);
    }

    $sql = "SELECT `classid` FROM `class` WHERE `classnumber` = '$class_teacher_create'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    if($password_create == $confirm_password_create){
        $sql = "INSERT INTO `teacher`(`teacherid`, `teachername`, `teacherpassword`, `classid`, `sectionid`, `subjectid`) VALUES ('$teacher_id_create','$teacher_name_create','$passToDB','$class_id','$section_name_create','$subject_name_create')";
        mysqli_query($conn, $sql);
        $sql2 = "INSERT INTO `user` (`userid`) VALUES ('$new_teacher_id');";
        mysqli_query($conn, $sql2);
    }
    else{
        $message = "Passwords do not match!";
    }

    $sqlCheckTeacher = "SELECT * FROM `teacher` WHERE teacherid LIKE '________03' ORDER BY `teacherid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckTeacher);
    while($row = mysqli_fetch_assoc($result)){
        $create_teacher_id = $row['teacherid'];
    }
    list($new_teacher_id1, $new_teacher_id2, $new_teacher_id3) = explode('-',$create_teacher_id);

    $new_teacher_id2 = sprintf('%04d', $new_teacher_id2 + 1);;

    $new_teacher_id = $new_teacher_id1."-".$new_teacher_id2."-".$new_teacher_id3;
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_teacher_update']))){
    
    if(!empty($_POST['class_name_edit'])){
        $class_name_edit = mysqli_real_escape_string($conn, $_POST['class_name_edit']);
    }
    
    if(!empty($_POST['section_name_edit'])){
        $section_name_edit = mysqli_real_escape_string($conn, $_POST['section_name_edit']);
    }
    
    if(!empty($_POST['subject_name_edit'])){
        $subject_name_edit = mysqli_real_escape_string($conn, $_POST['subject_name_edit']);
    }
    
    if(!empty($_POST['id_name_edit'])){
        $id_name_edit = mysqli_real_escape_string($conn, $_POST['id_name_edit']);
    }
    
    if(!empty($_POST['teacher_name_edit'])){
        $teacher_name_edit = mysqli_real_escape_string($conn, $_POST['teacher_name_edit']);
    }
    
    if(!empty($_POST['password_edit'])){
        $password_edit = mysqli_real_escape_string($conn, $_POST['password_edit']);
        $passToDB = password_hash($password_edit, PASSWORD_DEFAULT);
    }
    
    if(!empty($_POST['confirm_password_edit'])){
        $confirm_password_edit = mysqli_real_escape_string($conn, $_POST['confirm_password_edit']);
    }

    $sql = "SELECT `classid` FROM `class` WHERE `classnumber` = '$class_name_edit'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    if($password_edit == $confirm_password_edit){
        $sql = "UPDATE `teacher` SET `teacherid`='$id_name_edit',`teachername`='$teacher_name_edit',`teacherpassword`='$passToDB',`classid`='$class_id',`sectionid`='$section_name_edit',`subjectid`='$subject_name_edit' WHERE `teacherid` = '$id_name_edit'";
        mysqli_query($conn, $sql);
    }
    else{
        $message = "Passwords do not match!";
    }
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_teacher_delete']))){

    if(!empty($_POST['class_name_edit'])){
        $class_name_edit = mysqli_real_escape_string($conn, $_POST['class_name_edit']);
    }
    
    if(!empty($_POST['section_name_edit'])){
        $section_name_edit = mysqli_real_escape_string($conn, $_POST['section_name_edit']);
    }
    
    if(!empty($_POST['subject_name_edit'])){
        $subject_name_edit = mysqli_real_escape_string($conn, $_POST['subject_name_edit']);
    }
    
    if(!empty($_POST['id_name_edit'])){
        $id_name_edit = mysqli_real_escape_string($conn, $_POST['id_name_edit']);
    }

    $sql = "DELETE FROM `teacher` WHERE `teacherid` = '$id_name_edit'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM `user` WHERE `userid` = '$id_name_edit'";
    mysqli_query($conn, $sql);

    $sqlCheckTeacher = "SELECT * FROM `teacher` WHERE teacherid LIKE '________03' ORDER BY `teacherid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckTeacher);
    while($row = mysqli_fetch_assoc($result)){
        $create_teacher_id = $row['teacherid'];
    }
    list($new_teacher_id1, $new_teacher_id2, $new_teacher_id3) = explode('-',$create_teacher_id);

    $new_teacher_id2 = sprintf('%04d', $new_teacher_id2 + 1);;

    $new_teacher_id = $new_teacher_id1."-".$new_teacher_id2."-".$new_teacher_id3;
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
        function create_teacher(){
            document.getElementById('edit_teacher_form').style.display = 'none';
            document.getElementById('create_teacher_form').style.display = 'block';
            document.getElementById('edit_teacher').style.backgroundColor = '#fff';
            document.getElementById('create_teacher').style.backgroundColor = '#a7cde8';
        }
        function edit_teacher(){
            document.getElementById('create_teacher_form').style.display = 'none';
            document.getElementById('edit_teacher_form').style.display = 'block';
            document.getElementById('edit_teacher').style.backgroundColor = '#a7cde8';
            document.getElementById('create_teacher').style.backgroundColor = '#fff';
        }
        $(document).ready(function(){
            $('#class_teacher_select').on('change', function(){
                $('#get_section_create').load('create_teacher_section_load.php',{class_name: document.getElementById('class_teacher_select').value});
                $('#get_subject_create').load('create_teacher_subject_load.php',{class_name: document.getElementById('class_teacher_select').value});
            });
            $('#class_name_edit').on('change', function(){
                $('#get_section_edit').load('edit_teacher_section_load.php',{class_name: document.getElementById('class_name_edit').value});
                $('#get_subject_edit').load('edit_teacher_subject_load.php',{class_name: document.getElementById('class_name_edit').value});
            });
            $('#edit_teacher_form').on('change','#subject_name_edit_2', function(){
                $('#get_teacher').load('edit_teacher_teacher_load.php',{class_name: document.getElementById('class_name_edit').value, section_id: document.getElementById('section_name_edit_2').value, subject_id: document.getElementById('subject_name_edit_2').value});
            });
            $('#edit_teacher_form').on('change','#id_name_edit_2', function(){
                $('#get_teacher_name').load('edit_teacher_name_load.php',{teacher_id: document.getElementById('id_name_edit_2').value});
            });
        });
        $(function() {
            $('#man_teacher_update').click(function() {
                $("#password_edit").prop('required', true);
                $("#confirm_password_edit").prop('required', true);
            });
            $('#man_teacher_delete').click(function() {
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
                    <div id="manage_teacher">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Manage Teachers</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Edit Teacher" name="edit_teacher" id="edit_teacher" style="background-color: #a7cde8;" onclick="edit_teacher()">
                                <input type="button" value="Create Teacher" name="create_teacher" id="create_teacher" onclick="create_teacher()"> 
                            </div>
                            <div class="edit_teacher" id="edit_teacher_form">
                                <form action="manage_teacher.php" method="post">
                                    
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
                                            <td><label for="">Select Subject:</label></td>
                                            <td id="get_subject_edit">
                                                <select name="subject_name_edit" required>
                                                    <option value="" selected disabled>Select Subject</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Teacher ID:</label></td>
                                            <td id="get_teacher">
                                                <select name="id_name_edit" required>
                                                    <option value="" selected disabled>Select id</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Teacher Name:</label></td>
                                            <td id="get_teacher_name">
                                                <input type="text" name="teacher_name_edit" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Password:</label></td>
                                            <td><input type="text" name="password_edit" id="password_edit"></td> 
                                        </tr>
                                        <tr>
                                            <td><label for="">Confirm Password:</label></td>
                                            <td><input type="text" name="confirm_password_edit" id="confirm_password_edit"></td> 
                                        </tr>
                                    </table>
                                    <br>
                                    
                                    <input type="submit" value="Update" name="man_teacher_update" id="man_teacher_update">
                                    <input type="submit" value="Delete" name="man_teacher_delete" id="man_teacher_delete">
                                </form>
                            </div>
                            <div class="create_teacher" id="create_teacher_form" style="display: none;">
                                <form action="manage_teacher.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td style="min-width: 150px;"><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_teacher_create" id="class_teacher_select" required>
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
                                            <td style="min-width: 170px;"><label for="">Teacher ID:</label></td>
                                            <td>
                                                <input type="text" name="teacher_id_create" value="<?php echo $new_teacher_id; ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select Section:</label></td>
                                            <td id="get_section_create">
                                                <select name="section_name_create" required>
                                                    <option value="" selected disabled>Select Section</option>
                                                </select>
                                            </td>
                                            <td ></td>
                                            <td><label for="">Teacher name:</label></td>
                                            <td><input type="text" name="teacher_name_create" required></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select Subject:</label></td>
                                            <td id="get_subject_create">
                                                <select name="subject_name_create" required>
                                                    <option value="" selected disabled>Select Subject</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td><label for="">Password:</label></td>
                                            <td>
                                                <input type="text" name="password_create">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><label  for="">Confirm Password:</label></td>
                                            <td>
                                                <input type="text" name="confirm_password_create">
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <?php echo $message;?>
                                    <br>
                                    <input type="submit" value="Create" name="man_teacher_create">
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
