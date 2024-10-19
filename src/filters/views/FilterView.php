<?php
require_once "../../../vendor/autoload.php";

use PatientManagementSolution\filters\FilterController;
use PatientManagementSolution\surgeries\SurgeryController;

$surgery = [];
$surgeryController = new SurgeryController();
$surgeries = $surgeryController->findAll();

$filterController = new FilterController();

$input_names = [
    'surgery_name' => 'surgery_name'
] ?>

?>

<html lang="en">
<?php require_once "../../headers/head.php"; ?>
<body>

<?php require_once "../../headers/nav-bar.php" ?>
<main id="main" class="main">
    <!-- General Form Elements -->
    <form method="get" action="">
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Surgery Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"
                       placeholder="Search by Surgery Name"
                       name="<?= $input_names['surgery_name'] ?>" list="surgeries_name"
                       value="<?= $_GET[$input_names['surgery_name']] ?>">

                <datalist id="surgeries_name">
                    <?php foreach ($surgeries

                    as $row): ?>
                    <option value="<?= $row['name'] ?>">
                        <?php endforeach; ?>
                </datalist>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"
                        name="<?= $_GET['surgeryId'] ? 'updateSurgery' : 'createSurgery' ?>">
                    Search
                </button>
            </div>
        </div>

    </form><!-- End General Form Elements -->

    <?php
    $filteredData = $filterController->filter($_GET[$input_names['surgery_name']]);
    //        print_r($filteredData);die();
    foreach ($filteredData as $row): ?>
    <!-- Card with an image on left -->
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <figure>
                    <?php if ($row['image_path']): ?>
                    <img src="<?= htmlspecialchars($row['image_path']) ?>" width="350" class="img-fluid rounded-start" alt="<?= htmlspecialchars($row['patient_name']) ?>'s image">
                    <?php else: ?>
                    <img src="../../files/No-Image-Placeholder.png" width="200" class="img-fluid rounded-start" alt="<?= htmlspecialchars($row['patient_name']) ?>'s image">
                    <?php endif; ?>
                    <figcaption>Patient Image</figcaption>
                </figure>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="fs-6 badge text-bg-info">Surgery Details</p>
                    <h5 class="card title">Name: <span class="display-6"><?= htmlspecialchars($row['surgery_name']) ?></span></h5>
                    <p class="fs-6 badge text-bg-info">Patient Details</p>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Patient Name:</label>
                        <div class="col-sm-10 col-lg-3">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($row['patient_name']) ?>" disabled>
                        </div>

                        <label class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col-sm-10 col-lg-3">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($row['gender']) ?>" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mobile Number:</label>
                        <div class="col-sm-10 col-lg-3">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($row['mobile_number']) ?>" disabled>
                        </div>
                        <label class="col-sm-2 col-form-label">Age:</label>
                        <div class="col-sm-10 col-lg-3">
                            <input type="text" class="form-control" value="<?= date_diff(new DateTime($row['date_of_birth']), new DateTime())->y ?>" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Address:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($row['mobile_number']) ?>" disabled>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btn-lg"
                           href="<?=ROOT_URL?>/src/patients/views/PatientDetailsView.php?patientId=<?= htmlspecialchars($row['patient_id']) ?>">Details -></a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Card with an image on left -->
    <?php endforeach; ?>

    <!-- Table with stripped rows -->
<!--    <table class="table datatable">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Patient Name</th>-->
<!--            <th>Surgery Name</th>-->
<!--            <th>Gender</th>-->
<!--            <th>Address</th>-->
<!--            <th>Age</th>-->
<!--            <th>Mobile Number</th>-->
<!--            <th></th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php
//        $filteredData = $filterController->filter($_GET[$input_names['surgery_name']]);
////        print_r($filteredData);die();
//        foreach ($filteredData as $row): ?>
<!--            <tr>-->
<!--                <td>--><?php //= htmlspecialchars($row['patient_name']) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($row['surgery_name']) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($row['gender']) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($row['address']) ?><!--</td>-->
<!--                <td>--><?php //= date_diff(new DateTime($row['date_of_birth']), new DateTime())->y ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($row['mobile_number']) ?><!--</td>-->
<!--                <td>-->
<!--                    <a class="btn btn-primary"-->
<!--                       href="--><?php //=ROOT_URL?><!--/src/patients/views/PatientDetailsView.php?patientId=--><?php //= htmlspecialchars($row['patient_id']) ?><!--">Details</a>-->
<!--                </td>-->
<!---->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
    <!-- End Table with stripped rows -->
</main>
<!-- End #main -->
<?php require_once "../../footers/footer.php" ?>
