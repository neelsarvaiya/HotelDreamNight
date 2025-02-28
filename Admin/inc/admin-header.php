<!DOCTYPE html>
<html lang="en">
    
    <head>
        <title>Admin | panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/common.css">
        <link href="script1/bootstrap.min.css" rel="stylesheet">
        <script src="script1/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="script1/jquery-3.7.1.js"></script>
        <script src="script1/jquery.validate.min.js"></script>
    </head>

    <!-- icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <body class="bg-light">
        
        <div class="container-fluid bg-dark d-flex align-items-center justify-content-between sticky-top" style="z-index: 1000;">
        <a class="navbar-brand fw-bold fs-3 h-font text-light " href="dashbord.php" style="text-shadow: 4px 2px 4px rgba(0, 0, 0, 0.5);"> <img src="../img/logo.png" width="110px">DreamNights</a>
        <div class="dropdown">
            <button type="button" class="btn dropdown-toggle text-light me-3 p-3" data-bs-toggle="dropdown">
                <img src="img/user.jpg" class="img-fluid rounded-circle" style="height: 30px; width: 40%" alt=""> NEEL
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashbord-menu" style="position: fixed;">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2 text-light h-font">ADMIN PANEL</h4>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminbar">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="offcanvas offcanvas-start text-bg-dark" id="adminbar" style="width: 300px;">
                    <div class="offcanvas-header">
                        <h1 class="offcanvas-title fs-2 h-font">ADMIN PANEL</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body bg-dark">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="dashbord.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="Rooms.php"><i class="fa-solid fa-bed"></i> Rooms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="discount.php"><i class="fa-solid fa-percent"></i> Discounts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="carousel.php"><i class="fa-solid fa-sliders"></i> Carousel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="users.php"><i class="fa-solid fa-user-tie"></i> Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="feature.php"><i class="fa-solid fa-spa"></i> Feature & Facilities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="User-query.php"><i class="fa-solid fa-question"></i> User-query</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="review & rating.php"><i class="fa-solid fa-star-half-stroke"></i> Reviews & Ratings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="settings.php"> <i class="fa-solid fa-gear"></i> Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto">
</body>

</html>