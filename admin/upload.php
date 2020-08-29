<?php
//UPLOAD IMAGE LOGO
if($_FILES["file"]["name"] != '')
{

 $location = '../image/' . $_FILES["file"]["name"];  
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo $location;
}
?>