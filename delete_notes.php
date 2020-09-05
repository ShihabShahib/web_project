<?php

session_start();

include"includes/db_connect.inc.php";

if(!isset($_SESSION["u_id"])){
    header("Location: login.php");
    }

$message = "";

$dir = "uploads/".$_SESSION["u_id"].$_POST['section_name_edit'];

unlink($dir."/".$_POST['filename']);

$file_name = $_POST['filename'];

$sql = "DELETE FROM `upload` WHERE `filename` = '$file_name' AND `directory` = '$dir'";
mysqli_query($conn, $sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>