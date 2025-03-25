<?php
include_once('inc/admin-header.php');

$sql = "SELECT 
            r.Full_Name, 
            r.Profile_pic, 
            rr.rating, 
            rr.review_text, 
            rr.id 
        FROM review_and_rating rr
        JOIN register r ON r.id = rr.user_id";

$res = mysqli_query($conn, $sql);

?>


<div class="container mt-5">
    <h2 class="text-center mb-4 h-font">Room Reviews & Ratings</h2>

    <!-- Simple Room -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Simple Room (⭐ 3.5 from 50 reviews)</span>
            <div>
                <form action="review & rating.php" method="post">
                    <input type="hidden" name="room_type" value="">
                    <button class="btn btn-danger btn-sm delete-all" name="all"><i class="bi bi-trash"></i> All</button>
                    <button class="btn btn-primary btn-sm toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#simpleRoom">
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </form>
            </div>
        </div>

        <div id="simpleRoom" class="collapse">
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="text-center">
                            <th scop="col" class="bg-secondary">#</th>
                            <th scop="col" class="bg-secondary">Image</th>
                            <th scop="col" class="bg-secondary">User Name</th>
                            <th scop="col" class="bg-secondary">Rating</th>
                            <th scop="col" width="50%" class="bg-secondary">Review</th>
                            <th scop="col" class="bg-secondary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="align-middle text-center">
                            <td><?= $i ?></td>
                            <td><img src="../img/userProfile/<?= $data['Profile_pic'] ?>" width="35px" height="35px" class="rounded-circle"></td>
                            <td><?= $data['Full_Name'] ?></td>
                            <td><?= $data['rating'] ?> ⭐</td>
                            <td><?= $data['review_text'] ?></td>
                            <td>
                                <a href="?id=<?= $data['id'] ?>">
                                    <button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>  
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Luxury Room -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            <span>Luxury Room (⭐ 4.2 from 80 reviews)</span>
            <div>
                <button class="btn btn-danger btn-sm delete-all"><i class="bi bi-trash"></i> All</button>
                <button class="btn btn-primary btn-sm toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#luxuryRoom">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
        </div>
        <div id="luxuryRoom" class="collapse">
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="text-center">
                            <th scop="col" class="bg-secondary">#</th>
                            <th scop="col" class="bg-secondary">Image</th>
                            <th scop="col" class="bg-secondary">User Name</th>
                            <th scop="col" class="bg-secondary">Rating</th>
                            <th scop="col" width="50%" class="bg-secondary">Review</th>
                            <th scop="col" class="bg-secondary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `review_&_rating`";
                        $res = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($data = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr class="align-middle text-center">
                                <td><?= $i ?></td>
                                <td><img src="../img/about/<?= $data['image'] ?>" width="35px" height="35px" class="rounded-circle"></td>
                                <td><?= $data['user_name'] ?></td>
                                <td><?= $data['rating'] ?></td>
                                <td><?= $data['review'] ?></td>
                                <td>
                                    <a href="?id=<?= $data['id'] ?>"><button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Supreme Deluxe Room -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            <span>Supreme Deluxe Room (⭐ 4.5 from 120 reviews)</span>
            <div>
                <button class="btn btn-danger btn-sm delete-all"><i class="bi bi-trash"></i> All</button>
                <button class="btn btn-primary btn-sm toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#supremeDeluxeRoom">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
        </div>
        <div id="supremeDeluxeRoom" class="collapse">
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="text-center">
                            <th scop="col" class="bg-secondary">#</th>
                            <th scop="col" class="bg-secondary">Image</th>
                            <th scop="col" class="bg-secondary">User Name</th>
                            <th scop="col" class="bg-secondary">Rating</th>
                            <th scop="col" width="50%" class="bg-secondary">Review</th>
                            <th scop="col" class="bg-secondary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `review_&_rating`";
                        $res = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($data = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr class="align-middle text-center">
                                <td><?= $i ?></td>
                                <td><img src="../img/about/<?= $data['image'] ?>" width="35px" height="35px" class="rounded-circle"></td>
                                <td><?= $data['user_name'] ?></td>
                                <td><?= $data['rating'] ?></td>
                                <td><?= $data['review'] ?></td>
                                <td>
                                    <a href="?id=<?= $data['id'] ?>"><button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Deluxe Room -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            <span>Deluxe Room (⭐ 4.7 from 200 reviews)</span>
            <div>
                <button class="btn btn-danger btn-sm delete-all"><i class="bi bi-trash"></i> All</button>
                <button class="btn btn-primary btn-sm toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#deluxeRoom">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
        </div>
        <div id="deluxeRoom" class="collapse">
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="text-center">
                            <th scop="col" class="bg-secondary">#</th>
                            <th scop="col" class="bg-secondary">Image</th>
                            <th scop="col" class="bg-secondary">User Name</th>
                            <th scop="col" class="bg-secondary">Rating</th>
                            <th scop="col" width="50%" class="bg-secondary">Review</th>
                            <th scop="col" class="bg-secondary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `review_&_rating`";
                        $res = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($data = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr class="align-middle text-center">
                                <td><?= $i ?></td>
                                <td><img src="../img/about/<?= $data['image'] ?>" width="35px" height="35px" class="rounded-circle"></td>
                                <td><?= $data['user_name'] ?></td>
                                <td><?= $data['rating'] ?></td>
                                <td><?= $data['review'] ?></td>
                                <td>
                                    <a href="?id=<?= $data['id'] ?>"><button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>
</div>
</div>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM `review_&_rating` WHERE `id`= '$id'";

    if (mysqli_query($conn, $deleteQuery)) {
        setcookie("success", "Deleted Successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not Deleted Successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'review & rating.php';
    </script>
<?php

if (isset($_POST['all'])) {
    $room_type = $_POST['room_type']; 
    $delete_sql = "DELETE FROM `review_&_rating` WHERE `room_type` = '$room_type'"; 

    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('All reviews for $room_type deleted successfully!'); window.location.href='yourpage.php';</script>";
    } else {
        echo "<script>alert('Error deleting reviews');</script>";
    }
}

}
?>

<?php
// $sql = "SELECT COUNT(review) as total_reviews
//         FROM `review_&_rating` WHERE `room_type` =  'simple'";

//        $data =  mysqli_fetch_assoc(mysqli_query($conn,$sql));
//        echo $data['total_reviews'];

//         
?>

// <?php
