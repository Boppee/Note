<script type="text/javascript">
  var pageArray = <?php echo json_encode($_SESSION["perms"]["pages"]); ?>;
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
    <div id="settings">
      <a href="?page=settings"><i class="fas fa-cog"></i></a>
      <a href="?page=account"><i class="fas fa-user-alt"></i></a>
      <a href="?page=logout"><i class="fas fa-sign-out-alt"></i></a>
    </div>

  </div>
</header>
<link rel="stylesheet" href="css/pageparts/header.css">
