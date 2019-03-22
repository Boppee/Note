<?php
require_once 'res/header.php';

if (isset($_REQUEST["id"])) {
  $id = $_REQUEST["id"];
  if ($id == "preview") {
    ?>
      <script type="text/javascript">
        id = "<?php echo $_REQUEST["pid"] ?>";
      </script>
      <script src="scripts/news/previewidNews.js" charset="utf-8"></script>
    <?php
  }else {
    ?>
    <script type="text/javascript">
      id = "<?php echo $id; ?>";
    </script>
    <script src="scripts/news/idNews.js" charset="utf-8"></script>
    <?php
  }
}
?>
<link rel="stylesheet" href="<?php echo $pageUrl ?>.css">
<main>
  <div class="inner" id="startpage">
    <?php
    require_once 'res/menu.php';
    ?>
    <div class="marginLeftStart">
      <div id="imgGal">

      </div>
      <div id="newsName">
        <span></span>
      </div>
      <div id="newsDesc">
        <span></span>
      </div>
    </div>

  </div>
</main>
