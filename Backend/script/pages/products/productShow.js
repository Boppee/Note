$(document).ready(function () {
  $.ajax({
    type: "POST",
    data: {id: id},
    url: "script/pages/products/FetchProductID.php",
    success: function (data) {

      const manu = ({name, land, id}) => `<option value="${id}">${name} (${land})</option>`;
      const manuSel = ({name, land, id}) => `<option value="${id}" selected>${name} (${land})</option>`;

      $.ajax({
        type: "GET",
        url: "script/pages/manufacturer/fetchAll.php",
        success: function (data) {
          for (var i = 0; i < data.length; i++) {
            tempData = data[i];
            if (p.manufacturer == tempData.id) {
              $('#manufacuter').append([{name: tempData.name, land: tempData.country, id: tempData.id}].map(manuSel).join(''));
            }else {
              $('#manufacuter').append([{name: tempData.name, land: tempData.country, id: tempData.id}].map(manu).join(''));
            }
          }
        }
      });

      p = data[0];

      $("#name").val(p.name);
      $("#price").val(p.price);
      $("#sim").val(p.sim);

      if (p.visible == 1) {
        $("#visible").attr("checked", true);
      }

      $("#categorieSelector #"+p.categorie_id).attr("selected", true);

      catSpec(p.categorie_id, data.catSpecs, id);

      $("#categorieSelector").change(function () {
        catSpec($(this).children("option:selected").attr("id"), false, id);
      });

      const img = ({nr, id, imgname, imgtype}) => `
        <div class="imglist" id="img${nr}" value="${imgname}">
          <div class="controllimg">
            <i class="fas fa-chevron-up up"></i>
            <i class="fas fa-chevron-down down"></i>
            <i class="fas fa-times remove"></i>
          </div>
          <div class="img">
            <img src="../frontend/pages/products/imgs/${id}/${imgname}.${imgtype}" alt="">
          </div>
        </div>
      `;

      for (var i = 0; i < p.imgs.length; i++) {
        imgs = 0;
        for (var i = 0; i < p.imgs.length; i++) {
          imgs++;
          temp = p.imgs[i];
          $("#imgList").append([{nr: i, id: id, imgtype: temp.t, imgname: temp.n}].map(img).join(''));
          if (i == p.imgs.length-1) {
            $("#img"+i+" .down").attr("s", true);
          }else {
            $("#img"+i+" .down").attr("s", false);
          }
          if (i == 0) {
            $("#img"+i+" .up").attr("s", true);
          }else {
            $("#img"+i+" .up").attr("s", false);
          }
        }
        if (imgs == 1) {
          $("#img"+0+" .remove").attr("s", true);
        }
      }

      $("#imginput").change(function () {
        var formData = new FormData();

        formData.append("img", $('#imginput')[0].files[0]);
        formData.append("id", id);

        $.ajax({
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          url: "script/pages/products/update/uploadimg.php",
          complete: function () {
            //location.reload();
          }
        });
      });

      $(".up").click(function () {
        if ($(this).attr("s") != true) {
          $.ajax({
            type: "POST",
            url: "script/pages/products/update/updateImg.php",
            data: {img: $(this).parent().parent().attr("value"), action: "up", id: id},
            complete: function () {
              location.reload();
            }
          });
        }
      });
      $(".down").click(function () {
        if ($(this).attr("s") != true) {
          $.ajax({
            type: "POST",
            url: "script/pages/products/update/updateImg.php",
            data: {img: $(this).parent().parent().attr("value"), action: "down", id: id},
            complete: function () {
              location.reload();
            }
          });
        }
      });
      $(".remove").click(function () {
        if ($(this).attr("s") != true) {
          $.ajax({
            type: "POST",
            url: "script/pages/products/update/updateImg.php",
            data: {img: $(this).parent().parent().attr("value"), action: "remove", id: id},
            complete: function () {
              location.reload();
            }
          });
        }
      });

      $("#basics input").keyup(function () {
        val = $(this).val();
        index = $(this).attr("id");
        $.ajax({
          type: "POST",
          data: {id: id, value: val, index: index},
          url: "script/pages/products/update/updateBasics.php",
          success: function (data) {

          }
        });
      });
      $("#basics select, #categorieSelector").change(function () {
        index = $(this).attr("id");
        if (index == "categorieSelector") {
          val = $("#categorieSelector option:selected").attr("id");
        }else {
          val = $(this).val();
        }
        $.ajax({
          type: "POST",
          data: {id: id, value: val, index: index},
          url: "script/pages/products/update/updateBasics.php",
          success: function (data) {

          }
        });
      });

      $("#delete").click(function (e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "script/pages/products/removeProduct.php",
          data: {id: id},
          success: function () {

          }
        })
      });

    }
  });

});
function catSpec(id, specs, pid) {

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

  $('#spec').children().remove();

  $.ajax({
    type: "POST",
    url: "script/pages/categories/fetchtablestr.php",
    data: {id: id},
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
      if (specs !== false) {
        for (var property in specs) {
          if (property != "product_id") {
            $("#"+property+" input").val(specs[property]);
          }
        }
      }

      $("#spec input").keyup(function () {
        index = $(this).parent().parent().attr("id");
        value = $(this).val();
        $.ajax({
          type: "POST",
          data: {id: pid, value: value, index: index, cat: id},
          url: "script/pages/products/update/catSpecUpdate.php",
          success: function () {

          }
        })
      });

    }
  });
}
