$.ajax({
  type: "GET",
  url: "script/pages/accounts/fetchperms.php",
  success: function (data) {

    const perm = ({name, capName}) => `
    <section class="perms" id="${name}">
      <form class="permform" id="${name}form">
        <h1>${capName}</h1>
        <div class="permlist">
          <ul id='append${name}'>

          </ul>
        </div>
      </form>
    </section>
    `;

    for (var i = 0; i < data.length; i++) {
      $('#permdivs').append([{name: data[i].name, capName: capitalizeFirstLetter(data[i].name)}].map(perm).join(''));
      for (var a = 0; a < data[i].privileges.length; a++) {
        $("#append"+data[i].name).append('<li><input type="checkbox" name="'+data[i].privileges[a]+'" value="">'+ capitalizeFirstLetter(data[i].privileges[a])+'</li>')
      }
    }
  }
});
