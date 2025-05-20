<?php
require_once "../../../vendor/autoload.php";

use PatientManagementSolution\patients\controller\PatientController;
use PatientManagementSolution\patients\PatientModel;
use PatientManagementSolution\surgeries\SurgeryController;
use PatientManagementSolution\surgeries\SurgeryDetailsController;

$patientController = new PatientController();
$surgeryController = new SurgeryController();
$surgeryDetailsController = new SurgeryDetailsController();
$patientModel = new PatientModel();
if (isset($_GET['patientId'])) {
    $patient = $patientController->findById($_GET['patientId']);
    $surgeryList = $surgeryController->findAllByPatientId($_GET['patientId']);
} else {
    echo "patient id is missing";
    die();
}

if (isset($_GET['delete']) && $_GET['delete'] == "true"
    && isset($_GET['surgeryDetailsId'])) {
    $surgeryDetailsController->delete($_GET['surgeryDetailsId']);
}
$deleteSurgery = isset($_GET['surgeryId']) &&
    isset($_GET['deleteSurgery']) && $_GET['deleteSurgery'] == 'true';

if ($deleteSurgery) {
    $surgeryController->delete($_GET['surgeryId']);
    header("location:?patientId=$_GET[patientId]");
}

?>

<html lang="en">
<?php require_once "../../headers/head.php"; ?>

<body>
<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Patient Details</h5>

            <!-- Card with an image on top -->
            <div class="card">
                <div class="card-body">
                    <figure>
                        <?php if ($patient[$patientModel->image_path]): ?>
                            <img src="<?= htmlspecialchars($patient[$patientModel->image_path]) ?>" width="350" class="img-thumbnail" alt="<?= htmlspecialchars($patient[$patientModel->name]) ?>'s image">
                        <?php else: ?>
                            <img src="../../files/No-Image-Placeholder.png" width="200" class="img-thumbnail" alt="<?= htmlspecialchars($patient[$patientModel->name]) ?>'s image">
                        <?php endif; ?>
                        <figcaption>Patient Image</figcaption>
                    </figure>
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <td><?= htmlspecialchars($patient[$patientModel->name]) ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Mobile Number</td>
                            <td><?= htmlspecialchars($patient[$patientModel->mobile_number]) ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= htmlspecialchars($patient[$patientModel->gender]) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age</th>
                            <td><?= date_diff(new DateTime($patient['date_of_birth']), new DateTime())->y ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?= htmlspecialchars($patient[$patientModel->address]) ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div><!-- End Card with an image on top -->



        </div>
    </div>

    <!-- Basic Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Basic Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="surgeryId"></div>
                    Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit.
                    Placeat
                    autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet
                    incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic Modal-->

    <!--    --><?php //if ($surgeryUpdate): ?>
    <!--        --><?php //require_once "../../surgeries/views/SurgeryAddView.php" ?>
    <!--    --><?php //endif; ?>

    <h3><?= htmlspecialchars($patient[$patientModel->name]) ?>'s all surgery </h3>
    <?php foreach ($surgeryList

                   as $surgeryRow): ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surgery Details: </h5>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><?= htmlspecialchars($surgeryRow['name']) ?></td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm"
                                           href="../../surgeries/views/SurgeryAddView.php?patientId=<?= $_GET['patientId'] ?>&updateSurgery=true&surgeryId=<?= $surgeryRow['id'] ?>">
                                            Update
                                        </a>
                                        <?php $surgeryDetailsList = $surgeryDetailsController->findBySurgeryId($surgeryRow['id']); ?>
                                        <?php if (!$surgeryDetailsList): ?>
                                            <a class="btn btn-danger btn-sm"
                                               onclick=deleteConfirmation("?patientId=<?= $_GET['patientId'] ?>&deleteSurgery=true&surgeryId=<?= $surgeryRow['id'] ?>")>
                                                Delete
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                </thead>
                            </table>

                            <a href="PatientSurgeryDetailsAddView.php?patientId=<?= $_GET['patientId'] ?>&surgeryId=<?= $surgeryRow['id'] ?>"
                               class="btn btn-primary">
                                Add History for `<?= htmlspecialchars($surgeryRow['name']) ?>`
                            </a>
                            <h5 class="card-title">::Histories of <?= $surgeryRow['name'] ?>::</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($surgeryDetailsList as $surgeryDetailsRow): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($surgeryDetailsRow['date']) ?></td>
                                        <td><?= htmlspecialchars($surgeryDetailsRow['remarks']) ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                               href="../../surgeries/views/SurgeryDetailsIndividualView.php?patientId=<?= htmlspecialchars($patient[$patientModel->id]) ?>&surgeryDetailsId=<?= htmlspecialchars($surgeryDetailsRow['id']) ?>">Details</a>
                                            <a class="btn btn-sm btn-secondary"
                                               href="PatientSurgeryDetailsAddView.php?patientId=<?= $_GET['patientId'] ?>&surgeryId=<?= $surgeryRow['id'] ?>&surgeryDetailsId=<?= htmlspecialchars($surgeryDetailsRow['id']) ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                               onclick=deleteConfirmation("?patientId=<?= $_GET['patientId'] ?>&delete=true&surgeryDetailsId=<?= htmlspecialchars($surgeryDetailsRow['id']) ?>")>Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

    <a class="btn btn-primary"
       href="../../surgeries/views/SurgeryAddView.php?patientId=<?= $_GET['patientId'] ?>">
        Create New Surgery
    </a>
    <!--    --><?php //if (!$surgeryUpdate): ?>
    <!--        --><?php //require_once "../../surgeries/views/SurgeryAddView.php" ?>
    <!--    --><?php //endif; ?>

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


