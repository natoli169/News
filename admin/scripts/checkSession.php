<?php
require_once 'init.php';

session_start();
if(isset($_SESSION["id"])){
    $stmt = $conn->prepare("SELECT first_name, last_name FROM user WHERE id = ?");

    $stmt->bind_param("i", $_SESSION["id"]);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_row();
    echo $row[0] . " " . $row[1];
    $stmt->close();
    $conn->close();

};

