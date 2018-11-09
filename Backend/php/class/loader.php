<?php
require 'encode.php';
class pageLoader {

  public $page;
  private $enc;

  function __construct(){
    //session_destroy();

     $this->enc = new encoder("public");
     if (!isset($_SESSION["iv"])) {
       $_SESSION["iv"] = $this->enc->generatIv();
     }

    //check so you are on a page
    $this->page = strtolower($_REQUEST["page"]);
    if (!isset($this->page)) {
      $this->goToPage("?page=login");
    }

    if (!isset($_SESSION["signedIn"])) {
      $_SESSION["perms"]["pages"] = array("login", "cookies", "errors");
      $_SESSION["perms"]["perms"] = array("login");
      if (!in_array($this->page, $_SESSION["perms"]["pages"])) {
        $this->goToPage("?page=".$_SESSION["perms"]["pages"][0]);
      }
    }else if (isset($_SESSION["signedIn"])){
      if (!in_array($this->page, $_SESSION)) {
        $this->goToPage("?page=".$_SESSION["perms"]["pages"][0]);
      }
    }

    unset($_SESSION["loginAttempt"]);
    unset($_SESSION["logincaptcha"]);

    print_r($_SESSION);

  }
  //http_redirect
  public function goToPage($url){
    header('Location: '.$url);
    exit;
  }

  public function salt(){
    $_SESSION["salt"] = uniqid(mt_rand(), true);
  }
}
?>
