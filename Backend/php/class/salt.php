<?php
class salt {

  public function verifySalts($saltName, $salt){
    if ($_SESSION["salt"][$saltName] == $salt) {
      unset($_SESSION["salt"][$saltName]);
      return true;
    }
  }

  public function generatSalt($saltName){
    $_SESSION["salt"][$saltName] = uniqid(mt_rand(), true);
    return $_SESSION["salt"][$saltName];
  }

}

?>
