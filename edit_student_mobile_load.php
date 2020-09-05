<?php

include"includes/db_connect.inc.php";

if(isset($_POST['student_id'])){
    $student_id = $_POST['student_id'];

    $sql = "SELECT * from `student` WHERE `studentid` = '$student_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $student_mobile = $row['studentmobile'];
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <input type="text" name="student_mobile_edit" value="<?php echo $student_mobile; ?>" required>
</body>
</html>