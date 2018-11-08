<?php
require 'encode.php';
class pageLoader {

  public $page;
  private $enc;

  function __construct(){
    //session_destroy();

     $this->enc = new encoder("public");
     if (!isset($_SESSION["iv"])) {
       $this->enc->generatIv();
     }

    //check so you are on a page
    $this->page = strtolower($_REQUEST["page"]);
    if (!isset($this->page)) {
      $this->goToPage("?page=login");
    }

    unset($_SESSION["loginAttempt"]);

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
