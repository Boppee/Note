<?php
  @session_start();
  require_once '../../php/load.php';
  if (!isset($company)) {
    $company = new company();
  }
?>
<script type="text/javascript">
  var test = <?php echo json_encode($_SESSION["perms"]["pages"]); ?>;
</script>
<header>
  <div class="inner">
    <a href=""><img src="" alt="<?php echo $company->companyName; ?>"></a>

    <nav>

    </nav>

  </div>
</header>
