<?php
class session {

  private $enc;
  private $uid;
  private $pwd;

  function __construct(){
    $this->enc = new encoder("public");
    @session_start();
  }
  public function verify(){

    $this->uid = $this->enc->decode($_SESSION["cred"]["uid"],$_SESSION["iv"]);
    $this->pwd = $this->enc->decode($_SESSION["cred"]["pwd"],$_SESSION["iv"]);

    $userData = grabUserData($this->uid);
    if (password_verify($this->pwd, $userData["password"])) {
      return true;
    }
  }
  public function checkPrem($function){
    if (in_array($function, $_SESSION["perms"]["perms"])) {
      return true;
    }
  }
}

?>
