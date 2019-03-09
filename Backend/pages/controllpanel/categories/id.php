<script type="text/javascript">
var id = <?php echo $_REQUEST["id"] ?>
</script>
<link rel="stylesheet" href="css/page/cats.css">
<main>

  <section id="categorieinfo">
    <div id="changeparent">
      <?php if ($_REQUEST["id"] != 1): ?>
        <i id="removeS" class="fas fa-trash-alt"></i>
      <?php endif; ?>
      <select id="categorieSelector">
        <option id="1" selected>Start</option>
      </select>
      <i id="gotoselector" class="fas fa-caret-right"></i>
    </div>
    <div id="changename">
      <span>New name:</span>
      <input type="text" id="name" value="">
      <input type="submit" id="changenameSubmit" value="Change">
      <br>
      <span id="errorChangeName">Internal server error</span>
    </div>
  </section>

  <section id="stsec">
    <span>Structure name: </span>
    <input type="text" id="strName" class="update" value="">
    <br>
    <input type="button" id="switch" value="Enter manually (Only for Numbers)">

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
      <input type="submit" value="create" class="create auto">
    </div>
    <div id="manually">
      <span>Enter manually</span>
      <input type="text" id="maninput" onkeyup="preview()">
      <input type="number" placeholder="Length" class="length update" min="0">
      <input type="submit" value="create" class="create man">
      <br>
    </div>
    <div id="after">
      Insert after:
      <select id="where">
        <option value="FIRST">First</option>

      </select>
    </div>

  </section>
  <section id="prev">
    <h1>preview:</h1>
    <table class="stable">
      <tr class="struTr">
        <td class="nameStru"><input type="text" id="pname" value="" disabled></td>
        <td class="valueStru"><span id="ptext">50 </span><input type="text" id="pval" value="" disabled></td>
        <td class=""><i class="fas fa-edit"></i></td>
        <td class=""><i class="fas fa-trash-alt"></i></td>
      </tr>
    </table>
  </section>
  <section id="noStru">
    <h1>There are no existing structure</h1>
  </section>
  <section id="exStru">
    <h1>Current structure</h1>
    <table class="stable">

    </table>
  </section>
</main>
<script src="script/pages/categories/createSeletor.js" charset="utf-8"></script>
<script src="script/pages/categories/id.js" charset="utf-8"></script>
<script src="script/pages/categories/tableStr.js" charset="utf-8"></script>
