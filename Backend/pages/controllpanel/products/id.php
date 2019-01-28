<title><?php echo $company->companyName." - ".ucfirst($_REQUEST["underpage"])." - ".$_REQUEST["id"]; ?></title>
<script type="text/javascript">
  var id = "<?php echo $_REQUEST["id"]; ?>";
</script>
<section class="Ypadding productpage">
  <div class="inner">

    <div id="pbasics">
      <div id="named">
        <input type="checkbox" name="vis" value="">
        <input type="text" name="name" value="">
      </div>
      <div id="statsp">
        <h1>Current stock: </h1><h1 id="stocknr"></h1>
        <h1>Active orders: </h1><h1 id="ordersnr"></h1>
        <h1>Total sold: </h1><h1id="totalsell"></h1>
      </div>
    </div>

    <div class="imglib">
      <div class="controlls">
        <input type="file" name="" value="">
      </div>
    </div>

    <?php if ($session->checkPrem("list", "categories")): ?>
      <div class="cats">
        <div class="cat" value="0">
          <?php if ($session->checkPrem("mod", "categories")): ?>
            <i class="fas fa-times"></i>
          <?php endif; ?>
          </i><h1 id="catname"></h1>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($session->checkPrem("list", "orders")): ?>
      <div class="orders">
        <table>

        </table>
      </div>
    <?php endif; ?>

    <div class="stock">
      <table>
        <thead>
          <th>Stock location</th>
          <th>Amount</th>
          <th></th>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>

  </div>
</section>
<script src="script/pages/products/productShow.js" charset="utf-8"></script>
