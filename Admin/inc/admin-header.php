<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/common.css">
    <link href="script1/bootstrap.min.css" rel="stylesheet">
    <script src="script1/bootstrap.bundle.min.js"></script>
    <!-- <script src="script1/bootstrap-icons.min.css"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="script1/jquery-3.7.1.js"></script>
    <script src="script1/jquery.validate.min.js"></script>
</head>

<body>

    <div class="offcanvas offcanvas-start text-bg-dark" id="demo" style="width: 300px;">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title fs-2 text-info h-font">ADMIN PANEL</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="dashbord.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="Rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="discount.php">Room Discounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="carousel.php">Carousel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="feature.php">Feature & Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="User-query.php">User-query</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="review & rating.php">Reviews & Ratings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="settings.php">Settings</a>
                </li>
            </ul>
            <div class="dropdown mt-5">
                <button type="button" class="btn btn-info text-light dropdown-toggle" data-bs-toggle="dropdown">
                   Neel
                </button>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="logout.php">LogOut</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid  bg-dark py-2 d-flex align-items-center justify-content-between">
        <h3><a href="dashbord.php" class="text-decoration-none text-light fw-bold fs-3 h-font" style="text-shadow: 4px 2px 4px rgb(184, 170, 170);"><img src="img/logo.png" width="110px"> DreamNights</a></h3>
        <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
            <i class="bi bi-list fs-3"></i>
        </button>
    </div>

</body>

</html>