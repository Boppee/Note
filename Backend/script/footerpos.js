$(document).ready(function () {
  getFooterPos();

  window.addEventListener('resize', function(){
    getFooterPos();
  });

  var element = $(".totalhight");
  var lastHeight = $(".totalhight").css('height');

  checkForChanges();

  function checkForChanges() {
    console.log("test");
      if (element.css('height') != lastHeight)
      {
          getFooterPos();
          lastHeight = element.css('height');
      }
      setTimeout(checkForChanges, 100);
  }

  function getFooterPos() {
    if (document.body.scrollHeight > document.body.clientHeight) {
      $("footer").css("position", "");
    }else {
      $("footer").css("position", "fixed");
    }
  }
});
