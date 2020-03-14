<?php

    require_once "connection.php";

    session_start();

    $output = '';

    if(isset($_POST["action"])){

        if($_POST["action"] == "user_fetch"){

            $id_user = $_POST['id_user'];

            $sql = "SELECT id, username FROM tbl_admin WHERE id = '$id_user'";

            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_row($result);

            $output = array(
                'id'		    =>	$row[0],
                'username'      => 	$row[1]
            );
            
            echo json_encode($output);
        }

        if($_POST["action"] == "update_password"){

            $password = sha1($_POST['current_password']);
            $new_password = sha1($_POST['new_password']);
            $id_user = $_POST['idUser'];

            $sql = "SELECT * FROM tbl_admin WHERE password = '$password' AND id = '$id_user'";

            $result = mysqli_query($conn, $sql);

            $checkrows = mysqli_num_rows($result);

            if($checkrows > 0) {

                $sql = "UPDATE tbl_admin SET password = '$new_password' WHERE id = '$id_user'";

                $result = mysqli_query($conn, $sql);

                if($result > 0)	{

					$output = array(
						'status'	=>	'success'
                    );
                        
                    echo json_encode($output);
                } 

            } else {

                $output = array(
                    'error'		     =>	'true'
                );

                echo json_encode($output); 

            }

        }
        
        if($_POST["action"] == "Edit"){

            $username = $_POST['username'];
            $id_user = $_POST['id_user'];

            $sql = "SELECT * FROM tbl_admin WHERE username = '$username'";

            $result = mysqli_query($conn, $sql);

            $checkrows = mysqli_num_rows($result);

            if($checkrows > 0) {

                $output = array(
                    'error'		    =>	'true',
                );
                
                echo json_encode($output);

            } else {

                $sql = "UPDATE tbl_admin SET username = '$username' WHERE id = '$id_user'";

                $result = mysqli_query($conn, $sql);
    
                $_SESSION['username'] = $username;

                $output = array(
                    'status'        => 'success',
                );
                
                echo json_encode($output);
            }
        }
    }

    
?>
