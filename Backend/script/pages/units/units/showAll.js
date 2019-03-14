var number = 0;
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

        $(".remove").click(function (event) {
          event.preventDefault();
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

        var updateArray = [];
        var defValues = [];
        var table = "units";

        $(".editclick").click(function (event) {

          var id = event.target.parentElement.id.replace("edit", "");

          $(".toggle"+id).toggle();

          $("#units"+id+" .contenteditable").attr("contenteditable", true);
          $("#units"+id+" input").prop("disabled", false);


          if (document.getElementById("cbpinput"+id).checked) {
            var tempCBP = 1;
          }else {
            var tempCBP = 0;
          }

          defValues[id] = {id: id, name: name = $("#name"+id).text(), short: $("#short"+id).text(), description: $("#description"+id).text(), cbp: tempCBP};

          updateArray[id] = {};

          $("#cbpinput"+id).click(function () {
            if (document.getElementById("cbpinput"+id).checked) {
              updateArray[id].cbp = 1;
            }else {
              updateArray[id].cbp = 0;
            }
            if (defValues[id].cbp == updateArray[id].cbp) {
              delete updateArray[id].cbp;
            }
          });

          $("#description"+id).on('input', function() {
            updateArray[id].description = $("#description"+id).text();
            if (defValues[id].description == updateArray[id].description) {
              delete updateArray[id].description;
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

          $("#units"+id+" .contenteditable").attr("contenteditable", false);
          $("#units"+id+" input").prop("disabled", true);

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
});


function addNewRow(data, number) {
  $(document).ready(function () {
    $('#listTab').append([{id: data.product_id, name: data.name, short: data.short, description: data.description, nr: number}].map(tr).join(''));
    if (data.can_be_per == "1") {
      $(".cbp"+data.id+" input").attr("checked", "true");
    }
    $("#listTable input").prop("disabled", true);
  });
}
