$(document).ready(function () {

  $.ajax({
    type: "GET",
    url: "scripts/start/fetchData.php",
    success: function (data) {

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

      for (var i = 0; i < data.length; i++) {
        tempProducts = data[i];
        console.log(tempProducts);
        $("#products").append([{name: tempProducts.name, id: tempProducts.product_id, price: tempProducts.price}].map(childproduct).join(''));
        tempUrl = "url(pages/products/imgs/"+tempProducts.product_id+"/"+tempProducts.imgs[0].n+"."+tempProducts.imgs[0].t+")";
        $("#ca"+tempProducts.product_id).find(".cimg").css("background-image", tempUrl);
      }
    }
  });
});
