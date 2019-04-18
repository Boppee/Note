<?php
require_once 'res/header.php';
?>
<link rel="stylesheet" href="<?php echo $pageUrl ?>.css">
<script src="scripts/start/start.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/plist.css">
<main>
  <div class="inner" id="startpage">
    <?php
    require_once 'res/menu.php';
    ?>
    <div class="marginLeftStart">
      <section id="news">
        <?php
          require_once 'res/news.php';
        ?>
      </section>
      <section id="productsOuter">
        <div id="pHeader">
          <span>Produkter</span>
        </div>
        <div id="products">

        </div>
      </section>
    </div>

  </div>
</main>
