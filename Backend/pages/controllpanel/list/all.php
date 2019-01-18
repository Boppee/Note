
<div id="footerlist">
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
</div>
<div class="search">
  <input type="text" id="searchTable" placeholder="Serach by username">
</div>
<div class="overflowscroll">
  <table id="listTable">
    <?php
    require 'pages/controllpanel/'.$up.'/all.php';
    ?>
  </table>
</div>
<div class="accpp">
  <p><?php echo $up ?> per page <select id="numberOfItems"></select></p>
</div>
