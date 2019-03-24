numberInCart();

function elementAnimateToCart(selector) {
  html2canvas(document.querySelector("#"+selector),{logging: false}).then(canvas => {
    randomId = makeid(10);
    canvas.id='animateToCart'+selector+randomId;
    $("body").append(canvas).css("position", "relative");
    $(canvas).addClass("animation")
    element = document.getElementById(selector).getBoundingClientRect();
    cart = document.getElementById("cartIcon").getBoundingClientRect();
    $("#animateToCart"+selector+randomId).css({
      "position": "fixed",
      "top": element.y,
      "left": element.x,
      "width": element.width,
      "z-index": 100
    }).animate({
      top: cart.top,
      left: cart.x,
      height: cart.height,
      width: cart.width,
      opacity: 0
    }, 400, function () {
      $("#animateToCart"+selector+randomId).remove();
    })
  });
}

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
  var arr = JSON.parse(cartArray);
  for (var i = 1; i < arr.length; i++) {
    if (arr[i].id == id) {
      if (arr[i].amount > 1) {
        arr[i] = {id: id, amount: parseInt(arr[i].amount)-1};
        arr[0].total -= 1;
      }else {
        arr[0].total -= arr[i].amount;
        arr.splice(i, 1);
      }
      var json_str = JSON.stringify(arr);
      createCookie('cart', json_str);

      numberInCart();
    }
  }
}
function numberInCart() {
  $(document).ready(function () {
    var json_str = getCookie('cart');
    var arr = JSON.parse(json_str);
    if (arr == null) {
      $("#cartA").text(0);
    }else {
      $("#cartA").text(arr[0].total);
    }
  });
}
