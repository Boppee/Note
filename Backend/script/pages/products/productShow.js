$.ajax({
  type: "POST",
  url: "script/pages/products/FetchProductID.php",
  data: {id: id},
  success: function (info) {
    $(document).ready(function () {
      console.log(info);
    });
  }
});
