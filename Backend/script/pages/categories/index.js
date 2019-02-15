$("#categorieSelector").change(function () {
  if ($("#categorieSelector").children(":selected").attr("class") != "noselect") {
    $("#ccn").text("Create child for "+$("#categorieSelector").val().split('•').join(''));
  }
});

$("#createSubmit").click(function () {
  var parent = $("#categorieSelector").children(":selected").attr("id");
  var newCat = $("#childname").val();
  $.ajax({
    type: "POST",
    data: {parent: parent, newCat: newCat},
    url: "script/pages/categories/createCat.php",
    success: function (data) {

    }
  });
});

$("#categorieSelector ").change(function () {
  var tempUrl = "?page=categories&id="+$("#categorieSelector").children(":selected").attr("id");
  $("#tableStructure a").attr("href", tempUrl);
});
