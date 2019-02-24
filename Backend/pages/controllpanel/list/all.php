<?php
switch ($up) {
  case 'accounts':
    $sb = "username";
    break;
  case 'orders':
    $sb = "order id";
    break;
  case 'products':
    $sb = "product name";
    break;
  case 'manufacturer':
    $sb = "manufacturers name";
    if ($up == "manufacturer" && isset($_REQUEST["id"])) {
      $sb = "product name";
    }
    break;
  case 'units':
    if (isset($_REQUEST["units"])) {
      $sb = "units name";
    }
    if (isset($_REQUEST["prefix"])) {
      $sb = "prefix name";
    }
    break;
}
?>
<section id="pagecontroll">
  <div id="spacer">
    <div id="leftbutton" class="buttonlists">
      <button id="prevpage"><i class="fas fa-angle-left"></i> Previous page</button>
    </div>
    <div id="centertext">

    </div>
    <div id="rightbutton" class="buttonlists">
      <button id="nextpage">Next Page <i class="fas fa-angle-right"></i></button>
    </div>
  </div>
</section>
<section class="search">
  <input type="text" id="searchTable" placeholder="Serach by <?php echo $sb ?>">
</section>
<div class="overflowscroll">
  <table id="listTable">
    <?php
    if (!isset($_REQUEST["id"])) {
      require 'pages/controllpanel/'.$up.'/all.php';
    }
    if ($up == "manufacturer" && isset($_REQUEST["id"])) {
      require 'pages/controllpanel/manufacturer/idtable.php';
    }
    ?>
  </table>
</div>
<div class="accpp">
  <p><?php echo $up ?> per page <select id="numberOfItems"></select></p>
</div>
