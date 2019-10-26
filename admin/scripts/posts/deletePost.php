<?php

require_once '../init.php';

$stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
$stmt->bind_param("i", $id);

$id = $_POST['id'];
$stmt->execute();

$stmt->close();
$conn->close();
