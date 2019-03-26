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
        <i class="fas fa-sync-alt" id="reload"></i>
      </div>
      <div id="CartItems">
        <section id="cartHead">
          <span class="htext">Kundvagn</span>
        </section>
        <div id="cartDiv">
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
        <section id="sum">
          <div id="suminner">
            <div id="totalSum">
              <span id="sumTotSpan"></span>
            </div>
          </div>
        </section>
        <section id="checkout">
          <section id="checkoutHead">
            <span class="htext">Checkout</span>
          </section>
          <section>
            <span>Dina uppgifter</span>
            <form id="uppgifter">
              <div id="contactCheck">
                <input type="email" name="" placeholder="E-post" value="">
                <br>
                <input type="text" name="" placeholder="Mobilnummer" value="">
              </div>
              <div id="adress">
                <input type="text" placeholder="Förnamn" value="">
                <input type="text" placeholder="Eftername" value="">
                <br>
                <input type="text" placeholder="Adress" value="">
                <br>
                <input type="text" placeholder="Postnummer" value="">
                <input type="text" placeholder="Postort" value="">
              </div>
            </form>
          </section>
          <section id="payment">
            <section id="paymenthead">
              <span class="htext">Rabatt/presentkorts koder</span>
            </section>
            <section id="giftcards">
              <input type="button" id="addgiftcard" value="Lägg till presentkort">

            </section>
            <section id="promo">
              <input type="button" id="promoadd" value="Lägg till rabattkod (max en per köp!)">

            </section>
          </section>
        </section>
      </div>
    </div>
  </div>
</main>
