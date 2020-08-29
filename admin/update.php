<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<?php 
//UPDATE

include '../conn.php';
session_start();

// echo $_POST["id_app"];
if(isset($_POST["id_app"]))
{
    
    $output = '';
    $message = '';
    $name_app = $_POST['name_app'];
    $detail = $_POST['detail'];
    $system = $_POST['system'];
    $language = $_POST['language'];
    $version = $_POST['version'];
    $set_permissions = $_POST['set_permissions'];
    $department = $_POST['department'];

    $imgPath = $_POST['imgPath'];

    if($imgPath != ''){
        $query = "UPDATE app_s   
        SET name_app='$name_app',   
        detail='$detail',   
        system='$system',    
        language = '$language',
        set_permissions = '$set_permissions',
        department = '$department',
        img_logo = '$imgPath'
        WHERE id_app ='".$_POST["id_app"]."'";  
    }
    else
    {
        $query = "UPDATE app_s   
        SET name_app='$name_app',   
        detail='$detail',   
        system='$system',    
        language = '$language',
        set_permissions = '$set_permissions',
        department = '$department'
        WHERE id_app ='".$_POST["id_app"]."'";  
    }
           
    
    if(sqlsrv_query($conn, $query))
    {
        
        $select_query = "SELECT * FROM app_s ";
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
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    <div align="center">ID</div>
                </th>
                <th scope="col">
                    <div align="center">Application Name</div>
                </th>
                <th scope="col">
                    <div align="center">View</div>
                </th>
                ';
                if($_SESSION["edit_toggle"] == "on") {
        $output .= '
                <th scope="col">
                    <div align="center">Edit</div>
                </th>';
                } else if($_SESSION["edit_toggle"] == "off"){
                } else if($_SESSION["edit_toggle"] == ""){
                }
        $output .= '
                <th scope="col">
                    <div align="center">Screenshot</div>
                </th>
                <th scope="col">
                    <div align="center">Files</div>
                </th>';
                if($_SESSION["del_toggle"] == "on") {
        $output .= '
                <th scope="col">
                    <div align="center">Delete</div>
                </th>';
                } else if($_SESSION["del_toggle"] == "off"){
                } else if($_SESSION["del_toggle"] == ""){
                }
        $output .= '
            </tr>
        </thead>

        ';
      
        while($row = sqlsrv_fetch_array($result))
        {
            $output .= ''.$message.'';
            $output .= '
            <tr>  
                <td>' . $row["id_app"] . '</td>
                <td>' . $row["name_app"] . '</td>
                <td>
                    <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="'.$row["id_app"].'" >
                </td>';
                if($_SESSION["edit_toggle"] == "on") {
            $output .= '   
                <td>
                    <input class="btn btn-warning edit_data btn-xs fas fa-cut " type="button" data-toggle="modal" data-target="#" value="&#xf0c4;" id="btn_edit" data-id="'.$row['id_app'].'">
                </td>';
                } else if($_SESSION["edit_toggle"] == "off"){  
                } else if($_SESSION["edit_toggle"] == ""){
                } 
            $output .= '
                <td> 
                    <input class="btn btn-dark image_data btn-xs fas fa-images " type="button" data-toggle="modal" data-target="#image_detail_Modal" value="&#xf302;"  id="'.$row["id_app"].'">                              
                </td>
                <td>
                    <input class="btn btn-success file_data btn-xs fas fa-cut " type="button" data-toggle="modal" data-target="#file_data_Modal" value="&#xf15c;"  id="'.$row["id_app"].'">                    
                </td>';
                if($_SESSION["del_toggle"] == "on") {
            $output .= '   
                <td>
                    <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="'.$row['id_app'].'">
                </td>';
                } else if($_SESSION["del_toggle"] == "off"){  
                } else if($_SESSION["del_toggle"] == ""){
                } 
            $output .= '
            </tr>
            ';
        }
        $output .= '</table>';
    }
    echo $output;
}
?>

           
<script type="text/javascript" language="javascript">

$(document).ready(function datatable_per() {
    $('.table').dataTable();
} );
</script>    
