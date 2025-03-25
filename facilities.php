<?php
include_once('inc/header.php');
?>

<style>
    .pop {
        transition: all ease 0.5s;
    }

    .pop:hover {
        border-top-color: var(--teal) !important;
        transform: scale(1.1);
    }

    .slide-top {
        opacity: 0;
        transform: translateY(-100%);
        animation: slideTop 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    @keyframes slideTop {
        from {
            opacity: 0;
            transform: translateY(-300%);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center slide-top">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        At Dream Night Hotel, we offer world-class facilities to ensure a comfortable and enjoyable stay. Experience elegant rooms, airport transfers, exceptional dining options, a fully-equipped gym, relaxing spa, rooftop pool, free high-speed Wi-Fi, Swimming Pool meeting rooms.
    </p>
</div>

<div class="container">
    <div class="row">
        <?php
        $select = "SELECT * FROM room_facilities WHERE status = 'active'";
        $query = mysqli_query($conn, $select);

        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-iteams-center mb-2 ">
                        <img src="img/facilities/<?= $row['image'] ?>" width="40px">
                        <h5 class="m-0 ms-3"><b><?= $row['name'] ?></b></h5>
                    </div>
                    <p><?= $row['description'] ?></p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>



<?php
include_once('inc/footer.php');
?>