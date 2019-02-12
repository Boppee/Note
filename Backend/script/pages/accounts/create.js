$(document).ready(function () {

  $("#coac").hide();

  var perm = ["dashboard","settings","logout","myaccount"];

  var uid = 1;
  var pwd = 1;
  var email = 1;

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
  $("#accountpwd input:password").keyup(function () {
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
        pwd = 0;
      }else {
        pwd = 1;
      }
      $("#pwdErrorList li").css("color", "green");
      for (var i = 0; i < pwdErrors.length; i++) {
        $("#pwd"+pwdErrors[i]).css("color", "red");
      }
    }else {
      $("input[name=pwd2]").val("");
      $("input[name=pwd2]").prop("disabled", true);
      $("#pwdErrorList li").css("color", "");
      pwd = 1;
    }
    update(uid, pwd, email);
  });

  $("input[name=email]").keyup(function (event) {
    if (validateEmail(event.target.value)) {
      $("input[name=email]").removeClass("error");
      email = 0;
    }else {
      $("input[name=email]").addClass("error");
      email = 1;
    }
    update(uid, pwd, email);
  });

  $("input[name=uid]").keyup(function (e) {
    $.ajax({
      type: "POST",
      url: "script/pages/accounts/checkuid.php",
      data: {uid: e.target.value},
      success: function (data) {
        if (data == 0) {
          $("input[name=uid]").addClass("error");
          uid = 1;
        }else {
          $("input[name=uid]").removeClass("error");
          uid = 0;
        }
        if (e.target.value.length == 0) {
          uid = 1;
          $("input[name=uid]").removeClass("error");
        }
        e.target.value = removeSpace(e.target.value);
        update(uid, pwd, email);
      }
    });
  });

  function update(uid, pwd, email) {
    if ( (uid+pwd+email) == 0) {
      $("#coac").show();
    }else {
      $("#coac").hide();
    }
  }
  $(".permlist input").change(function (event) {
    var name = event.target.name;
    var defF = $(event.target).parents('form').attr('id');
    var index = $(event.target).parents('form').attr('id').substring(0, $(event.target).parents('form').attr('id').length - 4);
    if (event.target.checked) {
      state = 1;
    }else {
      state = 0;
    }
    perm = perms(perm, index, name, state);
    permsInputs(perm);
  });

  function perms(perm, index, name, state) {

    var perms = perm.length;

    for (var i = 4; i < perms; i++) {
      if (perm[i][0] == index) {
        var indexKey = i;
      }
    }

    if (typeof indexKey !== 'undefined') {
      var key = perm[indexKey].indexOf(name);
      if (state == 1) {
        if (key == -1) {
          perm[indexKey].push(name);
        }
      }else if (state == 0) {
        perm[indexKey].splice(key, 1);
      }
    }else {
      indexKey = perms;
      if (state == 1) {
        var tempArray = [index, name]
        perm[indexKey] = tempArray;
      }
    }

    var items = ["modify", "delete", "reset password"];

    if (name == "list") {
      if (state == 0) {
        for (var i = 0; i < items.length; i++) {
          if (perm[indexKey].indexOf(items[i]) != -1) {
            perm[indexKey].splice(perm[indexKey].indexOf(items[i]), 1);
          }
        }
      }
    }else {
      indexKey;
      if (perm[indexKey].indexOf("list") == -1) {
        if (name != "create") {
          perm[indexKey].push("list");
        }
      }
    }

    if (perm[indexKey].length == 1) {
      perm.splice(indexKey, 1);
    }
    return perm;
  }


  $("#coac").click(function (event) {
    event.preventDefault();
    create();
  });

  function create() {
    $(document).ready(function () {
      var sendPassword = $("input[name=pwd1]").val();
      var sendEmail = $("input[name=email]").val();
      var sendUsername = $("input[name=uid]").val();
      var sendActive = 0;

      if (document.getElementById("activeinput").checked == true) {
        sendActive = 1;
      }

      var sendPerms = JSON.stringify(perm);

      var formData = new FormData();

      formData.append('file', $('#imgInput')[0].files[0]);
      formData.append("uid", sendUsername);
      formData.append("pwd", sendPassword);
      formData.append("email", sendEmail);
      formData.append("active", sendActive);
      formData.append("perms", sendPerms);

      $.ajax({
        type: "POST",
        url: "script/pages/accounts/createAccount.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (info) {
          window.location.href = "?page=accounts&id="+info;
        }
      });
    });
  }

});
