<?php

include"includes/db_connect.inc.php";

if(isset($_POST['class_name'])){
    $class_name = $_POST['class_name'];
    $sql = "SELECT * from `class` WHERE `classnumber` = '$class_name'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    $sql2 = "SELECT * from `subject` WHERE `classid` = '$class_id'";
    $result2 = mysqli_query($conn, $sql2);
  }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <select name="subject_name_edit" id="subject_name_edit_2" required>
        <option value="" selected disabled>Select Subject</option>
        <?php
        while ($row = mysqli_fetch_assoc($result2)){
        ?>
        <option value="<?php echo $row['subjectid'];?>"><?php echo $row['subjectname'];?></option>
        <?php
        }
        ?>
    </select>
</body>
</html>