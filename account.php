<?php

  include('include/header.php');

?>

  <!-- Section: Password Updating -->
  <section class="section grey lighten-4">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <div class="row">
              <span class="card-title"><h5>Change Password</h5></span>
                <div class="col s12">
                  <form id="form-password">
                    <div class="row">
                      <div class="input-field s12 m6">
                        <input type="password" id="current_password" name="current_password" maxlength="50">
                        <label>Current password</label>
                        <div id="current_password_error_message" class="red-text"></div>
                      </div>
                      <div class="input-field s12 m6">
                        <input type="password" id="new_password" name="new_password" maxlength="50">
                        <label>New password</label>
                        <div id="new_password_error_message" class="red-text"></div>
                      </div>
                      <div class="input-field s12 m6">
                        <input type="password" id="confirm_password" name="confirm_password" maxlength="50">
                        <label>Confirm password</label>
                        <div id="confirm_password_error_message" class="red-text"></div>
                      </div>
                      <input type="hidden" id="idUser" name="idUser"/>
                      <input type="hidden" name="action" id="action" value="update_password"/>
                      <button type='button' id='btnPassword' class='btn teal'>Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section: User Account -->
  <section class="section grey section-bottom lighten-4">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <div class="row">
              <span class="card-title"><h5>Change Username</h5></span>
              </div>
              <div class="row">
                <div class="col s12">
                  <form id="form-account">
                    <div class="row">
                      <div class="input-field s12 m6">
                        <input type="text" id="username" name="username" value=" " maxlength="50">
                        <label>Username</label>
                        <div id="username_error_message" class="red-text"></div>
                      </div>
                      <input type="hidden" id="id_user" name="id_user"/>
                      <input type="hidden" name="action" id="action" value="Edit"/>
                      <button type='button' id='btnUsername' class='btn teal'>Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php

  include("include/footer.php");

?>

<script>

  $(document).ready(function () {

    getUser();

    function clear_field() {
      $('#form-password')[0].reset();
    }

    $('#btnPassword').click(function(){
      updatePassword();
    });

    $('#btnUsername').click(function(){
      updateUsername();
    });

    var error_current_password = false;
    var error_new_password = false;
    var error_confirm_password = false;
    var error_username = false;

    $("#current_password").focusout(function() {
      check_current_password();
    });

    $("#new_password").focusout(function() {
      check_new_password();
    });

    $("#confirm_password").focusout(function() {
      check_confirm_password();
    });

    $("#username").focusout(function() {
      check_username();
    });

    function check_current_password() {

      var current_password_length = $("#current_password").val().length;

      if( $.trim( $('#current_password').val() ) == '' ){
        $("#current_password_error_message").html("Current password is a required field.");
        $("#current_password_error_message").show();
        error_current_password = true;
      }else if(current_password_length < 8) {
        $("#current_password_error_message").html("At least 8 characters.");
        $("#current_password_error_message").show();
        error_current_password = true;
      } else {
        $("#current_password_error_message").hide();
      }
    }

    function check_new_password() {

      var current_password = $("#current_password").val();
      var new_password = $("#new_password").val();
      var new_password_length = $("#new_password").val().length;

      if( $.trim( $('#new_password').val() ) == '' ){
        $("#new_password_error_message").html("New password is a required field.");
        $("#new_password_error_message").show();
        error_new_password = true;
      }else if(new_password_length < 8) {
        $("#new_password_error_message").html("At least 8 characters.");
        $("#new_password_error_message").show();
        error_new_password = true;
      }else if(new_password == current_password) {
          $("#new_password_error_message").html("New password cannot be same as your current password.");
          $("#new_password_error_message").show();
          error_confirm_password = true;
      }else{
        $("#new_password_error_message").hide();
      }
    }

    function check_confirm_password() {

      var new_password = $("#new_password").val();
      var confirm_password = $("#confirm_password").val();

        if( $.trim( $('#confirm_password').val() ) == '' ){
          $("#confirm_password_error_message").html("Confirm password is a required field.");
          $("#confirm_password_error_message").show();
          error_confirm_password = true;
        }else if(new_password !=  confirm_password) {
          $("#confirm_password_error_message").html("Passwords do not match.");
          $("#confirm_password_error_message").show();
          error_confirm_password = true;
        } else {
          $("#confirm_password_error_message").hide();
        }
    }

    function check_username() {

      var username_length = $("#current_password").val().length;

      if( $.trim( $('#username').val() ) == '' ){
        $("#username_error_message").html("Username is a required field.");
        $("#username_error_message").show();
        error_username = true;
      }
      else{
        $("#username_error_message").hide();
      }
    }

    function updatePassword(){

      error_current_password = false;
      error_new_password = false;
      error_confirm_password = false;

      check_current_password();
      check_new_password();
      check_confirm_password();

      if(error_current_password == false && error_new_password == false && error_confirm_password == false) {

        data=$('#form-password').serialize();
        $.ajax({
          type:"POST",
          data:data,
          url:"account_action.php",
          dataType:"json",
          success:function(data){
            if(data.status) {
              Materialize.toast('Password updated successfully!', 3000, 'green');
              clear_field();
            }else if(data.error) {
              $("#current_password_error_message").html("Passwords do not match.");
              $("#current_password_error_message").show();
            }else{
              Materialize.toast('Oops! Something went wrong.', 3000, 'red');
            }
          },error:function(){
            Materialize.toast('Oops! Something went wrong.', 3000, 'red');
          }
        });
        return false;
      }else{
        Materialize.toast('Please check in on some of the fields.', 3000, 'red');
        return false;
      }
    }

    function updateUsername(){

      error_username = false;

      check_username();

      if(error_username == false) {

        data=$('#form-account').serialize();

        $.ajax({
          type:"POST",
          data: data,
          url:"account_action.php",
          dataType:"json",
          success:function(data){
            if(data.status) {
              Materialize.toast('Username updated successfully!', 3000, 'green');
            }else if(data.error) {
              $("#username_error_message").html("Username already exists");
              $("#username_error_message").show();
            }else{
              Materialize.toast('Oops! Something went wrong.', 3000, 'red');
            }
          },error:function(){
            Materialize.toast('Oops! Something went wrong.', 3000, 'red');
          }
        });
        return false;
      }else{
        Materialize.toast('Please check in on username field.', 3000, 'red');
        return false;
      }
    }

    function getUser() {

      var id_user ="<?php echo $_SESSION['id_user']; ?>";

      $.ajax({
          type: "POST",
          data: { action: 'user_fetch', id_user:id_user },
          url: "account_action.php",
          success: function (data) {
              var data = JSON.parse(data);
              $('#idUser').val(data['id']);
              $('#id_user').val(data['id']);
              $('#username').val(data['username']);
          }
      });
    }

  });

</script>
