const product = ({id, name, price, nr, stock}) => `
<tr value="${nr}" class="itemsRow" id="product${id}">
  <td class="vis${id} visibleTd"><input id="test" class="vis${id} visibleInput" type="checkbox"></td>
  <td class="name search">${name}</td>
  <td class="stock">${stock}</td>
  <td class="price">${price}</td>
  <td class="gotoprofile"><a href="?page=list&underpage=products&id=${id}">Profile</a></td>
</tr>
`;

$.ajax({
  type: "POST",
  url: "script/pages/categories/fetchProducts.php",
  data: {id: id},
  success: function (accountData) {

    number = 0;

    for (var i = 0; i < accountData.length; i++) {
      number = i;
      addNewRow(accountData[i], number);
    }

    $(document).ready(function () {
      pageSys = new pageSystem(number);

      $("#searchTable").on("keyup", function() {
        pageSys.tableSearch();
      });

      $("#rightbutton").click(function () {
        pageSys.nextPage();
      });
      $("#leftbutton").click(function () {
        pageSys.prevPage();
      });

      $("#numberOfItems").change(function () {
        pageSys.itemsPerPageUpdate();
      });

    });

  }
});

function addNewRow(data, number) {
  $(document).ready(function () {
    $('#listTab').append([{id: data.id, name: data.name, price: data.price, nr: number, stock: data.totalstock}].map(product).join(''));
    if (data.visible == "1") {
      $(".vis"+data.id+" input").attr("checked", "true");
    }
  });
}
