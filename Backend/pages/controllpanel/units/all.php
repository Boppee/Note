<?php
if (isset($_REQUEST["units"])) {
  ?>
  <script type="text/javascript">
    var page = "units";
  </script>
  <?php
  require 'pages/controllpanel/units/units/all.php';
}
if (isset($_REQUEST["prefix"])) {
  ?>
  <script type="text/javascript">
    var page = "prefix";
  </script>
  <?php
  require 'pages/controllpanel/units/prefix/all.php';
}
?>
<link rel="stylesheet" href="css/page/unitsall.css">
<script src="script/pages/units/create.js" charset="utf-8"></script>
