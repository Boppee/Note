$(document).ready(function () {

  pos = parseInt($("#topheader").css("margin-top"));

  if (getCookie("hidden") == "") {
    document.cookie = "hidden=false";
    var hide = getCookie("hidden");
  }else {
    var hide = getCookie("hidden");
  }
  headpos(window.scrollY, pos, hide);

  window.onscroll = function (e) {
    headpos(window.scrollY, pos, hide);
  }
  window.onresize = function(event) {
    headpos(window.scrollY, pos, hide);
  };

  $("#removeTop").click(function () {
    hide = "true";
    document.cookie = "hidden=true";
    headpos(window.scrollY, pos, hide);
  })
  $("#showTop").click(function () {
    hide = "false";
    document.cookie = "hidden=false";
    headpos(window.scrollY, pos, hide);
  });
});
function headpos(y, pos, hide) {

  innerW = window.innerWidth;
  var limit = Math.max(
    document.body.scrollHeight,
    document.body.offsetHeight,
    document.documentElement.clientHeight,
    document.documentElement.scrollHeight,
    document.documentElement.offsetHeight
  );

  if (innerW <= 700) {
    if (hide == "true") {
      $("#showTop").show();
      $("#fixposDiv").hide();
    }else {
      $("#showTop").hide();
      $("#fixposDiv").show();
    }
  }

  if (y != 0 && (limit-pos) >= window.outerHeight) {
    if (y > pos) {

      $("#fixposDiv").css("width", "100%");
      $("#fixposDiv").addClass("fixedPos");
      $("#topheader").css("margin", 0);

      if (innerW < 600) {
        $("#topul").hide();
      }else {
        $("#topul").show();
      }

    }
  }else {
    $("#topul").show();
    if (innerW <= 1000) {
      $("#fixposDiv").css("width", "100%");
    }else {
      $("#fixposDiv").css("width", "70%");
    }
    $("#fixposDiv").removeClass("fixedPos");
    $("#topheader").css("margin", "1em 0");
  }
}
