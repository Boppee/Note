$(document).ready(function () {
  $.ajax({
      type: "GET",
      url: "script/pages/header/echoArray.php",
      success: function(result) {

        var pageArray = result;
        var dontShowArray = ["logout","account","settings"];
        var navListLenght = 100/(pageArray.length-dontShowArray.length);

        pageArray.forEach(function (value, index) {
          $(document).ready(function () {
            if (dontShowArray.indexOf(value) == -1) {
              $("#navItems").append("<li id='nav"+value+"' class='navItem'><a href='?page="+value+"'>"+ capitalizeFirstLetter(value) +"</a></li>");
            }
            var temp = "nav"+value;
            $("#"+temp).width(navListLenght+"%");
          });
        });

        var link = "?page="+pageArray[0];
        $("#logoLink").attr("href", link);

        function capitalizeFirstLetter(string) {
          return string.charAt(0).toUpperCase() + string.slice(1);
        }
        
      }
  });
});
