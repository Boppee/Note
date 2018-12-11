<script src="script/pages/accounts/accountShow.js" charset="utf-8"></script>
<script type="text/javascript">
  var uid = "<?php echo $_REQUEST["id"]; ?>";
  //Grab Userdata add appends to page
  $.ajax({
    type: "POST",
    url: "script/pages/accounts/fetchAccountUID.php",
    data: {uid: uid},
    success: function (info) {
      $(document).ready(function () {
        console.log(info);
        if (info.username == "") {
          window.location.href = "?page=accounts";
        }else {
          $(".accountpage").show();
          $("#usernameP").text(info.username);
          $("#username").val(" ");
          username();

          $("#accountEmail .data").val(info.email);

          if (info.img.length > 0) {
            $("#accountimg").attr("src", info.img);
          }
          leng = $(".dropCont").length;
          for (var i = 0; i < leng; i++) {
            curTable = $(".dropCont table thead")[i].id;
            for (var o = 0+1; o < $("#"+curTable+" th").length+1; o++) {
              temp = $("#"+curTable+" th:nth-child("+o+")");
              tempId = temp[0].id;
              if (info.pages.indexOf(tempId) != -1) {
                $("#"+tempId).css("background", "green");
              }else {
                $("#"+tempId).css("background", "red");
              }
            }
          }
        }
      });
    }
  });
  function username() {
    var length = $("#username").val().length;
    if (length < 1) {
      $('#usernameP').text(function (_,txt) {
          return txt.slice(0, -1);
      });
    }else {
      $('#usernameP').text(function (_,txt) {
          return txt+$("#username").val().substring(1);
      });
    }
    $("#username").val(" ");
  }
  function redir() {
    window.location.href = "?page=accounts&id="+$("#usernameP").text();
  }
</script>
<link rel="stylesheet" href="css/page/account.css">
<section class="Ypadding accountpage">
  <div class="inner">
    <div id="accountHeader">
      <div id="accountName">
        <p id="usernameP"></p>
        <input type="text" id="username" onkeyup="username()">
        <button type="button" name="button" onclick="redir()"><i class="fas fa-arrow-circle-right"></i></button>
      </div>
    </div>
    <div id="accountInfo">
      <div id="imgpadder">
        <div id="accountImg">
        </div>
      </div>
      <div id="accountBasic">
        <table>
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
