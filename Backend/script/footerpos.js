$(document).ready(function () {
  getFooterPos();

  window.addEventListener('resize', function(){
    getFooterPos();
  });
  function getFooterPos() {
    if (document.body.scrollHeight > document.body.clientHeight) {
      $("footer").css("position", "");
    }else {
      $("footer").css("position", "fixed");
    }
    console.log("test");
  }
});
