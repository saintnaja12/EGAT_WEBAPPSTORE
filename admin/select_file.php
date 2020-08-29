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
    $query = "SELECT * FROM files WHERE id_app = '".$_POST["id_app"]."'";
    $result = sqlsrv_query($conn, $query);
    $output .= '
    <div class="table-responsive" id="file_table">
    <table class="table align-items-center table-sm" style="background-color: white;">
    <thead class="thead-light">
        <tr>
            <th scope="col">
                <div align="center">ID</div>
            </th>
            <th scope="col">
                <div align="center">File name</div>
            </th>
            <th scope="col">
                <div align="center">Path</div>
            </th>
            <th scope="col">
                <div align="center">Versions</div>
            </th>
            <th scope="col">
                <div align="center">Size</div>
            </th>
            <th scope="col">
                <div align="center">ID application</div>
            </th>
            <th scope="col">
                <div align="center">Download</div>
            </th>
            <th scope="col">';
            if($_SESSION["del_file_toggle"] == "on") {
    $output .= '<div align="center">Delete</div>';
            } else if($_SESSION["del_file_toggle"] == "off"){  
            } else if($_SESSION["del_file_toggle"] == ""){
            } 
    $output .= '    
            </th>
        </tr>
    </thead>';
    while($row = sqlsrv_fetch_array($result))
    {
        $data = substr($row["path_file"],9);

        $output .= '
            <tr>
                <td>'.$row["id_file"].'</td>
                <td>'.$data.'</td>
                <td>'.$row["path_file"].'</td>
                <td>'.$row["version"].'</td>
                <td>'.$row["size"].'</td>
                <td>'.$row["id_app"].'</td>
                <td><a href="../files/'.$data.'" class="btn btn-success far fa-file-alt	 btn-sm"></a></td>
                <td>';
                if($_SESSION["del_file_toggle"] == "on") {
                    
                $query_2 = "SELECT * FROM files WHERE id_app = '".$_POST["id_app"]."'";
                $result_2 = sqlsrv_query($conn, $query_2);
        $output .= '<form method="POST" id="del_file" name="del_file" ><input type="hidden" name="id_app" id="id_app" value="'.$result_2["id_app"].'">';                  
                    
        $output .= '  <input class="btn btn-danger btn-xs delete_path_file fas fa-eraser" type="button" value="&#xf12d;" id="'.$row["id_file"].'" > </form>';
                } else if($_SESSION["del_file_toggle"] == "off"){
                } else if($_SESSION["del_file_toggle"] == ""){
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
        if($_SESSION["adding_file_toggle"] == "on") {
        $output .= '
        <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel">Insert files</h5>
            </div>

            <form method="POST" id="upload_file_form" name="upload_file_form">

                <!-- Modal body -->
                <div class="modal-body" style="text-align: left;">
                    <input type="hidden" name="id_file" id="id_file" class="form-control">

                    <label class="ml-1">Application Name</label>
                    <input type="label" readonly="readonly"  name="name_app" id="name_app" required class="form-control" placeholder="" value="'.$row_3["name_app"].'"><br/>

                    <label class="ml-1">ID Applications</label>
                    <input type="text" readonly="readonly" name="id_app" id="id_app" required class="form-control" placeholder="" value="'.$row_3["id_app"].'"><br/>

                    <label class="ml-1">Version</label>
                    <input type="text" name="version" id="version" required class="form-control" placeholder=""><br/>

                    <label class="ml-1" style="color:red;">*Once you have uploaded.<br/>
                    **Only APK and IPA files.</label><br/>

                    <!-- upload file -->
                    <input type="hidden" id="path_file" name="path_file" required class="form-control" placeholder="">
                    <label class="ml-1">File Application</label> <br/>
                    <input type="file" name="file_up" id="file_up" /> <br/>
                    <div id="targetLayer" style="display:none;"></div>

                    <label class="ml-1">Size</label>
                    <input type="text" class="form-control" name="size" id="size" readonly="readonly" />


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <input type="button" name="insert_file" id="insert_file" class="btn btn-primary" value="Insert">

                </div>
            </form>
        ';
        } else if($_SESSION["adding_file_toggle"] == "off"){
        } else if($_SESSION["adding_file_toggle"] == ""){
        }
    }


    echo $output;
}
?>

<script>

$(document).ready(function() 
{
    //Only number and dot regex
    const regex = /[^\d.]|\.(?=.*\.)/g;
    const subst=``;

    $('#version').keyup(function(){
        const str=this.value;
        const result = str.replace(regex, subst);
        this.value=result;

    });

    //UPLOAD FILE 
    $(document).on('change', '#file_up', function(){
        var name = document.getElementById("file_up").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        $('#targetLayer').hide();
        if(jQuery.inArray(ext, ['apk', 'ipa']) == -1) 
        {
            // alert("Invalid APK or IPA File");
            setTimeout(function () { 
                    swal({
                        title:"Invalid APK or IPA File", 
                        icon:"error"});
                }, 100);
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file_up").files[0]);
        var f = document.getElementById("file_up").files[0];
        var fsize = f.size||f.fileSize;
        console.log(fsize);
        if(fsize > 200000000)
        {
            // alert("APK or IPA File Size is very big");
            setTimeout(function () { 
                    swal({
                        title:"APK or IPA File Size is very big", 
                        icon:"error"});
                }, 100);
        }
        else
        {
            sizz = fsize/1000000;

            console.log(sizz.toFixed(2));
            $('#size').val(sizz.toFixed(2) + " MB");
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

    // INSERT FILE 
    $('#insert_file').on("click",function()
    {
        var path_file = $('#path_file').val();
        var version = $('#version').val();

        if(version != '')
        {
            if(path_file != '')
            {
                $.ajax({  
                    url:"insert_file.php",  
                    method:"POST",  
                    data:$('#upload_file_form').serialize(),
                    success:function(data){  
                        //alert(data); 
                        $('#upload_file_form')[0].reset(); 
                        // $('#file_data_Modal').modal('hide');  
                        $('#file_table').html(data);  
                    }  
                });
            }
            else
            {
                setTimeout(function () {
                        swal({
                            title:"You haven't uploaded files", 
                            icon:"warning"});
                    }, 100);
            }
        }
        else
        {
            setTimeout(function () { 
                swal({
                    title:"Fields is required", 
                    icon:"warning"});
            }, 100);
        }
    });

    
    //DELETE FILE
    $(document).on('click', '.delete_path_file', function(){
        var id_file = $(this).attr("id");
        var id_app = $('#id_app').val();
        swal({
            title: "Are you sure?",
            text: "You want to remove file?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete){
                $.ajax({
                    url:"delete_file.php",
                    method:"POST",
                    data:{id_file:id_file,
                            id_app:id_app},
                    success:function(data){
                        $('#file_table').html(data);                              
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
});

</script>

           

