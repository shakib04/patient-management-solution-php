<html lang="en">

<?php

use PatientManagementSolution\patients\controller\PatientController;

require_once "../../../vendor/autoload.php";
$controller = new PatientController();

require_once "../../headers/head.php"; ?>

<body>
<?php require_once "../../headers/nav-bar.php" ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Patients List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Patients</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient List</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>
                                    Patient Name
                                </th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Mobile Number</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $data = $controller->getAll();
                            foreach ($data as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['gender']) ?></td>
                                    <td><?= htmlspecialchars($row['address']) ?></td>
                                    <td><?= date_diff(new DateTime($row['date_of_birth']), new DateTime())->y ?></td>
                                    <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="PatientDetailsView.php?patientId=<?= htmlspecialchars($row['id']) ?>">Details</a>
                                        <a class="btn btn-secondary"
                                           href="PatientRegistrationView.php?id=<?= htmlspecialchars($row['id']) ?>">Edit</a>
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
    removeCollapsed("patient-nav-links");
    navActive("patient-list");
</script>
</body>

</html>



