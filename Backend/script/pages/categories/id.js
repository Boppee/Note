//suggestions
const tr = ({id, text, nr, max, min}) => `
<div class="autoItem" id="${id}" value="${text}" max="${max}" min=${min}>
  <div class="autoInner ${nr}">
    <span class="autoInner ${nr}">${text}</span>
  </div>
</div>
`;
//prefixes
const prefix = ({id, name, short}) => `
  <option id="${id}" short="${short}" value="${name}">${name} (${short})</option>
`;
$(document).ready(function () {
  $(".strType").change(function () {
    var parent = $(this).parent().attr('id');

    if ($(this).val() != "N") {

      if (parent == "first") {
        $("#after, #per").addClass("hide");
        $("#prb").val("Add per");
      }

      $("#"+parent+" .prefixes").hide();
      $("#"+parent+" .autoC").hide();
      $("#"+parent+" .length").hide();
      if (parent != "after") {
        $("#prb").hide();
      }
    }else {
      $("#"+parent+" .autoC").show();
      $("#"+parent+" .length").show();
      $("#prb").show();
    }

    preview();

  });

  if (id == 1) {
    $("#changeparent select").css("margin-left", 0)
  }

  $.ajax({
    type: "GET",
    url: "script/pages/categories/fetchPrefix.php",
    success: function (data) {
      for (var i = 0; i < data.length; i++) {
        $(".prefixes").append([{id: data[i].id, name: data[i].name, short: data[i].short}].map(prefix).join(''));
      }
      $(".prefixes").hide();
    }
  });

  $("#prb").click(function () {
    $("#after, #per").toggleClass("hide", "");
    if ($(this).val() == "Add per") {
      $(this).val("Remove per")
    }else {
      $(this).val("Add per");
    }
    preview();
  });

  $(".autoC input").keyup(function () {
    $("#"+lastId+" .prefixes").hide();
    $("#"+lastId+" #prefix option").show();
    var parent = $(this).parent().parent().attr('id');
    $("#"+parent+" .autoItem").remove();
    $("#"+lastId+" .autoAppend").show();
    if ($(this).val().length != 0) {
      $.ajax({
        type: "POST",
        url: "script/pages/categories/getSug.php",
        data: {text: $(this).val()},
        success: function (data) {
          for (var i = 0; i < data.length; i++) {
            data[i].prefix = data[i].prefix.replace("[", "").replace("]", "");
            var maxmin = data[i].prefix.split(',');
            if (data[i].can_be_per == 1 && parent == "after") {
              $("#"+parent+" .autoAppend").append([{id: data[i].id, text: data[i].name, nr: "after", max: maxmin[1], min: maxmin[0]}].map(tr).join(''));
            }else {
              $("#"+parent+" .autoAppend").append([{id: data[i].id, text: data[i].name, nr: "first", max: maxmin[1], min: maxmin[0]}].map(tr).join(''));
            }
          }
        }
      });
    }
  });

  var lastId = 0;

  $(document).click(function (event) {
    if (event.target.id == "unit") {
      $("#"+lastId+" .autoAppend").hide();
      lastId = event.target.parentElement.parentElement.id;
      $("#"+lastId+" .autoAppend").show();
    }else {
      if (lastId != "0") {
        var id = event.target.classList[0];
        if (id != "autoInner") {
          $("#"+lastId+" .autoAppend").hide();
        }else {
          if (event.target.nodeName == "SPAN") {
            var text = event.target.innerText;
            min = event.target.parentElement.parentElement.attributes.min.nodeValue;
            max = event.target.parentElement.parentElement.attributes.max.nodeValue;
          }else {
            min = event.target.parentElement.attributes.min.nodeValue;
            max = event.target.parentElement.attributes.max.nodeValue;
            var text = event.target.firstElementChild.innerText;
          }
          $("#"+lastId+" .prefixes").show();
          $("#"+lastId+" #prefix #autoSelect").prop('selected', true);
          $("#"+lastId+" #prefix option").hide();
          for (var i = min; i < max; i++) {
            $("#"+lastId+" #prefix #"+i).show();
          }
          $("#"+lastId+" #prefix #autoSelect").show();
          $("#"+lastId+" #unit").val(text);
          preview();
          $("#"+lastId+" .autoItem").remove();
          $("#"+lastId+" .autoAppend").hide();
        }
      }
    }
  });

  $(".update").change(function () {
    preview();
  });
  $(".update").keyup(function () {
    preview();
  });
  $("#structure select").on('change',function(){
    preview();
  });
  $("#removeS").click(function () {
    if (confirm("Are you sure? \nAll under categories will also be removed and products moved to 'Start'")) {
      $.ajax({
        type: "POST",
        url: "script/pages/categories/removeCat.php",
        data: {id: id},
        success: function () {
          window.location.href = "?page=categories&id=1";
        }
      });
    }
  });

  $("#gotoselector").click(function () {
    window.location.href = "?page=categories&id="+$("#categorieSelector option:selected")[0].id;
  });
  $("#changenameSubmit").click(function () {
    $.ajax({
      type: "POST",
      url: "script/pages/categories/updateCatName.php",
      data: {id: id, name: $("#name").val()},
      success: function (data) {

      }
    });
  });
  $("#switch").click(function () {
    $("#manually, #structure").toggle();
    if ($(this).val() == "Enter manually") {
      $(this).val("Enter automatic")
    }else {
      $(this).val("Enter manually");
    }
  });

});

function preview() {
  var temp = "";
  if ($("#switch").val() == "Enter manually") {
    if ($(".strType").val() == "N") {
      temp += $("#first #prefix option:selected").val();
      temp += $("#first #unit").val();
      if ($("#prb").val() == "Remove per") {
        temp += "/";
        if ($("#after .strType").val() == "Y") {
          temp += "Year"
        }else {
          temp += $("#after #prefix option:selected").val();
          temp += $("#after #unit").val();
        }
      }

      $("#pname").val($("#strName").val());
      $("#pval").val(temp);
    }else {
      $("#preview").text("")
    }
  }else {
    $("#pname").text($("#strName").val());
    $("#pval").text("10 "+$("#maninput").val());
  }
}
function create() {

}
