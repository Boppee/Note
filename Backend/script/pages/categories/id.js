$("#strType").change(function () {
  $("#length, #unit").show();
  $("#psb").hide();
  $(".per").hide();
  switch ($("#strType").children(":selected").text()) {
    case "Number":
      $("#psb").show();
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
$("#strTypeP").change(function () {
  $("#lengthP, #unitP").show();
  switch ($("#strTypeP").children(":selected").text()) {
    case "Number":
      $("#lengthP").val(11);
      break;
    case "Text":
      $("#lengthP").val(64);
      $("#unitP").hide();
      break;
    case "Date":
      $("#lengthP").val(0);
      $("#lengthP, #unitP").hide();
      break;
    case "Year":
      $("#lengthP").val(4);
      $("#lengthP, #unitP").hide();
      break;
  }
});
