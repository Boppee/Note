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
        beforeSend: function(){
            $('#loadImg, #login').toggle();
        },
        complete: function(){
            $('#loadImg').hide();
        },
        success: function(result) {

          if (result.status == "pass") {

            changeSalt(result.salt);
            
            $("#email").css("display", "grid");

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
          }

        }
    });

    e.preventDefault();
  });
});
function changeSalt(salt) {
  $("#salt").val(salt);
}
