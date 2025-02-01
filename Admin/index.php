<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="script1/bootstrap5-icons.min.css">
    <link href="script1/bootstrap.min.css" rel="stylesheet">
    <script src="script1/jquery-3.7.1.js"></script>
    <script src="script1/jquery.validate.min.js"></script>
    <script src="script1/bootstrap.bundle.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4 bg-dark text-white p-2 rounded">Admin Login</h3>
                        <form method="POST" id="login">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-success w-100 fs-3" name="login"><i class="bi bi-box-arrow-right"></i> Login</button>
                        </form>
                        <?php
                        if (isset($_POST['login'])) {
                            echo "<script>
                                window.location.href = 'dashbord.php';
                                </script>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#login").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your username",
                        minlength: "Your username must be at least 3 characters long",
                    },
                    password: {
                        required: "Please provide your password",
                        minlength: "Your password must be at least 6 characters long",
                    }
                }
            });
        });
    </script>

</body>

</html>