<script type="text/javascript">
  var test = <?php echo json_encode($_SESSION["perms"]["pages"]); ?>;
  test.forEach(function (value, index) {
    $(document).ready(function () {
      $("#navItems").append("<li id='nav"+value+"' class='navItem'><a href='?page="+value+"'>"+value+"</a></li>");
    });
  });
  var link = "?page="+test[0];
  $("#logoLink").attr("href", link);
</script>
<header>
  <div class="inner">
    <a id="logoLink" href="?page="><img src="" alt="<?php echo $company->companyName; ?>"></a>

    <nav>
      <ul id="navItems">

      </ul>
    </nav>

  </div>
</header>
