$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "script/pages/units/units/fetchAll.php",
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
});


function addNewRow(data, number) {
  $(document).ready(function () {
    $('#listTab').append([{id: data.id, name: data.name, short: data.short, description: data.description, nr: number}].map(tr).join(''));
    if (data.can_be_per == "1") {
      $(".cbp"+data.id+" input").attr("checked", "true");
    }
  });
}
