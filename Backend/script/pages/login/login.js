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
          if (!isIE) {
            $("#login").css("display", "grid");
          }else {
            $("#login").css("display", "inline");
          }
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
        beforeSend: function(){
            $('#loadImg, #login, .loadImg').toggle();
        },
        complete: function(){
            $('#loadImg, .loadImg').hide();
        },
        success: function(result) {

          if (result.status == "pass") {

            changeSalt(result.salt);
            if (!isIE) {
              $("#email").css("display", "grid");
            }else {
              $("#email").css("display", "inline");
            }


            $("#email").submit(function (e) {

              var code = $("#code").val();
              var salt = $("#salt").val();

              $.ajax({
                type: "POST",
                url: "script/pages/login/validateemail.php",
                data: {
                  salt: salt,
                  code: code
                },
                success: function(result){
                  if (result.status == "pass") {
                    window.location.href = "?page="+result.page;
                  }else if (result.error) {
                    changeSalt(result.salt);
                  }
                }
              });

              e.preventDefault();
            });
          }else if (result.error){
            changeSalt(result.salt);
            $("#login").show();
          }

        }
    });

    e.preventDefault();
  });
});
function changeSalt(salt) {
  $("#salt").val(salt);
}
