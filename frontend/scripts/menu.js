const drop = ({id, name, layer, ob}) => `
  <div class="drop layer${layer}" id="menu${id}">
    <div class="fulltext" layer="${layer}">
      <div class="textNav">
        <button class="dropButton" data="${ob}" name="dropButton${id}"><i class="fas fa-caret-up"></i></button>
        <a id="${id}" data="${layer}" href="?page=category&id=${id}">${name}</a>
      </div>
    </div>
    <div class="dropList" id="drop${id}" layer="${layer}">

    </div>
  </div>
`;
const noDrop = ({id, name, layer}) => `
  <div class="drop layer${layer}" id="menu${id}">
    <div class="fulltext" layer="${layer}">
      <div class="textNav">
        <a id="${id}" class="addP" href="?page=category&id=${id}">${name}</a>
      </div>
    </div>
  </div>
`;

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "scripts/header/fetchMenu.php",
    success: function (data) {

      $(document).ready(function () {
        dumbArray = [];

        data.sort((a, b) => parseFloat(a.layer) - parseFloat(b.layer));

        maxLayer = 0;

        for (var i = 1; i < data.length; i++) {

          if (maxLayer < data[i].layer) {
            maxLayer = data[i].layer;
          }

          var par = data[i].par;
          var id = data[i].id;
          var name = data[i].name;
          var layer = data[i].layer;

          if (data[i].child.length == 0) {
            var tempDrop = false;
          }else {
            var tempDrop = true;
          }

          if (tempDrop) {
            $("#drop"+par).append([{id, name, layer, ob: i}].map(drop).join(''));
          }else {
            $("#drop"+par).append([{id, name, layer}].map(noDrop).join(''));
          }

          dumbArray[data[i].id] = data[i];

        }

        maxLayer = parseInt(maxLayer);

        var colorArray = ["f", "e", "d", "c", "b", "a", 9, 8, 7, 6, 5, 4, 3, 2, 1, 0];

        for (var i = maxLayer+1; i >= 2; i--) {

          $(".fulltext[layer="+i+"]").css("background", "#fefefe");
        }

        $(".dropButton").click(function (e) {

          tempId = $(this).parent().parent().parent().attr("id");
          tempId = tempId.slice(4);

          if ($(this).hasClass("rotate")) {
            $("#menu"+tempId+" .dropList").slideUp();
            $("#menu"+tempId+" button").removeClass("rotate");
          }else {
            $(this).toggleClass("rotate");
            $("#drop"+tempId).slideDown();
          }
        });

        $("#mobileNav").click(function () {
          $("#drop1").slideToggle();
          $("#mobileNav i").toggleClass("rotate");
        });

        window.onresize = function() {
          if (window.innerWidth > 700) {
            $("#drop1").show();
          }else {
            $("#drop1").hide();
          }
        };
      });

    }
  });
});
