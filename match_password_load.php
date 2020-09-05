<?php

session_start();

include"includes/db_connect.inc.php";

$message = $user_id = "";


if(isset($_POST['new_pass'])){
    $new_pass = $_POST['new_pass'];
    
    if($new_pass == $_POST['c_new_pass']){
        $message = "Passwords match!";
    }
    else{
        $message = "Passwords do not match!";
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <label for=""><?php echo $message; ?></label>
</body>
</html>