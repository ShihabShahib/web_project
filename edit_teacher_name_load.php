<?php

include"includes/db_connect.inc.php";

if(isset($_POST['teacher_id'])){
    $teacher_id = $_POST['teacher_id'];

    $sql = "SELECT * from `teacher` WHERE `teacherid` = '$teacher_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $teacher_name = $row['teachername'];
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <input type="text" name="teacher_name_edit" value="<?php echo $teacher_name; ?>" required>
</body>
</html>