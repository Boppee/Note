<?php
require_once 'connect.php';
class company {

  public $companyName = "Notes Clothing";
  public $reCaptchaSiteKey = "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI";

  function __construct(){
    $connect = new connect();
    $connection = $connect->newConnectionPre("CompanyDataBas");

    //grab company name

  }
}
?>
