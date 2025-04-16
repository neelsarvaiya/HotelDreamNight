<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id > 0) {
        $delete = "DELETE FROM `review_and_rating` WHERE `id` = $id";
        $result = mysqli_query($conn, $delete);

        if ($result) {
            setcookie("success", "Deleted Successfull", time() + 3, "/");
?>
            <script>
                window.location.href = 'review_and_rating.php';
            </script>
        <?php
        } else {
            setcookie("error", "NOt Deleted Successfull", time() + 3, "/");
        ?>
            <script>
                window.location.href = 'review_and_rating.php';
            </script>
<?php
        }
    }
}
?>

<?php
include_once('inc/admin-header.php');
?>

<?php
$review_sql = "SELECT 
                r.Full_Name, 
                r.Profile_pic, 
                rr.rating, 
                rr.review_text, 
                rr.id, 
                rr.room_id 
              FROM review_and_rating rr
              JOIN register r ON r.id = rr.user_id";

$reviews_result = mysqli_query($conn, $review_sql);
$reviews_by_room = [];

// Store reviews grouped by room_id
while ($review = mysqli_fetch_assoc($reviews_result)) {
    $room_id = $review['room_id'];
    $reviews_by_room[$room_id][] = $review;
}


// Fetch all room categories
$room_sql = "SELECT * FROM `room_categories`";
$rooms_result = mysqli_query($conn, $room_sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4 h-font">Room Reviews & Ratings</h2>
    
    <?php
    while ($room = mysqli_fetch_assoc($rooms_result)) {
        $room_id = $room['id'];
        
        $sql = "SELECT ROUND(AVG(rating), 1) AS rating_avg , COUNT(review_text) AS total_review 
                   FROM review_and_rating WHERE room_id = $room_id";
        $rr_avg = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    ?>
        <div class="card mb-5">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><?= $room['name'] ?> ( <?= ($rr_avg['rating_avg']) ? $rr_avg['rating_avg'] : 0 ?>⭐ from <?= $rr_avg['total_review'] ?> reviews)</span>
                <button class="btn btn-primary btn-sm toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#room_<?= $room_id ?>">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>

            <div id="room_<?= $room_id ?>" class="collapse">
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="bg-secondary">#</th>
                                <th scope="col" class="bg-secondary">Image</th>
                                <th scope="col" class="bg-secondary">User Name</th>
                                <th scope="col" class="bg-secondary">Rating</th>
                                <th scope="col" width="50%" class="bg-secondary">Review</th>
                                <th scope="col" class="bg-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($reviews_by_room[$room_id])) {
                                $i = 1;
                                foreach ($reviews_by_room[$room_id] as $data) {
                            ?>
                                    <tr class="align-middle text-center">
                                        <td><?= $i ?></td>
                                        <td><img src="../img/userProfile/<?= $data['Profile_pic'] ?>" width="35px" height="35px" class="rounded-circle"></td>
                                        <td><?= $data['Full_Name'] ?></td>
                                        <td><?= $data['rating'] ?> ⭐</td>
                                        <td><?= $data['review_text'] ?></td>
                                        <td>
                                            <a href="?id=<?= $data['id'] ?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr class='text-center'><td colspan='6'>No reviews available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

</div>
</div>
</div>