$(document).ready(function () {

  $("#headerspace").append('<a class="headerbutton" href="" id="coac"><i class="fas fa-plus-circle"></i> Complete <?php echo $temp ?></a>');

  $.get("pages/controllpanel/units/"+page+"/create.html", function(data){
    $("#headerspace").after(data);
  });

  $("#createB").click(function (event) {
    event.preventDefault();

    $("#sic").slideToggle();

    $("#coac").toggle();

  });

  $("#coac").click(function (event) {

    event.preventDefault();

    var cbp = "";

    var name = $("#"+page+"name").val();
    var short = $("#"+page+"short").val();

    if (page == "units") {
      var description = $("#"+page+"description").val();
      if (document.getElementById("unitscbp").checked) {
        var cbp = 1;
      }else {
        var cbp = 0;
      }

      $.ajax({
        type: "POST",
        url: "script/pages/units/units/create.php",
        data: {name: name, short: short, cbp: cbp, description: description},
        success: function (data) {
          number++;
          newRow = [{id: data, name: name, short: short, description: description, can_be_per: cbp}];
          addNewRow(newRow[0], number);
          updatepages();
        }
      });
    }

    if (page == "prefix") {
      var base = $("#prefixbase").val();
      var exponent = $("#prefixexponent").val();

      $.ajax({
        type: "POST",
        url: "script/pages/units/prefix/create.php",
        data: {name: name, short: short, base: base, exponent: exponent},
        success: function (data) {
          number++;
          newRow = [{id: data, name: name, short: short, base: base, exponent: exponent}];
          addNewRow(newRow[0], number);
          updatepages();
        }
      });
    }
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
