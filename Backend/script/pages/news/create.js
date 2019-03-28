$(document).ready(function () {
  $("#buttonpreview").click(function () {

    tempId = random();

      var reader = new FileReader();

      var formData = new FormData();

      for (var i = 0; i < $('#newsimg')[0].files.length; i++) {
        formData.append("newsimg[]", $('#newsimg')[0].files[i]);
      }
      formData.append("nid", tempId);
      formData.append("newsname", $("#newsname").val());
      formData.append("newsdesciption", $("#newsdesciption").val());
      if (document.getElementById('newsunique').checked) {
        formData.append("newsunique", 1);
        formData.append("newsdoc", $('#newsdoc')[0].files[0]);
        formData.append("newscss", $('#newscss')[0].files[0]);
      }
      if (document.getElementById('newsvisible').checked) {
        formData.append("newsvisible", 1);
      }

      $.ajax({
        type: "POST",
        url: "script/pages/news/updatePreview.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
          $("#prev").show();
          $("#prev").html('<object data="http://localhost:8888/Note/frontend/?page=news&id=preview&pid='+data+'" id="previewDOM">');
        }
      });


  });
});
