<script type="text/javascript">
  $(document).ready(function () {
    $("footer").css("position", "fixed");
    $("footer").css("bottom", "0");
  });
</script>
<script src="script/pages/login/login.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/login.css">
<div id="outer">
  <div id="inner">
    <div id="formdiv">
      <p>Sign in</p>
      <div id="centerlogin">
        <form id="capatcha">
          <div class="g-recaptcha" data-sitekey="<?php echo $loader->reCaptchaSiteKey; ?>" data-callback="sendRecaptcha"></div>
        </form>
        <form id="login">
          <input type="text" id="uid" class="borderinput" placeholder="Username">
          <input type="password" id="pwd" class="borderinput" placeholder="Password">
          <input type="submit" id="sumbitlogin" value="Sign in">
        </form>
        <form id="email">
          <input type="text" name="" value="" placeholder="Email verification">
          <input type="submit" name="" value="Sign in">
        </form>
        <input type="password" id="salt" value="
          <?php
            $loader->salt();
            echo $_SESSION["salt"]["salt"];
          ?>"
        hidden>
      </div>
      </div>
    <div id="imgdiv">
      <h1>
        Welcome to <?php echo $loader->companyName; ?>
      </h1>
    </div>
  </div>
</div>
