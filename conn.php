<?php

    // ini_set('display_errors', 1);
    // error_reporting(~0);

    // $serverName = "10.20.226.219";
    // $userName = "mobileapp_admin";
    // $userPassword = "mobileapp@admin";
    // $dbName = "mobileapp";

    $serverName = "localhost";
    $userName = "sa";
    $userPassword = "1234";
    $dbName = "mobileapp";

    // ----------------------------- Connection SQL SERVER PDO ---------------------------------- 
    // $conn = new PDO("sqlsrv:server=$serverName; Database = $dbName", $userName, $userPassword);
    // $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //------------------------------Connection SQL SERVER --------------------------------------
    $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true, "CharacterSet"=>'UTF-8');

    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) 
    {
        //echo "Connection established.<br />";
    }
    else
    {
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
    }

    date_default_timezone_set('Asia/Bangkok');
    
?>