<link rel="stylesheet" href="css/page/createProduct.css">
<script src="script/pages/products/create/create.js" charset="utf-8"></script>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<div class="inner">
  <section id="basics">
    <form>
      <input type="text" placeholder="Name" id="bname">
      <br>
      <input type="number" placeholder="Price" id="bpice">
      <br>
      <select id="manu">

      </select>
    </form>
    <select id="categorieSelector">
      <option id="1" selected="">Start</option>
    </select>
  </section>
  <section id="catspec">
    <table id="spec">

    </table>
  </section>
  <section id="Images">
    <form id="uploadNew">
      <input type="file" id="imginput" accept="image/x-png">
    </form>
    <ul id="imgList">

    </ul>
    *You can change the order later
  </section>
</div>
