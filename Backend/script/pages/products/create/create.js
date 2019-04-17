$(document).ready(function () {

  $("#coac").click(function (e) {

    e.preventDefault()

    formData.append("name", $("#bname").val());
    formData.append("price", $("#bpice").val());
    formData.append("manufacturer", $("#manu option:selected").val());
    formData.append("categories", $("#categorieSelector option:selected").attr("id"));

    for (var i = 0; i < $('#spec tr').length; i++) {
      tempEle = $('#spec tr')[i];
      tempId = $(tempEle).attr("id");
      tempVal = $(tempEle).find("input").val();
      formData.append(tempId, tempVal);
    }
    $.ajax({
      type:"POST",
      url: "script/pages/products/create/create.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {

      }
    });
  });

  const struTrN = ({name, unit, id}) => `
    <tr id="N${name}">
      <td>${name}</td>
      <td>
        <input type="nummer" step="0.1" value="0"><span>${unit}</span>
      </td>
    </tr>
  `;
  const struTrY = ({name, id}) => `
    <tr id="Y${name}">
      <td>${name}</td>
      <td>
        <input type="nummer" step="1" value="0"><span>${unit}</span>
      </td>
    </tr>
  `;
  const struTrT = ({name, id}) => `
    <tr id="T${name}">
      <td>${name}</td>
      <td>
        <input type="text"><span>${unit}</span>
      </td>
    </tr>
  `;
  const struTrD = ({name, id}) => `
    <tr id="D${name}">
      <td>${name}</td>
      <td>
        <input type="date-time">
      </td>
    </tr>
  `;
  const struTrB = ({name, id}) => `
  <tr id="b${name}">
    <td>${name}</td>
    <td>
      <input type="checkbox"><span>${unit}</span>
    </td>
  </tr>
  `;

  $("#categorieSelector").change(function () {

    $('#spec').children().remove();

    $.ajax({
      type: "POST",
      url: "script/pages/categories/fetchtablestr.php",
      data: {id: $(this).children("option:selected").attr("id")},
      success: function (data) {
        id = data.data.id;
        if (data.data.havetable == 1) {
          for (var i = 0; i < data.structure.length; i++) {
            if (id != 1) {
              temp = data.structure[i];
              var tempC = temp.Field.charAt(0)
              temp.Field = temp.Field.substr(1);
              switch (tempC) {
                case "N":
                  $('#spec').append([{name: temp.Field, unit: temp.Comment, id: i}].map(struTrN).join(''));
                  break;
                case "D":
                  $('#spec').append([{name: temp.Field, id: i}].map(struTrD).join(''));
                  break;
                case "Y":
                  $('#spec').append([{name: temp.Field, id: i}].map(struTrY).join(''));
                  break;
                case "T":
                  $('#spec').append([{name: temp.Field, id: i}].map(struTrT).join(''));
                  break;
              }
            }
          }
        }
      }
    });
  });

  const manu = ({name, land, id}) => `<option value="${id}">${name} (${land})</option>`;

  $.ajax({
    type: "GET",
    url: "script/pages/manufacturer/fetchAll.php",
    success: function (data) {
      for (var i = 0; i < data.length; i++) {
        tempData = data[i];
        $('#manu').append([{name: tempData.name, land: tempData.country, id: tempData.id}].map(manu).join(''));
      }
    }
  });

  var reader = new FileReader();
  formData = new FormData();

  const img = ({nr}) => `
    <div class="imglist" place="${nr}">
      <div class="controllimg">
        <i class="fas fa-chevron-up up" s="true"></i>
        <i class="fas fa-chevron-down down" s="true"></i>
        <i class="fas fa-times remove" onclick="formData.delete(images+id); $(this).parent().parent().remove();"></i>
      </div>
      <div class="img">
        <div id="imagesDiv${nr}">
        </div>
      </div>
    </div>
  `;

  images = 0;

  $("#imginput").change(function (e) {
    v = false;
    if ($("#imginput").get(0).files.length == 1) {
      if ($("#imginput").get(0).files[0].name.split('.').pop() == "png") {
        formData.append("images"+images+"", e.target.files[0]);

        $("#imgList").append([{nr: images}].map(img).join(''));

        readURL(this, images);

        images++;

      }else {
        v = true;
      }
    }
    if (v) {
      alert("Images most me .PNG");
    }
    $(this).val("");
  });

});
//take inputs and shows before upload //NOT MY CODE!
function readURL(input,images) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $("#imagesDiv"+images).css("background-image", "url("+e.target.result+")");
    }

    reader.readAsDataURL(input.files[0]);
  }
}
