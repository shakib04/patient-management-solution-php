<?php

use PatientManagementSolution\surgeries\SurgeryController;

require_once "../../../vendor/autoload.php";

$surgeryController = new SurgeryController();
if (isset($_POST['createSurgery'])) {
    $surgeryController->create();
    header("location:../../patients/views/PatientDetailsView.php?patientId=$_GET[patientId]");
} else if (isset($_POST['updateSurgery'])) {
    $surgeryController->update($_GET['surgeryId']);
    header("location:../../patients/views/PatientDetailsView.php?patientId=$_GET[patientId]");
}

$updateSurgery = isset($_GET['surgeryId']) &&
    isset($_GET['updateSurgery']) && $_GET['updateSurgery'] == 'true';

if ($updateSurgery) {
    $surgery = $surgeryController->findById($_GET['surgeryId']);
}

?>


<html lang="en">
<?php require_once "../../headers/head.php"; ?>
<body>

<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <?php if (isset($_POST['patientUpdate'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Success to update!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <div class="pagetitle">
        <h1><?php echo $_GET['id'] ? 'Update Surgery' : 'Create New Surgery' ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a
                            href="../../patients/views/PatientDetailsView.php?patientId=<?= $_GET['patientId'] ?>">Patient
                        Details</a></li>
                <li class="breadcrumb-item active"><?= $updateSurgery ? 'Update' : 'Create' ?> Surgery</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $_GET['surgeryId'] ? 'Update Surgery' : 'Create New Surgery' ?>
                        </h5>

                        <!-- General Form Elements -->
                        <form method="post" action="">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Surgery Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="surgery_name"
                                           value="<?= $surgery['name'] ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary"
                                            name="<?= $_GET['surgeryId'] ? 'updateSurgery' : 'createSurgery' ?>">
                                        <?= $_GET['surgeryId'] ? 'Update' : 'Create' ?>
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

</body>
</html>
