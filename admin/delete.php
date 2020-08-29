<?php
//DELETE
session_start();
include '../conn.php';
if(isset($_POST["id_app"]))
{ 

    $query_1 = "DELETE FROM images WHERE id_app = '".$_POST["id_app"]."'";
    if(sqlsrv_query($conn, $query_1))
    {
        echo '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Delete complete.", 
                icon:"success"});
        }, 100);
        </script>';
        
    }
    
    $query_2 = "DELETE FROM files WHERE id_app = '".$_POST["id_app"]."'";
    if(sqlsrv_query($conn, $query_2))
    {
        echo '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Delete complete.", 
                icon:"success"});
        }, 100);
        </script>';
        
    }
  
    $query_3 = "DELETE FROM app_s WHERE id_app = '".$_POST["id_app"]."'";
    if(sqlsrv_query($conn, $query_3))
    {
        echo '<script type="text/javascript">
        setTimeout(function () { 
            swal({
                title:"Delete complete.", 
                icon:"success"});
        }, 100);
        </script>';
        
    }
    
}
?>