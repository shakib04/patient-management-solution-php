<?php

require_once "../../../vendor/autoload.php";

use PatientManagementSolution\hospitals\HospitalController;
use PatientManagementSolution\hospitals\HospitalModel;
use PatientManagementSolution\patients\controller\PatientController;
use PatientManagementSolution\surgeries\SurgeryController;
use PatientManagementSolution\surgeries\SurgeryDetailsController;

$surgeryDetailsController = new SurgeryDetailsController();
$surgeryController = new SurgeryController();
$patientController = new PatientController();
$hospitalController = new HospitalController();
$hospitalModal = new HospitalModel();

if (isset($_POST['save_surgery_details'])) {
    $surgeryDetailsController->create($_POST['surgery_id']);
}

if (isset($_POST['updateSurgeryDetails'])) {
    $surgeryDetailsController->update($_GET['surgeryDetailsId']);
}

if (!isset($_GET['surgeryId'])) {
    echo "Surgery id not provided";
    die();
}

if (!isset($_GET['patientId'])) {
    echo "Patient id not provided";
    die();
}

$update = isset($_GET['surgeryDetailsId']);
if ($update) {
    $surgeryDetailsId = $_GET['surgeryDetailsId'];
    $surgeryDetails = $surgeryDetailsController->findById($surgeryDetailsId);
}

$patient = $patientController->findById($_GET['patientId']);
$surgery = $surgeryController->findById($_GET['surgeryId']);
$hospitalList = $hospitalController->getAll();
?>

<html lang="en">
<?php require_once "../../headers/head.php"; ?>

<title>Create new Patient</title>
<body>

<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Surgery History</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Elements</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $update ? 'Update' : 'Add' ?>
                            Surgery History for: <?= $patient['name'] ?></h5>

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled class="form-control" value="<?= $patient['name'] ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Surgery Name</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled class="form-control" value="<?= $surgery['name'] ?>">
                                    <input type="hidden" class="form-control" name="surgery_id"
                                           value="<?= $surgery['id'] ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Hospital</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example"
                                            name="hospital_id">
                                        <option <?= $update ? '' : 'selected' ?> disabled>----Select Hospital----
                                        </option>
                                        <?php foreach ($hospitalList

                                        as $hospital) : ?>
                                        <option <?= $update && $hospital[$hospitalModal->id] == $surgeryDetails['hospital_id'] ? 'selected' : '' ?>
                                                value="<?= htmlspecialchars($hospital[$hospitalModal->id]) ?>">
                                            <?= htmlspecialchars($hospital[$hospitalModal->code]) ?>
                                            - <?= htmlspecialchars($hospital[$hospitalModal->name]) ?>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date of Surgery</label>
                                <div class="col-sm-10">
                                    <input type="date" required value="<?= $surgeryDetails['date'] ?>" name="date"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Remarks</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px"
                                              placeholder="Remarks"
                                              name="remarks"><?= $surgeryDetails['remarks'] ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label"> Image (Before
                                    Surgery)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="before_image" type="file" id="formFile" accept="image/*">
                                </div>
                            </div>

                            <?php if (!$update): ?>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label"> Image (After
                                        Surgery)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" accept="image/*">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <a class="btn btn-secondary"
                                       href="PatientDetailsView.php?patientId=<?= $_GET['patientId'] ?>&surgeryId=<?= $_GET['surgeryId'] ?>">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary"
                                            name="<?= $update ? 'updateSurgeryDetails' : 'save_surgery_details' ?>">
                                        <?= $update ? 'Update' : 'Create' ?>
                                    </button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>
<!-- End #main -->
<?php require_once "../../footers/footer.php" ?>

<script>

</script>
</body>
</html>


