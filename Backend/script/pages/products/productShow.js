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
      $("#catap").attr("href", link);

      if (info.visible) {
        $("input[name='vis']").prop("checked", true);
      }

      stockTb = info.stock;

      for (var i = 0; i < stockTb.length; i++) {

        $("#stocktb").append("<tr id='tr"+i+"'></tr>");
        $("#tr"+i).append("<td class='loc'>"+stockTb[i].loc+"</td>");
        $("#tr"+i).append("<td class='am'>"+stockTb[i].am+"</td>");

      }

      imgArray = info.imgs;

      if (imgArray.length != 0) {
        $("#noimg_img").hide();
        for (var i = 0; i < imgArray.length; i++) {
          $('#imgs').append([{pnr: info.id, imgname: imgArray[i].name, imgtype: imgArray[i].imgtype}].map(Item).join(''));
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

      showNoImg();

      $(".img i").click(function functionName(event) {
        var iid = event.target.parentElement.id;
        var cid = iid.split("_")[0];
        $.ajax({
          type: "POST",
          url: "script/pages/products/update/removeimg.php",
          data: {id: cid, userid: info.id},
        });
        $("#"+iid).remove();
        showNoImg();
      });

      $("#imgupload").change(function () {
        uploadImg(this, info.id);
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

        $('#imgs').append([{pnr: info.id, imgname: info.name, imgtype: info.imgtype}].map(Item).join(''));

        $(".img i").click(function functionName(event) {
          var iid = event.target.parentElement.id;
          var cid = iid.split("_")[0];
          $.ajax({
            type: "POST",
            url: "script/pages/products/removeimg.php",
            data: {id: cid, userid: info.id},
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
