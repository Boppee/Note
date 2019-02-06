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

    $this->newPageControll();

    //destroy attempts
    unset($_SESSION["loginAttempt"]);
    unset($_SESSION["logincaptcha"]);

  }
  //http_redirect
  public function goToPage($url){
    header('Location: '.$url);
    exit;
  }
  public function controllSession(){
    if (isset($_SESSION["signedIn"])) {
      $session = new session();
      if (!$session->verify()) {
        $this->goToPage("?page=logout");
      }
    }
  }
  function newPageControll() {
    if (isset($_SESSION["signedIn"])) {

      updateLogon($this->enc->decode($_SESSION["cred"]["uid"],$_SESSION["iv"]));

      if (!isset($_SESSION["pages"])) {
        $_SESSION["pages"] = array("dashboard","settings","logout","myaccount");
        for ($i=4; $i < count($_SESSION["new_permsys"]); $i++) {
          $temp = $_SESSION["new_permsys"][$i][0];
          array_push($_SESSION["pages"], $temp);
        }
      }

      if (!in_array($this->page, $_SESSION["pages"])) {
        $this->goToPage("?page=".$_SESSION["pages"][0]);
      }

    }else {
      $_SESSION["pages"] = array("login", "cookies");
      if (!in_array($this->page, $_SESSION["pages"])) {
        $this->goToPage("?page=".$_SESSION["pages"][0]);
      }
    }
    $_SESSION["page"] = $this->page;
  }

}
?>
