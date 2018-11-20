$(document).ready(function () {

  for (var i = 1; i <= 8; i++) {
    var number = i*5;
    if (number == 20) {
      $("#numberofAcoounts").append("<option selected value='"+number+"'>"+number+"</option>");
    }else {
      $("#numberofAcoounts").append("<option value='"+number+"'>"+number+"</option>");
    }
  }

  var limit = $("#numberofAcoounts").val();
  var offset = "test";
  $.ajax({
      type: "POST",
      url: "script/pages/accounts/fetchAccounts.php",
      data: {limit: limit, offset: offset},
      success: function(result) {
<<<<<<< HEAD
        result.forEach(function (value, index) {
          $(document).ready(function () {
            
          });
=======
        result.accounts.forEach(function (value, index) {
          $("#accountab").append("<tr class='accountRow' id='"+value.username+"'>");
          if (value.active == 1) {
            $("#"+value.username).append("<td class='"+value.username+" activeTd'><input class='"+value.username+" activeInput' value="+value.username+" type='checkbox' checked></td>");
          }else {
            $("#"+value.username).append("<td class='"+value.username+" activeTd'><input class='"+value.username+" activeInput' value="+value.username+" type='checkbox'></td>");
          }
          $("#"+value.username).append("<td class='"+value.username+" username'>"+value.username+"</td>");
          $("#"+value.username).append("<td class='"+value.username+" lastlogon'>"+value.lastlogon+"</td>");
          $("#"+value.username).append("<td class='"+value.username+" pages'>"+value.json_page+"</td>");
          $("#"+value.username).append("<td class='"+value.username+" permission'>"+value.json_perms+"</td>");

        });
        $('tr').click(function (event) {
             window.location.replace("?page=accounts&id="+$(this).attr('id'));
>>>>>>> adabfdcc43bb03c3044a586ac9019669891f8e19
        });
      }
  });


});
