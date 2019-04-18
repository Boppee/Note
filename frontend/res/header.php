<link rel="stylesheet" href="css/header.css">
<div id="colorhead">
  <div id="showTop">
    Show
  </div>
  <div class="inner" id="fixposDiv">
    <section id="topheader">
      <i class="fas fa-times" id="removeTop"></i>
        <ul id="topul" >
          <li class="topli"><a href="#" name="frakretur"><i class="fas fa-check topfontA"></i>Fri frakt & retur!</a></li>
          <li class="topli"><a href="#" name="oppetkop"><i class="fas fa-check topfontA"></i>30 dagars öppet köp!</a></li>
        </ul>
        <ul id="topulcon">
          <li class="topli"><a href="#" name="support"><i class="fas fa-headset topfontA"></i>Support</a></li>
          <li class="topli"><a href="#" name="mypages"><i class="fas fa-user topfontA"></i></i>Mina sidor</a></li>
          <li class="topli" id="cartIcon"><span id="cartA"></span><a href="?page=cart" name="cart"><i class="fas fa-shopping-cart topfontA"></i></i>Kundvagn</a></li>
        </ul>
    </section>
  </div>
</div>
<header>
  <div class="inner">
    <section id="mainheader">
      <div id="logo">
        <a href="?page=start"><img src="https://www.komplett.se/logo/312/logo_b2c.svg" alt=""></a>
      </div>
      <div id="lowerheader">
        <div id="search">
          <form id="serachdiv">
            <input type="text" id="searchInput" value="">
            <button type="button" id="searchButton"><i class="fas fa-search"></i>Sök</button>
            <div id="searchres">
              <div class="productsSearch">
                <h1>Products</h1>
                <ul id="productList">

                </ul>
                <div id="pnores">
                  <h3>No products found!</h3>
                </div>
              </div>
              <div class="cats">
                <h1>Categories</h1>
                <ul id="catList">

                </ul>
                <div id="cnores">
                  No categories found!
                </div>
              </div>
            </div>
          </form>
        </div>
        <nav id="headnav">
          <ul class="navul left">
            <li><a href="?page=start" name="home"><i class="fas fa-home"></i>Start</a></li>
            <li class="spacer"><a href="#" name="deals">Veckans erbjudande</a></li>
            <li><a href="#" name="utgande">Utgånde</a></li>
          </ul>
          <ul class="navul right">
            <li class="spacer"><a href="#" name="comps">Tävlingar</a></li>
            <li><a href="#" name="guider">Guider</a></li>
          </ul>
        </nav>
      </div>
    </section>
  </div>
</header>
<script src="scripts/header/search.js" charset="utf-8"></script>
<script src="scripts/header/fixheader.js" charset="utf-8"></script>
