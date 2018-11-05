<?php

  session_start();

  require 'php/load.php';

  $enc = new encoder("databas");
  $connect =  new connect();

  $connection = $connect->newConnectionPre("CreateAdminAccount");

?>
