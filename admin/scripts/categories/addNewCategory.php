<?php
require_once '../init.php';

$stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");


//echo $_POST['category_name'];
$name = $_POST['category_name'];
$parent = $_POST['parent'];
$stmt->bind_param("si", $name, $parent);
$stmt->execute();


$stmt->close();
$conn->close();
