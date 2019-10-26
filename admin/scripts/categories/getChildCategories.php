<?php

require_once '../init.php';


$sql = "SELECT id,name FROM categories WHERE parent_id!=0";
$result = $conn->query($sql);

$dbdata = array();

while ( $row = $result->fetch_row())  {
    $dbdata []= $row;
}

$send = array("data"=>$dbdata);
echo json_encode($send);

$conn->close();
