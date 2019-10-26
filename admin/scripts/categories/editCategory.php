<?php
require_once '../init.php';

$stmt = $conn->prepare("UPDATE categories SET name=?, parent_id=? WHERE id=?");
$stmt->bind_param("sii", $name,$parent, $id);

$name = $_POST['category_name'];
$parent = $_POST['parent'];
$id = $_POST['id'];


$stmt->execute();
$stmt->close();
$conn->close();

