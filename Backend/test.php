<?php

$credArray = array('test' => 1, 'test'=>'appa');
$_SESSION["signedIn"] = true;

$_SESSION["cred"] = $credArray;

print_r($_SESSION);
?>
