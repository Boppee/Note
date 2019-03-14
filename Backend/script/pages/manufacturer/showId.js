$.get("res/country.html", function(data){
  $("#countrytd").append(data);
});

$.ajax({
  type: "POST",
  url: "script/pages/manufacturer/fetchId.php",
  data: {id: id},
  success: function (data) {
    $("#country").val(data[0].country).attr("disabled", true);
    $("#name").val(data[0].name).attr("disabled", true);
    $("#website").val(data[0].website).attr("disabled", true);

    var edit = false;

    var defValues = {name: data[0].name, country: data[0].country, website: data[0].website};
    var updateArray = {};

    $("#editmanufacturer").click(function (event) {
      event.preventDefault();

      if (edit == false) {

        edit = true;
        $("#info input, #info select").attr("disabled", false);

        $("#country").change(function () {
          updateArray.country = $(this).val();
          if (defValues.country == updateArray.country) {
            delete updateArray.country;
          }
        });
        $("#name").change(function () {
          updateArray.name = $(this).val();
          if (defValues.name == updateArray.name) {
            delete updateArray.name;
          }
        });
        $("#website").change(function () {
          updateArray.website = $(this).val();
          if (defValues.website == updateArray.website) {
            delete updateArray.website;
          }
        });

      }else {
        if (Object.keys(updateArray).length > 0){
          $.ajax({
            type: "POST",
            url: "script/pages/manufacturer/update.php",
            data: {updates: updateArray, id: id},
            success: function (alert) {
              edit = false;
              $("#info input, #info select").attr("disabled", true);
            }
          });
        }
      }

    });

    $("#delete").click(function (event) {
      event.preventDefault();
      if (confirm("Are you sure?\nProducts from this manufacturer will be without a manufacturer!")) {
        $.ajax({
          type: "POST",
          url: "script/pages/manufacturer/remove.php",
          data: {id: id},
          success: function () {
            window.location.href = "?page=list&underpage=manufacturer";
          }
        });
      }
    });

  }
});

$.ajax({
  type: "POST",
  url: "script/pages/manufacturer/fetchProducts.php",
  data: {manufacturer: manufacturer},
  success: function (accountData) {

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
    $('#listTab').append([{id: data.product_id, name: data.name, price: data.price, nr: number, stock: data.totalstock}].map(tr).join(''));
    if (data.visible == "1") {
      $(".vis"+data.id+" input").attr("checked", "true");
    }
  });
}
