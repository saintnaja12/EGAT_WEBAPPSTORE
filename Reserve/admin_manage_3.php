<?php 

session_start();
include '../conn.php';

    if (!$_SESSION["UserID"]){

        Header("Location: ../login/login.php");
  
    }
    else if($_SESSION["status"] == "User")
    {
        Header("Location: ../login/logout.php");
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
    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap Toggle -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>

    <!-- Icon -->
    <link href="../fontawesome-free-5.10.2-web/css/all.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript" scr="function.js"></script>

    <link rel="stylesheet" href="../css/style.css">

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
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Management
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin_manage.php">Application Table</a>
                            <a class="dropdown-item" href="admin_manage_2.php">Image Detail Table</a>
                            <a class="dropdown-item" href="admin_manage_3.php">Files Table</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="admin_permissions.php">Set permissions</a>
                        </div>
                    </li>

                </ul>

                <form action="" method="post">
                    <div class="btn-group mt-2">
                        <input class="form-control" id="search_text" name="search" type="text" placeholder="Search"
                            aria-label="Search">
                    </div>
                </form>
                <a class="nav-link" href="../login/logout.php"  id="logout">Sign out</a>
            </div>
        </div>
    </nav>

    

</head>


<!-- body----------------------------------------------------------------- --------------------------------------------------------->


<body>

    <div class="text-body mt-4">
        <h3 style="text-align: center; color: #EACA6A;">EGAT Mobile Applications</h3>
        <p style="color: aliceblue; text-align: center;">Manage Files Table</p>
    </div>

    <div class="container" style="text-align: center;">

        <!-- Click Modal Insert file----------------------------------------------------------------------------------------------------->
        <button type="button" id="modal_button" class="btn btn-primary mb-4" data-toggle="modal"
            data-target="#add_data_Modal">
            Upload Files
        </button>

    </div>

    <div class="container" style="text-align: center;">

        <!-- Table ----------------------------------------------------------------------------------------------------------------->
        <div class="table-responsive" id="app_table">
            <table class="table align-items-center table-sm" style="background-color: white;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">
                            <div align="center">ID</div>
                        </th>
                        <th scope="col">
                            <div align="center">Files Name</div>
                        </th>
                        <th scope="col">
                            <div align="center">ID Applications</div>
                        </th>
                        <th scope="col">
                            <div align="center">View</div>
                        </th>
                        <th scope="col">
                            <div align="center">Edit</div>
                        </th>
                        <th scope="col">
                            <div align="center">Delete</div>
                        </th>
                    </tr>
                </thead>


                <?php //----------------------------------------Show data on table--------------------------------------------------------------------------------

                $query = "SELECT * FROM files ORDER BY id_file ASC ";

                $result = sqlsrv_query($conn, $query);

                while ($row  = sqlsrv_fetch_array($result)) 
                {

                ?>

                <tr>
                    <td><?php echo $row['id_file'];?></td>
                    <td><?php echo $row['name_file'];?></td>
                    <td><?php echo $row['id_app'];?></td>
                    <td>
                        <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="<?php echo $row['id_file'];?>" >
                    </td>
                    <td>
                        <input class="btn btn-warning btn-xs edit_data fas fa-cut " type="button" data-toggle="modal" data-target="#add_data_Modal" value="&#xf0c4;" id="btn_edit" data-id='<?php echo $row['id_file'];?>'>
                    </td>
                    <td>
                        <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="<?php echo $row['id_file'];?>" >
                    </td>
                </tr>

                <?php

                } //------------------------------end of Show data on table --------------------------------------------------------------------------------

                ?>
            </table>
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
<?php } // End of session  ----------------------------------------------------------------------------------------------------------------------?> 

    <!-- Modal Select Detail ---------------------------------------------------------------------------------------------->

    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">

                    <h4 class="modal-title">File Details</h4>
                    <button type="button" align="right" class="close" data-dismiss="modal">&times;</button>

                </div>
                <!-- Modal body -->
                <div class="modal-body" id="app_detail">
                            
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add APK -------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="modal fade modal" id="add_data_Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="appModalLabel">New Data</h5>
                    <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="upload_form" name="upload_form">

                    <!-- Modal body -->
                    <div class="modal-body" style="text-align: left;">
                        <input type="hidden" name="id_file" id="id_file" class="form-control">

                        <label class="ml-1">File name</label>
                        <input type="text" name="name_file" id="name_file" required class="form-control" placeholder="">

                        <label class="ml-1">ID Applications</label>
                        <input type="text" name="id_app" id="id_app" required class="form-control" placeholder=""><br/>

                        <label class="ml-1" style="color:red;">*Once you have uploaded.<br/>
                        **Will not be able to edit images.<br/>
                        ***Only APK and IPA files.</label><br/>

                        <!-- upload file -->
                        <input type="hidden" id="path_file" name="path_file" required class="form-control" placeholder="">
                        <label class="ml-1">File Application</label> <br/>
                        <input type="file" name="file_up" id="file_up" /> <br/>
                        <div id="targetLayer" style="display:none;"></div>


                    </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <input type="button" name="insert" id="insert" class="btn btn-primary" value="Insert">

                </div>
                </form>
            </div>
        </div>
    </div>

    
<!-- script ajax view data detail -->
<script type="text/javascript" language="javascript">

$(document).ready(function()
{

    load_data();

    //SEARCH FUNCTION
    function load_data(query)
    {
        $.ajax({
            url: "search_3.php",
            method: "POST",
            data:{query:query},
            success:function(data)
            {
                $('#app_table').html(data);
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

    $('#modal_button').click(function(){  
           $('#insert').val("Insert");  
           $('#upload_form')[0].reset();  
    }); 

    //UPLOAD FILE 
    $(document).on('change', '#file_up', function(){
        var name = document.getElementById("file_up").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        $('#targetLayer').hide();
        if(jQuery.inArray(ext, ['apk', 'ipa']) == -1) 
        {
            alert("Invalid APK or IPA File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file_up").files[0]);
        var f = document.getElementById("file_up").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 200000000)
        {
            alert("APK or IPA File Size is very big");
        }
        else
        {
            form_data.append("file_up", document.getElementById('file_up').files[0]);
            $.ajax({
                url:"upload_file.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    $('#path_file').val(data)
                }
            });
        }
    });

    // UPDATE
    $(document).on('click', '.edit_data', function()
    {
        var id_file = $(this).data('id');
        $.ajax({  
            url:"fetch_3.php",  
            method:"POST",  
            data:{id_file:id_file},  
            dataType:"json",  
            success:function(data){  
                    $('#name_file').val(data.name_file);  
                    $('#id_app').val(data.id_app);  
                    $('#path_file').val(data.path_file); 
                    $('#id_file').val(data.id_file); 
                    console.log(data.id);  
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
            }  
        });  
    });

    // INSERT
    $('#insert').on("click",function()
    {
        //alert(id);
        if($('#insert').val() == "Update" )
        {
            $.ajax({  
                url:"update_3.php",  
                method:"POST",  
                data:$('#upload_form').serialize(),
                success:function(data){  
                    //alert(data); 
                $('#upload_form')[0].reset(); 
                $('#add_data_Modal').modal('hide');  
                $('#app_table').html(data);  
                }  
            });
        }
        else
        {
            $.ajax({  
                url:"insert_3.php",  
                method:"POST",  
                data:$('#upload_form').serialize(),
                success:function(data){  
                    //alert(data); 
                $('#upload_form')[0].reset(); 
                $('#add_data_Modal').modal('hide');  
                $('#app_table').html(data);  
                }  
            });
        }
    });

    //RESET TEXTBOX INSERT
    $(document).on('click','#btn_close',function()
    {
        $('form').trigger('reset');
    })

    // //SELECT
    $(document).on('click', '.view_data', function(){
        //$('#dataModal').modal();
            var id_file = $(this).attr("id");
            $.ajax({
            url:"select_3.php",
            method:"POST",
            data:{id_file:id_file},
            success:function(data){
                $('#app_detail').html(data);
                $('#dataModal').modal('show');
            }
        });
    });

    //DELETE
    $(document).on('click', '.delete_data', function(){
        var id_file = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "You want to remove this?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete){
                $.ajax({
                    url:"delete_3.php",
                    method:"POST",
                    data:{id_file:id_file},
                    success:function(data){
                        fetch_data();
                    }
                });
                setInterval('location.reload()', 2000);  
                
                setTimeout(function () { 
                    swal({
                        title:"Delete complete.", 
                        icon:"success"});
                }, 100);
            }
        })
    });    
});

//LOGOUT
$(function(){
    $('a#logout').click(function(){
        if(confirm('Are you sure to sign out ?')) {
            return true;
        }

        return false;
    });
});

</script>