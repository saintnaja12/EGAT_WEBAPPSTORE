<?php

include '../conn.php';
session_start();

// INSERT
if(!empty($_POST))
{
    
    $output = '';
    $message = '';

    $adding_toggle = $_POST['hidden_adding_toggle'];
    $edit_toggle = $_POST['hidden_edit_toggle'];
    $del_toggle = $_POST['hidden_del_toggle'];
    
    $adding_image_toggle = $_POST['hidden_adding_image_toggle'];
    $del_image_toggle = $_POST['hidden_del_image_toggle'];

    $adding_file_toggle = $_POST['hidden_adding_file_toggle'];
    $del_file_toggle = $_POST['hidden_del_file_toggle'];

    $Developer = 'Developer';

    $query = "UPDATE user_s
        SET adding_toggle = '$adding_toggle', 
        edit_toggle = '$edit_toggle', 
        del_toggle = '$del_toggle', 
        adding_image_toggle = '$adding_image_toggle', 
        del_image_toggle = '$del_image_toggle', 
        adding_file_toggle = '$adding_file_toggle', 
        del_file_toggle = '$del_file_toggle'
        WHERE row ='$Developer'";          

    if(sqlsrv_query($conn, $query))
    {
        $message .= '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Set permissions complete.", 
                icon:"success"});
        }, 100);
        </script>';
        $select_query = "SELECT * FROM user_s ORDER BY id_user DESC";
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
                        <div align="center">row</div>
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
?>