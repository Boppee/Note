<?php
$perms = array("dashboard","settings","logout","myaccount", array('account', 'list', 'resetpassword', 'create', 'mod'));

echo json_encode($perms);
echo "<br>";
$e = json_decode('{"0":"dashboard","1":"settings","2":"logout","3":"myaccount","accounts":["list","resetpassword","create","mod"]}', true);
print_r($e);
echo $e[0];
?>
