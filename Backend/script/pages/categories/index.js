$("#categorieSelector").change(function () {
  if ($("#categorieSelector").children(":selected").attr("class") != "noselect") {
    $("#ccn").text("Create child for "+$("#categorieSelector").val().split('•').join(''));
  }
});

$("#categorieSelector ").change(function () {
  var tempUrl = "?page=categories&id="+$("#categorieSelector").children(":selected").attr("id");
  $("#tableStructure a").attr("href", tempUrl);
});
