<?php 

// SEARCH 
session_start();
include '../conn.php';
$output = '';

// echo $_POST["id"];
if(isset($_POST["query"]))
{
    $search = $_POST["query"];

    $query = "SELECT * FROM images
    WHERE id_image LIKE '%".$search."%'
    OR name LIKE '%".$search."%'
    OR id_app LIKE '%".$search."%'
    ORDER BY id_image ASC";
}
else 
{
    $query = "SELECT * FROM images ORDER BY id_image ASC ";
}

if($result = sqlsrv_query($conn, $query))
{
    $output .= '
    <table class="table align-items-center table-sm" style="background-color: white;">
    <thead class="thead-light">
        <tr>
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
        </tr>
    </thead>



    ';
    
    while($row = sqlsrv_fetch_array($result))
    {
        $output .= '
        <tr>  
            <td>' . $row["id_image"] . '</td>
            <td>' . $row["name"] . '</td>
            <td>' . $row["id_app"] . '</td>
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
    $output .= '</table><div align="center">';
    
}
echo $output;
?>

           

