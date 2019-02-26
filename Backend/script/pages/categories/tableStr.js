const tr = ({id, name}) => `
<div class="autocItem" val="${id}">
  <div class="autocPadd">
    <span class="text">${name}</span>
  </div>
</div>
`;

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
$(document).ready(function () {
  
  $(".unit").keyup(function () {
    if ($(this).hasClass("first")) {
      var a = true;
      $("#acap .autocItem").remove();
    }else {
      $("#acapP .autocItem").remove();
    }

    if ($(this).val().length != 0) {
      $.ajax({
        type: "POST",
        data: {text: $(this).val()},
        url: "script/pages/categories/getSug.php",
        success: function (data) {
          for (var i = 0; i < data.length; i++) {
            if (a) {
              $('#acap').append([{id: data[i].id, name: data[i].name}].map(tr).join(''));
            }else {
              $('#acapP').append([{id: data[i].id, name: data[i].name}].map(tr).join(''));
            }
            $(".text").click(function () {
              if (a) {
                $("#unit").val($(this).text());
              }else {
                $("#unitP").val($(this).text());
              }

              $(".autocItem").remove();
            });
          }
        }
      });
    }
  });

});
