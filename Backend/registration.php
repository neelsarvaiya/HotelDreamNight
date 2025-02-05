<?php

include_once('connection.php');

if (isset($_POST['register'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $pic = $_FILES['pic']['name'];
  $address = $_POST['address'];
  $pin = $_POST['pin'];
  $dob = $_POST['dob'];
  $password = $_POST['password2'];


  $data = "INSERT INTO `register`(`Full_Name`, `Email`, `Phone_number`, `Profile_pic`, `Address`, `Pincode_number`, `DOB`, `Password`) VALUES ('$name','$email','$phone','$pic','$address','$pin','$dob','$password')";

   mysqli_query($conn, $data);

}
?>

<?php
    if (isset($_POST['register'])) {

        $ftype = $_FILES['pic']['type'];
        $fsize = $_FILES['pic']['size'];
        if ($ftype == "image/png" || $ftype == "image/jpg") {

            if ($fsize <= 1024 * 1024) {

                if (!is_dir("uploads")) {
                    mkdir("uploads");
                }

                $fname = uniqid() . $_FILES['pic']['name'];
                if (move_uploaded_file($_FILES['pic']['tmp_name'], "uploads/" . $fname)) {
                    echo "<script>
                            alert('Registration SuccessFully...');
                            window.location.href = '../index.php';
                      </script>";
                }else{
                  ?>
                  <script>
                    alert('Registration not successfull..');
                    window.location.href = '../index.php';
                    </script>
                  <?php
                }
            } else {
    ?>
                <script>
                    alert('File is larger than 1 KB. Please select a smaller file.')
                </script>

            <?php
            }
        } else {
            ?>
            <script>
                alert('File is not a png or jpg file')
            </script>
    <?php
        }
    }
    ?>