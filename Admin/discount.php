<?php
include 'connection.php';

if (isset($_POST['add_discount'])) {
    $room_id = $_POST['room'];
    $offer_name = $_POST['offer_name'];
    $discount = $_POST['discount'];
    $offer_start = $_POST['start'];
    $offer_end = $_POST['end'];

    $sql = "INSERT INTO `discount`(offer, discount_percentage, start_date, end_date) 
                VALUES ('$offer_name', '$discount', '$offer_start', '$offer_end')";

    if (mysqli_query($conn, $sql)) {

        $discount_id = mysqli_insert_id($conn);
        $insert = "INSERT INTO `room_wise_discount`(`room_id`, `discount_id`) VALUES ('$room_id','$discount_id')";
        mysqli_query($conn, $insert);
        setcookie("success", "Add Successfull.", time() + 3, "/");

    } else {
        setcookie("error", "Not add successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'discount.php';
    </script>
<?php
    exit;
}
?>


<?php
include_once('inc/admin-header.php');
?>
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Room Discounts
        <div>
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                Add
            </button>
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
        </div>
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Room</th>
                        <th scope="col" class="bg-dark text-white">Offer</th>
                        <th scope="col" class="bg-dark text-white">Discount</th>
                        <th scope="col" class="bg-dark text-white">Price</th>
                        <th scope="col" class="bg-dark text-white">Discounted Price</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                $select = "SELECT * FROM `discount`";
                $result = mysqli_query($conn, $select);

                while($data = mysqli_fetch_assoc($result)){
                    ?>
                    <tr class="align-middle">
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['id'] ?></td>
                        <td><?= $data['id'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning shadow-none mt-1" data-bs-toggle="modal" data-bs-target="#discount">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-danger btn-md mx-1 mt-1"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Room Discounts
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="discount.php" id="" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="room" class="form-label fw-bold">Choose room : </label>
                        <select name="room" id="room" class="form-control">
                            <?php
                            $select = "SELECT * FROM `room_categories` WHERE status='active'";
                            $result = mysqli_query($conn, $select);
                            while ($data =  $result->fetch_assoc()) {
                            ?>
                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="offer_name">Offer Name : </label>
                        <input type="text" name="offer_name" id="offer_name" data-validation="required" class="form-control">
                        <div class="error" id="offer_nameError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Discount (in % ) : </label>
                        <input type="number" name="discount" id="discount" data-validation="required numeric min max" data-min="1" data-max="3" class="form-control">
                        <div class="error" id="discountError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Offer Start : </label>
                        <input type="date" name="start" id="discount" data-validation="required" class="form-control">
                        <div class="error" id="startError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Offer End : </label>
                        <input type="date" name="end" id="discount" data-validation="required" class="form-control">
                        <div class="error" id="endError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="price" class="form-lable">Price : </label>
                        <input type="text" name="price" id="price" value="" class="form-control" readonly>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow" name="add_discount">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

</div>
</div>
</div>

<?php
if (isset($_POST['edt_discount'])) {
    $room = $_POST['room'];
    $offer_name = $_POST['offer_name'];
    $offer_name = $_POST['discount'];
    $offer_start = $_POST['start'];
    $offer_end = $_POST['end'];


    $insert = "";
}
?>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#room').change(function() {
            var roomId = $(this).val();

            $.ajax({
                url: 'get_room_price.php',
                type: 'POST',
                data: {
                    room_id: roomId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.price) {   
                        $('#price').val(response.price);
                    } else {
                        $('#price').val('');
                    }
                },
                error: function() {
                    alert('Error fetching room price.');
                }
            });
        });
    });
</script> -->