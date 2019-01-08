$(document).ready(function () {

  //take inputs and shows before upload //NOT MY CODE!
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $("#accountImg").css("background-image", "url("+e.target.result+")");
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imgInput").change(function() {
    readURL(this);
  });

  //check password
  $("#password input:password").keyup(function () {
    var pwd1 = $("input[name=pwd1]").val();
    var pwd2 = $("input[name=pwd2]").val();

    var pwdErrors = [];
    if (pwd1.length != 0) {
      $("input[name=pwd2]").prop("disabled", false);
      if (pwd1.length < 10) {
        pwdErrors.push("length");
      }
      if (pwd1 != pwd2) {
        pwdErrors.push("match");
      }
      if (!hasLowerCase(pwd1)) {
        pwdErrors.push("lowercase");
      }
      if (!hasUpperCase(pwd1)) {
        pwdErrors.push("uppercase");
      }
      if (!hasSpecial(pwd1)) {
        pwdErrors.push("special");
      }
      if (!hasNumber(pwd1)) {
        pwdErrors.push("number");
      }
      if (pwd1.length >= 20) {
        pwdErrors.push("length");
      }

      if (pwdErrors.length == 0) {
        sendCreatePwd = pwd1;
      }
      $("#pwdErrorList li").css("color", "green");
      for (var i = 0; i < pwdErrors.length; i++) {
        $("#pwd"+pwdErrors[i]).css("color", "red");
      }
    }else {
      $("input[name=pwd2]").val("");
      $("input[name=pwd2]").prop("disabled", true);
      $("#pwdErrorList li").css("color", "");
    }
  });

  $("input[name=uid]").keyup(function (e) {
    $.ajax({
      type: "POST",
      url: "script/pages/accounts/checkuid.php",
      data: {uid: e.target.value},
      success: function (data) {
        if (data == 0) {
          $("input[name=uid]").addClass("error");
        }else {
          $("input[name=uid]").removeClass("error");
        }
      }
    });
  });
});
