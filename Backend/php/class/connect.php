<?php
  class connect {
    //users that are used often
    //template => 'User1' => array('username' => 'test', 'password' => 'test', 'databas ' => 'test', 'host' => 'localhost')// This is a test user for (databas)->(table)
    private $users = array(
      'CreateAdminAccount' => array('username' => 'CreateAdminAccount', 'password' => 'bJKgBYXF5UUzKFIf', 'host' => 'localhost', 'databas' => 'admin'), //can only insert to admin->accounts
      'FetchFromAccounts' => array('username' => 'FetchFromAccounts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin'),
      'UpdateAccount' => array('username' => 'UpdateAccount', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => 'localhost', 'databas' => 'admin')
    );

    private $defaultHost = "localhost";

    public function newConnectionPre($uid) {
      return $this->newConnectionCred($this->users[$uid]["username"], $this->users[$uid]["password"], $this->users[$uid]["databas"], $this->users[$uid]["host"]);
    }

    public function newConnectionCred($uid, $pwd, $databas, $host) {
      if (!isset($host)) {
        $host = $this->defaultHost;
      }
      $uid = "root";
      $pwd = "";
      $databas = "admin";
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
