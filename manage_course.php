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

$message = $subject_id_edit = "";

$sqlCheckSubject = "SELECT `subjectid` FROM `subject` ORDER BY `subjectid` DESC LIMIT 1";
$result = mysqli_query($conn, $sqlCheckSubject);
while($row = mysqli_fetch_assoc($result)){
    $create_subject_id = $row['subjectid'];
}

$create_subject_id = $create_subject_id + 1;


if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_course_update']))){

    if(!empty($_POST['class_edit'])){
        $class_edit = mysqli_real_escape_string($conn, $_POST['class_edit']);
    }
    
    if(!empty($_POST['subject_name_edit'])){
        $subject_name_edit = mysqli_real_escape_string($conn, $_POST['subject_name_edit']);
    }
    
    if(!empty($_POST['subject_id_edit'])){
        $subject_id_edit = mysqli_real_escape_string($conn, $_POST['subject_id_edit']);
    }
    
    if(!empty($_POST['subject_name_edit'])){
        $subject_name_edit = mysqli_real_escape_string($conn, $_POST['subject_name_edit']);
    }

    $sql = "UPDATE `subject` SET `subjectname`= '$subject_name_edit' WHERE `subjectid` = '$subject_id_edit'"; 
    mysqli_query($conn, $sql);
}


if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_course_create']))){

    if(!empty($_POST['class_course_create'])){
        $class_course_create = mysqli_real_escape_string($conn, $_POST['class_course_create']);
    }
    
    if(!empty($_POST['subject_id_create'])){
        $subject_id_create = mysqli_real_escape_string($conn, $_POST['subject_id_create']);
    }

    if(!empty($_POST['subject_name_create'])){
        $subject_name_create = mysqli_real_escape_string($conn, $_POST['subject_name_create']);
    }

    $sql = "SELECT * from `class` WHERE `classnumber` = '$class_course_create'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    $sqlchecksubject = "SELECT * FROM `subject` WHERE `classid` = '$class_id' AND `subjectname` = '$subject_name_create'";
    $result = mysqli_query($conn, $sqlchecksubject);
    $rowCount = mysqli_num_rows($result);
    if($rowCount >= 1){
        $message = "Subject is already present!";
    }
    else{
        $sql2 = "INSERT INTO `subject`(`subjectid`, `subjectname`, `classid`) VALUES ('$subject_id_create','$subject_name_create','$class_id')";
        mysqli_query($conn, $sql2);
    }
    
    $sqlCheckSubject = "SELECT `subjectid` FROM `subject` ORDER BY `subjectid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckSubject);
    while($row = mysqli_fetch_assoc($result)){
        $create_subject_id = $row['subjectid'];
    }

    $create_subject_id = $create_subject_id + 1;
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_course_delete']))){
    
    if(!empty($_POST['class_edit'])){
        $class_edit = mysqli_real_escape_string($conn, $_POST['class_edit']);
    }
    
    if(!empty($_POST['subject_id_edit'])){
        $subject_id_edit = mysqli_real_escape_string($conn, $_POST['subject_id_edit']);
    }

    $sql = "DELETE FROM `subject` WHERE `subjectid` = '$subject_id_edit'";
    mysqli_query($conn, $sql);

    $sqlCheckSubject = "SELECT `subjectid` FROM `subject` ORDER BY `subjectid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckSubject);
    while($row = mysqli_fetch_assoc($result)){
        $create_subject_id = $row['subjectid'];
    }

    $create_subject_id = $create_subject_id + 1;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
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
        function create_course(){
            document.getElementById('edit_course_form').style.display = 'none';
            document.getElementById('create_course_form').style.display = 'block';
            document.getElementById('edit_course').style.backgroundColor = '#fff';
            document.getElementById('create_course').style.backgroundColor = '#a7cde8';
        }
        function edit_course(){
            document.getElementById('create_course_form').style.display = 'none';
            document.getElementById('edit_course_form').style.display = 'block';
            document.getElementById('edit_course').style.backgroundColor = '#a7cde8';
            document.getElementById('create_course').style.backgroundColor = '#fff';
        }
        $(document).ready(function(){
            $('#class_edit').on('change', function(){
                $('#get_subject').load('edit_course_load.php',{class_name: document.getElementById('class_edit').value});
            });
            $('#edit_course_form').on('change','table, tr, td, select', function(){
                $('#get_subject_id').load('subject_id_load.php',{subject_id: document.getElementById('subject_name_edit_2').value});
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
                    <div id="manage_course">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Manage Academic Courses</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Edit Course" name="edit_course" id="edit_course" style="background-color: #a7cde8;" onclick="edit_course()">
                                <input type="button" value="Create Course" name="create_course" id="create_course" onclick="create_course()"> 
                            </div>
                            <div class="edit_course" id="edit_course_form">
                                <form action="manage_course.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_edit" id="class_edit" required>
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
                                            <td><label for="">Select Subject:</label></td>
                                            <td id="get_subject">
                                                <select name="subject_name_edit" id="subject_name_edit" required>
                                                    <option value="" selected disabled>Select Subject</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Subject id:</label></td>
                                            <td id="get_subject_id">
                                                <input type="text" name="subject_id_edit" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Subject Name:</label></td>
                                            <td><input type="text" name="subject_name_edit"></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <input type="submit" value="Update" name="man_course_update">
                                    <input type="submit" value="Delete" name="man_course_delete">
                                </form>
                            </div>
                            <div class="create_course" id="create_course_form" style="display: none;">
                                <form action="manage_course.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_course_create" id="class_course_select" required>
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
                                            <td><label for="">Subject id:</label></td>
                                            <td><input type="text" name="subject_id_create" value="<?php echo $create_subject_id; ?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Subject Name:</label></td>
                                            <td><input type="text" name="subject_name_create" required></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <?php echo $message;?>
                                    <br>
                                    <input type="submit" value="Create" name="man_course_create">
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