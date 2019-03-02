const tr = ({id, text}) => `
<div class="autoItem" id="${id}">
  <div class="autoInner">
    <span>${text}</span>
  </div>
</div>
`;
$(document).ready(function () {

  $(".strType").change(function () {
    var parent = $(this).parent().attr('id');

    if ($(this).val() != "N") {
      $("#"+parent+" .prefixes").hide();
      $("#"+parent+" .autoC").hide();
      $("#"+parent+" .length").hide();
      if (parent != "after") {
        $("#prb").hide();
      }
    }else {
      $("#"+parent+" .prefixes").show();
      $("#"+parent+" .autoC").show();
      $("#"+parent+" .length").show();
      $("#prb").show();
    }
  });

  $("#prb").click(function () {
    $("#after, #per").toggleClass("hide", "");
    if ($(this).val() == "Add per") {
      $(this).val("Remove per")
    }else {
      $(this).val("Add per");
    }
  });

  $(".autoC input").keyup(function () {
    var parent = $(this).parent().parent().attr('id');
    $("#"+parent+" .autoItem").remove();
    if ($(this).val().length != 0) {
      $.ajax({
        type: "POST",
        url: "script/pages/categories/getSug.php",
        data: {text: $(this).val()},
        success: function (data) {
          for (var i = 0; i < data.length; i++) {
            if (data[i].can_be_per == 1 && parent == "after") {
              $("#"+parent+" .autoAppend").append([{id: data[i].id, text: data[i].name}].map(tr).join(''));
            }else {
              $("#"+parent+" .autoAppend").append([{id: data[i].id, text: data[i].name}].map(tr).join(''));
            }
          }
        }
      });
    }
  });

  $(".autoC input").focusout(function () {
    var parent = $(this).parent().parent().attr('id');
    
  });
  /*$(".autoC input").focusin(function () {
    var parent = $(this).parent().parent().attr('id');
    $("#"+parent+" .autoItem").show();
  });*/
  $(".autoAppend").click(function () {

  });
});
