$(document).ready(function () {

  $("#headerspace").append('<a class="headerbutton" href="" id="coac"><i class="fas fa-plus-circle"></i> Complete <?php echo $temp ?></a>');

  $.get("pages/controllpanel/manufacturer/create.html", function(data){
    $("#headerspace").after(data);
  });
  $.get("res/country.html", function(data){
    $("#countrytd").append(data);
  });

  $("#createB").click(function (event) {
    event.preventDefault();

    $("#sic").slideToggle();

    $("#coac").toggle();

  });

  $("#coac").click(function (event) {

    event.preventDefault();

    var name = $("#name").val();
    var country = $("#country").val();
    var website = $("#website").val();

    $.ajax({
      type: "POST",
      url: "script/pages/manufacturer/create.php",
      data: {name: name, country: country, website: website},
      success: function (data) {
        number++;
        newRow = [{id: data, name: name, country: country, website: website}];
        addNewRow(newRow[0], number);
        updatepages();
      }
    });

    function updatepages() {
      pageSys.items++;

      addPage = pageSys.itemsPerPage*pageSys.pages;

      if (pageSys.pages >= 1) {
        pageSys.page = pageSys.pages;
      }

      if (pageSys.items >= addPage) {
        pageSys.pages++;
        pageSys.page = pageSys.pages;
      }

      pageSys.showPage();
      pageSys.rowColors();
    }
  });
});
