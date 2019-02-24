<script type="text/javascript">
var id = "<?php echo $_REQUEST["id"]; ?>"
var manufacturer = "<?php echo $_REQUEST["id"]?>";
</script>
<section id="info">
  <?php
    require 'pages/controllpanel/manufacturer/create.html';
  ?>
</section>
<?php
require 'pages/controllpanel/list/all.php';
?>
</section>
<link rel="stylesheet" href="css/page/idman.css">
<script src="script/pages/manufacturer/showId.js" charset="utf-8"></script>
