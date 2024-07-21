<?php
require_once "../../../vendor/autoload.php";

use PatientManagementSolution\hospitals\HospitalController;
use PatientManagementSolution\hospitals\HospitalModel;
use PatientManagementSolution\patients\controller\PatientController;
use PatientManagementSolution\patients\PatientModel;
use PatientManagementSolution\surgeries\SurgeryController;
use PatientManagementSolution\surgeries\SurgeryDetailsController;

$patientController = new PatientController();
$surgeryController = new SurgeryController();
$patientModel = new PatientModel();
if (isset($_GET['patientId'])) {
    $patient = $patientController->findById($_GET['patientId']);
    $surgeryList = $surgeryController->findAllByPatientId($_GET['patientId']);
} else {
    echo "patient id is missing";
    die();
}
?>

<table>
    <tr>
        <td>Name</td>
        <td><?= htmlspecialchars($patient[$patientModel->name]) ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td><?= htmlspecialchars($patient[$patientModel->gender]) ?></td>
    </tr>
    <tr>
        <td>Mobile Number</td>
        <td><?= htmlspecialchars($patient[$patientModel->mobile_number]) ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?= htmlspecialchars($patient[$patientModel->address]) ?></td>
    </tr>
</table>

<?php require_once "../../surgeries/views/SurgeryAddView.php" ?>

<h3><?= htmlspecialchars($patient[$patientModel->name]) ?>'s all surgery </h3>

<?php
if (isset($_POST['save_surgery_details'])) {
    $surgeryDetailsController = new SurgeryDetailsController();
    $surgeryDetailsController->create($_POST['surgery_id']);
}
?>

<div>
    <p>Surgery Name: <?= htmlspecialchars($surgeryList[0]['name']) ?> </p>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="surgery_id" value="<?= htmlspecialchars($surgeryList[0]['id']) ?>" readonly> <br>
        <select name="hospital_id">
            <option>select hospital</option>
            <?php
            $hospitalController = new HospitalController();
            $hospitalModal = new HospitalModel();
            $data = $hospitalController->getAll();
            foreach ($data as $row):?>
                <option value="<?= htmlspecialchars($row[$hospitalModal->id]) ?>">
                    <?= htmlspecialchars($row[$hospitalModal->code]) ?>
                    - <?= htmlspecialchars($row[$hospitalModal->name]) ?>
                </option>
            <?php endforeach; ?>
        </select> <br>
        <input type="date" placeholder="select date" name="date"> <br>
        <textarea placeholder="Remarks" name="remarks"></textarea><br>
        <input type="file" name="before_images" placeholder="before images" accept="image/*"> <br>
        <input type="submit" name="save_surgery_details" value="Save">
    </form>
</div>
