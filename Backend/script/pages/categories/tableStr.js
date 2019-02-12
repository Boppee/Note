$.ajax({
  type: "POST",
  data: {id: id},
  url: "script/pages/categories/fetchtablestr.php",
  success: function (data) {
    if(data.table == false){

    }else {
      
    }
  }
});
