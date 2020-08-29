<?php 

include '../conn.php';
    
    // $e_mail = $_POST["e_mail"];
    // $query = "SELECT * FROM e_mail WHERE e_mail = '".$email."'";  
    
    // $params = array();
    // $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
    // $result = sqlsrv_query($conn, $query, $params, $options); 
    // echo sqlsrv_num_rows($result);  


    $email = explode("@",$_POST["e_mail"]);   
    $email = end($email);    

    if($email != "egat.co.th")
    {
        echo 0;
    }
    else 
    {
        $e_mail = $_POST["e_mail"];
        $query = "SELECT * FROM e_mail WHERE e_mail = '".$e_mail."'";  
        $params = array();
        $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
        $result = sqlsrv_query($conn, $query, $params, $options); 
        echo sqlsrv_num_rows($result);
        // echo true;
    }
    ?> 