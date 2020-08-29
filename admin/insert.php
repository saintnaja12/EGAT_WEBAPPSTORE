<?php

include '../conn.php';
session_start();

// INSERT
if(!empty($_POST))
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

    $sql_chk = "SELECT * FROM app_s WHERE name_app='$name_app'";
    $query_chk = sqlsrv_query( $conn, $sql_chk) or die( print_r( sqlsrv_errors(), true)) ;
    $result_chk = sqlsrv_fetch_array($query_chk);

    
    if(!$result_chk)
    {
    
        $query = "INSERT INTO app_s(name_app, detail, system, language, version, set_permissions, department, img_logo)
        VALUES('$name_app', '$detail', '$system', '$language', '$version', '$set_permissions', '$department', '$imgPath')";
        
        if(sqlsrv_query($conn, $query))
        {
            $message .= '<script type="text/javascript">
            setTimeout(function () { 
                swal({
                    title:"Insert complete.", 
                    icon:"success"});
            }, 100);
            </script>';
            $select_query = "SELECT TOP 1 * FROM app_s ORDER BY id_app DESC";
            $result = sqlsrv_query($conn, $select_query);
            $output .= '
            <table class="table align-items-center table-sm" style="background-color: white;">  
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
            $output .= '</table>';
            $output .= '<button type="button" class="btn btn-info" onClick="window.location.reload();">Back To Manage</button>';
        }
        echo $output;
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