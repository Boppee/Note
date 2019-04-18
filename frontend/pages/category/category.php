<?php
require_once 'res/header.php';
session_start();

?>
<link rel="stylesheet" href="<?php echo $pageUrl ?>.css">
<script type="text/javascript">
  id = "<?php echo $_REQUEST["id"]; ?>";
</script>
<script src="scripts/noUiSlider.js" charset="utf-8"></script>
<script src="scripts/category/id.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/slider.css">
<link rel="stylesheet" href="css/plist.css">
<main>
  <div class="inner" id="startpage">
    <?php
    require_once 'res/menu.php';
    ?>
    <div class="marginLeftStart">
      <section id="filter">

      </section>
      <section id="products">

      </section>
      <section id="childs">

      </section>
    </div>

  </div>
</main>
