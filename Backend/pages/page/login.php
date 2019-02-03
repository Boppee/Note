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

  <aside id="loginslider">

    <div id="loginbutton">
      <div id="logintext">
        <span><i id="navarrow" class="fas fa-caret-left"></i></span>
        <br>
        <span>S</span>
        <br>
        <span>i</span>
        <br>
        <span>g</span>
        <br>
        <span>n</span>
        <br>
        <span></span>
        <br>
        <span>i</span>
        <br>
        <span>n</span>
        <br>
        <span><i id="navarrow" class="fas fa-caret-left"></i></span>
        <br>
      </div>
    </div>

    <section id="forms">
      <div class="vcenterp" id="formpad">
        <div class="vcenterc rel">
          <form id="capatcha">
            <div class="g-recaptcha" data-sitekey="<?php echo $company->reCaptchaSiteKey; ?>" data-callback="sendRecaptcha"></div>
          </form>
          <form id="login">
            <input type="text" id="uid" class="borderinput" placeholder="Username">
            <input type="password" id="pwd" class="borderinput" placeholder="Password">
            <input type="submit" id="sumbitlogin" value="Sign in">
          </form>
          <div class="loadImg">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
          </div>
          <form id="email">
            <input type="password" id="code" value="" placeholder="Email verification">
            <input type="submit" name="" value="Sign in" id="sumbitcode">
          </form>
          <input type="hidden" id="salt" value="<?php $saltName = "login"; echo $salt->generatSalt($saltName);?>">
          <div id="pwdrs">
            <a href="#">Forgot password?</a>
          </div>
        </div>
      </div>
    </section>
  </aside>

</main>
