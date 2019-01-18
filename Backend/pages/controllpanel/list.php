<?php

$up = $_REQUEST["underpage"];

?>

<link rel="stylesheet" href="css/page/list.css">

<main>

  <div id="listInner">
    <div id="headerspace">
      <?php

        if ($session->checkPrem("create", $up)) {
          ?><a class="headerbutton" href="?page=list&underpage=<?php echo $up; ?>&createuser"><i class="fas fa-plus"></i> Create <?php echo $up ?></a><?php
        }
        if ($session->checkPrem("list", $up)) {
          ?><a class="headerbutton" href="?page=list&underpage=<?php echo $up ?>"><i class="fas fa-list-ul"></i> List <?php echo $up ?></a><?php
        }

        if (isset($_REQUEST["id"])) {
          if ($session->checkPrem("delete", $up)) {
            $enc = new encoder("public");
            if ($_REQUEST["id"] != $enc->decode($_SESSION["cred"]["uid"], $_SESSION["iv"]) || $up != "accounts") {
              ?><a class="headerbutton" href="" id="delete"><i class="fas fa-trash-alt"></i> Delete <?php echo $up ?></a><?php
            }
          }
          if ($session->checkPrem("mod", $up)) {
            ?><a class="headerbutton" href="" id="edit<?php echo $up ?>"><i class="fas fa-user-edit"></i> Edit <?php echo $up ?></a><?php
          }
        }
        if (isset($_REQUEST["create"])) {
          ?><a class="headerbutton" href="" id="coac"><i class="fas fa-plus-circle"></i> Complete <?php echo $up ?></a><?php
        }

      ?>
    </div>
    <section>
      <?php
        if (isset($_REQUEST["id"])) {
          if ($session->checkPrem("list", $up)) {
              include 'pages/controllpanel/'.$up.'/id.php';
          }
        }else if(isset($_REQUEST["create"])){
          if ($session->checkPrem("create", $up)) {
            include 'pages/controllpanel/'.$up.'/create.php';
          }
        }else {
          if ($session->checkPrem("list", $up)) {
            include 'pages/controllpanel/list/all.php';
          }
        }
      ?>
    </section>

  </div>

</main>
