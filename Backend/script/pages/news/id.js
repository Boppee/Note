$(document).ready(function () {

  const img = ({nr, id, imgname, imgtype}) => `
    <div class="imglist" id="img${nr}" value="${imgname}">
      <div class="controllimg">
        <i class="fas fa-chevron-up up"></i>
        <i class="fas fa-chevron-down down"></i>
        <i class="fas fa-times remove"></i>
      </div>
      <div class="img">
        <img src="../frontend/pages/news/imgs/${id}/${imgname}.${imgtype}" alt="">
      </div>
    </div>
  `;

  $.ajax({
    type: "POST",
    url: "script/pages/news/fetchNewsId.php",
    data: {id: id},
    success: function (data) {
      $("#newsname").val(data.name);
      $("#newsdesciption").val(data.description);
      if (data.visible == 1) {
        document.getElementById("newsvisible").checked = true;
      }
      imgs = 0;
      for (var i = 0; i < data.imgs.length; i++) {
        imgs++;
        temp = data.imgs[i];
        $("#imgList").append([{nr: i, id: id, imgtype: temp.t, imgname: temp.n}].map(img).join(''));
        if (i == data.imgs.length-1) {
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

      $(".up").click(function () {
        if ($(this).attr("s") != true) {
          $.ajax({
            type: "POST",
            url: "script/pages/news/updateImg.php",
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
            url: "script/pages/news/updateImg.php",
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
            url: "script/pages/news/updateImg.php",
            data: {img: $(this).parent().parent().attr("value"), action: "remove", id: id},
            complete: function () {
              location.reload();
            }
          });
        }
      });

      $("#submitimg").click(function (event) {
        event.preventDefault();

        var formData = new FormData();

        formData.append("img", $('#imginput')[0].files[0]);
        formData.append("id", id);

        $.ajax({
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          url: "script/pages/news/uploadimg.php",
          complete: function () {
            location.reload();
          }
        });

      })

    }
  });
});
