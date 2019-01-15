<?php
  session_start();

  include 'php/load.php';
  //loading and controlling page
  $loader = new pageLoader();
  $company = new company();
  include 'script/load.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  </head>
  <?php require 'script/load.php'; ?>
  <body>
    <div class="totalhight">
      <?php
        if ($loader->page == "logout") {
          require_once 'pages/inc/logout.php';
        }elseif (!isset($_SESSION["signedIn"])) {
            require_once 'pages/page/'.$loader->page.'.php';
        }else {
          require_once 'pages/pageparts/header.php';
          require 'pages/controllpanel/'.$loader->page.'.php';
        }
      ?>
    </div>
      <?php
        require_once 'pages/pageparts/footer.php';
        $loader->controllSession();
      ?>
  </body>
  <title><?php echo $company->companyName." - ".ucfirst($loader->page); ?></title>
</html>
