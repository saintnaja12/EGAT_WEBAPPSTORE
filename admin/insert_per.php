<?php

include '../conn.php';
session_start();

// INSERT
if(!empty($_POST))
{
    
    $output = '';
    $message = '';
    $message_error = '';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $row = $_POST['row'];
    $e_mail = $_POST['e_mail'];

    $adding_toggle = 'off';
    $edit_toggle = 'off';
    $del_toggle = 'off';
    
    $adding_image_toggle = 'off';
    $del_image_toggle = 'off';

    $adding_file_toggle = 'off';
    $del_file_toggle = 'off';

    $sql_chk = "SELECT * FROM user_s WHERE username='$username'";
    $query_chk = sqlsrv_query( $conn, $sql_chk) or die( print_r( sqlsrv_errors(), true)) ;
    $result_chk = sqlsrv_fetch_array($query_chk);

    
    if(!$result_chk)
    {

        $query_mail = "SELECT * FROM user_s WHERE e_mail = '".$e_mail."'";  
        $params = array();
        $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
        $result_mail = sqlsrv_query($conn, $query_mail, $params, $options);
        $chk_mail = sqlsrv_num_rows($result_mail);   

        if($chk_mail == '0')
        {

            $query = "INSERT INTO user_s(username, password, fname, lname, row, adding_toggle, edit_toggle, del_toggle, adding_image_toggle, del_image_toggle, adding_file_toggle, del_file_toggle, e_mail)
            VALUES('$username', '$password', '$fname', '$lname', '$row', '$adding_toggle' , '$edit_toggle' , '$del_toggle', '$adding_image_toggle', '$del_image_toggle', '$adding_file_toggle', '$del_file_toggle', '$e_mail')";
        
            if(sqlsrv_query($conn, $query))
            {
                $message .= '<script type="text/javascript">
                setTimeout(function () { 
                    swal({
                        title:"Insert complete.", 
                        icon:"success"});
                }, 100);
                </script>';
                $select_query = "SELECT TOP 1 * FROM user_s ORDER BY id_user DESC";
                $result = sqlsrv_query($conn, $select_query);
                $output .= '
                <div class="table-responsive" id="app_table">
                <table class="table align-items-center table-sm" style="background-color: white;">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">
                                <div align="center">ID</div>
                            </th>
                            <th scope="col">
                                <div align="center">Username</div>
                            </th>
                            <th scope="col">
                                <div align="center">Group</div>
                            </th>
                            <th scope="col">
                                <div align="center">View</div>
                            </th>
                            
                            <th scope="col">
                                <div align="center">Edit</div>
                            </th>
                            <th scope="col">
                                <div align="center">Delete</div>
                            </th>
                            
                        </tr>
                    </thead>
                ';
                
                while($row = sqlsrv_fetch_array($result))
                {
                    $output .= ''.$message.'';
                    $output .= '
                    <tr>
                        <td>' . $row["id_user"] . '</td>
                        <td>' . $row["username"] . '</td>
                        <td>' . $row["row"] . '</td>
                        <td>
                            <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="' . $row["id_user"] . '" >
                        </td>
                        <td>
                            <input class="btn btn-warning btn-xs edit_data fas fa-cut " type="button" data-toggle="modal" data-target="#add_data_Modal" value="&#xf0c4;" id="btn_edit" data-id="' . $row["id_user"] . '">
                        </td>
                        <td>
                            <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="' . $row["id_user"] . '" >      
                        </td>                 
                    </tr>
        
                    ';
                }
                $output .= '</table>';
                $output .= '<button type="button" class="btn btn-info" onClick="window.location.reload();">Back To Manage</button>';
            }
            echo $output; 
        }
    }
    else 
    {
        $output .= '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Insert error.", 
                icon:"error"});
        }, 100);
        </script>';
    }
    
}
?>