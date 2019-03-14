<?php
require_once 'scripts/load.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset=utf-8 />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  </head>
  <body>
    <?php
      require_once $pageUrl.'.php';
      require_once 'res/footer.php';
    ?>
  </body>
</html>
