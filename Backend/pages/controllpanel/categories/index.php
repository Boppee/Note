<script type="text/javascript">
  var id = "0";
</script>
<main>
  <div class="inner">

    <section id="categoriestructure">
      <select id="categorieSelector">
        <option id="1" selected>Start</option>
      </select>

      <?php if ($session->checkPrem("create", "categories")): ?>
        <div id="createChild">
          <h1 id="ccn">Create child for Start</h1>
          <input type="text" id="childname" value="">
          <input type="submit" id="createSubmit" value="Create">
        </div>
      <?php endif; ?>

      <div id="tableStructure">
        <a href="?page=categories&id=1">Table structure</a>
      </div>
    </section>

  </div>
</main>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<script src="script/pages/categories/index.js" charset="utf-8"></script>
