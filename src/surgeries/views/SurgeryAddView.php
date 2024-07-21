<?php

use PatientManagementSolution\surgeries\SurgeryController;

require_once "../../../vendor/autoload.php";

if (isset($_POST['createSurgery'])){
   $surgeryController = new SurgeryController();
   $surgeryController->create();
}

?>

<h3>Add new surgery</h3>

<form method="post">
    <input type="text" name="surgery_name" value="test" placeholder="surgery name"> <br>
    <input type="submit" name="createSurgery" value="Create"> <br>
</form>