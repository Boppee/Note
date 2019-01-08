<link rel="stylesheet" href="css/page/accounts.css">
<main>
  <div id="accountsInner">
    <div id="headerspace">
      <?php
      if ($session->checkPrem("create", "accounts")) {
        ?>
        <a class="headerbutton" href="?page=accounts&createuser"><i class="fas fa-plus"></i> Create Account</a>
        <?php
      }
      if ($session->checkPrem("list", "accounts")) {
        ?>
        <a class="headerbutton" href="?page=accounts"><i class="fas fa-list-ol"></i> Account list</a>
        <?php
      }
      if (isset($_REQUEST["id"])) {
        if ($session->checkPrem("delete", "accounts")) {
          $enc = new encoder("public");
          if ($_REQUEST["id"] != $enc->decode($_SESSION["cred"]["uid"], $_SESSION["iv"])) {
            ?>
            <a class="headerbutton" href="" id="deleteuser"><i class="fas fa-trash-alt"></i> Delete account</a>
            <?php
          }
        }
        if ($session->checkPrem("mod", "accounts")) {
          ?>
          <a class="headerbutton" href="" id="edituser"><i class="fas fa-user-edit"></i> Edit Account</a>
          <?php
        }
      }
      if (isset($_REQUEST["createuser"])) {
        ?>
        <a class="headerbutton" href="" id="coac"><i class="fas fa-plus-circle"></i> Complete accounnt</a>
        <?php
      }

      ?>
    </div>
    <section>
      <?php
        if (isset($_REQUEST["id"])) {
          if ($session->checkPrem("list", "accounts")) {
              include 'pages/controllpanel/accounts/account.php';
          }
        }else if(isset($_REQUEST["createuser"])){
          if ($session->checkPrem("create", "accounts")) {
            include 'pages/controllpanel/accounts/create.php';
          }
        }else {
          if ($session->checkPrem("list", "accounts")) {
            include 'pages/controllpanel/accounts/accounts.php';
          }
        }
      ?>
    </section>
  </div>
</main>
