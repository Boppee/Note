<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("create", "news")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("createNews", "");

    $v = strip_tags($_POST["newsvisible"]);
    $name = strip_tags($_POST["newsname"]);
    $desc = strip_tags($_POST["newsdesciption"]);

    $sth = $connection->prepare("INSERT INTO `news` (`visible`, `name`, `description`, `imgs`) VALUES (:v, :name, :descrip, '[]')");
    $sth->bindParam(':v', $v);
    $sth->bindParam(':name', $name);
    $sth->bindParam(':descrip', $desc);
    $sth->execute();

    $id = $connection->lastInsertId();

    for ($i=0; $i < count($_FILES['newsimg']['name']); $i++) {
      $sth = $connection->prepare("SELECT `imgs` FROM `news` WHERE `id` = :id");
      $sth->bindParam(':id', $id);
      $sth->execute();
      $imgArray = $sth->fetch(PDO::FETCH_ASSOC);

      $imgArray = json_decode($imgArray["imgs"]);


      $fileName = $_FILES['newsimg']['name'][$i];
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $fileError = $_FILES['newsimg']['error'][$i];
      $fileContent = file_get_contents($_FILES['newsimg']['tmp_name'][$i]);

      $imgErrors = array();
      if ($i != 0) {
        $imgname = "start".$i;
      }else {
        $imgname = "start";
      }


      if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "bmp") {
        array_push($imgErrors, "file format");
      }
      if (getimagesize($_FILES["newsimg"]["tmp_name"][$i]) == false) {
        array_push($imgErrors, "not a img");
      }
      if (count($imgErrors) == 0) {
        if (!file_exists("../../../../frontend/pages/news/imgs/".$id)) {
          mkdir("../../../../frontend/pages/news/imgs/".$id, 0700);
        }
        $filePath = "../../../../frontend/pages/news/imgs/".$id."/".$imgname.".".pathinfo($fileName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["newsimg"]["tmp_name"][$i], $filePath);
        $imgtype = pathinfo($fileName, PATHINFO_EXTENSION);
        $newArray = array('t' => $imgtype, 'n' => $imgname);
        array_push($imgArray, $newArray);

        $imgArray = json_encode($imgArray);

        $sth = $connection->prepare("UPDATE `news` SET `imgs` = :array WHERE `id` = :id");
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->bindParam(':array', $imgArray);
        $sth->execute();
      }
    }

    echo json_encode($id);

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
