<?php

 $conn = mysqli_connect("localhost","root","","hotel");

 if(!$conn){
    die("Connection Failed".mysqli_connect_error());
 }

