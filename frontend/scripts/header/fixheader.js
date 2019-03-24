$(document).ready(function () {

  head = $("#colorhead").height();

  if (getCookie("hidden") == "") {
    document.cookie = "hidden=false";
    var hide = getCookie("hidden");
  }else {
    var hide = getCookie("hidden");
  }
  headpos(window.scrollY, hide, head);

  window.onscroll = function (e) {
    headpos(window.scrollY, hide, head);
  }
  window.onresize = function(event) {
    headpos(window.scrollY, hide, head);
  };

  $("#removeTop").click(function () {
    hide = "true";
    document.cookie = "hidden=true";
    headpos(window.scrollY, hide, head);
  })
  $("#showTop").click(function () {
    hide = "false";
    document.cookie = "hidden=false";
    headpos(window.scrollY, hide, head);
  });
});
function headpos(y, hide, head) {

  pos = parseInt($("#topheader").css("margin-top"));

  windowSize = $(window).height();
  bodysize = $(document).height();

  innerW = window.innerWidth;

  if (innerW <= 700) {
    if (hide == "true") {
      $("#showTop").show();
      $("#fixposDiv").hide();
    }else {
      $("#showTop").hide();
      $("#fixposDiv").show();
    }
  }

  if (y != 0 && bodysize-head > windowSize) {
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
