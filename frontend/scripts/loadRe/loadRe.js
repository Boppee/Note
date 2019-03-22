$(document).ready(function () {
  for (var i = 0; i < $(".re").length; i++) {
    element = $(".re")[i];
    $.ajax({
      type: "GET",
      url: "scripts/loadRe/fetchProdcutData.php",
      success: function (data) {
        
      }
    });
  }
});
