<?php 

// SEARCH 
session_start();
include '../conn.php';
$output = '';

// echo $_POST["id_app"];
if(isset($_POST["query"]))
{
    $search = $_POST["query"];

    $query = "SELECT * FROM app_s
    WHERE id_app LIKE '%".$search."%'
    OR name_app LIKE '%".$search."%' 
    OR system LIKE '%".$search."%' 
    ORDER BY id_app ASC";
}
else 
{
    $query = "SELECT * FROM app_s ORDER BY id_app ASC ";
}

if($result = sqlsrv_query($conn, $query))
{    
    while($row = sqlsrv_fetch_array($result))
    {
        $output .= '
        <div class="col-md-4 col-lg-2 col-6">
                <div class="card mb-2 shadow-sm">
                    <img src="'.$row["img_logo"].'" class="figure-img img-fluid rounded" width="80" style="margin: 0.5em auto; ">
                    <div class="text-name mb-1" style="margin: auto;">'.$row["name_app"].'</div>
                    <small class="text-name" style="margin: 0.5em auto;">'.$row["system"].'</small>
                    <small class="text-name" style="margin: 0.5em auto; color: yellow;">'.$row["set_permissions"].'</small>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group" style="margin: 0.5em auto;">
                        
                        <form method="POST" action="admin_page_2.php">
                            <input type="hidden" class="btn btn-sm btn-outline-light" name="id_app" value="'.$row["id_app"].'">
                            <button class="btn btn-sm btn-outline-light" type="submit">View</button>
                        </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
    $output .= '</table><div align="center">';
    
}
echo $output;
?>

           

