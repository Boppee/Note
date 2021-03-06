$(document).ready(function () {
  $.ajax({
      type: "GET",
      url: "script/pages/header/echoArray.php",
      success: function(result) {

        var pageArray = result.pages;
        var page = result.page;
        var dontShowArray = ["settings","logout","myaccount"];
        var pages = ["accounts", "orders", "products", "statistics", "categories", "manufacturer", "units", "news", "promotions"];
        var navListLenght = (pageArray.length-dontShowArray.length);
        var navItems = 0;

        for (var i = 0; i < pageArray.length; i++) {
          if (pages.indexOf(pageArray[i]) != -1) {
            navItems++;
          }
        }

        navItems = (100/navItems);

        var listArray = ["accounts", "orders", "products", "manufacturer", "news", "promotions"];

        for (var i = 0; i < pageArray.length; i++) {
          if (pages.indexOf(pageArray[i]) != -1) {
            if (listArray.indexOf(pageArray[i]) == -1) {
              $("#navItems").append("<li id='nav"+pageArray[i]+"' class='navItem'><a href='?page="+pageArray[i]+"'>"+ capitalizeFirstLetter(pageArray[i]) +"</a></li>");
            }else {
              $("#navItems").append("<li id='nav"+pageArray[i]+"' class='navItem'><a href='?page=list&underpage="+pageArray[i]+"'>"+ capitalizeFirstLetter(pageArray[i]) +"</a></li>");
            }
          }
          var temp = "nav"+pageArray[i];
          $("#"+temp).width(navItems+"%");
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
