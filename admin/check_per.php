<?php  
//check.php  
include '../conn.php';
    
    $username = $_POST["username"];
    $query = "SELECT * FROM user_s WHERE username = '".$username."'";  
    
    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
    $result = sqlsrv_query($conn, $query, $params, $options); 
    echo sqlsrv_num_rows($result);  


    
      
?>