<?php
  include('include/header.php');
?>
<!-- Section: users list -->
<section class="section section-bottom grey lighten-4">
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <table id='userTable'>
              <thead>
                <tr>
                  <th>id</th>
                  <th>username</th>
                  <th>password</th>
                  <th>firstname</th>
                  <th>lastname</th>
                  <th>email</th>
                  <th>phone</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Fixed Action Button -->
<div class="fixed-action-btn">
  <a class="btn-floating btn-large blue">
    <i class="material-icons">add</i>
  </a>
  <ul>
    <li>
      <a href="excel.php" class="modal-trigger btn-floating red">
        <i class="material-icons">file_download</i>
      </a>
    </li>
    <li>
      <a href="print.php" target="_blank" class="modal-trigger btn-floating red">
        <i class="material-icons">print</i>
      </a>
    </li>
    <li>
      <a href="#add_user" class="modal-trigger btn-floating red">
        <i class="material-icons">person_add</i>
      </a>
    </li>
  </ul>
</div>

<!-- Modal: Add user -->
<div id="add_user" class="modal">
  <div class="modal-content">
    <h4>เพิ่มผู้ใช้งาน</h4>
    <form id="user_form">
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="username" name="username" maxlength="50">
          <label for="name">ชื่อผู้ใช้งาน:</label>
          <div id="username_error_message" class="red-text"></div>
        </div>
        <div class="input-field col s6">
          <input type="password" id="password" name="password" minlength="8">
          <label for="name">รหัสผ่าน:</label>
          <div id="password_error_message" class="red-text"></div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="firstname" name="firstname" maxlength="50">
          <label for="name">ชื่อจริง:</label>
          <div id="firstname_error_message" class="red-text"></div>
        </div>
        <div class="input-field col s6">
          <input type="text" id="lastname" name="lastname" maxlength="50">
          <label for="name">นามสกุล:</label>
          <div id="lastname_error_message" class="red-text"></div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="email" name="email" maxlength="100">
          <div id="email_error_message" class="red-text"></div>
          <label>อีเมลล์:</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="phone" name="phone" maxlength="10">
          <label>เบอร์โทรศัพท์:</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <textarea id="address" name="address" class="materialize-textarea" data-length="500"
            maxlength="500"></textarea>
          <label>ที่อยู่ :</label>
        </div>
      </div>

      <div class="modal-footer">
      
        <input type="hidden" name="action" id="action" value="Add" />
        <button class="btn waves-effect waves-light modal-action blue" type="submit" name="action">บันทึก
          <i class="material-icons right">save</i>
        </button>
        <button type="button" class="btn waves-effect waves-light grey modal-action modal-close" id="btnCancel"
          name="btnCancel">ยกเลิก
          <i class="material-icons right">cancel</i>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: View user -->
<div id="view_user" class="modal">
  <div class="modal-content">
    <h5>ข้อมูลผู้ใช้งาน</h5>
    <hr>
    <div class="row">
      <div class="col m12">
        <div class="card">
          <div class="card-content">
            <span class="card-title"><strong>ข้อมูลส่วนตัว</strong></span>
            <table>
              <tbody>
                <tr>
                  <td><strong>ชื่อผู้ใช้งาน :</strong></td>
                  <td><div id="view_username"></div></td>
                </tr>
                <tr>
                  <td><strong>รหัสผ่าน :</strong></td>
                  <td><div id="view_password"></div></td>
                </tr>
                <tr>
                  <td><strong>ชื่อจริง :</strong></td>
                  <td><div id="view_firstname"></div></td>
                </tr>
                <tr>
                  <td><strong>นามสกุล :</strong></td>
                  <td><div id="view_lastname"></div></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col m12">
        <div class="card">
          <div class="card-content">
            <span class="card-title"><strong>ช่องทางการติดต่อ</strong></span>
            <table>
              <tbody>
                <tr>
                  <td><strong>เบอร์โทรศัพท์ :</strong></td>
                  <td>
                    <div id="view_phone"></div>
                  </td>
                </tr>
                <tr>
                  <td><strong>อีเมลล์ :</strong></td>
                  <td>
                    <div id="view_email"></div>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col m12">
        <div class="card">
          <div class="card-content">
            <span class="card-title"><strong>ที่อยู่</strong></span>
            <table>
              <tbody>
                <tr>
                  <td><strong>ที่อยู่ :</strong></td>
                  <td>
                    <div id="view_address"></div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn waves-effect waves-light grey modal-action modal-close">ปิด</button>
    </div>
  </div>
</div>

<!-- Modal: Update user -->
<div id="update_modal" class="modal">
  <div class="modal-content">
    <h4>แก้ไขข้อมูล</h4>
    <form id="update_user_form">
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="update_username" name="update_username" value=" " maxlength="50">
          <label for="name">ชื่อผู้ใช้งาน :</label>
          <div id="update_username_error_message" class="red-text"></div>
        </div>
        <div class="input-field col s6">
          <input type="password" id="update_password" name="update_password" value=" " minlength="8">
          <label for="name">รหัสผ่าน :</label>
          <div id="update_password_error_message" class="red-text"></div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="update_firstname" name="update_firstname" value=" " maxlength="50">
          <label for="name">ชื่อจริง :</label>
          <div id="update_firstname_error_message" class="red-text"></div>
        </div>
        <div class="input-field col s6">
          <input type="text" id="update_lastname" name="update_lastname" value=" " maxlength="50">
          <label for="name">นามสกุล :</label>
          <div id="update_lastname_error_message" class="red-text"></div>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="update_email" name="update_email" value=" " maxlength="100">
          <div id="update_email_error_message" class="red-text"></div>
          <label>อีเมลล์ :</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" id="update_phone" name="update_phone" value=" " maxlength="8">
          <div id="update_phone_error_message" class="red-text"></div>
          <label>เบอร์โทรศัพท์ :</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="update_address" name="update_address" class="materialize-textarea" data-length="500"
            placeholder="" maxlength="500"></textarea>
            <div id="update_address_error_message" class="red-text"></div>
          <label>ที่อยู่ :</label>
        </div>

        <div class="modal-footer">
          <input type="hidden" id="user_id" name="user_id" />
          <input type="hidden" name="action" id="action" value="Update" />
          <button class="btn waves-effect waves-light modal-action" id='btnUpdateuser' name="action">บันทึกการแก้ไข
            <i class="material-icons right">save</i>
          </button>
          <button type="button" class="btn waves-effect waves-light grey modal-action modal-close" id="btnUpdateCancel"
            name="btnUpdateCancel">ยกเลิกการแก้ไข
            <i class="material-icons right">cancel</i>
          </button>
        </div>
    </form>
  </div>
</div>

<!-- Modal: Delete user -->
<div id="delete_modal" class="modal">
  <div class="modal-content">
    <h4>ยืนยันการลบผู้ใช้งาน</h4>
    <p>แน่ใจหรือไม่ว่าต้องการที่จะลบผู้ใช้งานนี้ออกจากระบบอย่างถาวร</p>
    <div class="modal-footer">
      <input type="hidden" id="user_id" name="user_id" />
      <input type="hidden" name="action" id="action" value="Update" />
      <button class="btn waves-effect waves-light red modal-action modal-close" 
        id='btnDeleteuser'>ยืนยันการลบ
        <i class="material-icons right">delete</i>
      </button>
      <button type="button" class="btn waves-effect waves-light grey modal-action modal-close"
        id="btnCancel">ยกเลิกการลบ
        <i class="material-icons right">cancel</i>
      </button>
    </div>
  </div>
</div>

<?php
  include("include/footer.php");
?>

<script>
  $(document).ready(function () {

    var dataTable = $('#userTable').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        url: 'user_action.php',
        type: 'POST',
        data: { action: 'user_fetch' }
      },
      'columns': [
        { data: 'id' },
        { data: 'username' },
        { data: 'password' },
        { data: 'firstname' },
        { data: 'lastname' },
        { data: 'address' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'action', "orderable": false },
      ]
    });

    $('select').material_select();

    $('.modal').modal();

    $("#add_user").modal({
      dismissible: false
    });
    $("#view_user").modal({
      dismissible: false
    });
    $("#update_modal").modal({
      dismissible: false
    });

    function clear_field() {
      $('#user_form')[0].reset();
      $('#update_contact_form')[0].reset();
      $("#username_error_message").hide();
      $("#password_error_message").hide();
      $("#firstname_error_message").hide();
      $("#lastname_error_message").hide();
      $("#address_error_message").hide();
      $("#email_error_message").hide();
      $("#phone_error_message").hide();

      $("#update_usermame_error_message").hide();
      $("#update_password_error_message").hide();
      $("#update_firstname_error_message").hide();
      $("#update_lastname_error_message").hide();
      $("#update_address_error_message").hide();
      $("#update_email_error_message").hide();
      $("#update_phone_error_message").hide();
    }

    $('#user_form').on('submit', function (event) {
      event.preventDefault();
      adduser();
    });

    $(document).on('click', '#btnCancel', function () {
      clear_field();
    });

    $(document).on('click', '#btnUpdateCancel', function () {
      clear_field();
    });

    $('#btnUpdateuser').click(function () {
      event.preventDefault();
      updateuser();
    });

    $('#btnDeleteuser').click(function () {
      deleteuser();
    });

    var error_username = false;
    var error_password = false;
    var error_firstname = false;
    var error_lastname = false;
    var error_address = false;
    var error_email = false;
    var error_phone = false;

    var error_update_username = false;
    var error_update_password = false;
    var error_update_firstname = false;
    var error_update_lastname = false;
    var error_update_address = false;
    var error_update_email = false;
    var error_update_phone = false;

    $("#username").focusout(function () {
      check_username();
    });

    $("#password").focusout(function () {
      check_password();
    });

    $("#firstname").focusout(function () {
      check_firstname();
    });

    $("#lastname").focusout(function () {
      check_lastname();
    });

    $("#address").focusout(function () {
      check_address();
    });

    $("#email").focusout(function () {
      check_email();
    });

    $("#phone").focusout(function () {
      check_phone();
    });


    $("#update_username").focusout(function () {
      check_update_username();
    });

    $("#update_password").focusout(function () {
      check_update_password();
    });

    $("#update_firstname").focusout(function () {
      check_update_firstname();
    });

    $("#update_lastname").focusout(function () {
      check_update_lastname();
    });

    $("#update_address").focusout(function () {
      check_update_address();
    });

    $("#update_email").focusout(function () {
      check_update_email();
    });

    $("#update_phone").focusout(function () {
      check_update_phone();
    });

    function check_username() {

      if ($.trim($('#username').val()) == '') {
        $("#username_error_message").html("username is a required field.");
        $("#username_error_message").show();
        error_username = true;
      }
      else {
        $("#username_error_message").hide();
      }
    }

    function check_password() {

      if ($.trim($('#password').val()) == '') {
        $("#password_error_message").html("password is a required field.");
        $("#password_error_message").show();
        error_password = true;
      }
      else {
        $("#password_error_message").hide();
      }
    }

    function check_firstname() {

      if ($.trim($('#firstname').val()) == '') {
        $("#firstname_error_message").html("First name is a required field.");
        $("#firstname_error_message").show();
        error_firstname = true;
      }
      else {
        $("#firstname_error_message").hide();
      }
    }

    function check_lastname() {

      if ($.trim($('#lastname').val()) == '') {
        $("#lastname_error_message").html("Last name is a required field.");
        $("#lastname_error_message").show();
        error_lastname = true;
      }
      else {
        $("#lastname_error_message").hide();
      }
    }


    function check_email() {

      var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
      var email_length = $("#email").val().length;

      if ($.trim($('#email').val()) == '') {
        $("#email_error_message").hide();
      } else if (!(pattern.test($("#email").val()))) {
        $("#email_error_message").html("Invalid email address!");
        $("#email_error_message").show();
        error_email = true;
      } else {
        error_email = false;
        $("#email_error_message").hide();
      }
    }


    function check_update_username() {

      if ($.trim($('#update_username').val()) == '') {
        $("#update_username_error_message").html("username is a required field.");
        $("#update_username_error_message").show();
        error_update_username = true;
      }
      else {
        $("#update_username_error_message").hide();
      }
    }

    function check_update_password() {

      if ($.trim($('#update_password').val()) == '') {
        $("#update_password_error_message").html("password is a required field.");
        $("#update_password_error_message").show();
        error_update_password = true;
      }
      else {
        $("#update_password_error_message").hide();
      }
    }



    function check_update_firstname() {

      if ($.trim($('#update_firstname').val()) == '') {
        $("#update_firstname_error_message").html("Firstname is a required field.");
        $("#update_firstname_error_message").show();
        error_update_firstname = true;
      }
      else {
        $("#update_firstname_error_message").hide();
      }
    }

    function check_update_lastname() {

      if ($.trim($('#update_lastname').val()) == '') {
        $("#update_lastname_error_message").html("Lastname is a required field.");
        $("#update_lastname_error_message").show();
        error_update_lastname = true;
      }
      else {
        $("#update_lastname_error_message").hide();
      }
    }

    function check_update_address() {

      if ($.trim($('#update_address').val()) == '') {
        $("#update_address_error_message").html("address is a required field.");
        $("#update_address_error_message").show();
        error_update_address = true;
      }
      else {
        $("#update_address_error_message").hide();
      }
    }


    function check_update_email() {

      var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
      var update_email_length = $("#update_email").val().length;

      if ($.trim($('#update_email').val()) == '') {
        $("#update_email_error_message").hide();
      } else if (!(pattern.test($("#update_email").val()))) {
        $("#update_email_error_message").html("Invalid email address!");
        $("#update_email_error_message").show();
        error_update_email = true;
      } else {
        error_update_email = false;
        $("#update_email_error_message").hide();
      }
    }

    function check_update_phone() {

      if ($.trim($('#update_phone').val()) == '') {
        $("#update_phone_error_message").html("phone is a required field.");
        $("#update_phone_error_message").show();
        error_update_phone = true;
      }
      else {
        $("#update_phone_error_message").hide();
      }
    }

    function adduser() {

      error_username = false;
      error_password = false;
      error_firstname = false;
      error_lastname = false;
      error_address = false;
      error_email = false;
      error_phone = false;

      check_username();
      check_password();
      check_firstname();
      check_lastname();
      check_address();
      check_email();
      check_phone();

      if (error_username == false && error_password == false && error_firstname == false && error_lastname == false && error_address == false && error_email == false && error_phone == false) {

        data = $('#user_form').serialize();
        $.ajax({
          type: "POST",
          data: data,
          url: "user_action.php",
          dataType: "json",
          success: function (data) {
            $('#add_user').modal('close');
            Materialize.toast('New user added successfully!', 3000, 'green');
            dataTable.ajax.reload();
          }, error: function () {
            Materialize.toast('Oops! Something went wrong.', 3000, 'red');
          }
        });
        return false;
      } else {
        Materialize.toast('Please make sure all required fields are filled out correctly', 3000, 'red');
        return false;
      }
    }

    var user_id = '';
    $(document).on('click', '.view_user', function () {
      var user_id = $(this).attr('id');
      $.ajax({
        url: "user_action.php",
        type: "POST",
        data: { action: 'single_fetch', user_id: user_id },
        success: function (data) {
          var data = JSON.parse(data);
          $('#view_id').text(data['id']);
          $('#view_username').text(data['username']);
          $('#view_password').text(data['password']);
          $('#view_firstname').text(data['firstname']);
          $('#view_lastname').text(data['lastname']);
          $('#view_phone').text(data['phone']);
          $('#view_email').text(data['email']);
          $('#view_address').text(data['address']);

        }
      });
    });

    $(document).on('click', '.update_user', function () {
      var user_id = $(this).attr('id');
      $.ajax({
        url: "user_action.php",
        type: "POST",
        data: { action: 'single_fetch', user_id: user_id },
        success: function (data) {

          var data = JSON.parse(data);
          $('#user_id').val(data['id']);
          $('#update_username').val(data['username']);
          $('#update_password').val(data.['password']);
          $('#update_firstname').val(data['firstname']);
          $('#update_lastname').val(data['lastname']);
          $('#update_gender').val(data['gender']);
          $('#update_phone').val(data['phone']);
          $('#update_email').val(data['email']);
          $('#update_address').val(data['address']);
          $('#update_city').val(data['city']);
          $('#update_state').val(data['state']);

        }
      });
    });

    function updateuser() {

      error_update_username = false;
      error_update_password = false;
      error_update_firstname = false;
      error_update_lastname = false;
      error_update_address = false;
      error_update_email = false;
      error_update_phone = false;

      check_update_username();
      check_update_password();
      check_update_firstname();
      check_update_lastname();
      check_update_address();
      check_update_email();
      check_update_phone();

      if (error_update_username == false && error_update_password == false && error_update_firstname == false && error_update_lastname == false && error_update_address == false && error_update_email == false && error_update_phone == false) {
        data = $('#update_user_form').serialize();
        $.ajax({
          type: "POST",
          data: data,
          url: "user_action.php",
          dataType: "json",
          success: function (data) {
            if (data.status == 'success') {
              $('#update_modal').modal('close');
              Materialize.toast('user has been successfully updated!', 3000, 'green');
              dataTable.ajax.reload();
            }
          }, error: function () {
            Materialize.toast('Oops! Something went wrong.', 3000, 'red');
          }
        });
      }
    }

    var id;
    $(document).on('click', '.delete_user', function () {
      id = $(this).attr('id');
    });

    function deleteuser() {
      $.ajax({
        type: "POST",
        data: { id:id, action:'delete' },
        url: "user_action.php",
        dataType: "json",
        success: function (data) {
          if (data.status) {
            Materialize.toast('user permanently deleted successfully!', 3000, 'green');
            dataTable.ajax.reload();
          } else {
            Materialize.toast('Oops! Something went wrong.', 3000, 'red');
          }
        }, error: function () {
          Materialize.toast('Oops! Something went wrong.', 3000, 'red');
        }
      });
    }
  });

</script>