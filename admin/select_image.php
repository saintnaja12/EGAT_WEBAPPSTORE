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

<?php 
//SELECT
session_start();
// echo $_POST["id"];
if(isset($_POST["id_app"]))
{
    $output = '';
    include '../conn.php';
    $query = "SELECT * FROM images WHERE id_app = '".$_POST["id_app"]."'";
    $result = sqlsrv_query($conn, $query);
    $output .= '
    <div class="table-responsive" id="image_table">
        <table class="table align-items-center table-sm" style="background-color: white;">
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    <div align="center">ID</div>
                </th>
                <th scope="col">
                    <div align="center">Image</div>
                </th>
                <th scope="col">
                    <div align="center">Image name</div>
                </th>
                <th scope="col">
                    <div align="center">Path</div>
                </th>
                <th scope="col">
                    <div align="center">ID application</div>
                </th>
                <th scope="col">';
                    if($_SESSION["del_image_toggle"] == "on") {
    $output .= '        <div align="center">Delete</div>';
                    } else if($_SESSION["del_image_toggle"] == "off"){  
                    } else if($_SESSION["del_image_toggle"] == ""){
                    } 
    $output .= '    
                </th>
            </tr>
        </thead>';
    while($row = sqlsrv_fetch_array($result))
    {
        $data = substr($row["image"],16);

        $output .= '
            <tr>
                <td>'.$row["id_image"].'</td>
                <td>
                    <img src="'.$row["image"].'" class="figure-img img-fluid rounded" width="80" style="margin: 0.5em auto; ">
                </td>
                <td>'.$data.'</td>
                <td>'.$row["image"].'</td>
                <td>'.$row["id_app"].'</td>
                <td>';
                if($_SESSION["del_image_toggle"] == "on") {

                $query_2 = "SELECT * FROM images WHERE id_app = '".$_POST["id_app"]."'";
                $result_2 = sqlsrv_query($conn, $query_2);
        $output .= '<form method="POST" id="del_image" name="del_image" ><input type="hidden" name="id_app" id="id_app" value="'.$result_2["id_app"].'">';

        $output .= '  <input class="btn btn-danger btn-xs delete_image_detail fas fa-eraser" type="button" value="&#xf12d;" id="'.$row["id_image"].'" > </form>';
                } else if($_SESSION["del_image_toggle"] == "off"){
                } else if($_SESSION["del_image_toggle"] == ""){
                }
        $output .= ' 
                </td>
            </tr>
        ';
    }
    $output .= "</table></div>";

    $query_3 = "SELECT * FROM app_s WHERE id_app = '".$_POST["id_app"]."'";
    $result_3 = sqlsrv_query($conn, $query_3);
    

    while($row_3 = sqlsrv_fetch_array($result_3))
    {
        if($_SESSION["adding_image_toggle"] == "on") {
        $output .= '
        <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel">Insert image</h5>
            </div>

            <form method="POST" id="upload_form" name="upload_form" >

                <input type="hidden" name="id_image" id="id_image" class="form-control">
                
                <label class="ml-1">Application Name</label>
                <input type="label" readonly="readonly"  name="name_app" id="name_app" required class="form-control" placeholder="" value="'.$row_3["name_app"].'"><br/>
            
                <label class="ml-1">ID Application</label>
                <input type="label" readonly="readonly" name="id_app" id="id_app" required class="form-control" placeholder="" value="'.$row_3["id_app"].'"><br/>
                
                <label class="ml-1" style="color:red;">*Once you have uploaded <br/>
                **Will not be able to edit images</label><br/>

                <!-- upload img -->
                <input type="hidden" id="img_deatail_path" name="img_deatail_path" required class="form-control" placeholder=""> 
                <label class="ml-1">Screenshot</label> <br/>
                <input type="file" name="file_image" id="file_image" /> <br/>
                <span>
                    <img id="uploaded_image_detail" class="img-thumbnail" hidden/>
                </span><br/>

            
            
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <input type="button" name="insert_image" id="insert_image" class="btn btn-primary" value="Insert">

        </div>

        </form>
        

        ';
        } else if($_SESSION["adding_image_toggle"] == "off"){
        } else if($_SESSION["adding_image_toggle"] == ""){
        }
    }
    echo $output;
}
?>


<script>

//UPLOAD IMAGE detail
    $(document).on('change', '#file_image', function(){
        var name = document.getElementById("file_image").files[0].name;
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
        oFReader.readAsDataURL(document.getElementById("file_image").files[0]);
        var f = document.getElementById("file_image").files[0];
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
            form_data.append("file_image", document.getElementById('file_image').files[0]);
            $.ajax({
                url:"upload_detail.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#uploaded_image_detail').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(data)
                {
                    $('#img_deatail_path').val(data);
                    $('#uploaded_image_detail').attr('src', data)
                    $('#uploaded_image_detail').attr('hidden', false)
                }
            });
        }
    });

    // INSERT image detail
    $('#insert_image').on("click",function()
    {
        var img_deatail_path = $('#img_deatail_path').val();

        if(img_deatail_path != '')
        {
            //alert(id);
            $.ajax({  
                url:"insert_image.php",  
                method:"POST",  
                data:$('#upload_form').serialize(),
                success:function(data){  
                    //alert(data); 
                    $('#upload_form')[0].reset(); 
                    // $('#add_data_Modal').modal('show');  
                    $('#image_table').html(data);  
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
    });

     //DELETE image detail
     $(document).on('click', '.delete_image_detail', function(){
        var id_image = $(this).attr("id");
        var id_app = $('#id_app').val();
        swal({
            title: "Are you sure?",
            text: "You want to remove image?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete){
                $.ajax({
                    url:"delete_image.php",
                    method:"POST",
                    data:{id_image:id_image,
                            id_app:id_app},
                    success:function(data){
                        $('#image_table').html(data);  
                    }
                });
                
                setTimeout(function () { 
                    swal({
                        title:"Delete complete.", 
                        icon:"success"});
                }, 100);
            }
        })
    });    

</script>


           

