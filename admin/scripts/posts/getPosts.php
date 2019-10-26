<?php
require_once '../init.php';


$sql = "SELECT id,title,author,time,category,headline,view FROM posts";
$stmt = $conn->prepare("SELECT name FROM categories WHERE id=?");
$result = $conn->query($sql);

$dbdata = array();


while ( $row = $result->fetch_row())  {


    $id = (int) $row[4];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $child_result = $stmt->get_result();
    $category_name = "Not Found";
    while($child_row = $child_result->fetch_row()){
        $category_name = $child_row[0];
    }


    $dbdata []= array($row[0],$row[1],$row[2],$row[3],$category_name,$row[5],$row[6]);
}

$send = array("data"=>$dbdata);
echo json_encode($send);

$conn->close();

