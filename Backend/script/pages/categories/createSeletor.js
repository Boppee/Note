$.ajax({
  type: "GET",
  url: "script/pages/categories/fetchcategories.php",
  success: function (info) {

    createTable(info, 1);

    $("#createSubmit").click(function () {
      var parent = $("#categorieSelector").children(":selected").attr("id");
      var newCat = $("#childname").val();
      $.ajax({
        type: "POST",
        data: {parent: parent, newCat: newCat},
        url: "script/pages/categories/createCat.php",
        success: function (data) {
          $(".remove").remove();
          newOption = {
            id: data.id,
            name: newCat,
            par: parent,
            child: {},
            layer: data.layer,
            havetable: 0
          };
          info[info.length] = newOption;
          createTable(info, data.id);
        }
      });
    });
  }
});
function createTable(info, select) {
  $(document).ready(function () {

    info.sort((a, b) => parseFloat(a.layer) - parseFloat(b.layer));
    for (var i = 1; i < info.length; i++) {
      var tempLayer = "";
      for (var a = 0; a < info[i].layer; a++) {
        tempLayer += "•";
      }
      if (select == info[i].id) {
        $("#"+info[i].par).after("<option id='"+info[i].id+"' selected class='remove'>"+tempLayer+info[i].name+"</option>");
      }else {
        $("#"+info[i].par).after("<option id='"+info[i].id+"' class='remove'>"+tempLayer+info[i].name+"</option>");
      }
      if (info[i].layer == 1) {
        $("#"+info[i].id).after("<option class=noselect disabled class='remove'>==========</option>");
      }
    }
    $("#1").after("<option class=noselect disabled class='remove'>==========</option>");
  });
}
