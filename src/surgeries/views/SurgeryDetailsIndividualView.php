<?php

use PatientManagementSolution\file_upload\FileUploadController;
use PatientManagementSolution\hospitals\HospitalController;
use PatientManagementSolution\surgeries\SurgeryController;
use PatientManagementSolution\surgeries\SurgeryDetailsController;

require_once "../../../vendor/autoload.php";

if (!isset($_GET['surgeryDetailsId'])) {
    echo "surgery details id is missing";
    die();
}

$surgeryDetailsController = new SurgeryDetailsController();
$surgeryController = new SurgeryController();
$hospitalController = new HospitalController();
$fileUploadController = new FileUploadController();
$surgeryDetails = $surgeryDetailsController->findById($_GET['surgeryDetailsId']);
$surgery = $surgeryController->findById($surgeryDetails['surgery_id']);
$hospital = $hospitalController->findById($surgeryDetails['hospital_id']);
$beforeImagePaths = $fileUploadController->getPathArray($surgeryDetails['before_surgery_images_csv']);
$afterImagePaths = $fileUploadController->getPathArray($surgeryDetails['after_surgery_images_csv']);


if (isset($_POST['beforeUpload'])) {
    $surgeryDetailsController->addFile($_GET['surgeryDetailsId']);
    header("location:SurgeryDetailsIndividualView.php?patientId=$_GET[patientId]&surgeryDetailsId=$_GET[surgeryDetailsId]");
}

if (isset($_POST['afterUpload'])) {
    $surgeryDetailsController->addFile($_GET['surgeryDetailsId'], false);
    header("location:SurgeryDetailsIndividualView.php?patientId=$_GET[patientId]&surgeryDetailsId=$_GET[surgeryDetailsId]");
}

if (isset($_GET['deleteFile'])) {
    $surgeryDetailsController->deleteFile($_GET['fileId'], $_GET['surgeryDetailsId'], $fileUploadController);
    header("location:?patientId=$_GET[patientId]&surgeryDetailsId=$_GET[surgeryDetailsId]");
}


?>

<html lang="en">
<?php require_once "../../headers/head.php"; ?>

<body>
<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="card">
        <div class="card-body">
            <a href="../../patients/views/PatientDetailsView.php?<?= "patientId=$_GET[patientId]" ?>"
               class="btn btn-secondary">Back</a>
            <h5 class="card-title">Surgery Details</h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <td><?= htmlspecialchars($surgery['name']) ?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Date</th>
                    <td><?= htmlspecialchars($surgeryDetails['date']) ?></td>
                </tr>
                <tr>
                    <th scope="row">Days Before</th>
                    <td><?= date_diff(new DateTime($surgeryDetails['date']), new DateTime())->d ?> days</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td><?= htmlspecialchars($surgeryDetails['remarks']) ?></td>
                </tr>

                <tr>
                    <th>Hospital</th>
                    <td><?= htmlspecialchars($hospital['name']) ?></td>
                </tr>
                </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Images Before Surgery</h5>
            <div class="d-flex">
                <?php foreach ($beforeImagePaths as $imagePath): ?>
                    <div class="d-flex flex-column px-1">
                        <img src="<?= htmlspecialchars($imagePath['path']) ?>" width="200" height="200" alt=""
                             class="pb-1">
                        <a href='<?= "?deleteFile=true&fileId=$imagePath[id]&patientId=$_GET[patientId]&surgeryDetailsId=$_GET[surgeryDetailsId]" ?>'
                           class="btn btn-outline-danger btn-sm">Delete</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="before_image" id="formFile" accept="image/*">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary" name="beforeUpload">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Images After Surgery</h5>
            <div>
                <?php foreach ($afterImagePaths as $imagePath): ?>
                    <img src="<?= htmlspecialchars($imagePath['path']) ?>" width="150" height="150" alt="">
                <?php endforeach; ?>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="row my-3">
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="after_image" id="formFile" accept="image/*">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary" name="afterUpload">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once "../../footers/footer.php" ?>

<script>
    function setSurgeryDetails(param) {
        console.log(param)
        document.getElementById("surgeryId").innerText = param;
    }
</script>
</body>
</html>
