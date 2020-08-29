<?php  
//check.php  
include '../conn.php';
    
    $name_app = $_POST["name_app"];
    $query = "SELECT * FROM app_s WHERE name_app = '".$name_app."'";  
    
    $params = array();
    $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
    $result = sqlsrv_query($conn, $query, $params, $options); 
    echo sqlsrv_num_rows($result);  

?>