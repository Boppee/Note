$.ajax({
  type: "POST",
  url: "script/pages/products/FetchProductID.php",
  data: {id: id},
  success: function (info) {
    $(document).ready(function () {

      info = info[0];

      $("input[name='name']").val(info.name);
      $("#stocknr").text(info.totalstock);
      $("#totalsell").text(info.totalsold);

      $("#catap").text(info.cat_name);
      link = "?page=categories&id="+info.cat_id;
      if (info.cat_id != 0) {
        $("#catap").attr("href", link);
      }else {
        $("#catap").text("No categorie!");
      }

      $("#price").text(info.price+" "+valuta);


      $("#manap").text(info.man_name);
      link = "?page=list&underpage=manufacturer&id="+info.manufacturer;
      if (info.manufacturer != 0) {
        $("#manap").attr("href", link);
      }else {
        $("#manap").text("No manufacturer!");
      }


      if (info.visible) {
        $("input[name='vis']").prop("checked", true);
      }

      stockTb = info.stocks;

      for (var i = 0; i < stockTb.length; i++) {

        $("#stocktb").append("<tr id='tr"+i+"'></tr>");
        $("#tr"+i).append("<td class='loc'>"+stockTb[i].l+"</td>");
        $("#tr"+i).append("<td class='am'>"+stockTb[i].a+"</td>");

      }

      imgArray = info.imgs;

      if (imgArray.length != 0) {
        console.log(imgArray);
        $("#noimg_img").hide();
        for (var i = 0; i < imgArray.length; i++) {
          $('#imgs').append([{pnr: id, imgname: imgArray[i].n, imgtype: imgArray[i].t}].map(Item).join(''));
        }
      }

      $(".img img").click(function (event) {
        $("#fullimg").show();
        $("#fullimg img").attr("src", $(this).attr("src"));
        $("#fullimg").css("top", window.scrollY+'px')
        $("body").css("overflow", "hidden");
        $(document).keyup(function(e) {
          if (e.keyCode === 27) {
            hideImg();
          }
        });
      });

      $("#imgClose").click(function () {
        hideImg()
      });

      function hideImg() {
        $("#fullimg").hide();
        $("body").css("overflow", "auto");
      }



      $("#changeCat").click(function () {
        $.ajax({
          type: "POST",
          url: "script/pages/products/update/changeCat.php",
          data: {cat:  $("#categorieSelector option:selected").attr("id"), product: id},
          success: function (data) {

          }
        });
      });

      const sugItems = ({name, id}) => `
        <div class="sugitem">
          <button type="button" name="button" value="${id}">${name}</button>
        </div>
      `;

      $("#manuinput").keyup(function () {
        if ($(this).val().length != 0) {
          $.ajax({
            type: "POST",
            url: "script/pages/products/getSug.php",
            data: {text: $(this).val()},
            success: function (data) {
              $(".sugitem").remove();
              for (var i = 0; i < data.length; i++) {
                $("#appendSug").append([{id: data[i].id, name: data[i].name}].map(sugItems).join(''));
              }

              $("#changeMan").hide();

              $(".sugitem button").click(function (event) {
                newManId = $(this).val();
                $("#manuinput").val($(this).text());
                $(".sugitem").remove();
                $("#changeMan").show();
                $("#changeMan").click(function () {
                  if (confirm("Do you want change manufacturer to\nManufacturer name: "+$("#manuinput").val()+"\nManufacturer id: "+newManId)) {
                    $.ajax({
                      type: "POST",
                      url: "script/pages/products/update/updateManufacturer.php",
                      data: {product: id, manufacturer: newManId},
                      success: function (data) {

                      }
                    });
                  }
                });
              });

            }
          });
        }
      });

      showNoImg();

      $(".img i").click(function functionName(event) {
        var iid = event.target.parentElement.id;
        var cid = iid.split("_")[0];
        $.ajax({
          type: "POST",
          url: "script/pages/products/update/removeimg.php",
          data: {id: cid, userid: info.product_id},
        });
        $("#"+iid).remove();
        showNoImg();
      });

      $("#imgupload").change(function () {
        uploadImg(this, id);
      });

      document.title = document.title+" "+info.name;

    });
  }
});
function uploadImg(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    var formData = new FormData();
    formData.append('file', $('#imgupload')[0].files[0]);
    formData.append("pid", id);

    $.ajax({
      type: "POST",
      url: "script/pages/products/update/uploadimg.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (info) {

        $('#imgs').append([{pnr: id, imgname: info.name, imgtype: info.imgtype}].map(Item).join(''));

        $(".img i").click(function functionName(event) {
          var iid = event.target.parentElement.id;
          var cid = iid.split("_")[0];
          $.ajax({
            type: "POST",
            url: "script/pages/products/removeimg.php",
            data: {id: cid, userid: info.product_id},
          });
          $("#"+iid).remove();
          showNoImg();
        });

        showNoImg();

      }
    });

  }
}
function showNoImg() {
  if ($("#imgs > div").length == 1) {
    $("#noimg_img").show();
  }else {
    $("#noimg_img").hide();
  }
}
