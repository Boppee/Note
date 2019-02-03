<?php
header('Content-Type: application/json');
$arrayName = array(array('loc' => "emil", "am" => 11), array('loc' => "test", 'am' => "1"));
echo json_encode($arrayName);
?>
