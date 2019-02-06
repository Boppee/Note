$.ajax({
  type: "POST",
  url: "script/pages/products/numberOfProducts.php",
  dataType: "JSON",
  success: function (data) {

    items = data[0].total;

    $.ajax({
      type: "POST",
      url: "script/pages/products/fetchProducts.php",
      data: {limit: items},
      success: function (accountData) {

        for (var i = 0; i < accountData.length; i++) {
          number = i;
          addNewRow(accountData[i], number);
        }

        $(document).ready(function () {
          pageSys = new pageSystem(items);

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

  }
});

function addNewRow(data, number) {
  $(document).ready(function () {
    $('#listTab').append([{id: data.id, name: data.name, price: data.price, nr: number, stock: data.totalstock}].map(tr).join(''));
    if (data.visible == "1") {
      $(".vis"+data.id+" input").attr("checked", "true");
    }
  });
}
