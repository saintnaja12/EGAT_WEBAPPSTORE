<?php 

session_start();
include '../conn.php';

    if (!$_SESSION["UserID"]){

        Header("Location: ../login/login.php");
  
    }
    else if($_SESSION["row"] != "Admin")
    {
        $message = 'You dont have access !!!';
        echo "<SCRIPT type='text/javascript'> //not showing me this
            alert('$message');
            window.location.replace(\" admin_page.php\");
        </SCRIPT>";
    }
    else
    {
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


<!-- body-------------------------------------------------------------------------------------------------------------------------->


<body>

    <div class="text-body mt-4">
        <h3 style="text-align: center; color: #EACA6A;">EGAT Mobile Applications</h3>
        <p style="color: aliceblue; text-align: center;">Set permissions</p>
    </div>


    <div class="container" style="text-align: center;">

    <!-- Click Modal Insert ----------------------------------------------------------------------------------------------------->
    <button type="button" id="modal_button" class="btn btn-primary mb-4" data-toggle="modal"
        data-target="#add_data_Modal">
        Insert new user
    </button><br/>

    <!-- Click Modal Permissions -->
    <button type="button" id="modal_button" class="btn btn-success mb-4" data-toggle="modal"
        data-target="#perModal">
        Permissions Developer
    </button><br/>

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
                            <div align="center">Username</div>
                        </th>
                        <th scope="col">
                            <div align="center">Group</div>
                        </th>
                        <th scope="col">
                            <div align="center">View</div>
                        </th>
                        <th scope="col">
                            <div align="center">Edit</div>
                        </th>
                        <!-- <th scope="col">
                            <div align="center">Permissions</div>
                        </th> -->
                        <th scope="col">
                            <div align="center">Delete</div>
                        </th>
                        
                    </tr>
                </thead>


                <?php //----------------------------------------Show data on table--------------------------------------------------------------------------------

                $query = "SELECT * FROM user_s ORDER BY row ASC ";

                $result = sqlsrv_query($conn, $query);

                while ($row  = sqlsrv_fetch_array($result)) 
                {

                ?>

                <tr>
                    <td><?php echo $row['id_user'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['row'];?></td>
                    <td>
                        <input class="btn btn-info btn-xs view_data far fa-eye " name="view" type="button" data-toggle="modal" data-target="#dataModal" value="&#xf06e;" id="<?php echo $row['id_user'];?>" >
                    </td>
                    <td>
                        <input class="btn btn-warning btn-xs edit_data fas fa-cut " type="button" data-toggle="modal" data-target="#add_data_Modal" value="&#xf0c4;" id="btn_edit" data-id='<?php echo $row['id_user'];?>'>
                    </td>
                    <td>
                        <input class="btn btn-danger btn-xs delete_data fas fa-eraser" type="button" value="&#xf12d;" id="<?php echo $row['id_user'];?>" >      
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

<?php require 'modal_per.php'; ?>  

<!-- script ajax view data detail -->
<script type="text/javascript" language="javascript">

$(document).ready(function datatable_per() {
    $('.table').dataTable();
} );

$(document).ready(function()
{
    load_data();

    //SEARCH FUNCTION
    function load_data(query)
    {
        $.ajax({
            url: "search_per.php",
            method: "POST",
            data:{query:query},
            success:function(data)
            {
                $('#app_table').html(data);
            }
        });
    }

    // //SEARCH KEY 
    // $('#search_text').keyup(function(){
    //     var search = $(this).val();
    //     if(search != '')
    //     {
    //         load_data(search);
    //     }
    //     else
    //     {
    //         load_data();
    //     }
    // });


    // Bootstrap switch toggle 

    //adding
    $('#adding_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'primary',
        offstyle: 'secondary'
    });

    $('#adding_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_adding_toggle').val('on');
        }
        else
        {
            $('#hidden_adding_toggle').val('off');
        }
    });

    //edit
    $('#edit_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'warning',
        offstyle: 'secondary'
    });

    $('#edit_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_edit_toggle').val('on');
        }
        else
        {
            $('#hidden_edit_toggle').val('off');
        }
    });

    //delete
    $('#del_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'danger',
        offstyle: 'secondary'
    });

    $('#del_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_del_toggle').val('on');
        }
        else
        {
            $('#hidden_del_toggle').val('off');
        }
    });

    //adding image
    $('#adding_image_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'primary',
        offstyle: 'secondary'
    });

    $('#adding_image_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_adding_image_toggle').val('on');
        }
        else
        {
            $('#hidden_adding_image_toggle').val('off');
        }
    });

    //delete image
    $('#del_image_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'danger',
        offstyle: 'secondary'
    });

    $('#del_image_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_del_image_toggle').val('on');
        }
        else
        {
            $('#hidden_del_image_toggle').val('off');
        }
    });

    //adding file
    $('#adding_file_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'primary',
        offstyle: 'secondary'
    });

    $('#adding_file_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_adding_file_toggle').val('on');
        }
        else
        {
            $('#hidden_adding_file_toggle').val('off');
        }
    });

    //delete file
    $('#del_file_toggle').bootstrapToggle({
        on: 'on',
        off: 'off',
        onstyle: 'danger',
        offstyle: 'secondary'
    });

    $('#del_file_toggle').change(function(){
        if($(this).prop('checked'))
        {
            $('#hidden_del_file_toggle').val('on');
        }
        else
        {
            $('#hidden_del_file_toggle').val('off');
        }
    });


    //insert permissions
    $('#per_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"insert_permissions.php",
            method:"POST",
            data:form_data,
            success:function(data){
                
                $('#per_form')[0].reset();
                $('#perModal').modal('hide'); 
                setTimeout(function () { 
                    swal({
                    title:"Set permissions complete", 
                    icon:"success"});
                }, 100);
                
            }
        });
    });








    //RESET TEXTBOX INSERT
    $(document).on('click','#btn_close',function()
    {
        $('form').trigger('reset');
    })

    
    //CHECK
    $('#username').blur(function(){

    var username = $(this).val();

        $.ajax({
            url:'check_per.php',
            method:"POST",
            data:{username:username},
            success:function(data)
            {
                if(data != '0')
                {
                    $('#availability').html('<span class="text-danger">Username Not available</span>');
                    $('#insert').attr("disabled", false);
                }
                else
                {
                    $('#availability').html('<span class="text-success">Username Available</span>');
                    $('#insert').attr("disabled", false);
                }
            }
        })
    });

    $('#e_mail').blur(function(){

    var e_mail = $(this).val();

        $.ajax({
            url:'check_email.php',
            method:"POST",
            data:{e_mail:e_mail},
            success:function(data)
            {
                if(data == 0)
                {
                    $('#availability_2').html('<span class="text-danger">E-mail Not available</span>');
                    $('#insert').attr("disabled", true);
                }
                else
                {
                    $('#availability_2').html('<span class="text-success">E-mail Available</span>');
                    $('#insert').attr("disabled", false);
                }
            }
        })
    });

    //INSERT
    $('#insert').on("click",function()
    {
        // alert(id_user);
        // UPDATE

        var username = $('#username').val();
        var password = $('#password').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var e_mail = $('#e_mail').val();

        if(username != '' && password != '' && fname != '' && lname != '')
        { 
            if($('#insert').val() == "Update" )
            {
                $.ajax({  
                    url:"update_per.php",  
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
            else if(username != '')
            {
                $.ajax({  
                    url:"insert_per.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),
                    beforeSend:function(){  
                        $('#insert').val("Insert");  
                    },  
                    success:function(data){  
                        // alert(data); 
                        $('#insert_form')[0].reset(); 
                        $('#add_data_Modal').modal('hide');  
                        $('#app_table').html(data); 
                    }  
                });
            }
            else if(e_mail != '')
            {
                $.ajax({  
                    url:"insert_per.php",  
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

            // setInterval('location.reload()', 2000);
            load_data();  

            setTimeout(function () { 
                swal({
                    title:"Insert failed !", 
                    text: "Because Username or E-mail is duplicated data",
                    icon:"error"});
            }, 100);           
        }
        else
        {
            setTimeout(function () { 
                    swal({
                        title:"All Fields is required.", 
                        icon:"warning"});
                }, 100);
        }
    });

    // UPDATE
    $(document).on('click', '.edit_data', function()
    {
        var id_user = $(this).data('id');
        $.ajax({  
            url:"fetch_per.php",  
            method:"POST",  
            data:{id_user:id_user},  
            dataType:"json",  
            success:function(data){  
                    $('#username').val(data.username);  
                    $('#password').val(data.password);  
                    $('#fname').val(data.fname);  
                    $('#lname').val(data.lname);  
                    $('#row').val(data.row);  
                    $('#e_mail').val(data.e_mail); 

                    $('#adding_toggle').val(data.adding_toggle);
                    $('#edit_toggle').val(data.edit_toggle);
                    $('#del_toggle').val(data.del_toggle);

                    $('#adding_image_toggle').val(data.adding_image_toggle);
                    $('#del_image_toggle').val(data.del_image_toggle);

                    $('#adding_file_toggle').val(data.adding_file_toggle);
                    $('#del_file_toggle').val(data.del_file_toggle);

                    $('#id_user').val(data.id_user);
                    console.log(data.id);  
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
            }  
        });  
    });


    //SELECT
    $(document).on('click', '.view_data', function(){
        //$('#dataModal').modal();
            var id_user = $(this).attr("id");
            $.ajax({
            url:"select_per.php",
            method:"POST",
            data:{id_user:id_user},
            success:function(data){
                $('#app_detail').html(data);
                $('#dataModal').modal('show');
            }
        });
    });

    //DELETE
    $(document).on('click', '.delete_data', function(){
        var id_user = $(this).attr("id");
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
                    url:"delete_per.php",
                    method:"POST",
                    data:{id_user:id_user},
                    success:function(data){
                        load_data();
                    }
                });
                //setInterval('location.reload()', 2000);  
                
                setTimeout(function () { 
                    swal({
                        title:"Delete complete.", 
                        icon:"success"});
                }, 100);
            }
        })
    });    
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