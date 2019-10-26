<?php
require_once '../init.php';
$stmt = $conn->prepare("INSERT INTO posts (title, author,time,body,img,category,headline) VALUES (?,?,NOW(),?,?,?,?)");

//File Upload Variables
$img = "none";
if(isset($_FILES["fileToUpload"]["name"])) {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $file_ext = end(explode(".", $file_name));
    $img = date("h-i-s") . "_" . md5($file_name) . "." . $file_ext;
    $target_file = $target_dir . $img;
    $uploadOk = 1;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
}
$title = $_POST['title'];
$author = $_POST['author'];
$body = $_POST['body'];
$headline = $_POST['headline'];
$category = $_POST['category'];
$stmt->bind_param("ssssis", $title, $author, $body, $img,$category, $headline);
$stmt->execute();


$stmt->close();
$conn->close();
