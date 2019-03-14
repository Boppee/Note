valuta = "kr";

function UrlExists(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
function hasLowerCase(str) {
    return (/[a-z]/.test(str));
}
function hasUpperCase(str) {
    return (/[A-Z]/.test(str));
}
function hasNumber(str) {
  return /\d/.test(str);
}
function hasSpecial(str) {
  var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
  if(format.test(str)){
    return true;
  } else {
    return false;
  }
}
function validateEmail(mail) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
    return (true)
  }else {
    return (false)
  }
}
function removeSpace(str) {
  return str.replace(/\s/g, '');
}
function permsInputs(perms) {
  $(document).ready(function () {

    $("#permdivs input").prop("checked", false);
    permslen = perms.length;
    if (permslen > 4) {
      for (var i = 4; i < permslen; i++) {
        id = perms[i][0];
        var checked = 0;
        for (var o = 1; o < perms[i].length; o++) {
          $("#"+id+" .permlist input[name='"+perms[i][o]+"']").prop("checked", true);
        }
      }
    }
  });
}
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function len(arr) {
  var count = 0;
  for (var k in arr) {
    if (arr.hasOwnProperty(k)) {
      count++;
    }
  }
  return count;
}
