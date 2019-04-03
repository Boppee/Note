<?php
require_once 'res/header.php';
?>
<script type="text/javascript">
  id = "<?php echo $_REQUEST["id"] ?>";
</script>
<link rel="stylesheet" href="<?php echo $pageUrl ?>.css">
<main>
  <div class="inner" id="startpage">
    <?php
    require_once 'res/menu.php';
    ?>
    <div class="marginLeftStart">
      <div id="pheader">
        <div id="pos">
          <div id="parents">

          </div>
        </div>
        <div id="pinfo">
          <h1 id="pname"></h1>
          <a id="manlink" href="?page=manufacture&id"><img id="manuImg" src=""></a>
        </div>

      </div>

      <section id="ppage">
        <section id="stockadd">
          <div id="stocks">
            <div id="stockh">
              <span>Lagerstatus</span>
            </div>
            <ul id="stocklist">

            </ul>
          </div>
        </section>
        <section id="ppi">
          
        </section>
      </section>

    </div>
  </div>
</main>
<script src="scripts/products/id.js" charset="utf-8"></script>
