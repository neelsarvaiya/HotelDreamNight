<?php
include_once('inc/header.php');
?>

<?php
if (isset($_POST['pay'])) {
    $room_id = $_POST['room_id'];
    $email = $_POST['email1'];
    $adults = $_POST['adults'];
    $child = $_POST['children'];
    $check_in = $_POST['checkin'];
    $check_out = $_POST['checkout'];

    $select = "SELECT actual_price FROM room_categories WHERE id = $room_id";
    $data = mysqli_fetch_assoc(mysqli_query($conn, $select));

    $date1 = new DateTime($check_in);
    $date2 = new DateTime($check_out);
    $nights = $date1->diff($date2)->days;

    $total_price = $nights * $data['actual_price'];

    $select1 = "SELECT id FROM `register` WHERE Email = '$email'";
    $res = mysqli_query($conn, $select1);



    $data = mysqli_fetch_assoc($res);
    $user_id = $data['id'];

    $insert = "INSERT INTO `bookings`( `room_id`, `user_id`,`adult`, `child`, `check_in_date`, `check_out_date`, `total_price`) VALUES ('$room_id','$user_id','$adults','$child','$check_in','$check_out','$total_price')";
    mysqli_query($conn, $insert);

}
?>
<?php
$select = "SELECT * FROM `bookings`";
$data = mysqli_fetch_assoc(mysqli_query($conn, $select));
?>
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 mt-5 bg-white">
        <form action="user-payment.php" method="post">
            <div class="container">
                <h2 class="text-center mt-5 p-3 h-font">Payment</h2>
                <label for="pay" class="form-label">Amount : </label>
                <input type="text" name="price" id="pay" class="form-control mb-5" value="<?= $data['total_price'] ?>" readonly>
                <input type="hidden" name="room_id" id="pay" class="form-control mb-5" value="<?= $data['room_id'] ?>">
            </div>
            <button class="btn btn-success text-center mb-4 w-100" name="payment">Payment</button>
        </form>
    </div>
    <div class="col-lg-4"></div>
</div>

<?php
include_once('inc/footer.php');

if (isset($_POST['payment'])) {
    $total_price = $_POST['price'];
    $room_id = $_POST['room_id'];

    $ins = "INSERT INTO `payment`(`room_id`,`amount`) VALUES ('$room_id','$total_price')";
    mysqli_query($conn, $ins);
?>
    <script>
        alert('Payment successful! Your booking has been confirmed.');
        window.location.href = 'rooms.php';
    </script>
<?php
}
?>