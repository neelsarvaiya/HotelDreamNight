<?php

 $conn = mysqli_connect("localhost","root","","hotel");

 if(!$conn){
    die("Connection Failed".mysqli_connect_error());
 }

define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/php/slider/images/");

?>
