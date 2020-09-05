<?php

session_start();

include"includes/db_connect.inc.php";

$dir = "";

if(isset($_POST['section_name_create'])){
    $class_id = $_POST['section_name_create'];

    $dir = "uploads/".$_SESSION["u_id"].$_POST['section_name_create'];

  }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        $sqlGetFiles = "SELECT * from `upload` where `directory` = '$dir'";
        $result = mysqli_query($conn, $sqlGetFiles);
        while($row = mysqli_fetch_assoc($result)){
            // $date_time = $row['datetime'];
            // $file_name = $row['filename'];
        ?>
        <tr>
            <td><?php echo $row['datetime']?></td>
            <td><a href="<?php echo $dir."/".$row['filename']?>" download><?php echo $row['filename']?></a></td>
            <td><input class="deletebox" type="checkbox" name="filename" value="<?php echo $row['filename']; ?>"></td>
        </tr>
        <?php
        }
        ?>
</body>
</html>