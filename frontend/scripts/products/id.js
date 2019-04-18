$(document).ready(function () {

  stopNav = true;

  //pos
  const pos = ({name, id}) => `<span id="remove${id}"><i class="fas fa-angle-right"></i></span><a href="?page=category&id=${id}"> ${name} </a>`;
  const stock = ({name, amount}) => `
    <li class="stock">
      <div class="stockInner">
        <span>${name}</span>
        <span class="stocka">${amount} st<i class="fas fa-circle"></i></span>
      </div>
    </li>
  `;

  $.ajax({
    type: "POST",
    url: "scripts/products/fetchId.php",
    data: {id: id},
    success: function (data, xhr) {

      $("#pname").text(data.productData.name);
      $("#manlink").attr("href", "?page=manufacture&id="+data.productData.manufacturer);

      $("#manuImg").attr("src", "pages/manufacture/imgs/"+data.productData.manufacturer+".png");

      for (var i = 0; i < data.productData.stocks.length; i++) {
        tempStock = data.productData.stocks[i];
        $("#stocklist").append([{name: tempStock.l, amount: tempStock.a}].map(stock).join(''));
      }

      $.ajax({
        type: "POST",
        url: "scripts/categories/posTree.php",
        data: {id: data.productData.categorie_id},
        success: function (data) {
          $(document).ready(function () {
            for (var i = data.length-1; i >= 0; i--) {
              $('#parents').append([{name: data[i].name, id: data[i].id}].map(pos).join(''));
            }
            $("#remove1").remove();
          });
        }
      });

      $("#add .addtocart").click(function () {
        elementAnimateToCart($(this).parent().attr("id"));
        addToCart(id);
      });

      window.onresize = function() {
        if (window.innerWidth > 900) {
          $("#drop1").show();
        }else {
          $("#drop1").hide();
        }
        w = $("#sisprod").width()/4;
        $(".sisImg").css("height", w+"px");
      };

      imgs(data.productData.imgs, id);

      $("#spec").show();

      $(".selectitem").click(function () {
        $("#seletedMenu div").hide();
        $("#menuselect div").removeClass("sel");
        $("#"+$(this).attr("id").replace(/select/g,'')).show();
        $(this).addClass("sel");
      });

      $("#manu").text(data.productData.manData.name);

      const strucTable = ({strucname, data, unit}) => `
        <tr>
          <td>${strucname}</td>
          <td>${data} ${unit}</td>
        </tr>
      `;

      for (var i = 0; i < data.struc.data.length; i++) {
        tempData = data.struc.data[i];
        if (tempData.Field != "product_id") {
          $("#spectable").append([{strucname: tempData.Field.substr(1), data: data.struc.ProductData[tempData.Field], unit: tempData.Comment}].map(strucTable).join(''));
        }
      }

      const simProd = ({name, price, id}) => `
        <div class="sisItem">
          <div class="sisImg">
            <div class="sisImgBack" id="imgSim${id}">

            </div>
          </div>
          <div class="sisInfo">
            <a href="?page=products&id=${id}">${name}</a>
            <div class="sisPrice">
              <i class="fas fa-cart-plus"></i> <span class="afterPrice">${price} </span>
            </div>
          </div>
        </div>
      `;

      for (var i = 0; i < data.sim.length; i++) {
        tempSim = data.sim[i];
        if (i < 4) {
          $("#sisprod").append([{name: tempSim.name, id: tempSim.product_id, price: tempSim.price}].map(simProd).join(''));
          $("#imgSim"+tempSim.product_id).css("background-image", 'url("pages/products/imgs/'+tempSim.product_id+'/1.png")')
        }
      }
      w = $("#sisprod").width()/4;
      $(".sisImg").css("height", w+"px");

    }
  });
});
