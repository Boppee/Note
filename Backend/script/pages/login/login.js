$(document).ready(function () {

  $("#navlist").hide();

  $("#navarrow").click(function () {
    $("#navlist").animate({
      width: "toggle"
    });
    $("#navarrow").toggleClass("rotate");
  });
  $("#loginbutton").click(function () {
    $("#forms").toggle("slow");
    $("#loginButton i").toggleClass("rotate");
    $("#forms").css("min-width", "500px");
  });

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

            $("#email").css("display", "inline");


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
                    window.location.href = result.page;
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
          $("#login").css("display", "inline");
        }
    });
  });
}
