<?php
class salt {

  public function verifySalts($saltName, $salt){
    //validate the salt generated from generatSalt()
    if ($_SESSION["salt"][$saltName] == $salt) {
      unset($_SESSION["salt"][$saltName]);
      return true;
    }
  }

  public function generatSalt($saltName){
    //generat a salt to $_SESSION["salt"]
    $_SESSION["salt"][$saltName] = uniqid(mt_rand(), true);
    return $_SESSION["salt"][$saltName];
  }

}

?>
