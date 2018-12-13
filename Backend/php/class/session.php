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
  public function checkPrem($function, $page){
    for ($i=4; $i < count($_SESSION["new_permsys"]); $i++) {
      if ($_SESSION["new_permsys"][$i][0] == $page) {
        if (in_array($function, $_SESSION["new_permsys"][$i])) {
          return true;
        }
      }
    }
  }
  public function setTimeOut($function){
    $_SESSION["allow"][$function]["time"] = date('Y-m-d H:i:s', strtotime($stop_date . ' +5 minutes'));
    $_SESSION["allow"][$function];
  }
  public function validateTimeOut($function){
    if (isset($_SESSION["allow"][$function])) {
      if ($_SESSION["allow"][$function]["time"] > date('Y-m-d H:i:s')) {
        return true;
      }else {
        return false;
      }
    }else {
      return false;
    }
  }
}

?>
