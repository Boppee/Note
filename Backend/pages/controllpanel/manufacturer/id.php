<script type="text/javascript">
  if ("<?php echo $_REQUEST["id"]; ?>" == "") {
    id = 1;
  }else {
    var id = "<?php echo $_REQUEST["id"]; ?>";
  }
var manufacturer = "<?php echo $_REQUEST["id"]?>";
</script>
<section id="info">
  <?php
    require 'pages/controllpanel/manufacturer/create.html';
  ?>
</section>
<h1 id="protext">Products</h1>
<?php
require 'pages/controllpanel/list/all.php';
?>
</section>
<link rel="stylesheet" href="css/page/idman.css">
<script src="script/pages/manufacturer/showId.js" charset="utf-8"></script>
