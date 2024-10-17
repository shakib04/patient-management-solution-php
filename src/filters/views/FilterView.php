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
                       placeholder="search by surgery"
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


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Accordion without outline borders</h5>

            <!-- Accordion without outline borders -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
            </div><!-- End Accordion without outline borders -->

        </div>
    </div>

    <!-- Table with stripped rows -->
    <table class="table datatable">
        <thead>
        <tr>
            <th>Patient Name</th>
            <th>Surgery Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Age</th>
            <th>Mobile Number</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $filteredData = $filterController->filter($_GET[$input_names['surgery_name']]);
//        print_r($filteredData);die();
        foreach ($filteredData as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                <td><?= htmlspecialchars($row['surgery_name']) ?></td>
                <td><?= htmlspecialchars($row['gender']) ?></td>
                <td><?= htmlspecialchars($row['address']) ?></td>
                <td><?= date_diff(new DateTime($row['date_of_birth']), new DateTime())->y ?></td>
                <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                <td>
                    <a class="btn btn-primary"
                       href="<?=ROOT_URL?>/src/patients/views/PatientDetailsView.php?patientId=<?= htmlspecialchars($row['patient_id']) ?>">Details</a>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
</main>
<!-- End #main -->
<?php require_once "../../footers/footer.php" ?>
