pos = parseInt($("#topheader").css("margin-top"));

if (getCookie("hidden") == "") {
  document.cookie = "hidden=false";
  var hide = getCookie("hidden");
}else {
  var hide = getCookie("hidden");
}
headpos(window.scrollY, pos, hide);

$(window).scroll(function() {
  headpos(window.scrollY, pos, hide);
});
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
function headpos(y, pos, hide) {
  if (window.innerWidth <= 700) {
    if (hide == "true") {
      $("#showTop").show();
      $("#fixposDiv").hide();
    }else {
      $("#showTop").hide();
      $("#fixposDiv").show();
    }
  }else {
    $("#showTop").hide();
    $("#fixposDiv").show();
  }
  if (y != 0) {
    if (window.innerWidth < 600) {
      $("#topul").hide();
    }else {
      $("#topul").show();
    }
    if (y < pos) {
      $("#fixposDiv").css("width", "100%");
      $("#fixposDiv").addClass("fixedPos");
      $("#topheader").css("margin", 0);
    }
  }else {
    $("#topul").show();
    if (window.innerWidth < 1000) {
      $("#fixposDiv").css("width", "100%");
    }else {
      $("#fixposDiv").css("width", "70%");
    }
    $("#fixposDiv").removeClass("fixedPos");
    $("#topheader").css("margin", "1em 0");
  }
}
