<link rel="stylesheet" href="css/page/promoC.css">
<section id="createpromo">

  <div id="product">
    <div class="inner">
      <div id="search">
        <select class="" id="selT">
          <option value="id">ID</option>
          <option value="name">name</option>
        </select>
        <input type="text" id="productInput" value="">
      </div>
      <div id="appp">
        <ul id="productList">
        </ul>
      </div>
    </div>
  </div>

  <div id="terms">
    <div class="inner">

      <div id="plist">
        <span>Products</span>
        <ul id="listp">
          <li id="nop">No products selected</li>
        </ul>
      </div>

      <div id="codeorall">
        <span>code needed</span>
        <input type="checkbox" id="cneeded" value="">
        <div id="cneed">
          <span>Code:</span>
          <input type="text" name="" value="">
        </div>
      </div>

      <div id="preterms">
        <span>Terms</span>
        <ul>
          <li id="minorderval">
            <input type="checkbox" name="" value="">
            <span>Minimum order value</span><input type="number" name="" value="">
          </li>
          <li id="maxpercust">
            <input type="checkbox" name="" value="">
            <span>Max per order</span><input type="number" name="" value="">
          </li>
          <li id="poff">
            <input type="checkbox" name="" value="">
            <span>% off</span><input type="number" name="" step="0.1" value="">
          </li>
          <li id="kroff">
            <input type="checkbox" name="" value="">
            <span>kr off</span><input type="number" name="" value="">
          </li>
          <li id="buyget">
            <input type="checkbox" name="" value="">
            <span>Buy</span><input type="number"><span>Get</span><input type="number">
          </li>
        </ul>

        <div id="active">
          <span>Active between</span>
          <div id="dates">
            <input type="datetime-local" class="time" value="">
            <input type="datetime-local" class="time" value="">
            <span id="Firefox">use this timeformat YYYY-MM-DDTHH:MM</span>
          </div>
        </div>

      </div>

    </div>
  </div>

</section>
<script src="script/pages/promotions/create.js" charset="utf-8"></script>
