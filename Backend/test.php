<?php
require 'php/load.php';
$stop_date = date("Y-m-d H:i:s");
echo 'date before day adding: ' . $stop_date;
$stop_date = date('Y-m-d H:i:s', strtotime($stop_date . ' +10 minutes'));
echo 'date after adding 1 day: ' . $stop_date;
?>
