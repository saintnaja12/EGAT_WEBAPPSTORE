<?php 
//UPDATE

include '../conn.php';

// echo $_POST["id_user"];
if(isset($_POST["id_user"]))
{
    
    $output = '';
    $message = '';
    $view = $_POST['view'];
    $edit = $_POST['edit'];
    $del = $_POST['del'];

    $query = "UPDATE user_s   
        SET view='$view',   
        edit='$edit',   
        del='$del'
        WHERE id_user ='".$_POST["id_user"]."'";  
        
    
    if(sqlsrv_query($conn, $query))
    {
        
        $select_query = "SELECT * FROM user_s ";
        $result = sqlsrv_query($conn, $select_query);
        $message .= '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Set permissions complete.", 
                icon:"success"});
        }, 100);
        </script>';
        $output .= '
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
                            <div align="center">Row</div>
                        </th>
                        <th scope="col">
                            <div align="center">View</div>
                        </th>
                        <th scope="col">
                            <div align="center">Edit</div>
                        </th>
                        <th scope="col">
                            <div align="center">Permissions</div>
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
                    <input class="btn btn-success btn-xs edit_data fas fa-edit " type="button" data-toggle="modal" data-target="#add_data_Modal" value="&#xf044;" id="btn_edit" data-id="' . $row["id_user"] . '">
                </td>
                <td>
                    <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="' . $row["id_user"] . '" >      
                </td>
                                    
            </tr>
            ';
        }
        $output .= '</table>';
    }
    echo $output;
}
?>

           

