<?php

session_start();

include"includes/db_connect.inc.php";

if(!isset($_SESSION["u_id"])){
    header("Location: login.php");
}
else{
    $userid = $_SESSION["u_id"];
    $type_check3 = substr_compare($userid,"03",8);
    if($type_check3 != 0){
        session_unset();
        header("Location: login.php");
    }
} 

$message = "";

//$dir = "uploads/".$_SESSION["u_id"].$_POST['section_name_create'];

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal</title>
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
        function create_notes(){
            document.getElementById('edit_notes_form').style.display = 'none';
            document.getElementById('create_notes_form').style.display = 'block';
            document.getElementById('edit_notes').style.backgroundColor = '#fff';
            document.getElementById('create_notes').style.backgroundColor = '#a7cde8';
        }
        function edit_notes(){
            document.getElementById('create_notes_form').style.display = 'none';
            document.getElementById('edit_notes_form').style.display = 'block';
            document.getElementById('edit_notes').style.backgroundColor = '#a7cde8';
            document.getElementById('create_notes').style.backgroundColor = '#fff';
        }
        $(document).ready(function(){
            $('#class_name_create').on('change', function(){
                $('#get_section_create').load('create_notes_section_load.php',{class_id: document.getElementById('class_name_create').value});
            });
            $('#class_name_edit').on('change', function(){
                $('#get_section_edit').load('edit_notes_section_load.php',{class_id: document.getElementById('class_name_edit').value});
            });
            $('#edit_notes_form').on('change','#section_name_edit_2', function(){
                $('#get_files').load('edit_notes_file_load.php',{section_name_create: document.getElementById('section_name_edit_2').value});
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
                                    <li><a href="manage_notes.php">Manage Notes</a></li>
                                    <li><a href="sample.html">Manage Notice</a></li>
                                    <li><a href="sample.html">Manage Assignment</a></li>
                                    <li><a href="sample.html">Manage Grades</a></li>
                                    <li><a href="sample.html">Manage Routine</a></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <section>
                    <div id="manage_notes">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Teacher Portal</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Edit Notes" name="edit_notes" id="edit_notes" style="background-color: #a7cde8;" onclick="edit_notes()">
                                <input type="button" value="Upload Notes" name="create_notes" id="create_notes" onclick="create_notes()"> 
                            </div>
                            <div class="edit_notes" id="edit_notes_form">
                                <form action="delete_notes.php" method="post">
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_name_edit" id="class_name_edit" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    <?php
                                                    $query = "SELECT `classid` FROM `teacher` WHERE `teacherid` = '".$_SESSION["u_id"]."'";
                                                    echo $query;
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)){
                                                        $class_id = $row['classid'];
                                                    }
                                                    $query = "SELECT * FROM `class` WHERE `classid` = '$class_id'";
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
                                            <td id="get_section_edit">
                                                <select name="section_name_edit" required>
                                                    <option value="" selected disabled>Select Section</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table style="text-align: center; background-color: #b6c2ff;">
                                        <thead>
                                            <td style="min-width: 220px; font-weight: 500;">Uploaded At</td>
                                            <td style="min-width: 220px; font-weight: 500;">Filename</td>
                                            <td style="min-width: 220px;"></td>
                                        </thead>
                                        <tbody id="get_files">
                                            
                                        </tbody>
                                    </table>
                                    <br>
        
                                    <input type="submit" value="Delete" name="man_notes_delete">
                                </form>
                            </div>
                            <div class="create_notes" id="create_notes_form" style="display: none;">
                                <form action="upload_notes.php" method="post" enctype="multipart/form-data">
                                    <br>
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_name_create" id="class_name_create" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    <?php
                                                    $query = "SELECT `classid` FROM `teacher` WHERE `teacherid` = '".$_SESSION["u_id"]."'";
                                                    echo $query;
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)){
                                                        $class_id = $row['classid'];
                                                    }
                                                    $query = "SELECT * FROM `class` WHERE `classid` = '$class_id'";
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
                                            <td id="get_section_create">
                                                <select name="section_name_create" required>
                                                    <option value="" selected disabled>Select Section</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Select file:</label></td>
                                            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <?php echo $message;?>
                                    
                                    <br>
                                    <input type="submit" value="Upload" name="man_teacher_create">
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

