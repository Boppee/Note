<script src="jquery.js" charset="utf-8"></script>
<?php
require_once 'php/load.php';
  $company = new company();
  session_start();
  print_r($_SESSION);
require_once 'pages/pageparts/header.php';
?>
