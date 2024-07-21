<?php

namespace PatientManagementSolution\surgeries;

use PatientManagementSolution\db\MySQLConnection;

class SurgeryController
{

    public function create()
    {
        MySQLConnection::getConnection()
            ->execute($this->insert_sql());
    }

    public function update($id)
    {

    }

    public function findAllByPatientId($patient_id): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from surgery where patient_id = " . $patient_id);
    }

    function insert_sql()
    {
        $r = $_POST;
        return str_replace(
            [
                ":patient_id",
                ":name",
            ],
            [
                $_GET['patientId'],
                $r['surgery_name'],
            ],
            "INSERT INTO surgery (patient_id, name)
                            VALUES (:patient_id, ':name');");
    }
}