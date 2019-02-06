<title><?php echo $company->companyName." - ".ucfirst($_REQUEST["underpage"])." -" ?></title>
<script type="text/javascript">
  var id = "<?php echo $_REQUEST["id"]; ?>";
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

    <?php if ($session->checkPrem("list", "categories")): ?>
      <section class="cats">
        <div class="inner">

        </div>
      </section>
    <?php endif; ?>

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
<script src="script/pages/products/productShow.js" charset="utf-8"></script>
