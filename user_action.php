<?php

  include "connection.php";

  session_start();

  $output = '';

  if(isset($_POST["action"])){

    // Fetch users
    if($_POST["action"] == "user_fetch"){

      // Read value
      $draw = $_POST['draw'];
      $row = $_POST['start'];
      $row_per_page = $_POST['length'];
      $column_index = $_POST['order'][0]['column'];
      $column_name = $_POST['columns'][$column_index]['data'];
      $column_sort_order = $_POST['order'][0]['dir'];
      $search_value = $_POST['search']['value'];

      // Search
      $search_query = " ";
      if($search_value != ''){
        $search_query = " and (id LIKE '%".$searchValue."%' OR
        username LIKE '%".$searchValue."%' OR
        firstname LIKE '%".$searchValue."%' OR
        lastname LIKE '%".$searchValue."%' OR
        address LIKE '%".$searchValue."%' OR
        email LIKE '%".$searchValue."%' OR
        phone LIKE '%".$searchValue."%' ) ";
      }

      // Total number of records without filtering
      $sql_user = mysqli_query($conn,"SELECT count(*) AS allcount FROM tbl_user");
      $records = mysqli_fetch_assoc($sql_user);
      $total_records = $records['allcount'];

      // Total number of records with filtering
      $sql_user = mysqli_query($conn,"SELECT count(*) AS allcount FROM tbl_user WHERE 1 ".$search_query);
      $records = mysqli_fetch_assoc($sql_user);
      $total_record_with_filter = $records['allcount'];

      // Fetch records
      $sql_user = "SELECT * FROM tbl_user WHERE 1 ".$search_query." ORDER BY ".$column_name." ".$column_sort_order." LIMIT ".$row.",".$row_per_page;
      $user_records = mysqli_query($conn, $sql_user);
      $data = array();

      while ($row = mysqli_fetch_assoc($user_records)) {
        $data[] = array(
          "id"                =>$row['id'],
          "username"          =>$row['username'],
          "password"          =>$row['password'],
          "firstname"         =>$row['firstname'],
          "lastname"          =>$row['lastname'],
          "address"           =>$row['address'],
          "email"             =>$row['email'],
          "phone"             =>$row['phone'],
          "action"            => '<button type="button" data-target="view_user" class="btn green modal-trigger view_user" id="'.$row['id'].'"><i class="material-icons">visibility</i></button>
                                  <button type="button" data-target="update_modal" class="btn blue modal-trigger update_user" id="'.$row['id'].'"><i class="material-icons">edit</i></button>
                                  <button type="button" data-target="delete_modal" class="btn red modal-trigger delete_user" id="'.$row['id'].'"><i class="material-icons">delete</i></button>'
        );
      }

      $response = array(
        "draw"                      => intval($draw),
        "iTotalRecords"             => $total_records,
        "iTotalDisplayRecords"      => $total_record_with_filter,
        "aaData"                    => $data
      );

      echo json_encode($response);

    }

    if($_POST["action"] == "Add"){

      $username = $_POST['username'];
      $password = sha1($_POST['password']);
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];


      $sql = "INSERT INTO tbl_user (username, password, firstname,
                                      lastname,
                                      email,
                                      phone,
                                      address)
                              VALUES('$username', '$firstname', '$password',
                                    '$lastname',
                                    '$email',
                                    '$phone',
                                    '$address',
                                    NOW())";

      if(mysqli_query($conn, $sql)){
        $output = array(
          'status'        => 'success',
          'alert'         => 'New user has been successfully added.'
        );
      }

      echo json_encode($output);

    }

    if($_POST["action"] == "single_fetch"){

      $user_id = $_POST['user_id'];

      $sql = "SELECT id, username , password,
                    firstname,
                    lastname,
                    address,
                    email,
                    phone
                  FROM tbl_user
                  WHERE id = '$user_id'";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_row($result);

      $output = array(
        "id"		            =>	$row[0],
        "username"		      =>	$row[1],
        "password"		      =>	$row[2],
        "firstname"		      =>	$row[3],
        "lastname"		      =>	$row[4],
        "email"             =>	$row[5],
        "address"           =>	$row[6],
        "phone"             =>	$row[7]
      );

      echo json_encode($output);
    }

    if($_POST["action"] == "general_fetch"){

      $user_id = $_POST['id'];

      $sql = "SELECT id, username, password,
                  firstname,
                  lastname,
                  address,
                  email,
                  phone
                  FROM tbl_user
                  WHERE id = '$user_id'";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_row($result);

      $output = array(
        "id"		            =>	$row[0],
        "username"		      =>	$row[1],
        "password"		      =>	$row[2],
        "firstname"		      =>	$row[3],
        "lastname"		      =>	$row[4],
        "email"             =>	$row[5],
        "address"           =>	$row[6],
        "phone"             =>	$row[7]
      );
      
      echo json_encode($output);
    }

    if($_POST["action"] == "Update"){

      $id = $_POST['user_id'];
      $username = $_POST['update_username'];
      $password = sha1($_POST['update_password']);
      $firstname = $_POST['update_firstname'];
      $lastname = $_POST['update_lastname'];
      $email = $_POST['update_email'];
      $address = $_POST['update_address'];
      $phone = $_POST['update_phone'];

      $sql = "UPDATE tbl_user SET username = '$username', password = '$password', firstname = '$firstname',
                                lastname = '$lastname',
                                phone = '$phone',
                                email = '$email',
                                address = '$address'
                                WHERE id = '$id'";
  
      $result = mysqli_query($conn, $sql);
  
      $output = array(
        'status'        => 'success'
      );  
      echo json_encode($output);
    }

    if($_POST["action"] == "delete"){

      $id = $_POST['id'];

      $sql = "DELETE FROM tbl_user  WHERE id='$id'";

      $result = mysqli_query($conn, $sql);

      $output = array(
          'status'        => 'success'
      );
          
      echo json_encode($output);
    
    }

  }

?>