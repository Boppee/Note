<?php

  session_start();

  include 'php/load.php';
  $loader = new pageLoader();
  $loader->setCompanyName("Notes Clothing")

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <script src="jquery.js" charset="utf-8"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/master.css">

    <title><?php echo ucfirst($loader->page); ?></title>
  </head>
  <body>
    <?php
      echo bin2hex(openssl_random_pseudo_bytes(32));
      require_once 'pages/page/'.$loader->page.'.php';
      require_once 'pages/pageparts/footer.php';

    ?>
  </body>
</html>
