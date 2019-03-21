$(document).ready(function () {
  $("#searchInput").keyup(function () {
    if ($(this).val().length != 0) {

      $(this).css("border-radius", "1.5em 1.5em 0 0");
      $("#catList li, productList li").remove();

      var tempSearch = $(this).val();

      const cat = ({id, name}) => `
        <li id="cat${id}">
          <a href="?category&id=${id}">${name}</a>
        </li>
      `;
      const products = ({id, name, imgtype, price}) => `
        <li id="ps${id}" class="searchLi">
          <div class="innerSearchP">
            <img src="pages/products/imgs/${id}/1.${imgtype}" class="searchImg">
            <div class="pinfo">
              <p class="psname">${name}</p>
              <p class="psprice">${price} Kr</p>
            </div>
            <a class="addtocart" onclick="addToCart(${id})" value="${id}" data="ps${id}"><i class="fas fa-cart-plus"></i></a>
          </div>
        </li>
      `;

      $.ajax({
        type: "POST",
        url: "scripts/header/search.php",
        data: {text: tempSearch},
        success: function (data) {

          maxCats = 5;
          maxProducts = 10;

          $("#searchres").show();
          $("#catList li, #productList li").remove();
          if (data["cats"].length == 0) {
            $("#catList li").remove();
            $("#cnores").show();
            $("#catList").hide();
          }else {
            $("#cnores").hide();
            $("#catList").show();
            for (var i = 0; i < data["cats"].length; i++) {
              if (maxCats > i) {
                $("#catList").append([{id: data["cats"][i].id, name: data["cats"][i].name}].map(cat).join(''));
              }
            }
          }
          if (data["products"].length == 0) {
            $("#sproductList li").remove();
            $("#pnores").show();
            $("#productList").hide();
          }else {
            $("#pnores").hide();
            $("#productList").show();
            for (var i = 0; i < data["products"].length; i++) {
              if (maxProducts > i) {
                $("#productList").append([{id: data["products"][i].product_id, name: data["products"][i].name, imgtype: data["products"][i].imgs[0].t, price: data["products"][i].price}].map(products).join(''));
              }
            }
          }
          $(".addtocart").click(function () {
            elementAnimateToCart($(this).attr("data"));
          });
        }
      });
    }else {
      $(this).css("border-radius", "2.5em");
      $("#catList li, #productList li").remove();
      $("#searchres").hide();
    }
  });
});
