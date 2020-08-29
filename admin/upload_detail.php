<?php
//UPLOAD IMAGE LOGO
if($_FILES["file_image"]["name"] != '')
{

 $location = '../image_detail/' . $_FILES["file_image"]["name"];  
 move_uploaded_file($_FILES["file_image"]["tmp_name"], $location);
 echo $location;
}
?>