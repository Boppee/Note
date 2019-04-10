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
          <a id="manlink" class="flex-center" href="?page=manufacture&id"><img id="manuImg" src=""></a>
        </div>

      </div>

      <section id="ppage">
        <section id="ppi">
          <div id="activepic" class="flex-center" value="0">
            <i class="fas fa-chevron-right pright"></i>
            <i class="fas fa-chevron-left pleft"></i>
            <div id="innerPic">

            </div>
          </div>
          <div id="imgGal">

          </div>
          <div id="menuselect">
            <div class="selectitem dis" id="infoselect">
              <i class="fas fa-info-circle"></i><span> Info</span>
            </div>
            <div class="selectitem hoveritems sel" id="specselect">
              <i class="fas fa-clipboard-list"></i><span> Specifikationer</span>
            </div>
            <div class="selectitem hoveritems" id="recselect">
              <i class="fas fa-comments"></i><span> Recensioner</span>
            </div>
          </div>
          <section id="seletedMenu">
            <div id="info">

            </div>
            <div id="spec">
              <table id="spectable">
                <tr>
                  <td>Tillverkare</td>
                  <td><a href="" id="manu"></a></td>
                </tr>
              </table>
            </div>
            <div id="rec">

            </div>
          </section>
        </section>
        <section id="sisP">
          <div id="sishead">
            <span>Liknade produkter</span>
          </div>
          <div id="sisprod">

          </div>
        </section>
        <section id="stockadd">
          <div id="stocks">
            <div id="stockh">
              <span>Lagerstatus</span>
            </div>
            <ul id="stocklist">

            </ul>
          </div>
          <div id="add">
            <button type="button" id="addbutton" class="addtocart">Lägg till i kundvagnen</button>
          </div>
        </section>
      </section>

    </div>
  </div>
</main>
<script src="scripts/products/id.js" charset="utf-8"></script>
<script src="scripts/products/idGal.js" charset="utf-8"></script>
