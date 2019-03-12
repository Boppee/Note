<title><?php echo $company->companyName." - ".ucfirst($_REQUEST["underpage"])." -" ?></title>
<script type="text/javascript">
  if ("<?php echo $_REQUEST["id"]; ?>" == "") {
    id = 1;
  }else {
    var id = "<?php echo $_REQUEST["id"]; ?>";
  }
</script>
<script type="text/javascript">
  const Item = ({pnr, imgname, imgtype }) => `
  <div id="${imgname}_img" class="img">
    <i class="fas fa-times-circle"></i>
    <img src="img/p/${pnr}/${imgname}.${imgtype}" alt="">
  </div>
`;
</script>
<link rel="stylesheet" href="css/page/products.css">
<section class="productpage">

    <section id="pbasics">
      <div class="inner">
        <div id="named">
          <input type="checkbox" name="vis" value="">
          <input type="text" name="name" value="">
        </div>
        <div id="statsp">
          <h1>Current stock: </h1><h1 id="stocknr">0</h1>
          <h1>Total sold: </h1><h1 id="totalsell">0</h1>
        </div>
      </div>
    </section>

    <section class="imglib">
      <div class="inner">
        <div id="imgs">
          <div id="noimg_img" class="img">
            <img src="img/p/No_Image_Available.webp" alt="">
          </div>
        </div>
        <div class="controlls">
          <input type="file" name="" value="" id="imgupload">
        </div>
      </div>
    </section>

    <section>
      <div class="inner" id="mancats">
        <section class="cats">
          <div class="mauto">
            <div id="wcat">
              <span>Current categorie: </span><a href="?page=categories&id=" id="catap"></a>
            </div>
            <?php if ($session->checkPrem("modify", "products")): ?>
              <div id="ccat">
                <span>Move product to: </span>
                <select id="categorieSelector">
                  <option id="1">Start</option>
                </select>
                <input type="button" id="changeCat" value="Change">

                <script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
              </div>
            <?php endif; ?>
          </div>
        </section>

        <section class="man">
          <div class="mauto">
            <span>Current manufacturer: </span><a href="" id="manap"></a>
            <?php if ($session->checkPrem("modify", "products")): ?>
              <div id="manflex">
                <span>Change manufacturer: </span>
                <div id="mansug">
                  <input type="text" id="manuinput" value="">
                  <div id="appendSug">
                  </div>
                </div>
                <input type="button" id="changeMan" value="Change">
              </div>
              <link rel="stylesheet" href="css/page/manpro.css">
            <?php endif; ?>
          </div>
        </section>
      </div>
    </section>

    <?php if ($session->checkPrem("list", "orders")): ?>
      <section class="orders">
        <div class="inner">
          <table>

          </table>
        </div>
      </section>
    <?php endif; ?>

    <section class="stock">
      <div class="inner">
        <table>
          <thead>
            <th>Stock location</th>
            <th>Amount</th>
            <th></th>
          </thead>
          <tbody id="stocktb">
          </tbody>
        </table>
      </div>
    </section>

</section>
<section id="fullimg">
  <i class="fas fa-times-circle" id="imgClose"></i>
  <img src="">
</section>
<script src="script/pages/products/productShow.js" charset="utf-8"></script>
