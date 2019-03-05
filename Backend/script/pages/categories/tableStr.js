const struTrN = ({name, unit}) => `
<tr class="struTr" value="N">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><span>50</span><input type="text" value="${unit}"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class=""><i class="fas fa-trash-alt"></i></td>
</tr>
`;
const struTrY = ({name}) => `
<tr class="struTr" value="Y">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><input type="text" value="2019"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class=""><i class="fas fa-trash-alt"></i></td>
</tr>
`;
const struTrT = ({name}) => `
<tr class="struTr" value="T">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><input type="text" value="Just Some random test :)"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class=""><i class="fas fa-trash-alt"></i></td>
</tr>
`;
const struTrD = ({name}) => `
<tr class="struTr" value="D">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><input type="text" value="2019-06-16"></td>
  <td class=""><i class="fas fa-edit"></i></td>
  <td class=""><i class="fas fa-trash-alt"></i></td>
</tr>
`;

$(document).ready(function () {
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
        }
        $('#exStru table input').prop("disabled", true);
      }else {
        $("#noStru").show();
      }
    }
  })
});
