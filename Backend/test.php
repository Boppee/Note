<?php
header('Content-Type: application/json');
$arrayName = array(array('imgtype' => "jpg", "name" => "1"), array('imgtype' => "jpg", "name" => "pewdiepie"));
echo json_encode($arrayName);
?>
