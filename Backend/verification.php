<?php

session_start();
require_once 'php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("reset password", "accounts")) {
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>
        <form class="" action="script/pages/accounts/pwdchange.php" method="post">
          <input type="password" name="returncode" value="">
          <input type="text" name="code" value="<?php echo $_REQUEST["code"]; ?>" hidden>
          <input type="text" name="uid" value="<?php echo $_REQUEST["uid"]; ?>" hidden>
          <input type="text" name="cr" value="<?php echo $_REQUEST["cr"]; ?>" hidden>
          <input type="text" name="id" value="<?php echo $_REQUEST["id"]; ?>" hidden>
          <input type="submit" name="" value="Submit">
        </form>
      </body>
    </html>
    <?php
  }
}else {
  echo "string";
}
?>
