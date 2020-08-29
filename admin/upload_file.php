<?php
//UPLOAD FILE
if($_FILES["file_up"]["name"] != '')
{

 $location = '../files/' . $_FILES["file_up"]["name"];  
 move_uploaded_file($_FILES["file_up"]["tmp_name"], $location);
 echo $location;
}
?>