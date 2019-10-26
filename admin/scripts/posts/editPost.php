<?php
require_once '../init.php';


$stmt = null;

//File Upload Variables
$img = null;
if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] != "") {
    $stmt = $conn->prepare("UPDATE posts SET title = ?,author = ?,category = ?,headline =?,body = ?,img = ? WHERE id=?");
    $stmt->bind_param("ssisssi", $title, $author, $category, $headline, $body,$img, $id);
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
}else{
    $stmt = $conn->prepare("UPDATE posts SET title = ?,author = ?,category = ?,headline =?,body = ? WHERE id=?");
    $stmt->bind_param("ssissi", $title, $author, $category, $headline, $body, $id);
}



$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];
$headline = $_POST['headline'];
$body = $_POST['body'];
$id = $_POST['id'];



$stmt->execute();
$stmt->close();
$conn->close();
