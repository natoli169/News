<?php
$target_dir = "uploads/";
$file_name = basename($_FILES["fileToUpload"]["name"]);
$file_ext = end(explode(".",$file_name));
$target_file = $target_dir . date("h-i-s") . "_" . md5($file_name) . "." .  $file_ext;
.
$uploadOk = 1;

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}