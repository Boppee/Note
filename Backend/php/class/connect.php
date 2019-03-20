<?php
  class connect {
    //users that are used often
    //template => 'User1' => array('username' => 'test', 'password' => 'test', 'databas ' => 'test', 'host' => '155.4.124.14')// This is a test user for (databas)->(table)
    private $users = array(
      'CreateAdminAccount' => array('username' => 'CreateAdminAccount', 'password' => 'bJKgBYXF5UUzKFIf', 'host' => '155.4.124.14', 'databas' => 'admin'), //can only insert to admin->accounts
      'FetchFromAccounts' => array('username' => 'FetchFromAccounts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'admin'),
      'UpdateAccount' => array('username' => 'UpdateAccount', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'admin'),
      'UpdateProducts' => array('username' => 'UpdateProducts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'FetchFromProducts' => array('username' => 'FetchFromProducts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'pwdChange' => array('username' => 'pwdChange', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'admin'),
      'removeAccounts' => array('username' => 'removeAccounts', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'admin'),
      'FetchFromcategories' => array('username' => 'FetchFromcategories', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'cats'),
      'creatCats' => array('username' => 'creatCats', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'deleteCats' => array('username' => 'creatCats', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'modifyCats' => array('username' => 'modifyCats', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'perms' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'admin'),
      'FetchPublic' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'admin'),
      'createUnits' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'units'),
      'removeUnits' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'units'),
      'modifyUnits' => array('username' => 'perms', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'units'),
      'createManufacturer' => array('username' => 'createManufacturer', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'modifyManufacturer' => array('username' => 'modifyManufacturer', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'removeManufacturer' => array('username' => 'removeManufacturer', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'products'),
      'previewNews' => array('username' => 'previewNews', 'password' => 'M3P3e2MGmDpMTl3S', 'host' => '155.4.124.14', 'databas' => 'promnews'),
    );

    private $defaultHost = "155.4.124.14";

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
      $uid = "per90";
      $pwd = "";
      $host = "155.4.124.14";
      if (isset($uid) && isset($pwd) && isset($databas)) {
        try {
          $dbh = new PDO('mysql:host='.$host.';dbname='.$databas,$uid,$pwd);
        } catch(PDOException $e){
          http_response_code(401);
          die();
        }
        if (isset($dbh)) {
          return $dbh;
        }
      }
    }
  }
?>
