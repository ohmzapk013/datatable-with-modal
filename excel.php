<?php
    //export.php
    $connect = mysqli_connect("localhost", "root", "", "egm_addressbook");
    $output = '';

    $query = "SELECT * FROM tbl_contacts";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0){
        $output .= '
        <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>E-mail</th>
            <th>Group</th>
            <th>Website</th>
            <th>Mobile Phone</th>
            <th>Home Phone</th>
            <th>Work Phone</th>
            <th>Fax</th>
            <th>Company</th>
            <th>Job Title</th>
            <th>Address 1</th>
            <th>Address 2</th>
            <th>City</th>
            <th>State</th>
            <th>Notes</th>
            <th>Created Date</th>
        </tr>';
        while($row = mysqli_fetch_array($result)){
            $output .= '
            <tr>
                <td>'.$row["id"].'</td>
                <td>'.$row["firstname"].'</td>
                <td>'.$row["lastname"].'</td>
                <td>'.$row["gender"].'</td>
                <td>'.$row["birthday"].'</td>
                <td>'.$row["email"].'</td>
                <td>'.$row["contact_group"].'</td>
                <td>'.$row["website"].'</td>
                <td>'.$row["mobile_phone"].'</td>
                <td>'.$row["home_phone"].'</td>
                <td>'.$row["work_phone"].'</td>
                <td>'.$row["fax"].'</td>
                <td>'.$row["company"].'</td>
                <td>'.$row["job_title"].'</td>
                <td>'.$row["address_1"].'</td>
                <td>'.$row["address_2"].'</td>
                <td>'.$row["city"].'</td>
                <td>'.$row["state"].'</td>
                <td>'.$row["notes"].'</td>
                <td>'.$row["created_date"].'</td>
            </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=Address Book.xls');
        echo $output;
    }

?>