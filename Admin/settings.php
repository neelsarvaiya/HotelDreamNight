<?php
include_once('inc/admin-header.php');
?>

<?php
    $select = "SELECT * FROM settings";
    $res = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($res);
    ?>
<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-12 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4 h-font">Settings</h3>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">General Settings</h5>
                        <button type="button" class="btn btn-warning shadow-none" data-bs-toggle="modal" data-bs-target="#settings">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                    </div>
                    <h6 class="card-subtitle mb-1 fw-bold">Website subtitle</h6>
                    <p class="card-text"><?= $row['site_title'] ?></p>
                    <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                    <p class="card-text"><?= $row['site_about'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="settings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle    fs-3 me-2"></i> Genral Settings
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <form action="settings.php" method="post">
                <div class="modal-body">
                    <label for="title" class="mb-2">Website Title :</label>
                    <input type="text" name="title" id="title" data-validation="required alpha min max" data-min="5" data-max="50" value="<?= $row['site_title'] ?>" placeholder="Enater Website Title :" class="form-control mb-2 col-md-12">
                    <div class="error" id="titleError"></div>
                    <label for="title_about" class="mb-2">Website About Us :</label>
                    <textarea name="title_about" id="title_about" class="form-control" rows="5" data-validation="required min max" data-max="3000" data-min="10  "><?= $row['site_about'] ?></textarea>
                    <div class="error" id="title_aboutError"></div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow mt-2" name="edt_settings_btn">Save Changes</button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['edt_settings_btn'])) {
                $title = $_POST['title'];
                $title_about = $_POST['title_about'];
                $update = "UPDATE settings SET site_title='$title',site_about='$title_about' WHERE 1";
                $res = mysqli_query($conn, $update);
                if ($res) {
                    setcookie('success', 'Settings Updated', time() + 3, "/");
                    ?>
                    <script>window.location.href='settings.php'</script>
                    <?php
                } else {
                    setcookie('error', 'Something went wrong', time() + 3, '/');
                    ?>
                    <script>window.location.href='settings.php'</script>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Staff Management
        <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#m_team">
        <i class="bi bi-plus-lg"></i> Add
        </button>
    </div>
    <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">

                    <tr class="text-center">
                        <th scope="col" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" class="bg-dark text-white">Image</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM `staff`";
                    $res = mysqli_query($conn, $select);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="text-center">
                            <td class="align-middle"><?= $no ?></td>
                            <td><img class="align-middle" src="/HotelDreamNight/img/about/<?= $row['image'] ?>" height="150px" width="150px"></td>
                            <td class="align-middle"><?= $row['name'] ?></td>
                            <td class="align-middle"><button class="btn btn-<?= ($row['status'] === "active") ? 'success' : 'danger' ?> btn-md mx-1"><?= $row['status'] ?></button></td>
                            <td class="align-middle"><button class="btn btn-danger btn-md mx-1" onclick="stafDelete(<?php echo $row['id'] ?>)"> <i class="bi bi-trash"></i></button></td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="m_team" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Staff
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <form action="settingsCRUD.php" id="manage_team" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="team_management">Choose Photo :</label>
                    <input type="file" name="team_management" id="team_management" data-validation="required file" class="col-md-12 form-control"> <br>
                    <div class="error" id="team_managementError"></div>
                    <label for="name4">Name :</label>
                    <input type="text" name="name4" id="name4" data-validation="required alpha min max" data-min="2" data-max="50" placeholder="Enater Name :" class="form-control col-md-12">
                    <div class="error" id="name4Error"></div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow mt-2" name="add">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
</div>


<script>
    function stafDelete(id){
        if(confirm("Sure want to delete?")){
            window.location.href = `settingsCRUD.php?id=${id}`;
        }
    }
</script>