<script type="text/javascript">
  var id = <?php echo $_REQUEST["id"] ?>
</script>
<link rel="stylesheet" href="css/page/cats.css">
<script src="script/pages/categories/tableStr.js" charset="utf-8"></script>
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

    <section class="structure">
      <div id="nostructure">
        <h1>The category currently has no structure</h1>
      </div>
      <div id="createstructure">
        <form>
          <span>Create a </span>
          <input type="text" id="strName" placeholder="name">
          <select id="strType" name="" class="sele f">
            <option value="N">Number</option>
            <option value="T">Text</option>
            <option value="D">Date</option>
            <option value="Y">Year</option>
          </select>
          <select class="prefixes" name="">

          </select>
          <div class="autoc">
            <input type="text" id="unit" placeholder="Unit" class="unit first">
            <div id="acap">

            </div>
          </div>
          <input type="number" id="length" placeholder="Length" value="64">
          <input type="button" id="psb" value="Add per">
          <span class="per">/</span>
          <select class="prefixes per" name="">

          </select>
          <select id="strTypeP" class="per sele" name="">
            <option value="">Number</option>
            <option value="">Text</option>
            <option value="">Date</option>
            <option value="">Year</option>
          </select>
          <div class="autoc per">
            <input type="text" id="unitP" placeholder="Unit" class="unit">
            <div id="acapP">

            </div>
          </div>
          <input type="number" id="lengthP" placeholder="Length" value="64" class="per">
          <input type="submit" value="Create">
        </form>
      </div>
      <div id= wstructure>

      </div>
    </div>

  </div>
</main>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<script src="script/pages/categories/id.js" charset="utf-8"></script>
