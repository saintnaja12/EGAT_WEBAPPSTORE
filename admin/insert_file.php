<?php

session_start();
include '../conn.php';

// INSERT
if(!empty($_POST))
{
    
    $output = '';
    $message = '';
    $id_app = $_POST['id_app'];
    $version = $_POST['version'];
    $path_file = $_POST['path_file'];
    $size = $_POST['size'];

    $query = "INSERT INTO files(path_file,version, size, id_app)
    VALUES('$path_file', '$version', '$size', '$id_app')";
       

    if(sqlsrv_query($conn, $query))
    {
        $message .= '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Upload file complete.", 
                icon:"success"});
        }, 100);
        </script>';
        $select_query = "SELECT * FROM files WHERE id_app = $id_app";
        $result = sqlsrv_query($conn, $select_query);
        $output .= '
        <div class="table-responsive" id="file_table">
            <table class="table align-items-center table-sm" style="background-color: white;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">
                            <div align="center">ID</div>
                        </th>
                        <th scope="col">
                            <div align="center">File name</div>
                        </th>
                        <th scope="col">
                            <div align="center">Path</div>
                        </th>
                        <th scope="col">
                            <div align="center">Versions</div>
                        </th>
                        <th scope="col">
                            <div align="center">Size</div>
                        </th>
                        <th scope="col">
                            <div align="center">ID application</div>
                        </th>
                        <th scope="col">
                            <div align="center">Download</div>
                        </th>
                        <th scope="col">';
                        if($_SESSION["del_file_toggle"] == "on") {
                $output .= '<div align="center">Delete</div>';
                        } else if($_SESSION["del_file_toggle"] == "off"){  
                        } else if($_SESSION["del_file_toggle"] == ""){
                        } 
                $output .= '
                        </th>
                    </tr>
                </thead>';    
        while($row = sqlsrv_fetch_array($result))
        {
            $output .= ''.$message.'';

            $data = substr($row["path_file"],9);

            $output .= '
            <tr>
                <td>'.$row["id_file"].'</td>
                <td>'.$data.'</td>
                <td>'.$row["path_file"].'</td>
                <td>'.$row["version"].'</td>
                <td>'.$row["size"].'</td>
                <td>'.$row["id_app"].'</td>
                <td><a href="../files/'.$data.'" class="btn btn-success far fa-file-alt	 btn-sm"></a></td>
                <td>';
                if($_SESSION["del_file_toggle"] == "on"){
        $output .= '<input class="btn btn-danger btn-xs delete_path_file fas fa-eraser" type="button" value="&#xf12d;" id="'.$row["id_file"].'" >';
                }else if($_SESSION["del_file_toggle"] == "off"){
                }else if($_SESSION["del_file_toggle"] == ""){
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