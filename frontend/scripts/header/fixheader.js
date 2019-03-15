pos = parseInt($("#topheader").css("margin-top"));

$(window).scroll(function() {
  headpos(window.scrollY, pos);
});
function headpos(y, pos) {
  if (y != 0) {
    if (y < pos) {
      $("#fixposDiv").css("width", "100%");
      $("#fixposDiv").addClass("fixedPos");
      $("#topheader").css("margin", 0);
    }
  }else {
    $("#fixposDiv").css("width", "70%");
    $("#fixposDiv").removeClass("fixedPos");
    $("#topheader").css("margin", "1em 0");
  }
}
