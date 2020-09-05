<?php

include"includes/db_connect.inc.php";

if(isset($_POST['class_name'])){
    $class_name = $_POST['class_name'];
    $sql = "SELECT * from `class` WHERE `classnumber` = '$class_name'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $class_id = $row['classid'];
    }
  }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <input type="text" name="class_id_create" value="<?php echo $class_id;?>" readonly>
</body>
</html>