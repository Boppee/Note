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
