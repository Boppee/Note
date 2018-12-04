<script type="text/javascript">
$(document).ready(function () {
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#accountImg').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imgInput").change(function() {
    readURL(this);
  });
});

</script>
<form id="createAccount">
  <input type='file' id="imgInput">
  <img id="accountImg" src="#" alt="your image">
</form>