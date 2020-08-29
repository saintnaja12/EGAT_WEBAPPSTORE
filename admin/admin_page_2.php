<?php 

session_start();
include '../conn.php';

    if (!$_SESSION["UserID"]){

        Header("Location: ../login/login.php");
  
    }
    
    else{
?>

<!doctype html>
<html lang="en">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="../css/style.css">

    <script type="text/javascript" scr="function.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="../pic/180px-การไฟฟ้าฝ่ายผลิตแห่งประเทศไทย.png">

    <title>EGAT Enterprise App Store</title>

    <nav class="navbar navbar-expand-lg navbar-light" style="text-align: center;">
        <div class="container">
            <a href="admin_page.php">
                <img class="img" src="../pic/logo (1).png" class="img-fluid" alt="Responsive image">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my" aria-controls="my"
                aria-expanded="true" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="my">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_page.php">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_iOS.php">iOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_AndroidOS.php">Android</a>
                    </li>

                    <?php 
                    if($_SESSION["row"] == "Employee")
                    {

                    } 
                    else if($_SESSION["row"] != "Admin")
                    {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_manage.php">Management Application</a>
                        </li>
                    <?php 
                    }
                    else 
                    {
                    ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Management
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin_manage.php">Application</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="admin_permissions.php">Permissions Group</a>
                        </div>
                    </li>

                    <?php 
                    } 
                    ?>


                </ul>

                <form action="" method="post">
                    <div class="btn-group">
                        <input class="form-control" id="search_text" name="search" type="text" placeholder="Search"
                            aria-label="Search">
                    </div>
                </form>

                <span class="style3 ml-3"> Hi <?=$_SESSION['User']?> </span>

                <a class="nav-link" href="../login/logout.php" id="logout">Sign out</a>
            </div>
        </div>
    </nav>

</head>

<body>

    <div class="text-body mt-4">
        <h3 style="text-align: center; color: #EACA6A;">EGAT Mobile Applications</h3>
        <p style="color: aliceblue; text-align: center;">All Applications </p>
    </div>

    <div class="container" style="margin-top: 30px; text-align: center">

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8 col-10">

                <div class="card mb-2 shadow-sm">
                    <div class="col d-flex flex-column position-static">

                        <?php //----------------------------------------Show data on table--------------------------------------------------------------------------------

                        $id_app = $_POST["id_app"];

                        $query = "SELECT * FROM app_s WHERE id_app = '".$id_app."'";

                        $result = sqlsrv_query($conn, $query);

                        while ($data = sqlsrv_fetch_array($result)) 
                        {

                        ?>

                        <img src="<?php echo $data["img_logo"] ?>" class="figure-img img-fluid rounded" width="120"
                            style="margin-left:auto; margin-right:auto;">
                        <div class="col-auto d-none d-lg-block">

                        </div>

                        <h5 class="m-2" style="color:white; text-align:center;"><?php echo $data["name_app"] ?></h5>

                        <p class="card-text mb-auto" style="color:whitesmoke;  text-align:center;">
                            <?php echo $data["detail"] ?></p>
                        <p class="text m-2 font-weight-bolder" style="color:yellow ; text-align:center;">
                            <?php echo $data["set_permissions"] ?></p>
                        <p style="color:whitesmoke;  text-align:center;">System : <?php echo $data["system"] ?></p>
                        <p style="color:whitesmoke;  text-align:center;">Language : <?php echo $data["language"] ?></p>
                        <p style="color:whitesmoke;  text-align:center;">Version : <?php echo $data["version"] ?></p>
                        <p style="color:whitesmoke;  text-align:center;">Department :
                            <?php echo $data["department"] ?><br />

                            <?php

                        } //------------------------------end of Show data on table --------------------------------------------------------------------------------

                        ?>

                            <?php
                        $query_img = "SELECT * FROM images WHERE id_app = '".$id_app."'";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $query_img , $params, $options );

                        $row_count = sqlsrv_num_rows( $stmt );
                        // $result_img = sqlsrv_query($conn, $query_img);
                        // echo $row_count;
                        ?>

                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    <?php
                                for($i=1;$i<=$row_count;$i++)
                                {
                                    $row_img=sqlsrv_fetch_array($stmt);
                                    
                                ?>

                                    <?php 
                                if($i==1)
                                {
                                ?>

                                    <div class="carousel-item active">
                                        <img src="<?php echo $row_img["image"] ?>" class="d-block w-100" alt="...">
                                    </div>

                                    <?php	
                                }
                                else
                                {
                                ?>

                                    <div class="carousel-item">
                                        <img src="<?php echo $row_img["image"] ?>" class="d-block w-100" alt="...">
                                    </div>

                                    <?php
                                }
                                }
                                ?>

                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>

                                </div>

                            </div>
                            <br/>
                <?php

                $id_app = $_POST["id_app"];

                $query = "SELECT TOP 2 * FROM files WHERE id_app = '".$id_app."' ORDER BY version DESC";

                $result = sqlsrv_query($conn, $query);

                // if($data['Type'] == "ios")
                // {
                //     echo '<img src="/ios/'. $query['ชื่อไฟล์'].'">'
                // }

                while ($data = sqlsrv_fetch_array($result)) 
                {

                    $data["path_file"];

                    $data = substr($data["path_file"],9);

                    // echo $data;

                    $file_parts = pathinfo($data);

                    

                    switch($file_parts['extension'])
                    {
                        case "apk":
                        echo '<a href="../files/'.$data.'" class="btn btn-success btn-sm"> DOWNLOAD FOR ANDROID </a><br/>';
                        break;

                        case "ipa":
                        echo '<a href="../files/'.$data.'" class="btn btn-light btn-sm"> DOWNLOAD FOR IOS </a><br/>';

                        break;

                        case "": // Handle file extension for files ending in '.'
                        case NULL: // Handle no file extension
                        break;
                    }

                    // if($data_1 == null)
                    // {
                        
                    // }
                    // else 
                    // {
                    //     echo '<a href="../file_apk/'.$data_1.'" class="btn btn-success btn-sm"> DOWNLOAD FOR ANDROID</a><br/>';
                    // }                

                }
                ?>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <footer class="container-fluid" style="background-color:#EACA6A;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4 mt-3 mb-3">
                <h6 style="text-align: left; color: black;">
                    ติดต่อผู้ดูแลระบบ : กองพัฒนาระบบสายงานกลาง <br>
                    ฝ่ายจัดการและพัฒนาระบบสารสนเทศ (อจส.) <br>
                    โทร. 64425 และ 64456 Email : egatentapp@egat.co.th
                </h6>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
        </div>
    </footer>

</body>

</html>
<?php }?>

<script>
    $(document).ready(function () {


    });

    // LOGOUT
    $(function () {
        $('a#logout').click(function () {
            if (confirm('Are you sure to sign out ?')) {
                return true;
            }

            return false;
        });
    });
</script>