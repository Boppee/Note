$.ajax({
  type: "POST",
  data: {id: id},
  url: "script/pages/categories/fetchtablestr.php",
  success: function (data) {
    if (data.data.id == 1) {
      $("#changeparent").remove();
    }
    $("#name").val(data.data.name);
    if(data.table == false){
      $("#wstructure").hide();
    }else {
      $("#nostructure").hide();
    }
  }
});
