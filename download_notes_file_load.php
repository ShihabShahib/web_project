<?php

session_start();

include"includes/db_connect.inc.php";

$dir = $section_id_download = $teacher_id = "";

if(isset($_POST['section_name_download'])){
    $section_id_download = $_POST['section_name_download'];

    $sqlGetFiles = "SELECT * from `teacher` where `sectionid` = '$section_id_download'";
    $result = mysqli_query($conn, $sqlGetFiles);
    while($row = mysqli_fetch_assoc($result)){
        $teacher_id = $row['teacherid'];
    }    

    $dir = "uploads/".$teacher_id.$_POST['section_name_download'];

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
        ?>
        <tr>
            <td><?php echo $row['datetime']?></td>
            <td><a href="<?php echo $dir."/".$row['filename']?>" download><?php echo $row['filename']?></a></td>
        </tr>
        <?php
        }
        ?>
</body>
</html>