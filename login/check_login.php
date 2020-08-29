<?php
  session_start();

  include("../conn.php");

  if(isset($_POST['username']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $username = stripslashes($username);
    // $password = stripslashes($password);

    $sql = "SELECT * FROM user_s WHERE username='$username' and password='$password'";
    $query = sqlsrv_query( $conn, $sql) or die( print_r( sqlsrv_errors(), true)) ;
    $result = sqlsrv_fetch_array($query);

    

    if(!$result)
    {
      echo json_encode(['row' => 0]);
    }
    else 
    {
      if($password == $result['password'])
      {
        $_SESSION["UserID"] = $result["id_user"];
        $_SESSION["User"] = $result["fname"]." ".$result["lname"];
        $_SESSION["row"] = $result["row"];

        $_SESSION["adding_toggle"] = $result["adding_toggle"];
        $_SESSION["edit_toggle"] = $result["edit_toggle"];
        $_SESSION["del_toggle"] = $result["del_toggle"];

        $_SESSION["adding_image_toggle"] = $result["adding_image_toggle"];
        $_SESSION["del_image_toggle"] = $result["del_image_toggle"];

        $_SESSION["adding_file_toggle"] = $result["adding_file_toggle"];
        $_SESSION["del_file_toggle"] = $result["del_file_toggle"];

        include '../Mobile_Detect.php';

        $detect = new Mobile_Detect;

        if ( $detect->isiOS() ) {
            // echo "You are on the iOS platform.";
            $system = "IOS";
        } else if ( $detect->isAndroidOS() ){
            // echo "You are on the AndroidOS platform.";
            $system = "Andriod";
        } else {
            // echo "You are on desktop.";
            $system = "Desktop";
        }

        $_SESSION["system"] = $system;

        // print_r($_SESSION);
        // exit();

        //เรียงความใหญ่จากบนลงล่าง
        if($_SESSION["row"] == "Admin") 
        {
          echo json_encode(['row' => 1, 'msg' => 'Admin', $system]);
        }
        else if ($_SESSION["row"] == "Developer") 
        {
          echo json_encode(['row' => 1, 'msg' => 'Developer', $system]);
        } 
        else
        {
          echo json_encode(['row' => 1, 'msg' => $_SESSION["User"], $system]);
        }
      }
      return $_SESSION["row"];
    }
  }else
?>