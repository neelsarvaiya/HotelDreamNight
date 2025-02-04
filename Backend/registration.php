<?php
 
  include_once('connection.php');

  if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pic = $_FILES['pic']['name'];
    $address = $_POST['address'];
    $pin = $_POST['pin'];
    $dob = $_POST['dob'];
    $password = $_POST['password2'];


    $data = "INSERT INTO `register`(`Full_Name`, `Email`, `Phone_number`, `Profile_pic`, `Address`, `Pincode_number`, `DOB`, `Password`) VALUES ('$name','$email','$phone','$pic','$address','$pin','$dob','$password')";

    $result = mysqli_query($conn, $data);

    if($result)
    {
        echo "data inserted..";
    }
    else{
        echo "failed";
    }

  }


?>