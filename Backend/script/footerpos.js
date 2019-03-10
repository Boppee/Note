$(document).ready(function () {

  var element = $(".totalhight");
  var lastHeight = 0;;

  checkForChanges();

  function checkForChanges() {
      if (element.css('height') != lastHeight)
      {
          lastHeight = element.css('height');
          lastHeight = parseInt(lastHeight.substring(0, lastHeight.length - 2));
          lastHeight += 50;
          if (lastHeight > window.innerHeight) {
            $("footer").css("position", "");
          }else {
            $("footer").css("position", "fixed");
          }
      }
      setTimeout(checkForChanges, 500);
  }
});
