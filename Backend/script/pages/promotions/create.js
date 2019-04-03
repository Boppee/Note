$(document).ready(function () {

  const products = ({id, name, imgtype, price}) => `
    <li id="ps${id}" class="searchLi" data="${id}">
      <div class="innerSearchP">
        <img src="../../note/frontend/pages/products/imgs/${id}/1.${imgtype}" class="searchImg">
        <div class="pinfo">
          <p class="psname">${name}</p>
          <p class="psprice">${price} Kr</p>
        </div>
      </div>
    </li>
  `;

  const plist = ({id, name}) => `<li data="${id}">${name}<i class="fas fa-times"></i></li>`;

  if (isFirefox) {
    $("#Firefox").show();
    $(".time").attr("placeholder", "2019-01-01T00:00");
  }

  $("#selT").change(getProducts);

  $("#productInput").keyup(getProducts);

  $("#cneeded").change(function () {
    $("#cneed").toggle();
  });

  function getProducts() {

    productsSelected = 0;

    $.ajax({
      type: "POST",
      url: "script/pages/promotions/fetchP.php",
      data: {type: $("#selT").val(), val: $("#productInput").val()},
      success: function (data) {
        $("#productList li").remove();
        for (var i = 0; i < data.products.length; i++) {
          $("#productList").append([{id: data["products"][i].product_id, name: data["products"][i].name, imgtype: data["products"][i].imgs[0].t, price: data["products"][i].price}].map(products).join(''));
        }

        $(".searchLi").click(function () {
          tempId = $(this).attr("data");
          $("#listp").append([{name: $(this).find(".psname").text(), id: tempId}].map(plist).join(''));

          $("#listp i").click(function () {
            $(this).parent().remove();
            productsSelected--;
            detectzp(productsSelected);
          });

          $(this).remove();

          productsSelected++;
          detectzp(productsSelected);

        });

        function detectzp(productsSelected) {
          if (productsSelected == 0) {
            $("#nop").show();
          }else {
            $("#nop").hide();
          }
        }

      }
    });
  }

});
