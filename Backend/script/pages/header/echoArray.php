<?php
  header('Content-type: application/json');
  session_start();
  $echo = array('pages' => $_SESSION["perms"]["pages"], 'page' => $_SESSION["page"]);
  echo json_encode($echo);
?>
