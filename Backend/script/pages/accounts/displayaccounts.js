//checks how many accounts exists
$.ajax({
  type: "GET",
  url: "script/pages/accounts/numberOfAccounts.php",
  success: function (number) {

    var standard = 10;
    createSelector(standard);

    var accounts = number[0].total;
    var accountPerPage = parseInt($("#numberofAcoounts").val());
    var page = 1;
    var pages = parseInt(Math.ceil(accounts/accountPerPage));

    $.ajax({
      type: "POST",
      url: "script/pages/accounts/fetchAccounts.php",
      data: {limit: accounts},
      success: function (accountData) {
        for (var i = 0; i < accountData.accounts.length; i++) {
          addRow(accountData.accounts[i], i);
        }

        function addRow(data, number) {
          $(document).ready(function () {

            $("#accountab").append("<tr value='"+number+"' class='accountRow' id='account"+data.username+"'>");
            $("#account"+data.username).append("<td class='"+data.username+" activeTd'><input id='test' class='"+data.username+" activeInput' type='checkbox'></td>");

            if (data.active == "1") {
              $("."+data.username+" input").attr("checked", "true");
            }

            $("#account"+data.username).append("<td class='"+data.username+" username'>"+data.username+"</td>");
            $("#account"+data.username).append("<td class='"+data.username+" lastlogon'>"+data.lastlogon+"</td>");

            var orderArray = ["dashboard", "accounts", "orders", "products", "categories", "statistics"];

            for (var i = 0; i < orderArray.length; i++) {
              $("#account"+data.username).append("<td class='"+data.username+" pages'><input class='"+data.username+" pageinput' value='"+data.username+orderArray[i]+"' type='checkbox'></td>");
            }

            for (var t = 0; t < data.json_page.length; t++) {
              if (orderArray.indexOf(data.json_page[t]) >= 0) {
                $("input[value='"+data.username+orderArray[orderArray.indexOf(data.json_page[t])]+"']").attr("checked", "true");
              }
            }
            $("#accountab input").prop("disabled", true);

            $("#account"+data.username).append("<td class='"+data.username+" gotoprofile'><a href='?page=accounts&id="+data.username+"'>Profile</a></td>");

          });
        }
        showPage(page, accountPerPage, accounts, pages);
      }
    });

    function pageArrows(page, pages) {
      $("#pages").remove();
      $("#centertext").append("<p id='pages'>Page: "+page+" out of "+pages);
      $("#centertexttop").append("<p id='pages'>Page: "+page+" out of "+pages);
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
    function createSelector(standard) {
      for (var i = 1; i <= 10; i++) {
        var a = i*5;
        if (a == standard) {
          $("#numberofAcoounts").append("<option selected value='"+a+"'>"+a+"</option>");
        }else {
          $("#numberofAcoounts").append("<option value='"+a+"'>"+a+"</option>");
        }
      }
    }
    function showPage(page, accountsPerPages, accounts, pages) {
      $(document).ready(function () {
        $(".accountRow").hide();
        var starting = (page-1)*accountsPerPages;
        var ending = ((page-1)*accountsPerPages)+accountsPerPages;
        for (var i = starting; i < ending; i++) {
          $("#accountab tr[value='"+i+"']").show();
        }
      });
      pageArrows(page, pages);
    }
    function oddEven() {
      $(document).ready(function () {
        $("#accountab tr:visible:odd").css("background-color", "#ffa500");
        $("#accountab tr:visible:odd td, #accountab tr:visible:odd a").css("color", "black");
        $("#accountab tr:visible:even td, #accountab tr:visible:even a").css("color", "#f5f5f5");
        $("#accountab tr:visible:even").css("background-color", "transparent");
      });
    }

    $("#rightbutton").click(function () {
      page++;
      showPage(page, accountPerPage, accounts, pages);
      oddEven();
    });
    $("#leftbutton").click(function () {
      page--;
      showPage(page, accountPerPage, accounts, pages);
      oddEven();
    });

    $("#numberofAcoounts").change(function (e) {
      accountPerPage = parseInt($("#numberofAcoounts").val());
      pages = parseInt(Math.ceil(accounts/accountPerPage));
      page = 1;
      showPage(page, accountPerPage, accounts, pages);
      oddEven();
    });

    $(document).ready(function(){
      $("#searchTable").on("keyup", function() {
        if ($("#searchTable").val().length == 0) {
          showPage(page, accountPerPage, accounts, pages);
          oddEven();
        }else {
          var value = $(this).val().toLowerCase();
          $("#accountTable tbody tr").filter(function() {
            $(this).toggle($(this).find('.username').text().toLowerCase().indexOf(value) > -1);
            oddEven();
          });
        }
      });
    });
  }
});
