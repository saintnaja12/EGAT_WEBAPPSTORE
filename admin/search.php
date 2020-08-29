<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<?php 

// SEARCH 
session_start();
include '../conn.php';
$output = '';

if(isset($_POST["query"]))
{
    $search = $_POST["query"];

    $query = "SELECT * FROM app_s
    WHERE id_app LIKE '%".$search."%'
    OR name_app LIKE '%".$search."%' ORDER BY id_app ASC";
}
else 
{
    $query = "SELECT * FROM app_s ORDER BY id_app ASC ";
}

if($result = sqlsrv_query($conn, $query))
{
    $output .= '
    <div class="table-responsive" id="app_table">
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
                    <th scope="col">';
            if($_SESSION["edit_toggle"] == "on") {
    $output .= '<div align="center">Edit</div>';
            } else if($_SESSION["edit_toggle"] == "off"){  
            } else if($_SESSION["edit_toggle"] == ""){
            } 
    $output .= '    
                    </th>
                    <th scope="col">
                        <div align="center">Screenshot</div>
                    </th>
                    <th scope="col">
                        <div align="center">Files</div>
                    </th>
                    <th scope="col">';
            if($_SESSION["del_toggle"] == "on") {
    $output .= '<div align="center">Delete</div>';
            } else if($_SESSION["del_toggle"] == "off"){  
            } else if($_SESSION["del_toggle"] == ""){
            } 
    $output .= '    
                    </th>
                </tr>
            </thead>

    ';
    
    while($row = sqlsrv_fetch_array($result))
    {
        $output .= '
        <tr>
            <td>' . $row["id_app"] . '</td>
            <td>' . $row["name_app"] . '</td>
            <td>
                <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="'.$row["id_app"].'"" >
            </td>
            <td>';
                if($_SESSION["edit_toggle"] == "on"){
                    $output .= '<input class="btn btn-warning btn-xs edit_data fas fa-cut " type="button" data-toggle="modal" data-target=file_data_Modal" value="&#xf0c4;" id="btn_edit" data-id="'.$row['id_app'].'">';
                }else if($_SESSION["edit_toggle"] == "off"){
                }else if($_SESSION["edit_toggle"] == ""){
                }
        $output .= '
            </td>
            <td>        
                <input class="btn btn-dark image_data btn-xs fas fa-images " type="button" data-toggle="modal" data-target="#image_detail_Modal" value="&#xf302;"  id="'.$row["id_app"].'">                              
            </td>
            <td>
                <input class="btn btn-success file_data btn-xs fas fa-cut " type="button" data-toggle="modal" data-target="#file_data_Modal" value="&#xf15c;"  id="'.$row["id_app"].'">                    
            </td>
            <td>';
                if($_SESSION["del_toggle"] == "on"){
                    $output .= '<input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="'.$row["id_app"].'" >';
                }else if($_SESSION["del_toggle"] == "off"){
                }else if($_SESSION["del_toggle"] == ""){
                }
                
        $output .= '
            </td>
        </tr>


        ';
    }
    $output .= '</table></div>';
    
}
echo $output;
?>

<script type="text/javascript" language="javascript">

$(document).ready(function datatable_per() {
    $('.table').dataTable();
} );
</script>             

