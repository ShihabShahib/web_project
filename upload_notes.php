<?php

session_start();

if(!isset($_SESSION["u_id"])){
  header("Location: login.php");
}

include"includes/db_connect.inc.php";

$dir = "uploads/".$_SESSION["u_id"].$_POST['section_name_create'];

try
  {
    mkdir("$dir");
  }
  catch (SomeException $e)
  {
      // do nothing... php will ignore and continue
  }

$target_dir = $dir."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is larger than 5MB.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "docx" && $imageFileType != "doc" && $imageFileType != "txt" && $imageFileType != "pptx" && $imageFileType != "ppt"
&& $imageFileType != "pdf" ) {
  echo "Sorry, only DOCX, DOC, TXT, PPT, PPTX and PDF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
    $upload_date = date('Y-m-d H:i:s');
    $file_name_upload = $_FILES["fileToUpload"]["name"];

    $sql = "INSERT INTO `upload`(`directory`, `filename`, `datetime`) VALUES ('$dir','$file_name_upload','$upload_date')";
    mysqli_query($conn, $sql);

    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Please wait for re-direct...";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>