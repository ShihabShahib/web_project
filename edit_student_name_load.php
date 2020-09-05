<?php

include"includes/db_connect.inc.php";

if(isset($_POST['student_id'])){
    $student_id = $_POST['student_id'];

    $sql = "SELECT * from `student` WHERE `studentid` = '$student_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $student_name = $row['studentname'];
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <input type="text" name="student_name_edit" value="<?php echo $student_name; ?>" required>
</body>
</html>