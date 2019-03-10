
//remove

function removeStru(event) {
  $(document).ready(function () {
    var tempElement = event.target.parentElement.parentElement;
    var tempDataBaseName = tempElement.getAttribute("value")+tempElement.getAttribute("id");
    $.ajax({
      type: "POST",
      url: "script/pages/categories/removeStru.php",
      data: {name: tempDataBaseName, id: id},
      complete: function (xhr) {
        switch (xhr.status) {
          case 304:
            $.ajax({
              type: "POST",
              url: "script/pages/categories/removeStruTb.php",
              data: {id: id},
              complete: function (xhr) {
                if (xhr.status == 200) {
                  $("#exStru, #noStru").toggle();
                }
              }
            });
            break;
          case 200:
            $(".stable #"+tempElement.getAttribute("id")).remove();
            break;
        }
      }
    });
  });
}

//structure constants
const struTrN = ({name, unit}) => `
<tr class="struTr" value="N" id="${name}">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><span>50</span><input type="text" value="${unit}"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class="remove"><i class="fas fa-trash-alt" onclick="removeStru(event)"></i></td>
</tr>
`;
const struTrY = ({name}) => `
<tr class="struTr" value="Y" id="${name}">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><input type="text" value="2019"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class="remove"><i class="fas fa-trash-alt" onclick="removeStru(event)"></i></td>
</tr>
`;
const struTrT = ({name}) => `
<tr class="struTr" value="T" id="${name}">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><input type="text" value="Just Some random test :)"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class="remove"><i class="fas fa-trash-alt" onclick="removeStru(event)"></i></td>
</tr>
`;
const struTrD = ({name}) => `
<tr class="struTr" value="D" id="${name}">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><input type="text" value="2019-06-16"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class="remove"><i class="fas fa-trash-alt" onclick="removeStru(event)"></i></td>
</tr>
`;
//option after
const after = ({name, type}) => `<option value="${type}${name}">${name}</option>`;

$(document).ready(function () {
  //get table info
  $.ajax({
    type: "POST",
    url: "script/pages/categories/fetchtablestr.php",
    data: {id: id},
    success: function (data) {
      if (data.table) {
        $("#exStru").show();
        for (var i = 0; i < data.structure.length; i++) {
          temp = data.structure[i];
          var tempC = temp.Field.charAt(0)
          temp.Field = temp.Field.substr(1);
          switch (tempC) {
            case "N":
              $('#exStru table').append([{name: temp.Field, unit: temp.Comment}].map(struTrN).join(''));
              break;
            case "D":
              $('#exStru table').append([{name: temp.Field}].map(struTrD).join(''));
              break;
            case "Y":
              $('#exStru table').append([{name: temp.Field}].map(struTrY).join(''));
              break;
            case "T":
              $('#exStru table').append([{name: temp.Field}].map(struTrT).join(''));
              break;
          }
          $('#where').append([{name: temp.Field, type: tempC}].map(after).join(''));
        }
        $('#exStru table input').prop("disabled", true);
      }else {
        $("#noStru").show();
      }
    }
  });

  //validate if createbutton shown
  totalLeng = 0;
  $("#strName").keyup(function () {
    totalLeng = $(this).val().length*$("#pval").val().length;
    showorhide(totalLeng);
  });
  $("#unit").keyup(function () {
    totalLeng = $(this).val().length*$("#pname").val().length;
    showorhide(totalLeng);
  });
  $("#maninput").keyup(function () {
    totalLeng = $(this).val().length*$("#pname").val().length;
    showorhide(totalLeng);
  });
  $(".strType").change(function () {
    if ($(this).val() != "N") {
      showorhide($("#strName").val().length);
    }else {
      showorhide($("#unit").val().length*$("#strName").val().length);
    }
  });
  function showorhide(totalLeng) {
    if (totalLeng != 0) {
      $(".create").show();
    }else {
      $(".create").hide();
    }
  }
  //create
  $(".create").click(function (event) {
    //creating info before sending
    if ($("#pname").val().length != 0 && $("#pval").val().length != 0) {
      if ($(event.target).hasClass("auto")) {
        var type = $(".strType option:selected").val();
        var length = $("#first .length").val();
      }else {
        var type = "N";
        var length = $("#manually .length").val();
      }
      if (length.length == 0) {
        var length = 11;
      }
      if (type == "N") {
        var unit = $("#pval").val();
      }else {
        var unit = false;
      }
      //sending and append
      $.ajax({
        type: "POST",
        url: "script/pages/categories/createStru.php",
        data: {name: $("#pname").val(), unit: unit, type: type, length: length, table: id, where: $("#where option:selected").val()},
        success: function (data) {
          $("#exStru").show();
          $("#noStru").hide();

          var where = '#exStru table #'+data.where;

          if (data.where == "FIRST") {
            switch (data.type) {
              case "N":
                $('#exStru table').prepend([{name: data.name, unit: data.unit}].map(struTrN).join(''));
                break;
              case "D":
                $('#exStru table').prepend([{name: data.name}].map(struTrD).join(''));
                break;
              case "Y":
                $('#exStru table').prepend([{name: data.name}].map(struTrY).join(''));
                break;
              case "T":
                $('#exStru table').prepend([{name: data.name}].map(struTrT).join(''));
                break;
            }
          }else {
            switch (data.type) {
              case "N":
                $(where).after([{name: data.name, unit: data.unit}].map(struTrN).join(''));
                break;
              case "D":
                $(where).after([{name: data.name}].map(struTrD).join(''));
                break;
              case "Y":
                $(where).after([{name: data.name}].map(struTrY).join(''));
                break;
              case "T":
                $(where).after([{name: data.name}].map(struTrT).join(''));
                break;
            }
          }
        }
      });
    }
  });
});
