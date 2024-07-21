<html lang="en">

<?php
require_once "../../../vendor/autoload.php";

use PatientManagementSolution\patients\controller\PatientController;

require_once "../../headers/head.php";

if (isset($_POST['patientRegistration'])) {
    $controller = new PatientController();
    $controller->save();
}

?>

<title>Create new Patient</title>
<body>

<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>New Patient Registration</h1>
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
                        <h5 class="card-title">Add New Patients</h5>

                        <!-- General Form Elements -->
                        <form method="post" action="">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="patientName">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Mobile Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mobile_number">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Patient Image Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date of Birth</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control">
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
                                               value="male" checked>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                               value="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="patientRegistration">
                                        Save
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
</script>
</body>
</html>