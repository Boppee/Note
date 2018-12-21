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
          console.log(info.img);

          $("#gotouser").show();
          $("#save").hide();

          info.active = parseInt(info.active);
          logon = info.lastlogon.split(' ').join('T').slice(0, -3);

          $(".accountpage").show();
          $("#usernameP").text(info.username);
          $("#username").val(" ");
          username();

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
      }
    });
  }
});

function username() {
  var length = $("#username").val().length;
  if (length < 1) {
    $('#usernameP').text(function (_,txt) {
        return txt.slice(0, -1);
    });
  }else {
    $('#usernameP').text(function (_,txt) {
        return txt+$("#username").val().substring(1);
    });
  }
  $("#username").val(" ");
}

function changes(info, show) {

  $("#changebody tr").remove();

  var email = $("#accountEmail .data").val();
  var active = 0;
  var uid = $("#usernameP").text();
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
  $(".shadow, #changeDiv, #nochange").hide();
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
