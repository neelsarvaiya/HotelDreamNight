<?php
include_once('inc/admin-header.php');
?>
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Carousel
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#c-img">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>
    <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <?php
                    $sql = "SELECT * FROM carousel";
                    $res = mysqli_query($conn, $sql);

                    ?>
                    <tr class="text-center">
                        <th scope="col" width="5%" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" width="10%" class="bg-dark text-white">Image</th>
                        <th scope="col" width="5%" class="bg-dark text-white">Status</th>
                        <th scope="col" width="5%" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="align-middle text-center">
                            <td><?= $no ?></td>
                            <td><img src="../img/carousel/<?= $data['image'] ?>" height="150px" width="500px"></td>
                            <td><a href="carouselCRUD.php?status_id=<?= $data['id'] ?>" class="btn btn-<?= ($data['status'] == 'active') ? 'success' : 'danger' ?> btn-md mx-1"><?= $data['status'] ?></a></td>
                            <td><button onclick="delete_img(<?= $data['id'] ?>);" class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i></button></td>
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

</div>
</div>
</div>


<div class="modal fade" id="c-img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Image
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <form id="carousel_pic" action="carouselCRUD.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="file" name="image" class="mb-1 col-md-12 form-control" data-validation="required file">
                    <div class="error" id="imageError"></div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" name="add" class="btn btn-success shadow-none">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function delete_img(id) {
        if (confirm("Sure want to delete?")) {
            window.location.href = `carouselCRUD.php?id=${id}`;
        }
    }
</script>