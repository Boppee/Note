
<link rel="stylesheet" href="css/page/accounts.css">
<main>
  <div class="inner">
    <div id="headerspace">
      <a class="headerbutton" href="?page=accounts&createuser"><i class="fas fa-plus"></i> Create Account</a>
      <a class="headerbutton" href="?page=accounts"><i class="fas fa-list-ol"></i> Account list</a>
    </div>
    <section>
      <?php
        if (isset($_REQUEST["id"])) {
          include 'pages/controllpanel/accounts/account.php';
        }else if(isset($_REQUEST["createuser"])){
          include 'pages/controllpanel/accounts/create.php';
        }else {
          include 'pages/controllpanel/accounts/accounts.php';
        }
      ?>
    </section>
  </div>
</main>
