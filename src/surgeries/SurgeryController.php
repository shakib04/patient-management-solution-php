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
       return MySQLConnection::getConnection()
            ->execute("update surgery set name = '$_POST[surgery_name]' where id = $id");
    }

    public function findAllByPatientId($patient_id): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue
            ("select * from surgery where patient_id = $patient_id order by id desc");
    }

    function insert_sql(): string
    {
        return "INSERT INTO surgery (patient_id, name)
                            VALUES ($_GET[patientId],'$_POST[surgery_name]');";
    }

    public function findById($surgeryId): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from surgery where id = " . $surgeryId)[0];
    }

    public function delete($surgeryId)
    {
        MySQLConnection::getConnection()
            ->execute("delete from surgery where id = $surgeryId");
    }
}