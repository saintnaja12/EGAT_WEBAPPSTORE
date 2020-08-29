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
                    <div class="btn-group ">
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

    <div class="container" style="text-align: center;">

        <div class="row" id="nameApp">

        

            <?php //----------------------------------------Show data on table--------------------------------------------------------------------------------

            $query = "SELECT * FROM app_s";

            $result = sqlsrv_query($conn, $query);

            while ($data = sqlsrv_fetch_array($result)) 
            {

            ?>

            <div class="col-md-4 col-lg-2 col-6">
                <div class="card mb-2 shadow-sm">
                    <img src="<?php echo $data["img_logo"] ?>" class="figure-img img-fluid rounded" width="80" style="margin: 0.5em auto; ">
                    <div class="text-name mb-1" style="margin: auto;"><?php echo $data["name_app"] ?></div>
                    <small class="text-name" style="margin: 0.5em auto;"><?php echo $data['system'];?></small>
                    <small class="text-name" style="margin: 0.5em auto; color: yellow;"><?php echo $data['set_permissions'];?></small>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group" style="margin: 0.5em auto;">
                        <form method="POST" action="admin_page_2.php">
                            <input type="hidden" class="btn btn-sm btn-outline-light" name="id_app" value='<?php echo $data['id_app'];?>'>
                            <button class="btn btn-sm btn-outline-light" type="submit">View</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            } //------------------------------end of Show data on table --------------------------------------------------------------------------------

            ?>
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

$(document).ready(function()
{
    load_data();

    //SEARCH FUNCTION
    function load_data(query)
    {
        $.ajax({
            url: "search_page.php",
            method: "POST",
            data:{query:query},
            success:function(data)
            {
                $('#nameApp').html(data);
            }
        });
    }

    //SEARCH KEY 
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();
        }
    })

});

// LOGOUT
$(function(){
    $('a#logout').click(function(){
        if(confirm('Are you sure to sign out ?')) {
            return true;
        }

        return false;
    });
});




</script>