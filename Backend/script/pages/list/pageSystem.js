class pageSystem {

  constructor(items) {

    this.items = items;

    var defultSelector = 10;

    this.constructSelector(defultSelector);

    $("#listTable input").prop("disabled", true);

  }

  constructSelector(defult) {
    for (var i = 1; i <= 10; i++) {
      var value = i*5;
      if (value != defult) {
        $("#numberOfItems").append("<option value="+value+">"+value+"</option>");
      }else {
        $("#numberOfItems").append("<option value="+value+" selected>"+value+"</option>");
      }
    }
    this.itemsPerPageUpdate();
  }

  itemsPerPageUpdate() {
    this.itemsPerPage = parseInt($("#numberOfItems").val());
    this.pages = parseInt(Math.ceil(this.items/this.itemsPerPage));
    this.page = 1;
    this.showPage();
    this.rowColors();
  }

  nextPage() {
    this.page++;
    this.showPage();
    this.rowColors();
  }
  prevPage() {
    this.page--;
    this.showPage();
    this.rowColors();
  }

  showPage() {
    $(".itemsRow").hide();
    var starting = (this.page-1)*this.itemsPerPage;
    var ending = ((this.page-1)*this.itemsPerPage)+this.itemsPerPage;
    for (var i = starting; i < ending; i++) {
      $("#listTab tr[value='"+i+"']").show();
    }
    this.pageArrows();
  }

  pageArrows(){
    $("#pages").remove();
    $("#centertext").append("<p id='pages'>Page: "+this.page+" out of "+this.pages);
    $("#centertexttop").append("<p id='pages'>Page: "+this.page+" out of "+this.pages);
    if (this.pages != 0) {
      if (this.pages == 1) {
        $(".buttonlists").hide();
      }else {
        $(".buttonlists").show();
      }

      if (this.page == 1) {
        $("#leftbutton").hide();
      }else {
        $("#leftbutton").show();
      }

      if (this.pages == this.page) {
        $("#rightbutton").hide();
      }else {
        $("#rightbutton").show();
      }
    }
  }

  rowColors() {
    $("#listTab tr:visible:even").css("background-color", "#ffa500").delay(0);
    $("#listTab tr:visible:even td, #listTab tr:visible:even a").css("color", "black").delay(0);
    $("#listTab tr:visible:odd td, #listTab tr:visible:odd a").css("color", "#f5f5f5").delay(0);
    $("#listTab tr:visible:odd").css("background-color", "transparent").delay(0);
  }

  tableSearch() {
    if ($("#searchTable").val().length == 0) {
      this.showPage();
      this.rowColors();
    }else {
      var value = $("#searchTable").val().toLowerCase();
      $("#listTable tbody tr").filter(function() {
        $(this).toggle($(this).find('.search').text().toLowerCase().indexOf(value) > -1);
      });
      this.rowColors();
    }
  }

}
