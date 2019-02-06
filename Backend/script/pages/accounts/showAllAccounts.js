$.ajax({
  type: "POST",
  url: "script/pages/accounts/numberOfAccounts.php",
  dataType: "JSON",
  success: function (data) {

    items = data[0].total;

    $.ajax({
      type: "POST",
      url: "script/pages/accounts/fetchAccounts.php",
      data: {limit: items},
      success: function (accountData) {

        for (var i = 0; i < accountData.length; i++) {
          number = i;
          addNewRow(accountData[i], number);
        }

        $(document).ready(function () {
          pageSys = new pageSystem(items);

          $("#searchTable").on("keyup", function() {
            pageSys.tableSearch();
          });

          $("#rightbutton").click(function () {
            pageSys.nextPage();
          });
          $("#leftbutton").click(function () {
            pageSys.prevPage();
          });

          $("#numberOfItems").change(function () {
            pageSys.itemsPerPageUpdate();
          });

        });

      }
    });

  }
});

function addNewRow(data, number) {
  $(document).ready(function () {
    $("#listTable").append("<tr value='"+number+"' class='itemsRow' id='account"+data.username+"'>");
    $("#account"+data.username).append("<td class='"+data.username+" activeTd'><input id='test' class='"+data.username+" activeInput' type='checkbox'></td>");

    if (data.active == "1") {
      $("."+data.username+" input").attr("checked", "true");
    }

    $("#account"+data.username).append("<td class='"+data.username+" username'>"+data.username+"</td>");
    $("#account"+data.username).append("<td class='"+data.username+" lastlogon'>"+data.lastlogon+"</td>");

    var orderArray = ["accounts", "orders", "products", "categories", "statistics"];

    for (var i = 0; i < orderArray.length; i++) {
      $("#account"+data.username).append("<td class='"+data.username+" pages'><input class='"+data.username+" pageinput' value='"+data.username+orderArray[i]+"' type='checkbox'></td>");
    }
    for (var t = 4; t < data.new_permsys.length; t++) {
      if (orderArray.indexOf(data.new_permsys[t][0]) >= 0) {
        $("input[value='"+data.username+orderArray[orderArray.indexOf(data.new_permsys[t][0])]+"']").attr("checked", "true");
      }
    }

    $("#account"+data.username).append("<td class='"+data.username+" gotoprofile'><a href='?page=list&underpage=accounts&id="+data.username+"'>Profile</a></td>");

  });
}
