<?php

include"includes/db_connect.inc.php";

if(isset($_POST['class_id'])){
    $class_id = $_POST['class_id'];

    $sql2 = "SELECT * from `section` WHERE `classid` = '$class_id'";
    $result2 = mysqli_query($conn, $sql2);
  }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <select name="section_name_create" id="section_name_create_2" required>
        <option value="" selected disabled>Select Section</option>
        <?php
        while ($row = mysqli_fetch_assoc($result2)){
        ?>
        <option value="<?php echo $row['sectionid'];?>"><?php echo $row['sectionname'];?></option>
        <?php
        }
        ?>
    </select>
</body>
</html>