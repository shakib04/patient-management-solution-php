<?php

require 'vendor/autoload.php';

use PatientManagementSolution\db\MySQLConnection;

$connection = new MySQLConnection();
$connection->connect();
?>

<!doctype html>
<html lang="en">
<?php require_once __DIR__ . '/src/headers/head.php' ?>
<body>

<h1>Patient Management Solution</h1>

<?php require_once __DIR__ . '/src/headers/nav-bar.php' ?>


<!--<h1>--><?php //echo $_SERVER['HTTP_HOST'] ?><!--</h1>-->

</body>
</html>
