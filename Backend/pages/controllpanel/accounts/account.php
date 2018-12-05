<script type="text/javascript">
  var uid = "<?php echo $_REQUEST["id"]; ?>";
  //Grab Userdata add appends to page
  $.ajax({
    type: "POST",
    url: "script/pages/accounts/fetchAccountUID.php",
    data: {uid: uid},
    success: function (info) {
      $("#accountName").append("<h1>"+info.username+"</h1>");
    }
  });
</script>
<main>
  <div id="accountHeader">
    <div id="accountName">

    </div>
    <div id="accountActions">
      <button type="button" id="removeAccount"><i class="fas fa-trash-alt"></i></button>
      <button type="button" id="editaccount"><i class="fas fa-user-edit"></i></button>
    </div>
  </div>
  <div id="accountInfo">
    <div id="accountImg">

    </div>
    <div id="accountBasic">

    </div>
  </div>
  <div id="accountPriv">
    <div id="accounPage">
      <table>
        <thead>
          <th class="defult">Dashboard</th>
          <th class="defult">Settings</th>
          <th class="defult">Logout</th>
          <th class="defult">Myaccount</th>
        </thead>
        <tbody>
          <tr id="pages">

          </tr>
        </tbody>
      </table>
    </div>
    <div id="accounperms">

    </div>
  </div>
</main>
