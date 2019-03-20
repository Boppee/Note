var number = 0;
$.ajax({
  type: "GET",
  url: "script/pages/promotions/fetchAll.php",
  success: function (data) {

    for (var i = 0; i < data.length; i++) {
      number = i;
      addNewRow(data[i], number);
    }

    $(document).ready(function () {
      pageSys = new pageSystem(data.length);

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
    $('#listTab').append([{
      id: data.id,
      newsid: data.news_con,
      nname: data.nname,
      pname: data.pname,
      pid: data.product_id,
      nr: number
    }].map(tr).join(''));
    if (data.visible == 1) {
      $(".vis"+data.id+" input").attr("checked", "true");
    }
  });
}
