  const cartItem = ({id, name, price, lager, index}) => `
    <div class="cartItem" value="${id}" id="cartItem${id}" index="${index}">
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
            <span class="lagerBefore deskLager"></span>
            <br class="deskLager">
            <span class="deskLager">${lager} <i class="fas fa-circle"></i></span>
            <i class="fas fa-circle mobileLager"></i>
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

  const giftCard = ({id}) => `
  <div class="giftcard" id="giftcard${id}">
    <i class="fas fa-times removeGC"></i>
    <input type="text" placeholder="Kod" class="codeGC" apl="false">
    <input type="submit" class="apGC" value="Använd" ids="${id}">
  </div>
  `;

  cookie = JSON.parse(getCookie("cart"));

  totalSum = 0;

  if (cookie !== null) {
    if (cookie[0].total !== 0) {
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
            for (var i = 0; i < data["prodcuts"].length; i++) {
              pData = data["prodcuts"][i];
              if (data.totalstock > 50) {
                lagerTemp = "50+";
              }else {
                lagerTemp = pData.totalstock;
              }
              $("#cartBody").append([{index: i, id: pData.product_id, name: pData.name, price: pData.price, lager: lagerTemp}].map(cartItem).join(''));
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

              totalSum = 0;

              $("#cartBody .cartItem").each(function () {
                totalSum += parseInt(data["prodcuts"][$(this).attr("index")].price*$(this).find(".amountInput").val());
              });

              $("#sumTotSpan").text(totalSum);
            });

            $("#cartBody .cartItem").each(function () {
              totalSum += parseInt(data["prodcuts"][$(this).attr("index")].price*$(this).find(".amountInput").val());
            });

            $("#sumTotSpan").text(totalSum);

            idcards = 0;
            cards = [];

            $("#addgiftcard").click(function () {
              if (idcards == 0) {
                $("#giftcards").append([{id: idcards}].map(giftCard).join(''));
                idcards++;
              }else {
                if ($("#giftcard"+(idcards-1)+" .codeGC").attr("apl") == "true") {
                  $("#giftcards").append([{id: idcards}].map(giftCard).join(''));
                  idcards++;
                }
              }


              $(".removeGC").click(function () {
                if ($(this).parent().find(".codeGC").attr("apl") == "true") {
                  cards.splice(cards.indexOf($(this).parent().find(".codeGC").val()),1);
                  $(this).parent().remove();
                }else {
                  $(this).parent().remove();
                }
              });

              $(".apGC").click(function () {
                tempCode = $(this).parent().find(".codeGC").val();
                if (tempCode.length > 5) {
                  $.ajax({
                    type: "POST",
                    url: "scripts/cart/giftcards.php",
                    data: {code: tempCode, id: $(this).attr("ids")},
                    success: function (data) {
                      if (data.status == "ok") {
                        cards.push(tempCode);
                        $("#giftcard"+data.id).find(".apGC").hide();
                        $("#giftcard"+data.id).find(".codeGC").attr("disabled", "true");
                        $("#giftcard"+data.id).find(".codeGC").attr("apl", "true");
                        $("#giftcard"+data.id).find(".codeGC").removeClass("error");
                        $("#giftcard"+data.id).append("<span class='priceAfter'>"+data.card+" </span>");
                      }else {
                        $("#giftcard"+data.id+" .codeGC").addClass("error");
                      }
                    }
                  });
                }
              });

            });

          }
        });
    }else {
      $(document).ready(function () {
        h = $("#mrc").height();
        $("#noitems").show();
        $("#CartItems").hide();
        $("#noitems").css("line-height", h+"px");

        $("#reload").click(function () {
          location.reload();
        });

      });
    }
  }else {
    $(document).ready(function () {
      h = $("#mrc").height();
      $("#noitems").show();
      $("#CartItems").hide();
      $("#noitems").css("line-height", h+"px");

      $("#reload").click(function () {
        location.reload();
      });

    });
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
