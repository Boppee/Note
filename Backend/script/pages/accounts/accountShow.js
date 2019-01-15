$(document).ready(function () {
  $(".userexbutton").click(function (event) {
    $("."+event.target.id+"Ex").toggle();
    $("#rotate"+event.target.id).toggleClass('flip');
  });
});
//Grab Userdata add appends to page
$.ajax({
  type: "POST",
  url: "script/pages/accounts/fetchAccountUID.php",
  data: {uid: uid},
  success: function (info) {
    $(document).ready(function () {
      if (info.username == "") {
        window.location.href = "?page=accounts";
      }else {
        loaddefult(info);

        function loaddefult(info) {

          $("#gotouser").show();
          $("#save").hide();

          info.active = parseInt(info.active);
          logon = info.lastlogon.split(' ').join('T').slice(0, -3);

          $(".accountpage").show();
          $("#usernameP").val(info.username);
          $("#username").val(" ");

          $("#accountEmail .data").val(info.email);
          $("#lastlogon .data").val(logon);

          if (info.img != "def") {
            if (UrlExists("img/accounts/"+info.img)) {
              var url = "url(img/accounts/"+info.img+")";
              $("#accountImg").css("background-image", url);
            }
          }

          if (info.active == 1) {
            $("#accountActive .data").prop("checked", true);
          }

          $(".data").attr("disabled", "true");

          permsInputs(info.new_permsys);
        }

        var edit = 0;

        $("#edituser").click(function (event) {
          if (edit == 0) {
            loaddefult(info);
            $("#gotouser").hide();
            $(".data").prop("disabled", false);
            $("#save").show();
            $("#lastlogon .data").attr("disabled", "true");
            edit = 1;
          }else {
            if (changes(info, false) > 0) {
              if (!confirm("You have unsaved changes!")) {
                edit = 0;
                loaddefult(info);
              }
            }else {
              edit = 0;
              loaddefult(info);
            }
          }
          event.preventDefault();
        });

        $("#save").click(function (event) {
          changes(info, true);
          event.preventDefault();
        });

        $(".close").click(function (event) {
          close();
          event.preventDefault();
        });

        $("#changeok").click(function (event) {
          close();
          updateAccount(uid);
          event.preventDefault();
        });
        $("#changec").click(function (event) {
          edit = 0;
          loaddefult(info);
          close();
          event.preventDefault();
        });
        $("#imginput").change(function () {
          changeAccountImg(this, info.username);
        });
        $(".permlist input").change(function (event) {
          updatePerm(this, info.username);
        });
        $("#pwdr").click(function () {
          $("body").css("overflow", "hidden");
          window.scrollTo(0, 0);
          $("#pwdrb").show();
        });
        $("#pwdc").click(function () {
          $.ajax({
            type: "POST",
            url: "script/pages/accounts/pwdres.php",
            data: {uid: info.username, newPwd: $("input[name=npwd]").val()},
            success: function (a) {
              $("#code").text("Your code is: "+a);
              $("#codeinfo").text("valid for 5 minutes");
              $(".codedone").hide();
            }
          });

        });

        $("#usernameP").keyup(function () {
          $("#usernameP").val(removeSpace($("#usernameP").val()));
          $.ajax({
            type: "POST",
            url: "script/pages/accounts/checkuid.php",
            data: {uid: $("#usernameP").val()},
            success: function (data) {
              if (edit == 1) {
                if (info.username != $("#usernameP").val()) {

                  if (data == 0) {
                    $("#usernameP").addClass("error");
                    $("#save").hide();
                  }else {
                    $("#usernameP").removeClass("error");
                    $("#save").show();
                  }

                  if ($("#usernameP").val().length == 0) {
                    $("#usernameP").removeClass("error");
                    $("#save").hide();
                  }

                }else {
                  $("#save").show();
                  $("#usernameP").removeClass("error");
                }
              }else {
                $("#save").hide();
                $("#usernameP").removeClass("error");
              }
            }
          });
          $("#email").focus();
        });

      }
    });
  }
});
function changes(info, show) {

  $("#changebody tr").remove();

  var email = $("#accountEmail .data").val();
  var active = 0;
  var uid = $("#usernameP").val();
  var changes = 0;

  if (document.getElementById('activeinput').checked) {
    active = 1;
  }
  if (uid != info.username) {
    changes++;
    $("#changebody").append("<tr id='changeusername'><td>Username</td><td value='"+uid+"'>"+uid+"</td><td>"+info.username+"</td></tr>");
  }
  if (email != info.email) {
    changes++;
    $("#changebody").append("<tr id='changeemail'><td>Email</td><td value='"+email+"'>"+email+"</td><td>"+info.email+"</td></tr>");
  }
  if (active != info.active) {
    changes++;
    if (active == 1) {
      tempactiveN = "Active";
    }else {
      tempactiveN = "Deactivate";
    }
    if (info.active == 1) {
      tempactiveO = "Active";
    }else {
      tempactiveO = "Deactivate";
    }
    $("#changebody").append("<tr id='changeactive'><td>Active</td><td value='"+active+"'>"+tempactiveN+"</td><td>"+tempactiveO+"</td></tr>");

  }
  if (show ==  true) {
    $("body").css("overflow", "hidden");
    window.scrollTo(0, 0);
    if (changes > 0) {
      $("#saveshadow, #changediv").show();
    }else {
      $("#saveshadow, #nochange").show();
    }
  }else {
    return changes;
  }
}
function close() {
  $("body").css("overflow", "");
  $(".shadow, #changeDiv, #nochange, #pwdrb").hide();
}
function updateAccount(sendUID) {
  var errors;
  var ans;
  for (var i = 0; i < $("#changebody tr").length; i++) {
    var temp = $("#changebody").children();

    var formData = new FormData();
    formData.append("uid", sendUID);
    formData.append("index", temp[i].id.replace('change',''));
    formData.append("val", temp[i].children[1].attributes[0].value);

    updateAjax(formData, $("#changebody tr").length, sendUID);

    if (temp[i].id.replace('change','') == "username") {
        sendUID = temp[i].children[1].attributes[0].value;
    }
  }
}
function redir(errors, sendUID){
    if (errors) {
      location.reload();
    }else {
      window.location.href = "?page=accounts&id="+sendUID;
    }
}
function changeAccountImg(input, uid) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $("#accountImg").css("background-image", "url("+e.target.result+")");
    }

    var formData = new FormData();
    formData.append('file', $('#imginput')[0].files[0]);
    formData.append("uid", uid);
    formData.append("index", "img");
    updateAjax(formData, 1, uid);

    reader.readAsDataURL(input.files[0]);
  }
}
function updateAjax(formData, nr, sendUID) {
  formData.append("nr", nr);
  $.ajax({
    type: "POST",
    url: "script/pages/accounts/updateaccount.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (info) {
      if (info == "done") {
        redir(false, sendUID);
      }
      if (info.status == "errors") {
        redir(true, sendUID);
      }
    }
  });
}
function updatePerm(event, uid) {
  var name = event.name;
  var defF = $(event).parents('form').attr('id');
  var form = $(event).parents('form').attr('id').substring(0, $(event).parents('form').attr('id').length - 4);
  if (event.checked) {
    state = 1;
  }else {
    state = 0;
  }
  sendS(name, form, state, uid);
}
function sendS(name, form, state, uid) {
  $.ajax({
    type: "POST",
    url: "script/pages/accounts/permupdate.php",
    data: {name: name, index: form, state: state, uid: uid},
    success: function (a) {
      permsInputs(a);
    }
  });
}
