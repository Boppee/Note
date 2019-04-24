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

      sliders = {};

      for (var i = 0; i < data.tableStruc.length; i++) {
        sliders[data.tableStruc[i].Field] = {};
        sliders[data.tableStruc[i].Field]["max"] = 0;
        sliders[data.tableStruc[i].Field]["min"] = 0;
      }

      for (var i = 0; i < data.childs.length; i++) {

        temp = data.childs[i];

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

      for (var i = 0; i < data.products.length; i++) {

        for (var o = 0; o < Object.keys(data.products[i]["tableData"]).length; o++) {
          index = Object.keys(data.products[i]["tableData"])[o];
          if (index != "product_id") {
            value = data.products[i]["tableData"][index];
            if (Number(value) > Number(sliders[index]["max"])) {
              sliders[index]["max"] = value;
              sliders[index]["min"] = value;
            }
          }
        }
        for (var o = 0; o < Object.keys(data.products[i]["tableData"]).length; o++) {
          index = Object.keys(data.products[i]["tableData"])[o];
          if (index != "product_id") {
            value = data.products[i]["tableData"][index];
            if (value < sliders[index]["min"]) {
              sliders[index]["min"] = value;
            }
          }
        }


        temp = data.products[i];
        $("#products").append([{name: temp.name, id: temp.product_id, price: temp.price}].map(childproduct).join(''));
        tempUrl = "url(pages/products/imgs/"+temp.product_id+"/"+temp.imgs[0].n+"."+temp.imgs[0].t+")";
        $("#ca"+temp.product_id).find(".cimg").css("background-image", tempUrl);

        for (var u = 0; u < Object.keys(sliders).length; u++) {
          tempIndex = Object.keys(sliders)[u];
          if (tempIndex != "product_id") {
            $("#ca"+temp.product_id).attr(tempIndex.substr(1), temp.tableData[tempIndex])
          }
        }

      }

      const sliderElement = ({name, n, unit, nr}) => `
      <div class="outerSlider" value="${name}" nr="${nr}">
      <div class="sliderHead">
      <span>${name} (${unit})</span>
      </div>
      <div id="slider${name}" class="sliderElements" value="${n}" nr="${nr}">
      </div>
      </div>
      `;

      index = Object.keys(sliders);

      filters = [];

      nr = 0;

      for (var i = 0; i < index.length; i++) {
        if (index[i] != "product_id") {
          if (sliders[index[i]]["min"] !== sliders[index[i]]["max"]) {
            filters.push(index[i].substr(1));
            $("#filter").append([{name: index[i].substr(1), n:index[i], unit: data.tableStruc[i].Comment, nr: nr}].map(sliderElement).join(''));
            nr++;
          }
        }
      }

      slidersEle = document.getElementsByClassName('sliderElements');

      for ( var i = 0; i < slidersEle.length; i++ ) {
        noUiSlider.create(slidersEle[i], {
          start: [Number(sliders[$(slidersEle[i]).attr("value")]["min"]), Number(sliders[$(slidersEle[i]).attr("value")]["max"])],
          connect: true,
          tooltips: [true, true],
          behaviour: 'unconstrained-tap',
          range: {
            'min': Number(sliders[$(slidersEle[i]).attr("value")]["min"]),
            'max': Number(sliders[$(slidersEle[i]).attr("value")]["max"])
          },
        });
      }

      for (var i = 0; i < slidersEle.length; i++) {
        slidersEle[i].noUiSlider.on("set", function () {
          addValues($(this)[0].target, filters);
        });
      }

      function addValues(target,filters){
        var allValues = [];

        for (var i = 0; i < slidersEle.length; i++) {
          allValues.push(slidersEle[i].noUiSlider.get());
        };

        arrayIndex = $(target).attr("nr");

        maxValue = Number(allValues[arrayIndex][1]);
        minValue = Number(allValues[arrayIndex][0]);

        $("#products").children(".cproduct").hide();

        valueIndex = $(target).attr("value").substr(1);

        $("#products").children(".cproduct").each(function () {
          value = $(this).attr(valueIndex);
          if (value >= minValue && value <= maxValue) {
            $(this).show();
          }
        });

      }

      $(".addcart").click(function () {
        item = $(this).parent().parent().parent().attr("value");
        addToCart(item);
        sel = "ca"+item;
        elementAnimateToCart(sel);
      });

    }
  });

});
