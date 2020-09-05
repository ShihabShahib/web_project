<?php

include"includes/db_connect.inc.php";

if(isset($_POST['class_id'])){
    $class_id = $_POST['class_id'];
    $sql = "SELECT * from `section` WHERE `classid` = '$class_id'";
    $result = mysqli_query($conn, $sql);
  }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <select name="section_name_edit" required>
        <option value="" selected disabled>Select Section</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)){
        ?>
        <option value="<?php echo $row['sectionid'];?>"><?php echo $row['sectionname'];?></option>
        <?php
        }
        ?>
    </select>
</body>
</html>