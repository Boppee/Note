<script type="text/javascript">
  var id = <?php echo $_REQUEST["id"] ?>
</script>
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
          <input type="text" id="strName" placeholder="name">
          <select id="strType" name="">
            <option value="">Number</option>
            <option value="">Text</option>
            <option value="">Date</option>
            <option value="">Year</option>
          </select>
          <input type="text" id="unit" placeholder="Unit">
          <input type="number" id="length" placeholder="Length" value="64">
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
