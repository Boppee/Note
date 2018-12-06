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
        $("#accountName").append("<h1>"+info.username+"</h1>");
        if (info.img.length > 0) {
          $("#accountimg").attr("src", info.img);
        }
        leng = $(".dropCont").length;
        for (var i = 0; i < leng; i++) {
          console.log(i);
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
      });
    }
  });
</script>
<link rel="stylesheet" href="css/page/account.css">
<section class="Ypadding" class="accountpage">
  <div class="inner">
    <div id="accountHeader">
      <div id="accountName">

      </div>
    </div>
    <div id="accountInfo">
      <div id="accountImg">
        <img id="accountimg" src="img/account.png">
      </div>
      <div id="accountBasic">

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
