<script type="text/javascript">
  var pageArray = <?php echo json_encode($_SESSION["perms"]["pages"]); ?>;
  var navListLenght = 100/pageArray.length;

  pageArray.forEach(function (value, index) {
    $(document).ready(function () {
      if (value == "logout") {
        var text = "log out";
        $("#navItems").append("<li id='nav"+value+"' class='navItem'><a href='?page="+value+"'>"+text+"</a></li>");
      }else {
        $("#navItems").append("<li id='nav"+value+"' class='navItem'><a href='?page="+value+"'>"+value+"</a></li>");
      }
      var temp = "nav"+value;
      $("#"+temp).width(navListLenght+"%");
    });
  });

  var link = "?page="+pageArray[0];
  $("#logoLink").attr("href", link);
</script>
<header>
  <div id="headContainer">

    <div id="headLogo">
      <a id="logoLink" href="?page="><?php echo $company->companyName; ?></a>
    </div>

    <nav>
      <ul id="navItems">

      </ul>
    </nav>

  </div>
</header>
<link rel="stylesheet" href="css/pageparts/header.css">
