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
    for (var i = 1; i <= 8; i++) {
      var number = i*5;
      if (number == 20) {
        $("#numberofAcoounts").append("<option selected value='"+number+"'>"+number+"</option>");
      }else {
        $("#numberofAcoounts").append("<option value='"+number+"'>"+number+"</option>");
      }
    }

    $("#numberofAcoounts").change(function (e) {
      accountsPerPage = $("#numberofAcoounts").val();
      pages = Math.ceil(this.accounts/this.perPage);
    });

    accountsPerPage = $("#numberofAcoounts").val();
    pages = Math.ceil(this.accounts/this.perPage);

    generatTable(accountsPerPage, page, accounts);

    function generatTable(accountsPerPage, page, accounts) {
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
                console.log(value);

                $("#accountab").append("<tr class='accountRow' id='"+value.username+"'>");
                $("#"+value.username).append("<td class='"+value.username+" activeTd'><input id='test' class='"+value.username+" activeInput' type='checkbox'></td>");

                if (value.active == "1") {
                  $("."+value.username+" input").attr("checked", "true");
                }

                $("#"+value.username).append("<td class='"+value.username+" username'>"+value.username+"</td>");
                $("#"+value.username).append("<td class='"+value.username+" lastlogon'>"+value.lastlogon+"</td>");

                var orderArray = ["dashboard", "accounts", "orders", "products", "categories", "statistics"];

                for (var i = 0; i < orderArray.length; i++) {
                  $("#"+value.username).append("<td class='"+value.username+" pages'><input class='"+value.username+" pageinput' value='"+value.username+orderArray[i]+"' type='checkbox'></td>");
                }

                for (var t = 0; t < value.json_page.length; t++) {
                  if (orderArray.indexOf(value.json_page[t]) >= 0) {
                    $("input[value='"+value.username+orderArray[orderArray.indexOf(value.json_page[t])]+"']").attr("checked", "true");
                  }
                }

                $('#accountab tr').click(function (event) {
                  if (typeof $(this).attr('id') !== 'undefined') {
                    window.location.href = "?page=accounts&id="+$(this).attr('id');
                  }
                });
              });
            }
          });
        }
      }
    }
    function destroyTable() {
      $(".accountRow").remove();
    }

  }
});
