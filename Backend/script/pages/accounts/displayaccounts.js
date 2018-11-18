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
        result.forEach(function (value, index) {
          $("#accountab").append("<tr class='accountRow' id='"+value.username+"'>");
          if (value.active == 1) {
            $("#"+value.username).append("<td class='"+value.username+" activeTd'><input id='"+value.username+"Input' class='"+value.username+" activeInput' value="+value.username+" type='checkbox' checked></td>");
          }else {
            $("#"+value.username).append("<td class='"+value.username+" activeTd'><input id='"+value.username+"Input' class='"+value.username+" activeInput' value="+value.username+" type='checkbox'></td>");
          }
          $("#"+value.username).append("<td class='"+value.username+" username'>"+value.username+"</td>");

        });

        $(".activeInput").change(function (event) {
          var index = "active";
          var user = "";
          $.ajax({
              type: "POST",
              url: "script/pages/accounts/updateaccount.php",
              data: {
                value: value,
                index: index,
                user: user
              },
              success: function(result) {

              }
          });
        });
      }
  });


});
