<?php
class pageLoader {

  public $page;
  public $companyName;

  function __construct(){

    //check so you are on a page
    $this->page = $_REQUEST["page"];
    if (!isset($this->page)) {
      $this->goToPage("?page=home");
    }

    if (!isset($_SESSION["pages"])) {
      $_SESSION["pages"] = array("errors");
    }

    //check if user have prems to this page
    if (!in_array($this->page, $_SESSION["pages"])) {
      if (isset($_SESSION["signedIn"])) {
        array_push($_SESSION["pages"], "dashboard");
        $this->goToPage("?page=dashboard");
      }else {
        array_push($_SESSION["pages"], "login");
        $this->goToPage("?page=login");
      }
    }

    if (isset($_SESSION["errors"])) {
      $this->errorHandler();
    }

  }
  //http_redirect
  public function goToPage($url){
    header('Location: '.$url);
    exit;
  }

  public function errorHandler(){
    unset($_SESSION["errors"]);
  }

  public function salt(){
    return "test";
  }
  public function setCompanyName($name){
    $this->companyName = $name;
  }
}

?>
