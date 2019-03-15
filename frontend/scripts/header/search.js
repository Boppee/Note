$(document).ready(function () {
  $("#searchInput").keyup(function () {
    var tempSearch = $(this).val();
    $.ajax({
      type: "POST",
      url: "script/header/search.php",
      data: {text: tempSearch},
      success: function () {
        
      }
    })
  });
});
