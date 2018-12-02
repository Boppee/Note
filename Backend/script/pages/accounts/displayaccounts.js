//checks how many accounts exists
$.ajax({
  type: "GET",
  url: "script/pages/accounts/numberOfAccounts.php",
  success: function (number) {

    var page = 1;
    var accounts = number[0].total;
    var accountsPerPage;
    var pages;

    // generats selector
    for (var i = 1; i <= 10; i++) {
      var number = i*5;
      if (number == 20) {
        $("#numberofAcoounts").append("<option selected value='"+number+"'>"+number+"</option>");
      }else {
        $("#numberofAcoounts").append("<option value='"+number+"'>"+number+"</option>");
      }
    }

    $("#numberofAcoounts").change(function (e) {
      accountsPerPage = $("#numberofAcoounts").val();
      pages = Math.ceil(accounts/accountsPerPage);
      generatTable(accountsPerPage, page, accounts, pages);
    });

    accountsPerPage = $("#numberofAcoounts").val();
    pages = Math.ceil(accounts/accountsPerPage);

    $(".buttonaccounts").click(function (event) {
      if (event.target.id == "nextpage") {
        page++;
      }else {
        page--;
      }
      generatTable(accountsPerPage, page, accounts, pages);
    });

    generatTable(accountsPerPage, page, accounts, pages);

    function generatTable(accountsPerPage, page, accounts, pages) {
      destroyTable();
      var startingPoint = (page-1)*accountsPerPage;
      var endPoint =  ((page-1)*accountsPerPage)+accountsPerPage;
      for (var i = startingPoint; i < endPoint; i++) {
        if (i < accounts) {
          $.ajax({
            type: "POST",
            url: "script/pages/accounts/fetchAccounts.php",
            data: {offset: i},
            success: function (accountData) {
              $(document).ready(function () {
                var value = accountData.accounts[0];

                $("#accountab").append("<tr class='accountRow' id='account"+value.username+"'>");
                $("#account"+value.username).append("<td class='"+value.username+" activeTd'><input id='test' class='"+value.username+" activeInput' type='checkbox'></td>");

                if (value.active == "1") {
                  $("."+value.username+" input").attr("checked", "true");
                }

                $("#account"+value.username).append("<td class='"+value.username+" username'>"+value.username+"</td>");
                $("#account"+value.username).append("<td class='"+value.username+" lastlogon'>"+value.lastlogon+"</td>");

                var orderArray = ["dashboard", "accounts", "orders", "products", "categories", "statistics"];

                for (var i = 0; i < orderArray.length; i++) {
                  $("#account"+value.username).append("<td class='"+value.username+" pages'><input class='"+value.username+" pageinput' value='"+value.username+orderArray[i]+"' type='checkbox'></td>");
                }

                for (var t = 0; t < value.json_page.length; t++) {
                  if (orderArray.indexOf(value.json_page[t]) >= 0) {
                    $("input[value='"+value.username+orderArray[orderArray.indexOf(value.json_page[t])]+"']").attr("checked", "true");
                  }
                }
                $("#accountab input").prop("disabled", true);

                $("#account"+value.username).append("<td class='"+value.username+" gotoprofile'><a href='?page=accounts&id="+value.username+"'>Profile</a></td>");

              });
            }
          });
          pagearrows(page, pages);
        }
      }
    }

    function destroyTable() {
      $(".accountRow").remove();
    }

    function pagearrows(page, pages) {
      $("#pages").remove();
      $("#centertext").append("<p id='pages'>Page: "+page+" out of "+pages);
      if (pages == 1) {
        $(".buttonaccounts").hide();
      }else {
        $(".buttonaccounts").show();
      }

      if (page == 1) {
        $("#leftbutton").hide();
      }else {
        $("#leftbutton").show();
      }

      if (pages == page) {
        $("#rightbutton").hide();
      }else {
        $("#rightbutton").show();
      }
    }

  }
});
