<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<?php 

// SEARCH 
session_start();
include '../conn.php';
$output = '';

// echo $_POST["id_user"];
if(isset($_POST["query"]))
{
    $search = $_POST["query"];

    $query = "SELECT * FROM user_s
    WHERE id_user LIKE '%".$search."%'
    OR username LIKE '%".$search."%' 
    OR row LIKE '%".$search."%' ORDER BY row ASC";
}
else 
{
    $query = "SELECT * FROM user_s ORDER BY row ASC ";
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
    $output .= '</table><div align="center">';
    
}
echo $output;
?>

<script type="text/javascript" language="javascript">

$(document).ready(function datatable_per() {
    $('.table').dataTable();
} );
</script>  

