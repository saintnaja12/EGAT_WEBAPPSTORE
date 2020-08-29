<?php  
 //FETCH
 session_start();
include '../conn.php';
 if(isset($_POST["id_app"]))  
 {  
      $query = "SELECT * FROM app_s WHERE id_app = '".$_POST["id_app"]."'";  
      $result = sqlsrv_query($conn, $query);  
      $row = sqlsrv_fetch_array($result);  
      echo json_encode($row);  
 }
 ?>