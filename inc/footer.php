<div class="container-fluid bg-white mt-5 p-3">
    <div class="row">
        <div class="col-lg-4">
            <?php
            $select = "SELECT * FROM settings";
            $res = mysqli_query($conn, $select);
            $row = mysqli_fetch_assoc($res);
            ?>
            <h3 class="h-font fw-bold fs-3 mb-2"><?= $row['site_title'] ?></h3>
            <p><?= $row['site_about'] ?></p>
        </div>
        <div class="col-lg-4">
            <h5 class="mb-3 h-font hov">Links </h5>
            <a href="index.php" class="d-line-block mb-2 text-dark text-decoration-none ">Home</a><br>
            <a href="rooms.php" class="d-line-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="facilities.php" class="d-line-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="contact.php" class="d-line-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
            <a href="about.php" class="d-line-block mb-2 text-dark text-decoration-none">About Us</a><br>
        </div>
        <div class="col-lg-4 ft">
            <h5 class="mb-3 h-font">Follow Us</h5>
            <?php 
             $select ="SELECT * FROM `contact_details`";
             $result = mysqli_fetch_assoc(mysqli_query($conn,$select));
            ?>
            <a href="https://www.twitter.com/" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-twitter me-1"></i> <?= $result['twitter'] ?>
            </a><br>
            <a href="https://www.facebook.com/" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-facebook me-1"></i> <?= $result['fb'] ?>
            </a><br>
            <a href="https://www.instagram.com/" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-instagram me-1"></i> <?= $result['insta'] ?>
            </a><br>
            <a href="https://www.instagram.com/" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-threads me-1"></i> <?= $result['thread'] ?>
            </a><br>
        </div>
    </div>
</div>

<?php
            $select = "SELECT * FROM settings";
            $res = mysqli_query($conn, $select);
            $row = mysqli_fetch_assoc($res);
            ?>

<h6 class="text-center bg-dark text-white p-3 m-0 h-font">@Designed and Developed by <?= $row['site_title'] ?></h6>

<script>
    function checkLoginToBook(status,room_id){
        if(status){
            window.location.href =  'booking.php?room_id='+room_id;
        }else{
            alert("⚠ You must log in to book a room!");
        }
    }
</script>

</body>

</html>