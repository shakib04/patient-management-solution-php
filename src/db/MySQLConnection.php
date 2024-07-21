<?php

namespace PatientManagementSolution\db;

use mysqli;
use RuntimeException;

class MySQLConnection
{

    public static function getConnection(): MySQLConnection
    {
        return new MySQLConnection();
    }

    public function connect(): mysqli
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host == "localhost") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "patient_management_solution";
        } else if ($host == "patients-management.free.nf") {
            $servername = "sql113.infinityfree.com";
            $username = "if0_36784300";
            $password = "2LvCp7gPur5";
            $database = "if0_36784300_patient_management_solution";
        } else {
            $servername = "localhost";
            $username = "id19593044_root";
            $password = "Shakibul@1";
            $database = "if0_36784300_patient_management_solution";
        }

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function execute($sql)
    {
        try {
            $connection = $this->connect();
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            return $result;
        } catch (RuntimeException $ex) {
            echo "<h1>SQL Exception Occurred</h1>";
            echo "<ol>";
            echo "<li>failed to execute, sql: <em><strong>" . $sql . "</strong></em></li>";
            echo "<li>" . $ex->getMessage() . "</li>";
            echo ("<li style='overflow: scroll'>Exception details: <pre>$ex</pre></li>");
            echo "</ol>";
            die();
        }
    }

    public function getColumnsValue($sql): array
    {
        $data = [];
        $connection = $this->connect();
        $result = mysqli_query($connection, $sql);
        mysqli_close($connection);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}