<!DOCTYPE html>
<html>

<head>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--Import Google Icon Font-->
  <link href="vendor/icon.css" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="vendor/materialize/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="vendor/materialize/main.css"/>
  <!--favicon-->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!--jQuery library-->
  <script src="vendor/jquery-3.4.1.min.js"></script>
  <!--jQuery library-->
  <script type="text/javascript" src="vendor/materialize/materialize.min.js"></script>
  <!--favicon-->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.jpg">
  <title>Login - EGM Address Book</title>
</head>

<body class="blue lighten-5">

  <!-- Login -->
  <section class="section section-login">
    <div class="container">
      <div class="row">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
          <div class="card-panel login blue darken-1 white-text center">
            <h2>Swapthings</h2>
            <form id="form-login">
              <div class="input-field">
                <i class="material-icons prefix">account_box</i>
                <input type="text" id="username" name="username" maxlength="50" autocomplete="off">
                <label class="white-text">ชื่อผู้ใช้งาน</label>
                <div id="username_error_message"></div>
              </div>
              <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input type="password" id="password" name="password" maxlength="50">
                <label class="white-text">รหัสผ่าน</label>
                <div id="password_error_message"></div>
              </div>
                <button type='button' id='btnLogin' class="btn btn-large btn-extended grey lighten-4 black-text">เข้าใช้งาน</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>

<script>

  $(document).ready(function () {

    clear_field();

    function clear_field() {
      $('#form-login')[0].reset();
    }

    $('#btnLogin').click(function(){
      login();
    });

    $(document).keypress(function(e) {
      if(e.which == 13) {
        login();
      }
    });

    var error_fullname = false;
    var error_email = false;

    $("#username").focusout(function() {
      check_username();
    });

    $("#password").focusout(function() {
      check_password();
    });

    function check_username() {

      var username_length = $("#username").val().length;
      if( $.trim( $('#username').val() ) == '' ){
        $("#username_error_message").html("กรุณากรอกชื่อผู้ใช้งาน !");
        $("#username_error_message").show();
        error_username = true;
      }
      else{
        $("#username_error_message").hide();
      }

    }

    function check_password() {

      var password_length = $("#password").val().length;
      if( $.trim( $('#password').val() ) == '' ){
        $("#password_error_message").html("กรุณากรอกรหัสผ่าน !");
        $("#password_error_message").show();
        error_password = true;
      }
      else {
        $("#password_error_message").hide();
      }

    }

    function login(){

      error_username = false;
      error_password = false;

      check_username();
      check_password();

      if(error_username == false && error_password == false) {

        data=$('#form-login').serialize();
        $.ajax({
          type:"POST",
          data:data,
          url:"check_login.php",
          success:function(data){
            if(data==1){  
              window.location="index.php";
            }else if (data==0){
              Materialize.toast('ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดผลาด กรุณากรอกใหม่อีกครั้ง', 3000, 'red');
            } else {
              Materialize.toast('มีบางอย่างผิดพลาด', 3000, 'red');
            }
          }
        });
        return false;
      }else{
        Materialize.toast('ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดผลาด กรุณากรอกใหม่อีกครั้ง', 3000, 'red');
        return false;
      }
    }
  });

</script>
