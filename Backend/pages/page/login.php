<?php
$salt = new salt();
?>
<script type="text/javascript">
  $(document).ready(function () {
    $("footer").css("position", "fixed");
    $("footer").css("bottom", "0");
  });
</script>
<script src="script/pages/login/login.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/login.css">
<main>

  <nav>
    <span><?php echo $company->companyName; ?> <i id="navarrow" class="fas fa-caret-right"></i></span>
    <ul id="navlist">
      <li><a href="">Store</a></li>
    </ul>
  </nav>

  <section>
    <div id="loginButton">
      <span>Sign in</span>
    </div>
  </section>

  <aside class="">

    <header>
      <span>Sign in</span>
    </header>

    <div>

      <form id="capatcha">
        <div class="g-recaptcha" data-sitekey="<?php echo $company->reCaptchaSiteKey; ?>" data-callback="sendRecaptcha"></div>
      </form>

      <form id="login">
        <input type="text" id="uid" class="borderinput" placeholder="Username">
        <input type="password" id="pwd" class="borderinput" placeholder="Password">
        <input type="submit" id="sumbitlogin" value="Sign in">
      </form>

      <div class="loader">

      </div>

      <form id="email">
        <input type="password" id="code" value="" placeholder="Email verification">
        <input type="submit" name="" value="Sign in" id="sumbitcode">
      </form>

      <input type="hidden" id="salt" value="<?php $saltName = "login"; echo $salt->generatSalt($saltName);?>">

    </div>

  </aside>

</main>
<div id="outer">
  <div id="inner">
    <div id="formdiv">
      <p>Sign in</p>
      <div id="centerlogin">
        <form id="capatcha">
          <div class="g-recaptcha" data-sitekey="<?php echo $company->reCaptchaSiteKey; ?>" data-callback="sendRecaptcha"></div>
        </form>
        <form id="login">
          <input type="text" id="uid" class="borderinput" placeholder="Username">
          <input type="password" id="pwd" class="borderinput" placeholder="Password">
          <input type="submit" id="sumbitlogin" value="Sign in">
        </form>
        <div class="loadImg">
          <img src="img/load.gif" id="loadImg">
        </div>
        <form id="email">
          <input type="password" id="code" value="" placeholder="Email verification">
          <input type="submit" name="" value="Sign in" id="sumbitcode">
        </form>
        <input type="hidden" id="salt" value="<?php $saltName = "login"; echo $salt->generatSalt($saltName);?>">
      </div>
      </div>
    <div id="imgdiv">
      <h1>
        Welcome to <?php echo $company->companyName; ?>
      </h1>
    </div>
  </div>
</div>
