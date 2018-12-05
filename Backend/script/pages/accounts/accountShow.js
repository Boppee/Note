$(document).ready(function () {
  $(".userexbutton").click(function (event) {
    $("."+event.target.id+"Ex").toggle();
    $("#rotate"+event.target.id).toggleClass('flip');
  });
});
