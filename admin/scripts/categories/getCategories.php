<?php

require_once '../init.php';


$sql = "SELECT id,name,parent_id FROM categories WHERE parent_id=0";
$stmt = $conn->prepare("SELECT id,name,parent_id FROM categories WHERE parent_id=?");
$result = $conn->query($sql);

$dbdata = array();


while ( $row = $result->fetch_row())  {
    $dbdata []= $row;
    $id = (int) $row[0];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $child_result = $stmt->get_result();
    while($child_row = $child_result->fetch_row()){
        $dbdata []= $child_row;
    }

}

$send = array("data"=>$dbdata);
echo json_encode($send);

$stmt->close();
$conn->close();

