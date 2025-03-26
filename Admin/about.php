<?php
include_once('inc/admin-header.php');
?>
<?php
$select = "SELECT * FROM `about_details`";
$data = mysqli_fetch_assoc(mysqli_query($conn, $select));
?>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> About Text
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" class="bg-dark text-white">Description</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td><?= $data['about_text'] ?></td>
                        <td width="20%">
                            <button type="button" class="btn btn-warning btn-md mx-1 mt-1 shadow-none" data-bs-toggle="modal" data-bs-target="#edit_description">
                                <i class="fa-solid fa-pen-to-square">
                            </button>
                            <button class="btn btn-danger"><i class="bi bi-trash"></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_description" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Description
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <?php
            $select = "SELECT * FROM `about_details`";
            $data = mysqli_fetch_assoc(mysqli_query($conn, $select));
            ?>
            <form action="about.php" method="post">
                <div class="modal-body">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="mb-1 col-md-12 form-control" rows="5" data-validation="required"><?= $data['about_text'] ?></textarea>
                    <div class="error" id="descriptionError"></div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" name="save_description" class="btn btn-success shadow-none">Save Changes</button>
                </div>
            </form>
            <?php
                if(isset($_POST['save_description'])){
                    $description = $_POST['description'];

                    $update = "UPDATE `about_details` SET `about_text`='$description' WHERE 1";
                    mysqli_query($conn, $update);
                }
            ?>
        </div>
    </div>
</div>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Owner Details
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" width="30%" class="bg-dark text-white">Image</th>
                        <th scope="col" width="10%" class="bg-dark text-white">Name</th>
                        <th scope="col" width="50%" class="bg-dark text-white">Detail</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td class="p-2"><img src="../img/about/<?= $data['image'] ?>" height="200px" width="300px"></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['owner_detail'] ?></td>
                        <td>
                            <a href="" class="btn btn-warning btn-md mx-1 mt-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Details of Hotel
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" class="bg-dark text-white">Image</th>
                        <th scope="col" class="bg-dark text-white">Detail</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM detail_of_hotel";
                    $res = mysqli_query($conn, $select);

                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="align-middle">
                            <td><?= $data['id'] ?></td>
                            <td class="p-2"><img src="img/about/<?= $data['image'] ?>" height="100px" width="100px"></td>
                            <td><?= $data['detail'] ?></td>
                            <td><button class="btn btn-<?php
                                                        if ($data['status'] == "active")
                                                            echo "info";
                                                        else
                                                            echo "danger";
                                                        ?> btn-md mx-1"><?= $data['status'] ?></button></td>
                            <td>
                                <a href="" class="btn btn-info btn-md mx-1 mt-1"><i class="fa-solid fa-pen-to-square"></i></a>
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