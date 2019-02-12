<script src="script/pages/accounts/create.js" charset="utf-8"></script>
<script src="script/pages/accounts/createperms.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/account.css">
<link rel="stylesheet" href="css/page/createAccount.css">

<section class="Ypadding">
  <div class="inner">

    <div id="accountHeader">
      <div id="accountName">
        <tr id="accountActive">
          <div class="dataInputs" id="accountuid">
            <h1 class="text">Username:</h1>
            <input type="text" name="uid" class="data text" value="">
          </div>
        </tr>
      </div>
    </div>

    <div id="accountInfo">
      <div id="img">
        <div id="imgpadder">
          <div id="accountImg">
          </div>
        </div>
        <div id="changeimg">
          <input type="file" id="imgInput" value="">
        </div>
      </div>
      <div id="accountBasic">
        <div class="dataInputs" id="accountActive">
          <h1 class="text">Active:</h1>
          <input type="checkbox" id="activeinput" namne="active" class="data text" value="">
        </div>
        <div class="dataInputs" id="accountEmail">
          <h1 class="text">Email:</h1>
          <input type="email" class="data text" name="email" value="">
        </div>
        <div class="dataInputs" id="accountpwd">
          <h1 class="text">Password:</h1>
          <input type="password" class="data text" name="pwd1" id="dots" value="">
          <input type="password" class="data text" name="pwd2" value="">
        </div>
        <div id="pwdErrorList">
          <ul>
            <li id="pwdlength" class="text">The password must be between 10 and 20 characters</li>
            <li id="pwdnumber" class="text">The password must contain at least one number</li>
            <li id="pwdlowercase" class="text">The password must contain a lowercase character</li>
            <li id="pwduppercase" class="text">The password must contain a uppercase character</li>
            <li id="pwdspecial" class="text">The password must contain a special character</li>
            <li id="pwdmatch" class="text">The passwords must be identical</li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</section>

<section id="perms" class="Ypadding">
  <div class="inner">
    <div id="permdivs">

    </div>
  </div>
</section>

<title><?php echo $company->companyName." - Create Account"; ?></title>
