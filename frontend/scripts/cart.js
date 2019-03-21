numberInCart();

function addToCart(id) {
  cartArray = getCookie("cart");
  if (cartArray == null) {
    var arr = [{total: 1},{id: id, amount: 1}];
    var json_str = JSON.stringify(arr);
    createCookie('cart', json_str);
  }else {
    var json_str = getCookie('cart');
    var arr = JSON.parse(json_str);
    tempFound = false;
    for (var i = 1; i < arr.length; i++) {
      if (arr[i].id == id) {
        arr[i] = {id: id, amount: parseInt(arr[i].amount)+1};
        var tempFound = true;
      }
    }
    if (!tempFound) {
      arr.push({id: id, amount: 1});
    }
    arr[0].total += 1;
    var json_str = JSON.stringify(arr);
    createCookie('cart', json_str);
  }

  numberInCart();

}
function removeFromCart(id, amount) {
  cartArray = getCookie("cart");
  var arr = JSON.parse(json_str);
  for (var i = 1; i < arr.length; i++) {
    if (arr[i].id == id) {
      var key = i;
    }
  }
  if (arr[key].amount > 0) {
    arr[key] = {id: id, amount: parseInt(arr[i].amount)-1};
    arr[0].total -= 1;
  }else {
    arr[0].total -= arr[key].amount;
    arr.splice(key, 1);
  }
  var json_str = JSON.stringify(arr);
  createCookie('cart', json_str);

  numberInCart();

}
function numberInCart() {
  var json_str = getCookie('cart');
  var arr = JSON.parse(json_str);
  if (arr == null) {
    alert()
    $("#cartA").text(0);
  }else {
    alert(arr[0].total)
    $("#cartA").text(arr[0].total);
  }
}
