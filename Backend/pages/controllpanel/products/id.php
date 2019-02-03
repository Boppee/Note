<title><?php echo $company->companyName." - ".ucfirst($_REQUEST["underpage"])." - ".$_REQUEST["id"]; ?></title>
<script type="text/javascript">
  var id = "<?php echo $_REQUEST["id"]; ?>";
</script>
<section class="Ypadding productpage">
  <div class="inner">

    <section id="pbasics">
      <div id="named">
        <input type="checkbox" name="vis" value="">
        <input type="text" name="name" value="">
      </div>
      <div id="statsp">
        <h1>Current stock: </h1><h1 id="stocknr">0</h1>
        <h1>Total sold: </h1><h1 id="totalsell">0</h1>
      </div>
    </section>

    <section class="imglib">
      <div class="controlls">
        <input type="file" name="" value="">
      </div>
    </section>

    <?php if ($session->checkPrem("list", "categories")): ?>
      <section class="cats">
        <div class="cat" value="0">
          <?php if ($session->checkPrem("mod", "categories")): ?>
            <i class="fas fa-times"></i>
          <?php endif; ?>
          </i><h1 id="catname"></h1>
        </div>
      </section>
    <?php endif; ?>

    <?php if ($session->checkPrem("list", "orders")): ?>
      <section class="orders">
        <table>

        </table>
      </section>
    <?php endif; ?>

    <section class="stock">
      <table>
        <thead>
          <th>Stock location</th>
          <th>Amount</th>
          <th></th>
        </thead>
        <tbody id="stocktb">
          <tr>
            <td class="loc"></td>
            <td class="am"></td>
          </tr>
        </tbody>
      </table>
    </section>

  </div>
</section>
<script src="script/pages/products/productShow.js" charset="utf-8"></script>
