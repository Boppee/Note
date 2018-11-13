<?php

  session_start();

  include 'php/load.php';
  include 'script/load.php';
  //loading and controlling page
  $loader = new pageLoader();
  $company = new company();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <script src="jquery.js" charset="utf-8"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <title><?php echo $company->companyName." - ".ucfirst($loader->page); ?></title>
  </head>
  <body>
    <?php
    //include the ?page
    require_once 'pages/page/'.$loader->page.'.php';
    require_once 'pages/pageparts/footer.php';
    ?>
  </body>
</html>
