<?php

include"includes/db_connect.inc.php";

if(isset($_POST['subject_id'])){
    $subject_id = $_POST['subject_id'];
  }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <input type="text" name="subject_id_edit" value="<?php echo $subject_id; ?>" readonly>
</body>
</html>