function sendRecaptcha(recap) {
  $(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "script/pages/login/confirmrecaptcha.php",
        data: {
          key: recap
        },
        success: function(result) {
          $("#capatcha").toggle();
          $("#login").css("display", "grid");
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
        data: {
          uid: uid,
          pwd: pwd,
          salt: salt
        },
        success: function(result) {

          if (result.status == "pass") {

            $("#login").hide();
            $("#email").css("display", "grid");

            $("#email").submit(function (e) {

              var code = $("#code").val();

              $.ajax({
                type: "POST",
                url: "script/pages/login/validateemail.php",
                data: {
                  salt: result.salt,
                  code: code
                },
                succes: function(result ){

                }
              });

              e.preventDefault();
            });
          }else if (result.errors == 1){
            changeSalt(result.salt);
          }

        }
    });

    e.preventDefault();
  });
});
function changeSalt(salt) {
  $("#salt").val(salt);
}
