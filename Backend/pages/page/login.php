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
    <p class="text">Welcome to <?php echo $company->companyName; ?></p>
    <ul>
      <li>
        <a class="text" href="#">Store</a>
      </li>
      <li>
        <a class="text" href="#">Forgot password?</a>
      </li>
    </ul>
    <i class="ico fas fa-caret-right"></i>
  </nav>

  <section>
    <button type="button" name="button">Sign in</button>
  </section>

  <aside class="">
    <div class="padder">
      <header>
        <h1>Sign in</h1>
      </header>

      <form id="capatcha">
        <div class="g-recaptcha" data-sitekey="<?php echo $company->reCaptchaSiteKey; ?>" data-callback="sendRecaptcha"></div>
      </form>
      <form id="login">
        <input type="text" id="uid" class="borderinput" placeholder="Username">
        <input type="password" id="pwd" class="borderinput" placeholder="Password">
        <input type="submit" id="sumbitlogin" value="Sign in">
      </form>
      <div class="loding">
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
      </div>
      <form id="email">
        <input type="password" id="code" value="" placeholder="Email verification">
        <input type="submit" name="" value="Sign in" id="sumbitcode">
      </form>

      <input type="hidden" id="salt" value="<?php $saltName = "login"; echo $salt->generatSalt($saltName);?>">

    </div>
  </aside>

</main>
