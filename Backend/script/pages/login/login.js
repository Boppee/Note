function sendRecaptcha(recap) {
  $(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "script/pages/login/confirmrecaptcha.php",
        data: {key: recap},
        success: function(result) {
          $("#capatcha").toggle();
          $("#login").css("display", "grid")
        }
    });
  });
}
$(document).ready(function () {
  $("#login").submit(function (e) {

    var salt = $("#salt").val();
    var uid = $("#uid").val();
    var pwd = $("#pwd").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "script/pages/login/validatelogin.php",
        data: {uid: uid, pwd: pwd, salt: salt},
        success: function(result) {
          
        }
    });

    e.preventDefault();

  });
});
