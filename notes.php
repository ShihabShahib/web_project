<?php

session_start();

include"includes/db_connect.inc.php";

$message = "";

if(!isset($_SESSION["u_id"])){
    header("Location: login.php");
}
else{
    $userid = $_SESSION["u_id"];
    $type_check4 = substr_compare($userid,"04",8);
    if($type_check4 != 0){
        session_unset();
        header("Location: login.php");
    }
} 

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
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
            $('#class_name_download').on('change', function(){
                $('#get_section_download').load('download_notes_section_load.php',{class_id: document.getElementById('class_name_download').value});
            });
            $('#download_notes_form').on('change','#section_name_download_2', function(){
                $('#get_files').load('download_notes_file_load.php',{section_name_download: document.getElementById('section_name_download_2').value});
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
                                    <li><a href="notes.php">Notes</a></li>
                                    <li><a href="sample.html">Notices</a></li>
                                    <li><a href="sample.html">Grades</a></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                    <li><label for="" style="visibility: hidden;">a</label></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <section>
                    <div id="notes">
                        <div class="col-md-1"></div>
                        <div class="col-md-6" style="max-width: 100%; padding: 30px;">
                            <h3>Student Portal</h3><br><br>
                            <div class="man_type">
                                <input type="button" value="Download Notes" name="download_notes" id="download_notes" style="background-color: #a7cde8;">
                            </div>
                            <div class="download_notes" id="download_notes_form">
                                <form action="" method="">
                                    <table>
                                        <tr>
                                            <td><label for="">Select Class:</label></td>
                                            <td>
                                                <select name="class_name_download" id="class_name_download" required>
                                                    <option value="" selected disabled>Select Class</option>
                                                    <?php
                                                    $query = "SELECT `classid` FROM `student` WHERE `studentid` = '".$_SESSION["u_id"]."'";
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
                                            <td id="get_section_download">
                                                <select name="section_name_download" required>
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
                                        </thead>
                                        <tbody id="get_files">
                                            
                                        </tbody>
                                    </table>
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