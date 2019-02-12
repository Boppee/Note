$.ajax({
  type: "GET",
  url: "script/pages/categories/fetchcategories.php",
  success: function (info) {

    info.sort((a, b) => parseFloat(a.layer) - parseFloat(b.layer));
    for (var i = 1; i < info.length; i++) {
      var tempLayer = "";
      for (var a = 0; a < info[i].layer; a++) {
        tempLayer += "•";
      }
      $("#"+info[i].par).after("<option id='"+info[i].id+"'>"+tempLayer+info[i].name+"</option>");
      if (info[i].layer == 1) {
        $("#"+info[i].id).after("<option class=noselect disabled>==========</option>");
      }
    }
    $("#1").after("<option class=noselect disabled>==========</option>");

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

  }
});
