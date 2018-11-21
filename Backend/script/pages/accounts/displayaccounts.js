$(document).ready(function () {

  for (var i = 1; i <= 8; i++) {
    var number = i*5;
    if (number == 20) {
      $("#numberofAcoounts").append("<option selected value='"+number+"'>"+number+"</option>");
    }else {
      $("#numberofAcoounts").append("<option value='"+number+"'>"+number+"</option>");
    }
  }

  var test = $("#numberofAcoounts").val();
  $.ajax({
      type: "GET",
      url: "script/pages/accounts/fetchAccounts.php",
      data: test,
      success: function(result) {
        $(document).ready(function () {
          console.log(result);
          for (var i = 0; i < result.accounts.length; i++) {
            var value = result.accounts[i];

            $("#accountab").append("<tr class='accountRow' id='"+value.username+"'>");

            $("#"+value.username).append("<td class='"+value.username+" activeTd'><input id='test' class='"+value.username+" activeInput' type='checkbox'></td>");

            if (value.active == "1") {
              $("."+value.username+" input").attr("checked", "true");
            }

            $("#"+value.username).append("<td class='"+value.username+" username'>"+value.username+"</td>");
            $("#"+value.username).append("<td class='"+value.username+" lastlogon'>"+value.lastlogon+"</td>");
          }
          var orderArray = ["dashboard", "accounts", "orders", "products", "categories", "statistics"];

          for (var i = 0; i < orderArray.length; i++) {
            $("#"+value.username).append("<td class='"+value.username+" pages'><input class='"+value.username+" pageinput' value='"+value.username+orderArray[i]+"' type='checkbox'></td>");
          }

          for (var t = 0; t < value.json_page.length; t++) {
            if (orderArray.indexOf(value.json_page[t]) >= 0) {
              $("input[value='"+value.username+orderArray[orderArray.indexOf(value.json_page[t])]+"']").attr("checked", "true");
            }
          }

          $('tr').click(function (event) {
              window.location.replace("?page=accounts&id="+$(this).attr('id'));
          });
        });
      }
  });
});
