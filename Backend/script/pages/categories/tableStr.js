const struTr = ({name, unit}) => `
<tr class="struTr">
  <td class="nameStru"><input type="text" value="${name}"></td>
  <td class="valueStru"><span>50</span><input type="text" value="${unit}"></td>
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
          $('#exStru table').append([{name: temp.Field, unit: temp.Comment}].map(struTr).join(''));
        }
        $('#exStru table input').prop("disabled", true);
      }else {
        $("#noStru").show();
      }
    }
  })
});
