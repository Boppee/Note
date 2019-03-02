<script type="text/javascript">
  var id = <?php echo $_REQUEST["id"] ?>
</script>
<link rel="stylesheet" href="css/page/cats.css">
<main>
  <div class="inner">

    <section id="categorieinfo">
      <div id="changeparent">
        <select id="categorieSelector">
          <option id="1" selected>Start</option>
        </select>
      </div>
      <div id="changename">
        <input type="text" id="name" value="">
      </div>
    </section>

    <section id="structure">
      <span>Create a </span>
      <input type="text" id="strName" value="">

      <div class="outerUnit" id="first">
        <select class="strType">
          <option value="N">Number</option>
          <option value="T">Text</option>
          <option value="D">Date</option>
          <option value="Y">Year</option>
        </select>
        <select id="prefix" class="prefixes">

        </select>
        <div class="autoC">
          <input type="text" id="unit" placeholder="Units">
          <div class="autoAppend">

          </div>
        </div>
        <input type="number" placeholder="Length" class="length">
      </div>

      <span id="per" class="hide">/</span>

      <div class="outerUnit hide" id="after">
        <select class="strType">
          <option value="N">Number</option>
          <option value="T">Text</option>
          <option value="D">Date</option>
          <option value="Y">Year</option>
        </select>
        <select id="prefix" class="prefixes">

        </select>
        <div class="autoC">
          <input type="text" id="unit" placeholder="Units">
          <div class="autoAppend">
            
          </div>
        </div>
        <input type="number" placeholder="Length" class="length">
      </div>

      <input type="button" id="prb" value="Add per">
      <input type="submit" value="create">

    </section>

  </div>
</main>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<script src="script/pages/categories/id.js" charset="utf-8"></script>
<script src="script/pages/categories/tableStr.js" charset="utf-8"></script>
