<?php
include_once('inc/admin-header.php');
?>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Staf Management
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
                    $select = "SELECT * FROM `team`";
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
                    <i class="bi bi-person-circle fs-3 me-2"></i> Staf
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
        if(confirm("Sure want to delete.")){
            window.location.href = `settingsCRUD.php?id=${id}`;
        }
    }
</script>