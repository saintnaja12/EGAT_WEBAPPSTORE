<?php
//DELETE
session_start();
include '../conn.php';
if(isset($_POST["id_user"]))
{ 
  
    $query = "DELETE FROM user_s WHERE id_user = '".$_POST["id_user"]."'";
    if(sqlsrv_query($conn, $query))
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