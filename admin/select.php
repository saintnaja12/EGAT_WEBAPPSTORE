<?php 
//SELECT
session_start();
// echo $_POST["id_app"];
if(isset($_POST["id_app"]))
{
    $output = '';
    include '../conn.php';
    $query = "SELECT * FROM app_s WHERE id_app = '".$_POST["id_app"]."'";
    $result = sqlsrv_query($conn, $query);
    $output .= '
    <div class="table-responsive">
        <table class="table table-bordered">';
    while($row = sqlsrv_fetch_array($result))
    {
        $output .= '
            <tr>
                <td width="30%"><label>Name</label></td>
                <td width="70%">'.$row["name_app"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Detail</label></td>
                <td width="70%">'.$row["detail"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>System</label></td>
                <td width="70%">'.$row["system"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Language</label></td>
                <td width="70%">'.$row["language"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Version</label></td>
                <td width="70%">'.$row["version"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Permissions</label></td>
                <td width="70%">'.$row["set_permissions"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Department</label></td>
                <td width="70%">'.$row["department"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Image</label></td>
                <td width="70%"><img src="'.$row["img_logo"].'" class="figure-img img-fluid rounded" width="80" style="margin: 0.5em auto; "></td>
            </tr>
            <tr>
                <td width="30%"><label>Image Path</label></td>
                <td width="70%">'.$row["img_logo"].'</td>
            </tr>

        ';
    }
    $output .= "</table></div>";
    echo $output;
}
?>

           

