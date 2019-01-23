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
    $("#listTable").append("<tr value='"+number+"' class='itemsRow' id='product"+data.name+"'>");
    $("#product"+data.name).append("<td class='"+data.name+" visibleTd'><input id='test' class='"+data.name+" visibleInput' type='checkbox'></td>");

    if (data.visible == "1") {
      $("."+data.name+" input").attr("checked", "true");
    }

    $("#product"+data.name).append("<td class='"+data.name+" name'>"+data.name+"</td>");
    $("#product"+data.name).append("<td class='"+data.name+" name'>"+data.stock+"</td>");
    $("#product"+data.name).append("<td class='"+data.name+" name'>"+data.price+"</td>");

    $("#product"+data.name).append("<td class='"+data.name+" gotoprofile'><a href='?page=list&underpage=products&id="+data.name+"'>Profile</a></td>");

  });
}
