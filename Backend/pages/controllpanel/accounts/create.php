<script src="script/pages/accounts/create.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/account.css">

<section class="Ypadding">
  <div class="inner">
    <div id="accountHeader">
      <div id="accountName">
        <tr id="accountActive">
          <td class="text">Username:</td>
          <td><input type="text" name="uid" class="data text" value=""></td>
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
        <table>
          <tr id="accountActive">
            <td class="text">Active:</td>
            <td><input type="checkbox" id="activeinput" namne="active" class="data text" value=""></td>
          </tr>
          <tr id="accountEmail">
            <td class="text">Email:</td>
            <td><input type="email" class="data text" name="email" value=""></td>
          </tr>
          <tr id="password">
            <td class="text">Password:</td>
            <td><input type="password" class="data text" name="pwd1" value=""></td>
            <td><input type="password" class="data text" name="pwd2" value=""></td>
          </tr>
        </table>
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
  </div>
</section>

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

<title><?php echo $company->companyName." - Create Account"; ?></title>
