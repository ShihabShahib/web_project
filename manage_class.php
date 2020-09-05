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

$message = $result = $edit_class_id = $class_name_edit = $section_name_edit = $class_edit = $section_edit = $sql = $sql2 = $class_id_create = $class_create = $section_id_create = $name_section_create = $sqlchecksection = $sqlCheckClass = $create_class_id = $sqlCheckSection = $create_section_id = $section_present = $sec_name = $flag = "";

$sqlCheckSection = "SELECT `sectionid` FROM `section` ORDER BY `sectionid` DESC LIMIT 1";
$result = mysqli_query($conn, $sqlCheckSection);
while($row = mysqli_fetch_assoc($result)){
    $create_section_id = $row['sectionid'];
}

$create_section_id = $create_section_id + 1;

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_class_update']))){

    if(!empty($_POST['class_name_edit'])){
        $class_name_edit = mysqli_real_escape_string($conn, $_POST['class_name_edit']);
    }
    
    if(!empty($_POST['section_name_edit'])){
        $section_name_edit = mysqli_real_escape_string($conn, $_POST['section_name_edit']);
    }
    
    if(!empty($_POST['class_edit'])){
        $class_edit = mysqli_real_escape_string($conn, $_POST['class_edit']);
    }
    
    if(!empty($_POST['section_edit'])){
        $section_edit = mysqli_real_escape_string($conn, $_POST['section_edit']);
    }

    $sql = "UPDATE `section` SET `classid`= (SELECT classid FROM `class` WHERE `classnumber` = '$class_edit') WHERE `classid` = '$class_name_edit' AND `sectionid` = '$section_name_edit'"; 
    $sql2 = "UPDATE `section` SET `sectionname`= '$section_edit' WHERE `sectionid` = '$section_name_edit'"; 
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql2);
}

if(($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST['man_class_create']))){

    if(!empty($_POST['class_id_create'])){
        $class_id_create = mysqli_real_escape_string($conn, $_POST['class_id_create']);
    }
    
    if(!empty($_POST['class_create'])){
        $class_create = mysqli_real_escape_string($conn, $_POST['class_create']);
    }
    
    if(!empty($_POST['section_id_create'])){
        $section_id_create = mysqli_real_escape_string($conn, $_POST['section_id_create']);
    }
    
    if(!empty($_POST['name_section_create'])){
        $name_section_create = mysqli_real_escape_string($conn, $_POST['name_section_create']);
    }

    $sqlchecksection = "SELECT * FROM `section` WHERE `classid` = '$class_id_create' AND `sectionname` = '$name_section_create'";
    $result = mysqli_query($conn, $sqlchecksection);
    $rowCount = mysqli_num_rows($result);
    
    if($rowCount >= 1){
        $message = "Section is already present!";
    }
    else{
        $sql2 = "INSERT INTO `section`(`sectionid`, `sectionname`, `classid`) VALUES ('$section_id_create','$name_section_create','$class_id_create')";
        mysqli_query($conn, $sql2);
    }
    $sqlCheckSection = "SELECT `sectionid` FROM `section` ORDER BY `sectionid` DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlCheckSection);
    while($row = mysqli_fetch_assoc($result)){
    $create_section_id = $row['sectionid'];
    }

    $create_section_id = $create_section_id + 1;
    
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
        function create_class(){
            document.getElementById('edit_class_form').style.display = 'none';
            document.getElementById('create_class_form').style.display = 'block';
            document.getElementById('edit_class').style.backgroundColor = '#fff';
            document.getElementById('create_class').style.backgroundColor = '#a7cde8';
        }
        function edit_class(){
            document.getElementById('create_class_form').style.display = 'none';
            document.getElementById('edit_class_form').style.display = 'block';
            document.getElementById('edit_class').style.backgroundColor = '#a7cde8';
            document.getElementById('create_class').style.backgroundColor = '#fff';
        }
        $(document).ready(function(){
            $('#select_class').on('change', function(){
                $('#get_section').load('edit_class_load.php',{class_id: document.getElementById('select_class').value});
            });
        });
        $(document).ready(function(){
            $('#create_class_select').on('change', function(){
                $('#get_class').load('create_class_load.php',{class_name: document.getElementById('create_class_select').value});
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
                    <div id="manage_class">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Manage Academic Classes</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Edit Class" name="edit_class" id="edit_class" style="background-color: #a7cde8;" onclick="edit_class()">
                                <input type="button" value="Create Class" name="create_class" id="create_class" onclick="create_class()"> 
                            </div>
                            <div class="edit_class" id="edit_class_form">
                                <form action="manage_class.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_name_edit" id="select_class" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    <?php
                                                    $query = "select * from `class`";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)){
                                                    ?>
                                                    <option value="<?php echo $row['classid'];?>"><?php echo $row['classnumber'];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select Section:</label></td>
                                            <td id="get_section">
                                                <select name="section_name_edit" required>
                                                    <option value="" selected disabled>Select Section</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Changed Value:</label></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Class:</label></td>
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
                                            <td><label for="">Section:</label></td>
                                            <td><input type="text" name="section_edit" required></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <input type="submit" value="Update" name="man_class_update">
                                </form>
                            </div>
                            <div class="create_class" id="create_class_form" style="display: none;">
                                <form action="manage_class.php" method="post">
                                    <br>
                                    <table>
                                        <tr>
                                            <td><label for="">Class:</label></td>
                                            <td>
                                                <select name="class_create" id="create_class_select">
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
                                            <td><label for="">Class id:</label></td>
                                            <td id="get_class"><input type="text" name="class_id_create" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Section id:</label></td>
                                            <td><input type="text" name="section_id_create" value="<?php echo $create_section_id; ?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Section:</label></td>
                                            <td><input type="text" name="name_section_create"></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <?php echo $message;?>
                                    <br>
                                    <input type="submit" value="Create" name="man_class_create">
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