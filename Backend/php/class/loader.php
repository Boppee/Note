<?php
require 'encode.php';
class pageLoader {

  public $page;
  private $enc;
  private $session;

  function __construct(){

     $this->enc = new encoder("public");
     //gets a session iv for encoding session vars
     if (!isset($_SESSION["iv"])) {
       $_SESSION["iv"] = $this->enc->generatIv();
     }

    //check so you are on a page
    $this->page = strtolower($_REQUEST["page"]);
    if (!isset($this->page)) {
      $this->goToPage("?page=login");
    }

    $this->pageControll();

    //destroy attempts
    unset($_SESSION["loginAttempt"]);
    unset($_SESSION["logincaptcha"]);

  }
  //http_redirect
  public function goToPage($url){
    header('Location: '.$url);
    exit;
  }

  public function pageControll(){
    if (!isset($_SESSION["signedIn"])) {

      $_SESSION["perms"]["pages"] = array("login", "cookies");
      $_SESSION["perms"]["perms"] = array("login");

      if (!in_array($this->page, $_SESSION["perms"]["pages"])) {
        $this->goToPage("?page=".$_SESSION["perms"]["pages"][0]);
      }

    }else if (isset($_SESSION["signedIn"])){

      if (!in_array($this->page, $_SESSION["perms"]["pages"])) {
        $this->goToPage("?page=".$_SESSION["perms"]["pages"][0]);
      }

      updateLogon($this->enc->decode($_SESSION["cred"]["uid"],$_SESSION["iv"]));
    }
    $_SESSION["page"] = $this->page;
  }
  public function controllSession(){
    if (isset($_SESSION["signedIn"])) {
      $session = new session();
      if (!$session->verify()) {
        $this->goToPage("?page=logout");
      }
    }
  }

}
?>
