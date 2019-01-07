<title><?php echo $company->companyName." - ".ucfirst($loader->page)." - ".$_REQUEST["id"]; ?></title>
<script type="text/javascript">
  var uid = "<?php echo $_REQUEST["id"]; ?>";
</script>
<script src="script/pages/accounts/accountShow.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/account.css">
<div class="shadow" id="saveshadow">

</div>
<div class="center" id="nochange">
  <div class="rel">
    <div class="close">
      <i class="fas fa-times"></i>
    </div>
    <div class="vtext">
      <div class="vitext">
        <h1>No changes</h1>
      </div>
    </div>
  </div>
</div>
<div class="center" id="pwdrb">
  <div class="rel">
    <div class="close">
      <i class="fas fa-times"></i>
    </div>
    <div class="vtext">
      <div class="vitext tac">
        <h1 id="code"></h1>
        <p id="codeinfo"></p>
        <h1 class="codedone">New password</h1>
        <input class="codedone" type="password" name="npwd" value="">
      </div>
    </div>
    <div class="changebuttons">
      <a id="pwdc" class="curp codedone">Change</a>
    </div>
  </div>
</div>
<div id="changeDiv" class="center">
  <div class="rel">
    <div class="close">
      <i class="fas fa-times"></i>
    </div>
    <div id="headerchange">
      <h1>Changes</h1>
    </div>
    <div id="changes">
      <table>
        <thead>
          <th></th>
          <th>New</th>
          <th>Old</th>
        </thead>
        <tbody id="changebody">

        </tbody>
      </table>
    </div>
    <div class="changebuttons">
      <a id="changec" class="curp">Cancel</a>
      <a id="changeok" class="curp">Change</a>
    </div>
  </div>
</div>
<section class="Ypadding accountpage">
  <div class="inner">
    <div id="accountHeader">
      <div id="accountName">
        <p id="usernameP" contenteditable="true"></p>
        <button type="button" id="gotouser" onclick="redir()"><i class="fas fa-arrow-circle-right"></i></button>
      </div>
    </div>
    <div id="accountInfo">
      <div id="img">
        <div id="imgpadder">
          <div id="accountImg">
          </div>
        </div>
        <div id="changeimg">
          <form class="" action="index.html" method="post">
            <input type="file" id="imginput" value="">
          </form>
        </div>
      </div>
      <div id="accountBasic">
        <table>
          <tr id="accountActive">
            <td>Active:</td>
            <td><input type="checkbox" id="activeinput" class="data" value=""></td>
          </tr>
          <tr id="accountEmail">
            <td>Email:</td>
            <td><input type="email" class="data" value=""></td>
          </tr>
          <tr id="lastlogon">
            <td>Last logon:</td>
            <td><input type="datetime-local" class="data" value=""></td>
          </tr>
        </table>
      </div>
      <div id="lowerbuttons">
        <a id="pwdr" class="button">Reset password</a>
        <a id="save" class="button">Save</a>
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
