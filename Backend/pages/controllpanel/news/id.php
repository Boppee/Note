<script type="text/javascript">
    id = <?php echo $_REQUEST["id"]; ?>;
</script>
<link rel="stylesheet" href="css/page/news.css">
<section id="idnews">
  <div class="inner">
    <form>
      <span>Name: </span>
      <input type="name" placeholder="Name" id="newsname">
      <br>
      <span>Description</span>
      <input type="name" placeholder="Description" id="newsdesciption">
      <br>
      <span>Visible</span>
      <input type="checkbox" placeholder="Visible" id="newsvisible">
    </form>

  </div>
</section>
<section id="Images">
  <div class="inner">
    <ul id="imgList">

    </ul>
    <form id="uploadNew">
      <input type="file" id="imginput">
      <input type="submit" id="submitimg" value="Upload">
    </form>
  </div>
</section>

<script src="script/pages/news/id.js" charset="utf-8"></script>
