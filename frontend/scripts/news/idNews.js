$(document).ready(function () {

    const imgs = ({id, imgtype, name}) => `
    <div class="imgsGal" id="i${id}" style="background-image: url(pages/news/imgs/${id}/${name}.${imgtype});">
    </div>
    `;

    $.ajax({
      type: "POST",
      url: "scripts/news/fetchIdNews.php",
      data: {id: id},
      success: function (data) {

        $("#newsName span").text(data[0].name);
        $("#newsDesc span").text(data[0].description);

          for (var i = 0; i < data[0].imgs.length; i++) {
            $("#imgGal").append([{id: id, imgtype: data[0].imgs[i].t, name: data[0].imgs[i].n}].map(imgs).join(''));
          }

          resizeID();

          window.addEventListener('resizeID', resize, false);

          function resizeID() {
            $("#imgGal").css("height", "auto");
            margin = 10;
            $(".imgsGal").css("height", margin+($("#imgGal").css("width").slice(0, -2)/21)*9+"px");
            $(".imgsGal").css("margin", margin+"px 0px");
          }

      }
    });

});
