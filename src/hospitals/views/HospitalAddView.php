<html lang="en">

<?php
require_once "../../../vendor/autoload.php";
require_once "../../headers/head.php";

use PatientManagementSolution\hospitals\HospitalController;
use PatientManagementSolution\hospitals\HospitalModel;

$hospitalController = HospitalController::getInstance();

if (isset($_POST['saveHospital'])) {
    $hospitalController->save();
}

if (isset($_POST['updateHospital'])) {
    $hospitalController->update($_GET['id']);
}

if (isset($_GET['id'])) {
    $model = new HospitalModel();
    $hospital = $hospitalController->findById($_GET['id']);
}
?>

<title>Create new Patient</title>
<body>

<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>New Hospital Registration</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Hospital</li>
                <li class="breadcrumb-item active">
                    <?php echo isset($_GET['id']) ?
                        'Edit Hospital' : 'Add New Hospital' ?>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo isset($_GET['id']) ?
                                'Edit Hospital : ' . $hospital[$model->name] : 'Add New Hospital' ?>
                        </h5>

                        <!-- General Form Elements -->
                        <form method="post" action="">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Hospital Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name"
                                           value="<?php echo $hospital[$model->name]; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Hospital Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="code"
                                           value="<?php echo $hospital[$model->code]; ?>" maxlength="20">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Branch</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="branch"
                                           value="<?php echo $hospital[$model->branch]; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="location"
                                           value="<?php echo $hospital[$model->location]; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php
                                    echo isset($_GET['id']) ?
                                        '<input type="submit" class="btn btn-primary" name="updateHospital" value="Update">' :
                                        '<input type="submit" class="btn btn-primary" name="saveHospital" value="Create">';
                                    ?>
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
    removeCollapsed("hospital-nav-links");
    navActive("hospital-reg");
</script>
</body>
</html>