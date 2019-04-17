$(document).ready(function () {

  const child = ({id, name}) => `
    <div class="child" value="${id}">
      <div class="cheader">
        <a href="?page=category&id=${id}">${name}</a>
      </div>
      <div class="cbody" id="c${id}">

      </div>
    </div>
  `;
  const childproduct = ({id, name, price}) => `
    <div class="cproduct" value="${id}" id="ca${id}">
      <div class="cinner">
        <div class="cimg">
        </div>
        <div class="cinfo">
          <a href="?page=products&id=${id}">${name}</a>
          <br>
          <i class="fas fa-cart-plus addcart"></i><span>${price} kr</span>
        </div>
      </div>
    </div>
  `;

  $.ajax({
    type: "POST",
    data: {id: id},
    url: "scripts/category/childs.php",
    success: function (data) {
      for (var i = 0; i < data.length; i++) {
        temp = data[i];

        $("#childs").append([{name: temp.cat.name, id: temp.cat.id}].map(child).join(''));

        if (temp.products.length == null) {
          $("#c"+temp.cat.id).remove();
        }

        for (var o = 0; o < temp.products.length; o++) {
          tempProducts = temp.products[o];
          $("#c"+temp.cat.id).append([{name: tempProducts.name, id: tempProducts.product_id, price: tempProducts.price}].map(childproduct).join(''));
          tempUrl = "url(pages/products/imgs/"+tempProducts.product_id+"/"+tempProducts.imgs[0].n+"."+tempProducts.imgs[0].t+")";
          $("#c"+temp.cat.id).find(".cimg").css("background-image", tempUrl);
        }
      }

      $(".addcart").click(function () {
        item = $(this).parent().parent().parent().attr("value");
        addToCart(item);
        sel = "ca"+item;
        elementAnimateToCart(sel);
      });

    }
  })

});
