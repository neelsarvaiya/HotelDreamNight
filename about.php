<?php
include_once('inc/header.php');
?>

<style>
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

    .box {
        border-top-color: var(--teal);
    }

    .pop {

        transition: all ease 0.9s;
    }

    .pop:hover {
        border-top-color: var (--teal) !important;
        transform: scaleX(-1);
    }

    .pok {
        transition: all ease 0.9s;
    }

    .pok:hover {
        border-top-color: var(--teal) !important;
        transform: scaleX(0.9) scaleY(1.1);
    }

    .typewriter {
        height: 220px;
        display: block;
        overflow: hidden;
        white-space: normal;
        animation: typing 4s steps(30, end) forwards;
    }

    @keyframes typing {
        from {
            width: 0;
        }

        to {
            width: 100%;
        }
    }
</style>

<?php
$select = "SELECT * FROM `about_details`";
$data = mysqli_fetch_assoc(mysqli_query($conn, $select));
?>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center slide-top">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        <?= $data['about_text'] ?>
    </p>
</div>

<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-6 mb-4 me-md-5 order-lg-1 order-md-1 order-sm-2">
            <h3 class="mb-3 h-font"><?= $data['name'] ?></h3>
            <p class="typewriter">
                <?= $data['owner_detail'] ?>
            </p>
        </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-sm-1">
            <img src="img/about/<?= $data['image'] ?>" class="w-100">
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <?php
        $select = "SELECT * FROM detail_of_hotel WHERE status= 'active'";
        $result = mysqli_query($conn, $select);
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-lg-3 col-md-6 px-4 mb-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box pok">
                    <img src="img/about/<?= $data['image'] ?>" width="70px">
                    <h4 class="mt-3 h-font"><?= $data['detail'] ?></h4>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM
    <div class="h-line bg-dark mt-2"></div>
</h3>

<div class="container px-4">
    <div class="row">
        <?php
        $select = "SELECT * FROM `staff` WHERE `status` = 'active'";
        $res = mysqli_query($conn, $select);
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <div class="col-lg-3 col-md-6">
                <img src="img/about/<?= $row['image'] ?>" class="w-100 pop">
                <div class="d-flex align-items-center justify-content-around">
                    <h5 class="p-1 text-center shadow w-100"><?= $row['name'] ?></h5>
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