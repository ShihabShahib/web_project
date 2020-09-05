<?php

include"includes/db_connect.inc.php";

if(isset($_POST['subject_id'])){
    $class_name = $_POST['class_name'];
    $section_id = $_POST['section_id'];
    $subject_id = $_POST['subject_id'];

    $sql = "SELECT * from `class` WHERE `classnumber` = '$class_name'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }

    $sql2 = "SELECT * from `teacher` WHERE `classid` = '$class_id' AND `sectionid` = '$section_id' AND `subjectid` = '$subject_id'";
    $result2 = mysqli_query($conn, $sql2);
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <select name="id_name_edit" id="id_name_edit_2" required>
        <option value="" selected disabled>Select Teacher</option>
        <?php
        while ($row = mysqli_fetch_assoc($result2)){
        ?>
        <option value="<?php echo $row['teacherid'];?>"><?php echo $row['teacherid'];?></option>
        <?php
        }
        ?>
    </select>
</body>
</html>