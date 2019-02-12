
<?php
  if (!isset($_REQUEST["id"])) {
    require 'pages/controllpanel/categories/index.php';
  }else {
    require 'pages/controllpanel/categories/id.php';
  }
?>
