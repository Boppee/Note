const img = ({id}) => `
<div class="imgGal" id="img${id}" value="${id}">

</div>
`;

function imgs(imgArray, id) {
  for (var i = 0; i < imgArray.length; i++) {
    $("#imgGal").append([{id: i}].map(img).join(''));
    $("#img"+i).css("background-image", "url(pages/products/imgs/"+id+"/"+imgArray[i].n+"."+imgArray[i].t+")");
  }
  $("#innerPic").css("background-image", "url(pages/products/imgs/"+id+"/"+imgArray[0].n+"."+imgArray[0].t+")");
  if (imgArray.length != 1) {
    $("#activepic .pright").show();
  }

  $("#activepic .pright").click(function () {
    $("#activepic .pleft").show();
    $("#activepic").attr("value", parseInt($("#activepic").attr("value"))+1);
    $("#innerPic").css("background-image", "url(pages/products/imgs/"+id+"/"+imgArray[$("#activepic").attr("value")].n+"."+imgArray[$("#activepic").attr("value")].t+")");
    if ($("#activepic").attr("value") == imgArray.length-1) {
      $("#activepic .pright").hide();
    }
  });
  $("#activepic .pleft").click(function () {
    $("#activepic .pright").show();
    $("#activepic").attr("value", parseInt($("#activepic").attr("value"))-1);
    $("#innerPic").css("background-image", "url(pages/products/imgs/"+id+"/"+imgArray[$("#activepic").attr("value")].n+"."+imgArray[$("#activepic").attr("value")].t+")");
    if ($("#activepic").attr("value") == 0) {
      $("#activepic .pleft").hide();
    }
  });

  $(".imgGal").click(function () {
    $("#activepic").attr("value", $(this).attr("value"));
    $("#innerPic").css("background-image", "url(pages/products/imgs/"+id+"/"+imgArray[$("#activepic").attr("value")].n+"."+imgArray[$("#activepic").attr("value")].t+")");
    if ($("#activepic").attr("value") != 0) {
      $("#activepic .pleft").show();
    }else {
      $("#activepic .pleft").hide();
    }
    if ($("#activepic").attr("value") != imgArray.length-1) {
      $("#activepic .pright").show();
    }else {
      $("#activepic .pright").hide();
    }
  });

}

$(document).ready(function () {
  $("#activepic").css("height", ($("#activepic").width()*0.55));
  $("#innerPic").css("width", $("#activepic").height());
  $(window).resize(function() {
    $("#activepic").css("height", ($("#activepic").width()*0.55));
    $("#innerPic").css("width", $("#activepic").height());
  });
});
