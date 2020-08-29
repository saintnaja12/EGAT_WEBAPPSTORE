<?php  
 //FETCH
 session_start();
include '../conn.php';
     if(isset($_POST["id_user"]))  
     {  
          $query = "SELECT * FROM user_s WHERE id_user = '".$_POST["id_user"]."'";  
          $result = sqlsrv_query($conn, $query);  
          $row = sqlsrv_fetch_array($result);  
          echo json_encode($row);  
     }  


 ?>