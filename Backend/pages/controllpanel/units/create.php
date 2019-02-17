<?php
if (isset($_REQUEST["units"])) {
  require 'pages/controllpanel/units/units/create.php';
}
if (isset($_REQUEST["prefix"])) {
  require 'pages/controllpanel/units/prefix/create.php';
}
?>
