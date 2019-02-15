$("#strType").change(function () {
  $("#length, #unit").show();
  switch ($("#strType").children(":selected").text()) {
    case "Number":
      $("#length").val(11);
      break;
    case "Text":
      $("#length").val(64);
      $("#unit").hide();
      break;
    case "Date":
      $("#length").val(0);
      $("#length, #unit").hide();
      break;
    case "Year":
      $("#length").val(4);
      $("#length, #unit").hide();
      break;
  }
});
