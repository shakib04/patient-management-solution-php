<?php
require_once "../../../vendor/autoload.php";

use PatientManagementSolution\patients\controller\PatientController;

$patientController = new PatientController();
if (isset($_POST['patientRegistration'])) {
    $patientController->save();
}

if (isset($_POST['patientUpdate'])) {
    $patientController->update($_GET['id']);
}

if ($_GET['id']) {
    $patient = $patientController->findById($_GET['id']);
}
?>

<html lang="en">
<?php require_once "../../headers/head.php"; ?>

<title>Create new Patient</title>
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
        <h1><?php echo $_GET['id'] ? 'Update Patient' : 'New Patient Registration' ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="PatientDataListView.php">Patients</a></li>
                <li class="breadcrumb-item active">Patient Registration</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $_GET['id'] ? 'Update Patient' : 'New Patient Registration' ?>
                        </h5>

                        <!-- General Form Elements -->
                        <form method="post" action="">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name"
                                           value="<?= $patient['name'] ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Mobile Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mobile_number"
                                           value="<?= $patient['mobile_number'] ?>">
                                </div>
                            </div>

                            <?php if (!$_GET['id']): ?>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Patient Image
                                        Upload</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-4">
                                    <input type="date" name="date_of_birth" class="form-control"
                                           value="<?= $patient['date_of_birth'] ?>"
                                           onchange="updateAge(this.value)">
                                </div>

                                <label for="inputDate" class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled name="age" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                                               value="male"
                                            <?= $_GET['id'] && $patient['gender'] == 'male' ? 'checked' : '' ?> >
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                               value="female"
                                            <?= $_GET['id'] && $patient['gender'] == 'female' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary"
                                            name="<?= $_GET['id'] ? 'patientUpdate' : 'patientRegistration' ?>">
                                        <?= $_GET['id'] ? 'Update' : 'Create' ?>
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
    removeCollapsed("patient-nav-links");
    navActive("patient-reg");

    function updateAge(dob) {
        document.getElementsByName("age")[0].value = ageCalculator(dob);
    }

    const dob = document.getElementsByName("date_of_birth")[0].value;
    if (dob) {
        updateAge(dob)
    }
</script>
</body>
</html>