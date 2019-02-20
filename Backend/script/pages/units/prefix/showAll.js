var number = 0;
$.ajax({
  type: "GET",
  url: "script/pages/units/prefix/fetchAll.php",
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
    $('#listTab').append([{id: data.id, name: data.name, short: data.short, base: data.base, exponent: data.exponent, nr: number}].map(tr).join(''));
    $(document).ready(function () {

      $(".remove").click(function (event) {
        var id = event.target.parentElement.id.replace("remove", "");
        $.ajax({
          type: "POST",
          url: "script/pages/units/remove.php",
          data: {id: id, table: page},
          success: function (remove) {
            $(document).ready(function () {
              $("#"+remove).remove();
              pageSys.items--;
            })
          }
        });
      });

      $(".edit").click(function (event) {
        var id = event.target.parentElement.id.replace("edit", "");
        $("#edit"+id+" i").toggleClass("fa-edit fa-check");
        if ($("#edit"+id+" i").hasClass("fa-check")) {
          $("#prefix"+id+" .contenteditable").attr("contenteditable", "true");
        }else {
          $("#prefix"+id+" .contenteditable").attr("contenteditable", "false");
        }
      });

    });
  });
}
