for (var i = 1; i <= 8; i++) {
  var number = i*5;
  if (number == 20) {
    $("#numberofAcoounts").append("<option selected value='"+number+"'>"+number+"</option>");
  }else {
    $("#numberofAcoounts").append("<option value='"+number+"'>"+number+"</option>");
  }
}
$(document).ready(function () {
  var test = $("#numberofAcoounts").val();
  $.ajax({
      type: "GET",
      url: "script/pages/accounts/fetchAccounts.php",
      data: test,
      success: function(result) {
        result.forEach(function (value, index) {
          $(document).ready(function () {
            $("#accountab").append("<tr class='accountRow' id='"+value.username+"'>");
            $("#"+value.id).append("<td class='accountId'>"+value.id+"</td>");
          });
        });
      }
  });
});
