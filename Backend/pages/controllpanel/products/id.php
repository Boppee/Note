<script type="text/javascript">
  id = "<?php echo $_REQUEST["id"]; ?>";
</script>
<script src="script/pages/products/productShow.js" charset="utf-8"></script>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/idProducts.css">
<div id="outer">
  <div class="inner">
    <div id="basics">
      <span>Visible </span><input type="checkbox" id="visible">
      <br>
      <span>Name </span><input type="text" id="name">
      <br>
      <span>Price </span><input type="text" id="price">
      <br>
      <span>Similar </span><input type="text" id="sim">
      <br>
      <span>Manufacuter </span>
      <select id="manufacuter">

      </select>
    </div>
    <section id="catSec">
      <span>Category</span>
      <select id="categorieSelector">
        <option id="1" selected="">Start</option>
      </select>
      <div id="spec">

      </div>
    </section>
    <section id="imgs">
      <ul id="imgList">

      </ul>
      <form id="uploadNew">
        <input type="file" id="imginput" accept="image/x-png">
      </form>
    </section>
  </div>
</div>
