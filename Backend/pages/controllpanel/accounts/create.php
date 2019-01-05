<script src="script/pages/accounts/create.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/account.css">
<form id="createAccount">
  <input type="text" name="uid" placeholder="Username">
  <div id="pwdDiv">
    <input type="password" name="pwd1" placeholder="password">
    <input type="password" name="pwd2" placeholder="password Repeat" disabled>
    <div id="pwdErrorList">
      <ul>
        <li id="pwdlength">The password must be between 10 and 20 characters</li>
        <li id="pwdnumber">The password must contain at least one number</li>
        <li id="pwdlowercase">The password must contain a lowercase character</li>
        <li id="pwduppercase">The password must contain a uppercase character</li>
        <li id="pwdspecial">The password must contain a special character</li>
        <li id="pwdmatch">The passwords must be identical</li>
      </ul>
    </div>
  </div>
  <input type="email" name="" placeholder="email">
  <input type='file' id="imgInput">
  <img id="accountImg" src="img/accounts/account.png" alt="your image">
  <section id="perms" class="Ypadding">
    <div class="inner">
      <div id="permdivs">

        <div class="perms" id="accounts">
          <form class="permform" id="accountsform">
            <h1>Accounts</h1>
            <div class="permlist">
              <ul>

                <li><input type="checkbox" name="list" value=""> List</li>
                <li><input type="checkbox" name="respwd" value=""> Reset password</li>
                <li><input type="checkbox" name="create" value=""> Create</li>
                <li><input type="checkbox" name="mod" value=""> Modify</li>
                <li><input type="checkbox" name="delete" value=""> Delete</li>
              </ul>
            </div>
          </form>
        </div>

        <div class="perms" id="orders">
          <form class="permform" id="ordersform">
            <h1>Orders</h1>
            <div class="permlist">
              <ul>

                <li><input type="checkbox" name="list" value=""> List</li>
                <li><input type="checkbox" name="create" value=""> Create</li>
                <li><input type="checkbox" name="mod" value=""> Modify</li>
                <li><input type="checkbox" name="delete" value=""> Delete</li>
              </ul>
            </div>
          </form>
        </div>

        <div class="perms" id="products">
          <form class="permform" id="productsform">
            <h1>Products</h1>
            <div class="permlist">
              <ul>

                <li><input type="checkbox" name="list" value=""> List</li>
                <li><input type="checkbox" name="create" value=""> Create</li>
                <li><input type="checkbox" name="mod" value=""> Modify</li>
                <li><input type="checkbox" name="delete" value=""> Delete</li>
              </ul>
            </div>
          </form>
        </div>

        <div class="perms" id="categories">
          <form class="permform" id="categoriesform">
            <h1>Categories</h1>
            <div class="permlist">
              <ul>

                <li><input type="checkbox" name="list" value=""> List</li>
                <li><input type="checkbox" name="create" value=""> Create</li>
                <li><input type="checkbox" name="mod" value=""> Modify</li>
                <li><input type="checkbox" name="delete" value=""> Delete</li>
              </ul>
            </div>
          </form>
        </div>

        <div class="perms" id="statistics">
          <form class="permform" id="statisticsform">
            <h1>Statistics</h1>
            <div class="permlist">
              <ul>
                <li><input type="checkbox" name="list" value=""> List</li>
              </ul>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
</form>
<title><?php echo $company->companyName." - Create Account"; ?></title>
