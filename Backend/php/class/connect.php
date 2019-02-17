<?php
  class connect {
    //users that are used often
    //template => 'User1' => array('username' => 'test', 'password' => 'test', 'databas ' => 'test', 'host' => 'localhost')// This is a test user for (databas)->(table)
    private $users = array(
      'CreateAdminAccount' => array('username' => 'CreateAdminAccount', 'password' => 'bJKgBYXF5UUzKFIf', 'host' => 'localhost', 'databas' => 'admin'), //can only insert to admin->accounts
      'FetchFromAccounts' => array('username' => 'FetchFromAccounts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin'),
      'UpdateAccount' => array('username' => 'UpdateAccount', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin'),
      'UpdateProducts' => array('username' => 'UpdateProducts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'products'),
      'FetchFromProducts' => array('username' => 'FetchFromProducts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'products'),
      'pwdChange' => array('username' => 'pwdChange', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin'),
      'removeAccounts' => array('username' => 'removeAccounts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin'),
      'FetchFromcategories' => array('username' => 'FetchFromcategories', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'cats'),
      'creatCats' => array('username' => 'creatCats', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'cats'),
      'perms' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin'),
      'FetchPublic' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin')
    );

    private $defaultHost = "localhost";

    public function newConnectionPre($uid, $db) {
      if (strlen($db) == 0) {
        return $this->newConnectionCred($this->users[$uid]["username"], $this->users[$uid]["password"], $this->users[$uid]["databas"], $this->users[$uid]["host"]);
      }else {
        return $this->newConnectionCred($this->users[$uid]["username"], $this->users[$uid]["password"], $db, $this->users[$uid]["host"]);
      }
    }

    public function newConnectionCred($uid, $pwd, $databas, $host) {
      if (!isset($host)) {
        $host = $this->defaultHost;
      }
      $uid = "root";
      $pwd = "";
      $host = "localhost";
      if (isset($uid) && isset($pwd) && isset($databas)) {
        try {
          $dbh = new PDO('mysql:host='.$host.';dbname='.$databas,$uid,$pwd);
        } catch(PDOException $e){
          echo "Error: ".$e->getMessage();
        }
        return $dbh;
      }
    }
  }
?>
