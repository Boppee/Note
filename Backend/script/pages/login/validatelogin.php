<?php
  //grabing userinputs
  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];
  //check if value are set

  require_once '../../../php/class/encode.php';
  require_once '../../../php/class/connect.php';
  require_once '../../../php/class/email.php'; 
  require_once '../../../php/class/vars.php';

  $login = new login($pwd, $uid, $salt);

  class login {

    private $password;
    private $username;
    private $email;
    private $iv;
    private $emailCode;
    private $enc;
    private $connection;

    function __construct($pwd, $uid, $salt){

      if (isset($pwd) && isset($salt) && isset($uid)) {
        if ($_SESSION["logincaptcha"]["pass"]) {
          if ($salt == $_SESSION["salt"]) {
            session_start();

            $this->enc = new encoder("private");
            $this->connection = new connect();

            $this->setUsername($uid);
            $this->setPassword($pwd);

            $userData = $this->grabUserData();

            //validateing password
            if ($this->Username == $userData["uid"] && password_verify($this->password, $userData["pwd"])) {
              $this->setIV($userData["iv"]);
              $email = $this->enc-decode($userData["email"], $this->iv);
              $this->setEmail($email);

              $this->sendVerifyEmail();
              //seting session vars so i can use the when validating email
              $_SESSION["loginAttempt"] = array(
                'username' => $uid,
                'password' => $pwd,
                'time' => date(),
                'salt' => uniqid(mt_rand(), true)
              );

              echo "pass";

            }else {
              echo "fail";
            }
          }else {
            echo "Salt error";
          }
        }else {
          echo "captcha error";
        }
      }else {
        echo "missing inputs";
      }
    }

    public function setUsername($uid){
      $this->username = $this->enc->revEncode($uid);
    }
    public function setPassword($pwd){
      $this->password = $pwd;
    }
    public function setEmail($email){
      $this->email = $email;
    }
    public function setIV($iv){
      $this->iv = $iv;
    }
    public function grabuserData(){

      $this->connection->newConnectionPre("FetchFromAccounts");

      $sth = $this->connection->prepare("SELECT * FROM `accounts` WHERE `uid` = :uid");
      $sth->bindParam(':uid', $this->uid);
      $sth->execute();
      return $sth->fetch(PDO::FETCH_LAZY);
    }
    public function sendVerifyEmail(){
      $company = new company();
      $mail->Subject = "Email verification from ".$company->companyName;
      $mail->AddAddress($this->email);

      $this->emailCode = uniqid(mt_rand(), true);

      $_SESSION["emailCode"] = $this->enc->encode($this->emailCode, $this->iv);

      $mail->Body = $this->emailCode;

      $mail->Send();
    }
  }
?>
