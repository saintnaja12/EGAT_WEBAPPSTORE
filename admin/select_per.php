<?php 
//SELECT
session_start();
// echo $_POST["id_user"];
if(isset($_POST["id_user"]))
{
    $output = '';
    include '../conn.php';
    $query = "SELECT * FROM user_s WHERE id_user = '".$_POST["id_user"]."'";
    $result = sqlsrv_query($conn, $query);
    $output .= '
    <div class="table-responsive">
        <table class="table table-bordered">';
    while($row = sqlsrv_fetch_array($result))
    {

        if($row["row"] == 'Employee')
        {
            $output .= '
            <tr>
                <td width="30%"><label>Username</label></td>
                <td width="70%">'.$row["username"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Password</label></td>
                <td width="70%">'.$row["password"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>First name</label></td>
                <td width="70%">'.$row["fname"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Last name</label></td>
                <td width="70%">'.$row["lname"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Row</label></td>
                <td width="70%">'.$row["row"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>E-mail</label></td>
                <td width="70%">'.$row["e_mail"].'</td>
            </tr>
        ';
        }
        else
        {
            $output .= '
            <tr>
                <td width="30%"><label>Username</label></td>
                <td width="70%">'.$row["username"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Password</label></td>
                <td width="70%">'.$row["password"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>First name</label></td>
                <td width="70%">'.$row["fname"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Last name</label></td>
                <td width="70%">'.$row["lname"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Row</label></td>
                <td width="70%">'.$row["row"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>E-mail</label></td>
                <td width="70%">'.$row["e_mail"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Add</label></td>
                <td width="70%">'.$row["adding_toggle"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Edit</label></td>
                <td width="70%">'.$row["edit_toggle"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Delete</label></td>
                <td width="70%">'.$row["del_toggle"].'</td>
            </tr>

            <tr>
                <td width="30%"><label>Adding image detail</label></td>
                <td width="70%">'.$row["adding_image_toggle"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Delete image detail</label></td>
                <td width="70%">'.$row["del_image_toggle"].'</td>
            </tr>

            <tr>
                <td width="30%"><label>Adding file</label></td>
                <td width="70%">'.$row["adding_file_toggle"].'</td>
            </tr>
            <tr>
                <td width="30%"><label>Delete file</label></td>
                <td width="70%">'.$row["del_file_toggle"].'</td>
            </tr>
        ';
        }
        
    }
    $output .= "</table></div>";
    echo $output;
}
?>

           

