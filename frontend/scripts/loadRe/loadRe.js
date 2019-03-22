$(document).ready(function () {

  const reDiv = ({name, img, price, id}) => `
    <div class="re" id="re${id}">
      <div class="reHead">
        <span>Vi rekommenderar</span>
      </div>
      <div id="recItem" id="${id}">
        <div class="innerRec">
          <span class="recName">${name}</span>
          <img class="w" src="pages/products/imgs/${id}/${img.n}.${img.t}">
          <div class="recInfo">
            <span>${price} kr</span>
            <br>
            <a class="addtocart" value="re${id}" data="re${id}"><i class="fas fa-cart-plus"></i></a>
          </div>
        </div>
      </div>
    </div>
  `;

  for (var i = 0; i < $(".reDiv").length; i++) {
    element = $(".reDiv")[i];
    $.ajax({
      type: "GET",
      url: "scripts/loadRe/fetchProdcutData.php",
      success: function (data) {

        $(element).append([{id: data.product_id, name: data.name, img: data.imgs[0], price: data.price}].map(reDiv).join(''));

        $(".addtocart").click(function () {
          elementAnimateToCart($(this).attr("data"));
        });

      }
    });
  }
});
