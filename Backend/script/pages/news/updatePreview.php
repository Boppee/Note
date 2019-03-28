<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("create", "news")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("previewNews", "");

    $id = strip_tags($_POST["nid"]);

    $sth = $connection->prepare("SELECT * FROM `previewnews` WHERE `id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
    $test = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (!isset($test[0])) {
      $sth = $connection->prepare("INSERT INTO `previewnews` (`id`) VALUES (:id)");
      $sth->bindParam(':id', $id);
      $sth->execute();
    }

    if (isset($_POST["newsname"])) {
      $name = strip_tags($_POST["newsname"]);
      $sth = $connection->prepare("UPDATE `previewnews` SET `name` = :name WHERE `id` = :id");
      $sth->bindParam(':name', $name);
      $sth->bindParam(':id', $id);
      $sth->execute();
    }
    if (isset($_POST["newsdesciption"])) {
      $desc = strip_tags($_POST["newsdesciption"]);
      $sth = $connection->prepare("UPDATE `previewnews` SET `description` = :description WHERE `id` = :id");
      $sth->bindParam(':description', $desc);
      $sth->bindParam(':id', $id);
      $sth->execute();
    }
    if (isset($_POST["newsunique"])) {
      $newsunique = strip_tags($_POST["newsunique"]);
      $sth = $connection->prepare("UPDATE `previewnews` SET `uniquepage` = :newsunique WHERE `id` = :id");
      $sth->bindParam(':newsunique', $newsunique);
      $sth->bindParam(':id', $id);
      $sth->execute();
    }
    if (isset($_POST["newsvisible"])) {
      $newsvisible = strip_tags($_POST["newsvisible"]);
      $sth = $connection->prepare("UPDATE `previewnews` SET `visible` = :newsvisible WHERE `id` = :id");
      $sth->bindParam(':newsvisible', $newsvisible);
      $sth->bindParam(':id', $id);
      $sth->execute();
    }
    if (isset($_FILES["newsimg"])) {

      $i = 0;

      for ($i=0; $i < count($_FILES['newsimg']['name']); $i++) {
        $sth = $connection->prepare("SELECT `imgs` FROM `previewnews` WHERE `id` = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();
        $imgArray = $sth->fetch(PDO::FETCH_ASSOC);

        $imgArray = json_decode($imgArray["imgs"]);


        $fileName = $_FILES['newsimg']['name'][$i];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileError = $_FILES['newsimg']['error'][$i];
        $fileContent = file_get_contents($_FILES['newsimg']['tmp_name'][$i]);

        $imgErrors = array();

        $imgname = "temp".$i;

        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "bmp") {
          array_push($imgErrors, "file format");
        }
        if (getimagesize($_FILES["newsimg"]["tmp_name"][$i]) == false) {
          array_push($imgErrors, "not a img");
        }
        if (count($imgErrors) == 0) {
          if (!file_exists("../../../../frontend/pages/news/imgs/preview/".$id)) {
            mkdir("../../../../frontend/pages/news/imgs/preview/".$id, 0700);
          }
          $filePath = "../../../../frontend/pages/news/imgs/preview/".$id."/".$imgname.".".pathinfo($fileName, PATHINFO_EXTENSION);
          move_uploaded_file($_FILES["newsimg"]["tmp_name"][$i], $filePath);
          $imgtype = pathinfo($fileName, PATHINFO_EXTENSION);
          $newArray = array('t' => $imgtype, 'n' => $imgname);
          array_push($imgArray, $newArray);

          $imgArray = json_encode($imgArray);

          $sth = $connection->prepare("UPDATE `previewnews` SET `imgs` = :array WHERE `id` = :id");
          $sth->bindParam(':id', $id, PDO::PARAM_INT);
          $sth->bindParam(':array', $imgArray);
          $sth->execute();
        }
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
