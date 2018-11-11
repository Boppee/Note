<?php
class salt {

  public function generatSalt($saltName){
    $_SESSION["salt"][$saltName] = uniqid(mt_rand(), true);
    return $_SESSION["salt"][$saltName];
  }
  public function verifySalt($saltName, $salt){
    if ($_SESSION["salt"][$saltName] == $salt) {
      return true;
    }
  }

}

?>
