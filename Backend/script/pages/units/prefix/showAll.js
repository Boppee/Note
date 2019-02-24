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

      var updateArray = [];
      var defValues = [];
      var table = "prefix";

      $(".editclick").click(function (event) {
        var id = event.target.parentElement.id.replace("edit", "");

        $(".toggle"+id).toggle();

        $("#prefix"+id+" .contenteditable").attr("contenteditable", true);
        $("#prefix"+id+" input").prop("disabled", false);

        defValues[id] = {id: id, name: name = $("#name"+id).text(), short: $("#short"+id).text(), base: $("#baseinput"+id).val(), exponent: $("#exponentinput"+id).val()};

        updateArray[id] = {};

        $("#exponentinput"+id).change(function () {
          updateArray[id].exponent = $(this).val();
          if (defValues[id].exponent == updateArray[id].exponent) {
            delete updateArray[id].exponent;
          }
        });
        $("#baseinput"+id).change(function () {
          updateArray[id].base = $(this).val();
          if (defValues[id].base == updateArray[id].base) {
            delete updateArray[id].base;
          }
        });
        $("#short"+id).on('input', function() {
          updateArray[id].short = $("#short"+id).text();
          if (defValues[id].short == updateArray[id].short) {
            delete updateArray[id].short;
          }
        });
        $("#name"+id).on('input', function() {
          updateArray[id].name = $("#name"+id).text();
          if (defValues[id].name == updateArray[id].name) {
            delete updateArray[id].name;
          }
        });
      });

      $(".saveclick").click(function (event) {
        var id = event.target.parentElement.id.replace("edit", "");

        $(".toggle"+id).toggle();

        $("#prefix"+id+" .contenteditable").attr("contenteditable", false);
        $("#prefix"+id+" input").prop("disabled", true);

        if (Object.keys(updateArray[id]).length > 0){
          $.ajax({
            type: "POST",
            url: "script/pages/units/update.php",
            data: {updates: updateArray[id], table: table, id: id},
            success: function (alert) {
              if (alert == "error") {
                $(".toggle"+id).toggle();
              }
            }
          });
        }
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
            });
          }
        });
      });

    });
  });
}
