<html lang="en">

<?php

require_once "../../../vendor/autoload.php";

use PatientManagementSolution\hospitals\HospitalController;
use PatientManagementSolution\hospitals\HospitalModel;

$hospitalController = HospitalController::getInstance();
$hospitalModal = new HospitalModel();

if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $hospitalController->delete($_GET['id']);
}


require_once "../../headers/head.php"; ?>

<body>
<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Hospital List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Hospitals</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hospitals</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $data = $hospitalController->getAll();
                            foreach ($data as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row[$hospitalModal->code]) ?></td>
                                    <td><?= htmlspecialchars($row[$hospitalModal->name]) ?></td>
                                    <td><?= htmlspecialchars($row[$hospitalModal->branch]) ?>
                                        - <?= htmlspecialchars($row[$hospitalModal->location]) ?></td>
                                    <td>
                                        <a class="btn btn-secondary"
                                           href="HospitalAddView.php?id=<?= htmlspecialchars($row[$hospitalModal->id]) ?>">Edit</a>
                                        <a class="btn btn-danger"
                                           href="?delete=true&id=<?= htmlspecialchars($row[$hospitalModal->id]) ?>">Delete</a>
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

</main><!-- End #main -->

<?php require_once "../../footers/footer.php" ?>
<script>
    removeCollapsed("hospital-nav-links");
    navActive("hospital-list");
</script>
</body>

</html>



