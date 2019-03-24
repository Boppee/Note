

  const cartItem = ({id, name, price, lager}) => `
    <div class="cartItem" value="${id}" id="cartItem${id}">
      <div class="productCart">
        <div class="pimg">
        </div>
        <div class="productInfo">
          <div class="nameAprice">
            <span>${name}</span>
            <br>
            <span class="priceAfter">${price} </span>
          </div>
          <div class="lager">
            <span class="lagerBefore"></span>
            <br>
            <span>${lager} <i class="fas fa-circle"></i></span>
          </div>
        </div>
      </div>
      <div class="amountCart">
        <i class="fas fa-minus" value="${id}" data="minus" price="${price}"></i>
        <input type="number" class="amountInput" min="1" value="">
        <i class="fas fa-plus" value="${id}" data="plus" price="${price}"></i>
      </div>
      <div class="priceCart">
        <span class="priceAfter"></span>
      </div>
    </div>
  `;

  cookie = JSON.parse(getCookie("cart"));

  if (cookie.length > 1) {
    ids = [];
    o = [];
    for (var i = 1; i < cookie.length; i++) {
      ids.push(cookie[i].id);
      o.push(i);
    }
      $.ajax({
        type: "POST",
        data: {ids: JSON.stringify(ids), o: JSON.stringify(o)},
        url: "scripts/cart/fetch.php",
        success: function (data) {
          console.log(data);
          for (var i = 0; i < data["prodcuts"].length; i++) {
            pData = data["prodcuts"][i];
            if (data.totalstock > 50) {
              lagerTemp = "50+";
            }else {
              lagerTemp = pData.totalstock;
            }
            $("#cartBody").append([{id: pData.product_id, name: pData.name, price: pData.price, lager: lagerTemp}].map(cartItem).join(''));
            $("#cartItem"+pData.product_id+" .pimg").css("background-image", "url(pages/products/imgs/"+pData.product_id+"/"+pData.imgs[0].n+"."+pData.imgs[0].t+")");
            if (lagerTemp != 0) {
              $("#cartItem"+pData.product_id+" .productCart i").addClass("ilager");
            }else {
              $("#cartItem"+pData.product_id+" .productCart i").addClass("slutilager");
            }
            $("#cartItem"+pData.product_id+" .amountInput").val(cookie[data["o"][i]].amount);
            $("#cartItem"+pData.product_id+" .priceCart .priceAfter").text(cookie[data["o"][i]].amount*pData.price);
          }

          $(".amountCart i").click(function () {
            updateCart($(this).attr("value"), $(this).attr("data"), $(this).attr("price"));
          });

        }
      });
  }else {
    h = $("#mrc").height();
    $("#noitems").show();
    $("#noitems").css("line-height", h+"px");

  }


  function updateCart(id, pm, price) {

    cookie = JSON.parse(getCookie("cart"));

    for (var i = 1; i < cookie.length; i++) {
      if (cookie[i].id == id) {
        if (pm == "plus") {
          addToCart(id);
          $("#cartItem"+id+" .priceCart .priceAfter").text((cookie[i].amount+1)*price);
          $("#cartItem"+id+" .amountInput").val((cookie[i].amount+1));
        }else {

          if (cookie[i].amount > 1) {
            removeFromCart(id, 1);
            $("#cartItem"+id+" .priceCart .priceAfter").text((cookie[i].amount-1)*price);
            $("#cartItem"+id+" .amountInput").val((cookie[i].amount-1));
          }else {
            removeFromCart(id, 1);
            $("#cartItem"+id).remove();
          }
        }
      }
    }

  }
