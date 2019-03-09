$(document).ready(function () {

  var element = $(".totalhight");
  var lastHeight = $(".totalhight").css('height');

  checkForChanges();

  function checkForChanges() {
      if (element.css('height') != lastHeight)
      {
          lastHeight = element.css('height');
          lastHeight = parseInt(lastHeight.substring(0, lastHeight.length - 2));
          lastHeight += 50;
          //console.log("Window: "+window.innerHeight);
          //console.log("lastHeight: "+lastHeight);
          if (lastHeight > window.innerHeight) {
            $("footer").css("position", "");
          }else {
            $("footer").css("position", "fixed");
          }
      }
      setTimeout(checkForChanges, 100);
  }
});
