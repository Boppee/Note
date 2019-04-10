<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("modify", "categories")) {

    //get posted Data
    $name = strip_tags($_POST["name"]);
    $unit = strip_tags($_POST["unit"]);
    $length = strip_tags($_POST["length"]);
    $type = strip_tags($_POST["type"]);
    $table = strip_tags($_POST["table"]);
    $where = strip_tags($_POST["where"]);

    $dbName = $type.$name;

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyCats", "products");

    $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $sth->bindParam(':id', $table, PDO::PARAM_INT);
    $sth->execute();
    $cats = $sth->fetchAll(PDO::FETCH_ASSOC);

    if ($cats[0]["havetable"] == 0) {
      $sth = $connection->prepare("UPDATE `cats` SET `havetable` = '1' WHERE `id` = :id");
      $sth->bindParam(':id', $table, PDO::PARAM_INT);
      $sth->execute();
      $sth = $connection->prepare("CREATE TABLE `:id` ( `product_id` INT NOT NULL , PRIMARY KEY (`product_id`)) ENGINE = InnoDB;");
      $sth->bindParam(':id', $table, PDO::PARAM_INT);
      $sth->execute();
    }

    if ($type == "N") {
      if ($where == "FIRST") {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` FLOAT(:length) NOT NULL COMMENT :unit FIRST");
      }else {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` FLOAT(:length) NOT NULL COMMENT :unit AFTER `".$where."`");
      }
      $sth->bindParam(':table', $table, PDO::PARAM_INT);
      $sth->bindParam(':unit', $unit);
      $sth->bindParam(':length', $length, PDO::PARAM_INT);
    }
    if ($type == "T") {
      if ($where == "FIRST") {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` VARCHAR(:length) NOT NULL FRIST");
      }else {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` VARCHAR(:length) NOT NULL AFTER `".$where."`");
      }
      $sth->bindParam(':table', $table, PDO::PARAM_INT);
      $sth->bindParam(':length', $length, PDO::PARAM_INT);
    }
    if ($type == "D") {
      if ($where == "FIRST") {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` DATE NOT NULL FIRST");
      }else {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` DATE NOT NULL AFTER `".$where."`");
      }
      $sth->bindParam(':table', $table, PDO::PARAM_INT);
    }
    if ($type == "Y") {
      if ($where == "FIRST") {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` YEAR NOT NULL FIRST");
      }else {
        $sth = $connection->prepare("ALTER TABLE `:table` ADD `".$dbName."` YEAR NOT NULL AFTER `".$where."`");
      }
      $sth->bindParam(':table', $table, PDO::PARAM_INT);
    }

    if ($sth->execute()) {
      $echo["name"] = $name;
      $echo["unit"] = $unit;
      $echo["type"] = $type;
      if ($where != "FIRST") {
        $echo["where"] = substr($where, 1);
      }else {
        $echo["where"] = "FIRST";
      }

      echo json_encode($echo);
    }else {
      http_response_code(304);
    }

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}

?>
