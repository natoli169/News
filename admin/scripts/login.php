<?php

require_once 'init.php';
$stmt = $conn->prepare("SELECT id, password FROM user  WHERE email = ?");

$email = $_POST['email'];
$password = $_POST['password'];

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_row();
if(password_verify($password,$row[1])){
session_start();
$_SESSION["id"] = $row[0];
echo "logged";
}else{
    echo "failed";
}
$stmt->close();
$conn->close();
