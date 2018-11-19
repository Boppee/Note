<?php
  if (isset($_REQUEST["id"])) {
    include 'pages/controllpanel/accounts/account.php';
  }else {
    include 'pages/controllpanel/accounts/accounts.php';
  }
?>
