<script src="script/pages/header/createNav.js" charset="utf-8"></script>
<header>
  <div id="headContainer">

    <div id="headLogo">
      <a id="logoLink" href="?page="><?php echo $company->companyName; ?></a>
    </div>

    <nav>
      <ul id="navItems">

      </ul>
    </nav>
    <section id="setting">
      <a href="?page=settings" title="Settings"><i class="fas fa-cog"></i></a>
      <a href="?page=list&underpage=accounts&id=<?php $enc = new encoder("public"); echo $enc->decode($_SESSION["cred"]["uid"], $_SESSION["iv"]); ?>" title="Account"><i class="fas fa-user-alt"></i></a>
      <a href="?page=logout" title="Log out"><i class="fas fa-sign-out-alt"></i></a>
    </section>

  </div>
</header>
<link rel="stylesheet" href="css/pageparts/header.css">
