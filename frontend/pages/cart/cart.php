<?php
require_once 'res/header.php';
?>
<link rel="stylesheet" href="<?php echo $pageUrl ?>.css">
<script src="scripts/cart/loadCart.js" charset="utf-8"></script>
<main>
  <div class="inner rel">
    <aside class="reDiv" id="cartRe">

    </aside>
    <div class="marginLeftStart" id="mrc">
      <div id="noitems">
        <h1>Din kundvagn är tom</h1>
      </div>
      <div id="CartItems">
        <section id="cartHead">
          <h1>Kundvagn</h1>
          <br>
        </div>
        <section class="cartTop">
          <div class="productCart">
            <span>Produkt</span>
          </div>
          <div class="amountCart">
            <span>Antal</span>
          </div>
          <div class="priceCart">
            <span>Pris</span>
          </div>
        </section>
        <section id="cartBody">

        </section>
      </div>
    </div>
  </div>
</main>
