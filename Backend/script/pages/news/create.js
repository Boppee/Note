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
          window.open('http://localhost/Note/frontend/?page=news&id=preview&pid='+data);
        }
      });


  });


  $("#coac").click(function (e) {
    e.preventDefault()
    var reader = new FileReader();

    var formData = new FormData();

    for (var i = 0; i < $('#newsimg')[0].files.length; i++) {
      formData.append("newsimg[]", $('#newsimg')[0].files[i]);
    }
    formData.append("nid", tempId);
    formData.append("newsname", $("#newsname").val());
    formData.append("newsdesciption", $("#newsdesciption").val());
    if (document.getElementById('newsvisible').checked) {
      formData.append("newsvisible", 1);
    }

    $.ajax({
      type: "POST",
      url: "script/pages/news/create.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        window.open('http://localhost/Note/frontend/?page=news&id='+data+'');
      }
    });
  });

});
