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
    <div id="changebuttons">
      <a id="changec" >Cancel</a>
      <a id="changeok" >Change</a>
    </div>
  </div>
</div>
<section class="Ypadding accountpage">
  <div class="inner">
    <div id="accountHeader">
      <div id="accountName">
        <p id="usernameP"></p>
        <input type="text" id="username" onkeyup="username()">
        <button type="button" id="gotouser" onclick="redir()"><i class="fas fa-arrow-circle-right"></i></button>
      </div>
    </div>
    <div id="accountInfo">
      <div id="imgpadder">
        <div id="accountImg">
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
  <div id="accountPriv">

    <div id="accounPage">

      <div class="dropDown">
        <div id="default" class="userexbutton">
          <i class="fas fa-angle-up" id="rotatedefault"></i> Default pages
        </div>
        <div class="defaultEx dropCont">
          <table>
            <thead id="defth">
              <th class="thPadd" id="dashboard">Dashboard</th>
              <th class="thPadd" id="settings">Settings</th>
              <th class="thPadd" id="logout">Logout</th>
              <th class="thPadd" id="myaccount">My account</th>
            </thead>
          </table>
        </div>
      </div>
      <div class="dropDown">
        <div id="pages" class="userexbutton">
          <i class="fas fa-angle-up" id="rotatepages"></i> Pages
        </div>
        <div class="pagesEx dropCont">
          <table>
            <thead id="path">
              <th class="thPadd" id="accounts">Accounts</th>
              <th class="thPadd" id="orders">Orders</th>
              <th class="thPadd" id="products">Products</th>
              <th class="thPadd" id="myaccount">Myaccount</th>
            </thead>
          </table>
        </div>
      </div>

    </div>

    <div id="accounperms">

    </div>
  </div>
</section>
<title><?php echo $company->companyName." - ".ucfirst($loader->page)." - ".$_REQUEST["id"]; ?></title>
