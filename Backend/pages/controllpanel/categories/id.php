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
        <input type="submit" id="gotoselector" value="->">
      </div>
      <div id="changename">
        <span>New name:</span>
        <input type="text" id="name" value="">
        <input type="submit" id="changenameSubmit" value="Change">
      </div>
    </section>

    <section id="">
      <span>Structure name: </span>
      <input type="text" id="strName" class="update" value="">

      <div id="structure">
        <div class="outerUnit" id="first">
          <select class="strType">
            <option value="N">Number</option>
            <option value="T">Text</option>
            <option value="D">Date</option>
            <option value="Y">Year</option>
          </select>
          <select id="prefix" class="prefixes">
            <option selected value="" id="autoSelect">None</option>
          </select>
          <div class="autoC">
            <input type="text" id="unit" class="update" placeholder="Units">
            <div class="autoAppend">

            </div>
          </div>
          <input type="number" placeholder="Length" class="length update" min="0">
        </div>

        <span id="per" class="hide">/</span>

        <div class="outerUnit hide" id="after">
          <select class="strType">
            <option value="N">Number</option>
            <option value="Y">Year</option>
          </select>
          <select id="prefix" class="prefixes" id="autoSelect">
            <option selected value="" id="autoSelect">None</option>
          </select>
          <div class="autoC">
            <input type="text" id="unit" placeholder="Units" class="update">
            <div class="autoAppend">

            </div>
          </div>
          <input type="number" placeholder="Length" class="length update" min="0">
        </div>

        <input type="button" id="prb" value="Add per" onclick="preview()">
        <input type="submit" value="create" onclick="create()">
      </div>
      <span>preview:</span>
      <table>
        <td>
          <span id="pname"></span>
        </td>
        <td>
          <span id="pval"></span>
        </td>
      </table>

    </section>

    <section id="exStru">
      <table>
        
      </table>
    </section>

  </div>
</main>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<script src="script/pages/categories/id.js" charset="utf-8"></script>
<script src="script/pages/categories/tableStr.js" charset="utf-8"></script>
