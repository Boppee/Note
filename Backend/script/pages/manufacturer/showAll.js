var number = 0;
$.ajax({
  type: "GET",
  url: "script/pages/manufacturer/fetchAll.php",
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
    $('#listTab').append([{id: data.id, name: data.name, country: data.country, website: data.website, nr: number}].map(tr).join(''));
  });
}
