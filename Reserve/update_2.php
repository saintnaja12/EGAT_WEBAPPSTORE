<?php 
//UPDATE
session_start();
include '../conn.php';

// echo $_POST["id"];
if(isset($_POST["id_image"]))
{
    
    $output = '';
    $message = '';
    $name = $_POST['name'];
    $id_app = $_POST['id_app'];

    $query = "UPDATE images   
        SET name='$name',   
        id_app='$id_app'
        WHERE id_image ='".$_POST["id_image"]."'";  
        
    
    if(sqlsrv_query($conn, $query))
    {
        
        $select_query = "SELECT * FROM images ";
        $result = sqlsrv_query($conn, $select_query);
        $message .= '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Update complete.", 
                icon:"success"});
        }, 100);
        </script>';
        $output .= '
        <table class="table align-items-center table-sm" style="background-color: white;">  
        <th scope="col">
            <div align="center">ID</div>
        </th>
        <th scope="col">
            <div align="center">Image Name</div>
        </th>
        <th scope="col">
            <div align="center">ID Main Applications</div>
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

        ';
        
        while($row = sqlsrv_fetch_array($result))
        {
            $output .= ''.$message.'';
            $output .= '
            <tr>  
                <td>' . $row["id_image"] . '</td>
                <td>' . $row["name"] . '</td>
                <td>' . $row['id_app']. '</td>
                <td>
                    <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="'.$row["id_image"].'" >
                </td>
                <td>
                    <input class="btn btn-warning edit_data btn-xs fas fa-cut " type="button" data-toggle="modal" data-target="#" value="&#xf0c4;" id="btn_edit" data-id="'.$row['id_image'].'">
                </td>
                <td>
                <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" data-toggle="modal" data-target="#" value="&#xf12d;" id="'.$row["id_image"].'">
                </td>
            </tr>
            ';
        }
        $output .= '</table>';
    }
    echo $output;
}
?>

           

