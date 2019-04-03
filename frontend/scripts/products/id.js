$(document).ready(function () {

  //pos
  const pos = ({name, id}) => `<span id="remove${id}"><i class="fas fa-angle-right"></i></span><a href="?page=categories&id=${id}"> ${name} </a>`;
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
            $("#remove1").remove()
          });
        }
      });

    }
  });



});
