$(document).ready(function () {
  $.ajax({
      type: "GET",
      url: "script/pages/header/echoArray.php",
      success: function(result) {

        var pageArray = result.pages;
        var page = result.page;
        var dontShowArray = ["","settings","logout","myaccount"];
        var navListLenght = (pageArray.length-dontShowArray.length);

        for (var i = 0; i < pageArray.length; i++) {
          if (pageArray[i] === "") {
            navListLenght - 1;
          }
        }
        navListLenght = (100/navListLenght);

        for (var i = 0; i < pageArray.length; i++) {
          if (dontShowArray.indexOf(pageArray[i]) <= 0) {
            if (pageArray[i] !== "") {
              $("#navItems").append("<li id='nav"+pageArray[i]+"' class='navItem'><a href='?page="+pageArray[i]+"'>"+ capitalizeFirstLetter(pageArray[i]) +"</a></li>");
            }
          }
          var temp = "nav"+pageArray[i];
          $("#"+temp).width(navListLenght+"%");
          if (pageArray[i] == page) {
            $("#nav"+pageArray[i]).addClass("active");
          }
        }


        var link = "?page="+pageArray[0];
        $("#logoLink").attr("href", link);

        function capitalizeFirstLetter(string) {
          return string.charAt(0).toUpperCase() + string.slice(1);
        }

      }
  });
});
