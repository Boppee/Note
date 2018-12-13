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
          $("#usernameP").text(info.username);
          $("#username").val(" ");
          username();

          $("#accountEmail .data").val(info.email);
          $("#lastlogon .data").val(logon);

          if (info.img.length > 0) {
            $("#accountimg").attr("src", info.img);
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

function redir() {
  window.location.href = "?page=accounts&id="+$("#usernameP").text();
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
  for (var i = 0; i < $("#changebody tr").length; i++) {
    var temp = $("#changebody").children();
    var tempid = temp[i].id.replace('change','');
    var tempval = temp[i].children[1].attributes[0].value;
    $.ajax({
      type: "POST",
      url: "script/pages/accounts/updateaccount.php",
      data: {uid: sendUID, index: tempid, val: tempval},
      success: function (info) {
        console.log(info);
        if (info.status == "errors") {
          alert(info.errors);
          errors++;
        }
      }
    });
    if (tempid == "username") {
        sendUID = tempval;
    }
  }
  if (errors > 0) {
    location.reload();
  }else {
    window.location.href = "?page=accounts&id="+sendUID;
  }
}
