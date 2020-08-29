<?php

session_start();
include '../conn.php';

// INSERT
if(!empty($_POST))
{
    
    $output = '';
    $message = '';
    $id_app = $_POST['id_app'];
    $img_deatail_path = $_POST['img_deatail_path'];

    $query = "INSERT INTO images(image, id_app)
    VALUES('$img_deatail_path', '$id_app')";
       

    if(sqlsrv_query($conn, $query))
    {
        $message .= '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Upload complete.", 
                icon:"success"});
        }, 100);
        </script>';
        $select_query = "SELECT * FROM images WHERE id_app = $id_app";
        $result = sqlsrv_query($conn, $select_query);
        $output .= '
        <div class="table-responsive" id="image_table">
        <table class="table align-items-center table-sm" style="background-color: white;">
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    <div align="center">ID</div>
                </th>
                <th scope="col">
                    <div align="center">Image</div>
                </th>
                <th scope="col">
                    <div align="center">Image name</div>
                </th>
                <th scope="col">
                    <div align="center">Path</div>
                </th>
                <th scope="col">
                    <div align="center">ID application</div>
                </th>
                <th scope="col">';
                if($_SESSION["del_image_toggle"] == "on") {
        $output .= '<div align="center">Delete</div>';
                } else if($_SESSION["del_image_toggle"] == "off"){  
                } else if($_SESSION["del_image_toggle"] == ""){
                } 
        $output .= '    
                </th>
            </tr>
        </thead>';
        
        while($row = sqlsrv_fetch_array($result))
        {
            $output .= ''.$message.'';

            $data = substr($row["image"],16);

            $output .= '
            <tr>
                <td>'.$row["id_image"].'</td>
                <td>
                    <img src="'.$row["image"].'" class="figure-img img-fluid rounded" width="80" style="margin: 0.5em auto; ">
                </td>
                <td>'.$data.'</td>
                <td>'.$row["image"].'</td>
                <td>'.$row["id_app"].'</td>
                <td>';
                if($_SESSION["del_image_toggle"] == "on"){
        $output .= '<input class="btn btn-danger btn-xs delete_image_detail fas fa-eraser" type="button" value="&#xf12d;" id="'.$row["id_image"].'" >';
                }else if($_SESSION["del_image_toggle"] == "off"){
                }else if($_SESSION["del_image_toggle"] == ""){
                }
        $output .= '
                </td>
            </tr>
        ';
        }
        $output .= '</table></div>';
    }
    echo $output;
}
?>