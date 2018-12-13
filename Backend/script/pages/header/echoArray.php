<?php
  header('Content-type: application/json');
  session_start();
  $echo = array('pages' => $_SESSION["pages"], 'page' => $_SESSION["page"]);
  echo json_encode($echo);
?>
