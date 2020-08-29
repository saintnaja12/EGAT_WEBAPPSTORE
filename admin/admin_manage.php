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
    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

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

                <!-- <form action="" method="post">
                    <div class="btn-group">
                        <input class="form-control" id="search_text" name="search" type="text" placeholder="Search"
                            aria-label="Search">
                    </div>
                </form> -->

                <span class="style3 ml-3"> Hi <?=$_SESSION['User']?> </span>

                <a class="nav-link" href="../login/logout.php"  id="logout">Sign out</a>
            </div>
        </div>
    </nav>

    

</head>


<!-- body----------------------------------------------------------------- --------------------------------------------------------->


<body>

    <div class="text-body mt-4">
        <h3 style="text-align: center; color: #EACA6A;">EGAT Mobile Applications</h3>
        <p style="color: aliceblue; text-align: center;">Manage Applications Table</p>
    </div>

    <div class="container" style="text-align: center;">

        <!-- Click Modal Insert ----------------------------------------------------------------------------------------------------->
        <?php if($_SESSION["adding_toggle"] == "on") {?>
            <button type="button" id="modal_button" class="btn btn-primary mb-4" data-toggle="modal"
                data-target="#add_data_Modal">
                Insert new data
            </button>
        <?php } else if($_SESSION["adding_toggle"] == "off"){?> 
            
        <?php } else if($_SESSION["adding_toggle"] == ""){?>
            
        <?php } ?>

    </div>

    <div class="container" style="text-align: center;">
    <div style="background-color: white; border-radius: 5px;">
        <!-- Table ----------------------------------------------------------------------------------------------------------------->
        <div class="table-responsive" id="app_table">
            <table class="table align-items-center table-sm" style="background-color: white;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">
                            <div align="center">ID</div>
                        </th>
                        <th scope="col">
                            <div align="center">Application Name</div>
                        </th>
                        <th scope="col">
                            <div align="center">View</div>
                        </th>
                        <th scope="col">
                            <?php if($_SESSION["edit_toggle"] == "on") {?>
                                <div align="center">Edit</div>
                            <?php } else if($_SESSION["edit_toggle"] == "off"){?>  
                            <?php } else if($_SESSION["edit_toggle"] == ""){?>
                            <?php } ?>
                        </th>
                        <th scope="col">
                            <div align="center">Screenshot</div>
                        </th>
                        <th scope="col">
                            <div align="center">Files</div>
                        </th>
                        <th scope="col">
                            <?php if($_SESSION["del_toggle"] == "on") {?>
                                <div align="center">Delete</div>
                            <?php } else if($_SESSION["del_toggle"] == "off"){?>  
                            <?php } else if($_SESSION["del_toggle"] == ""){?>
                            <?php } ?>
                        </th>
                    </tr>
                </thead>


                <?php //----------------------------------------Show data on table--------------------------------------------------------------------------------

                $query = "SELECT * FROM app_s ORDER BY id_app ASC ";

                $result = sqlsrv_query($conn, $query);

                while ($row  = sqlsrv_fetch_array($result)) 
                {

                ?>

                <tr>
                    <td><?php echo $row['id_app'];?></td>
                    <td><?php echo $row['name_app'];?></td>
                    <td>
                        <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="<?php echo $row['id_app'];?>" >
                    </td>
                    <td>
                        <?php if($_SESSION["edit_toggle"] == "on") {?>
                            <input class="btn btn-warning btn-xs edit_data fas fa-cut " type="button" data-toggle="modal" data-target="#add_data_Modal" value="&#xf0c4;" id="btn_edit" data-id='<?php echo $row['id_app'];?>'>
                        <?php } else if($_SESSION["edit_toggle"] == "off"){?>  
                        <?php } else if($_SESSION["edit_toggle"] == ""){?>
                        <?php } ?>
                    </td>
                    <td> 
                        <input class="btn btn-dark image_data btn-xs fas fa-images " type="button" data-toggle="modal" data-target="#image_detail_Modal" value="&#xf302;"  id='<?php echo $row['id_app'];?>'>                              
                    </td>
                    <td>
                        <input class="btn btn-success file_data btn-xs fas fa-cut " type="button" data-toggle="modal" data-target="#file_data_Modal" value="&#xf15c;"  id='<?php echo $row['id_app'];?>'>                    
                    </td>
                    <td>
                        <?php if($_SESSION["del_toggle"] == "on") {?>
                            <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="<?php echo $row['id_app'];?>" >
                        <?php } else if($_SESSION["del_toggle"] == "off"){?> 
                        <?php } else if($_SESSION["del_toggle"] == ""){?> 
                        <?php } ?>
                    </td>
                </tr>

                <?php

                } //------------------------------end of Show data on table --------------------------------------------------------------------------------

                ?>
            </table>
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
<?php } // End of session  ----------------------------------------------------------------------------------------------------------------------?> 

<?php require 'modal.php'; ?>  

<!-- script ajax view data detail -->
<script>

$(document).ready(function() {
    $('.table').dataTable();
} );

$(document).ready(function()
{
    load_data();

    //SEARCH FUNCTION
    function load_data(query,page)
    {
        $.ajax({
            url: "search.php",
            method: "POST",
            data:{query:query,
                page:page},
            success:function(data)
            {
                $('#app_table').html(data);
            }
        });
    }

    // //PAGINATION
    // $(document).on('click', '.pagination_link', function(){  
    //        var page = $(this).attr("id");  
    //        load_data(page);  
    //   }); 

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
    

      // --------------- SCRIPT APPLICATION TABLE-----------------------------------------------------------

    //UPLOAD IMAGE
    $(document).on('change', '#file', function(){
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
            // alert("Invalid Image File");
            setTimeout(function () { 
                    swal({
                        title:"Invalid Image File", 
                        icon:"error"});
                }, 100);
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);
        var f = document.getElementById("file").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
            // alert("Image File Size is very big");
            setTimeout(function () { 
                    swal({
                        title:"Image File Size is very big", 
                        icon:"error"});
                }, 100);
            
        }
        else
        {
            form_data.append("file", document.getElementById('file').files[0]);
            $.ajax({
                url:"upload.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(data)
                {
                    $('#imgPath').val(data)
                    $('#uploaded_image').attr('src', data)
                    $('#uploaded_image').attr('hidden', false)
                }
            });
        }
    });


    //Only number and dot regex
    const regex = /[^\d.]|\.(?=.*\.)/g;
    const subst=``;

    $('#version').keyup(function(){
        const str=this.value;
        const result = str.replace(regex, subst);
        this.value=result;

    });

    //CHECK
    $('#name_app').blur(function(){

    var name_app = $(this).val();

        $.ajax({
            url:'check.php',
            method:"POST",
            data:{name_app:name_app},
            success:function(data)
            {
                if(data != '0')
                {
                    $('#availability').html('<span class="text-danger">Application name Not available</span>');
                    $('#insert').attr("disabled", false);
                }
                else if(data == '0')
                {
                    $('#availability').html('<span class="text-success">Application name Available</span>');
                    $('#insert').attr("disabled", false);
                }
            }
        })
    });

    //INSERT
    $('#insert').on("click",function()
    {
        // alert(id_app);
        // UPDATE
        var name_app = $('#name_app').val();
        var detail = $('#detail').val();
        var size = $('#size').val();
        var version = $('#version').val();
        var department = $('#department').val();
        var imgPath = $('#imgPath').val();

        if(name_app != '' && detail != '' && system != '' && size != '' && language != '' && version != '' && set_permissions != '' && department != '')
        {        
            if($('#insert').val() == "Update" )
            {
                $.ajax({  
                    url:"update.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),
                    success:function(data){  
                        //alert(data); 
                        $('#insert_form')[0].reset(); 
                        $('#add_data_Modal').modal('hide');  
                        $('#app_table').html(data);  
                        $('#insert').val("Insert"); 
                    }  
                });
            }
            else if(imgPath != '')
            {
                $.ajax({  
                    url:"insert.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),
                    beforeSend:function(){  
                        $('#insert').val("Inserting");  
                    },  
                    success:function(data){  
                        // alert(data); 
                        $('#insert_form')[0].reset(); 
                        $('#add_data_Modal').modal('hide');  
                        $('#app_table').html(data);  
                    }  
                });
            }
            else
            {
                setTimeout(function () { 
                    swal({
                        title:"You haven't uploaded images", 
                        icon:"warning"});
                }, 100);
            }
            // setInterval('location.reload()', 2000); 
            load_data(); 

            setTimeout(function () { 
                swal({
                    title:"Insert failed !", 
                    text: "Because application name is duplicated data",
                    icon:"error"});
            }, 100);   
        }
        else
        {
            setTimeout(function () { 
                    swal({
                        title:"All Fields is required", 
                        icon:"warning"});
                }, 100);
        }
        
    });

    //RESET TEXTBOX INSERT
    $(document).on('click','#btn_close',function()
    {
        $('form').trigger('reset');
    }, function(){
        window.location.replace("admin_manage.php");
    })

    //RESET TEXTBOX INSERT
    $(document).on('click','#btn_close_2',function()
    {
        $('form').trigger('reset');
    })

    //SELECT
    $(document).on('click', '.view_data', function(){
        //$('#dataModal').modal();
            var id_app = $(this).attr("id");
            $.ajax({
            url:"select.php",
            method:"POST",
            data:{id_app:id_app},
            success:function(data){
                $('#app_detail').html(data);
                $('#dataModal').modal('show');
            }
        });
    });

    // UPDATE
    $(document).on('click', '.edit_data', function()
    {
        var id_app = $(this).data('id');
        $.ajax({  
            url:"fetch.php",  
            method:"POST",  
            data:{id_app:id_app},  
            dataType:"json",  
            success:function(data){  
                    $('#name_app').val(data.name_app);  
                    $('#detail').val(data.detail);  
                    $('#system').val(data.system);  
                    $('#size').val(data.size);  
                    $('#language').val(data.language);  
                    $('#version').val(data.version); 
                    $('#set_permissions').val(data.set_permissions);   
                    $('#department').val(data.department);  
                    $('#img_logo').val(data.img_logo); 
                    $('#id_img').val(data.id_img);   
                    $('#id_app').val(data.id_app);
                    // console.log(data.id);  
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
            }  
        });  
    });

    //DELETE
    $(document).on('click', '.delete_data', function(){
        var id_app = $(this).attr("id");
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
                    url:"delete.php",
                    method:"POST",
                    data:{id_app:id_app},
                    success:function(data){
                        load_data();
                    }
                });
                // setInterval('location.reload()', 2000);  
                
                setTimeout(function () { 
                    swal({
                        title:"Delete complete.", 
                        icon:"success"});
                }, 100);
            }
        })
    });    

    // --------------- SCRIPT IMAGE TABLE-----------------------------------------------------------

    //SELECT image detail
    $(document).on('click', '.image_data', function(){
        //$('#dataModal').modal();
            var id_app = $(this).attr("id");
            $.ajax({
            url:"select_image.php",
            method:"POST",
            data:{id_app:id_app},
            success:function(data){
                $('#image_detail').html(data);
                $('#image_id_app').html(data);
                $('#image_detail_Modal').modal('show');
            }
        });
    });   

    // --------------- SCRIPT FILES TABLE-----------------------------------------------------------

    // //SELECT FILE 
    $(document).on('click', '.file_data', function(){
        //$('#dataModal').modal();
            var id_app = $(this).attr("id");
            $.ajax({
            url:"select_file.php",
            method:"POST",
            data:{id_app:id_app},
            success:function(data){
                $('#file_detail').html(data);
                $('#file_id_app').html(data);
                $('#file_data_Modal').modal('show');
            }
        });
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
