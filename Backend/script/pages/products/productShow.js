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

      for (var i = 0; i < imgArray.length; i++) {
        $('#imgs').append([{pnr: info.id, imgname: imgArray[i].name, imgtype: imgArray[i].imgtype}].map(Item).join(''));
      }

    });
  }
});
