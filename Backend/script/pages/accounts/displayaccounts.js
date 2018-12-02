//checks how many accounts exists
$.ajax({
  type: "GET",
  url: "script/pages/accounts/numberOfAccounts.php",
  success: function (number) {

    class accountTable {

      constructor(accounts, page) {

        this.destroyTable();

        this.accounts = accounts;
        this.page = page;
        this.getNrAccount();

        this.calcPoints();
        this.calcPages();
        this.generatTable();

      }

      getNrAccount() {
        this.accountsPerPage = parseInt($("#numberofAcoounts").val());
      }
      calcPages() {
        this.pages = Math.ceil(this.accounts/this.accountsPerPage);
      }
      generatTable(){
        for (var i = this.startingPoint; i < this.endingPoint; i++) {
          if (i < this.accounts) {
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
          }
        }
        this.pageArrows();
      }
      destroyTable() {
        $(document).ready(function () {
          $(".accountRow").remove();
        });
      }
      pageArrows() {
        $("#pages").remove();
        $("#centertext").append("<p id='pages'>Page: "+this.page+" out of "+this.pages);
        if (this.pages == 1) {
          $(".buttonaccounts").hide();
        }else {
          $(".buttonaccounts").show();
        }

        if (this.page == 1) {
          $("#leftbutton").hide();
        }else {
          $("#leftbutton").show();
        }

        if (this.pages == this.page) {
          $("#rightbutton").hide();
        }else {
          $("#rightbutton").show();
        }
      }
      calcPoints() {
        this.calcStartPoint();
        this.calcEndPoint();
      }
      calcStartPoint() {
        this.startingPoint = (this.page-1)*this.accountsPerPage;
      }
      calcEndPoint() {
        this.endingPoint = (this.page-1)*this.accountsPerPage+this.accountsPerPage;
      }

    }
    var standard = 10;

    for (var i = 1; i <= 10; i++) {
      var a = i*5;
      if (a == standard) {
        $("#numberofAcoounts").append("<option selected value='"+a+"'>"+a+"</option>");
      }else {
        $("#numberofAcoounts").append("<option value='"+a+"'>"+a+"</option>");
      }
    }

    var page = 1;

    new accountTable(number[0].total, page);

    $("#numberofAcoounts").change(function (e) {
      page = 1;
      new accountTable(number[0].total, page);
    });

    $("#rightbutton").click(function () {
      page++;
      new accountTable(number[0].total, page);
    });
    $("#leftbutton").click(function () {
      page--;
      new accountTable(number[0].total, page);
    });

  }
});
