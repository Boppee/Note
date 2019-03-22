<?php
require_once 'res/header.php';
?>
<link rel="stylesheet" href="<?php echo $pageUrl ?>.css">
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
    </div>

  </div>
</main>
