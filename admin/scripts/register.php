<?php
require_once 'init.php';
$stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?,?,?,?)");
$stmt1 = $conn->prepare("SELECT id FROM user  WHERE email = ?");

$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$email = $_POST['email'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

$stmt1->bind_param("s",$email);
$stmt1->execute();
$result = $stmt1->get_result();
if($result->num_rows == 0){
    $stmt->bind_param("ssss", $first_name, $last_name, $email,$password);
    $stmt->execute();

    $stmt1->bind_param("s",$email);
    $stmt1->execute();

    $result = $stmt1->get_result();
    session_start();
    $_SESSION["id"] = $result->fetch_row()[0];
}else {
    echo "error";
}

$stmt->close();
$stmt1->close();
$conn->close();
