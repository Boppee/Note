<?php

$up = $_REQUEST["underpage"];

?>

<link rel="stylesheet" href="css/page/list.css">

<main>

  <div id="listInner">
    <div id="headerspace">
      <?php

        if ($up == "units") {
          if (isset($_REQUEST["units"])) {
            $add = "?page=list&underpage=".$up."&units&create";
            $list = "?page=list&underpage=".$up."&units";
            $temp = "units";
          }elseif (isset($_REQUEST["prefix"])) {
            $add = "?page=list&underpage=".$up."&prefix&create";
            $list = "?page=list&underpage=".$up."&prefix";
            $temp = "prefix";
          }
        }else {
          $temp = $up;
          $add = "?page=list&underpage=".$up."&create";
          $list = "?page=list&underpage=".$up;
        }

        if ($session->checkPrem("create", $up)) {
          ?><a class="headerbutton" id="createB" href='<?php echo $add; ?>'><i class="fas fa-plus"></i> Create <?php echo $temp ?></a><?php
        }
        if ($session->checkPrem("list", $up)) {
          ?><a class="headerbutton" href='<?php echo $list ?>'><i class="fas fa-list-ul"></i> List <?php echo $temp ?></a><?php
        }

        if (isset($_REQUEST["id"])) {
          if ($session->checkPrem("delete", $up)) {
            $enc = new encoder("public");
            if ($_REQUEST["id"] != $enc->decode($_SESSION["cred"]["uid"], $_SESSION["iv"]) || $up != "accounts") {
              ?><a class="headerbutton" href="" id="delete"><i class="fas fa-trash-alt"></i> Delete <?php echo $temp ?></a><?php
            }
          }
          if ($session->checkPrem("modify", $up)) {
            ?><a class="headerbutton" href="" id="edit<?php echo $up ?>"><i class="fas fa-user-edit"></i> Edit <?php echo $temp ?></a><?php
          }
        }
        if (isset($_REQUEST["create"])) {
          ?><a class="headerbutton" href="" id="coac"><i class="fas fa-plus-circle"></i> Complete <?php echo $temp ?></a><?php
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
<title><?php echo $company->companyName." - ".ucfirst($_REQUEST["underpage"]); ?></title>
