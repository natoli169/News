<?php
require_once '../init.php';

$stmt = $conn->prepare("SELECT id,title,author,time,category,headline,view,body,img FROM posts WHERE id = ?");
$stmt1 = $conn->prepare("SELECT name FROM categories WHERE id=?");
$stmt2 = $conn->prepare("UPDATE posts SET view = ? WHERE id=?");
$id = (int) $_GET["id"];
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();



$dbdata = array();


while ( $row = $result->fetch_row())  {
    $category_id = (int) $row[4];
    $stmt1->bind_param("i", $category_id);
    $stmt1->execute();
    $child_result = $stmt1->get_result();
    $category_name = "Not Found";
    while($child_row = $child_result->fetch_row()){
        $category_name = $child_row[0];
    }
    $new_view = $row[6] + 1;
    $stmt2->bind_param("ii",$new_view,$id);
    $stmt2->execute();
    $dbdata = array($row[0],$row[1],$row[2],$row[3],$category_name,$row[5],$new_view,$row[7],$row[8],$row[4]);
}

$send = array("data"=>$dbdata);
echo json_encode($send);

$conn->close();


