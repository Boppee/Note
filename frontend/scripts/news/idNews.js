$(document).ready(function () {

    $.ajax({
      type: "POST",
      url: "scripts/news/fetchIdNews.php",
      data: {id: id},
      success: function (data) {

      }
    });

    $("#imgGal").css("height", ($("#imgGal").css("width").slice(0, -2)/21)*9+"px");

    window.onresize = function() {
      $("#imgGal").css("height", ($("#imgGal").css("width").slice(0, -2)/21)*9+"px");
    };

});
