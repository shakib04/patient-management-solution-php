<?php

namespace PatientManagementSolution\patients\controller;

use PatientManagementSolution\db\MySQLConnection;

class PatientController
{
    public function save()
    {
        MySQLConnection::getConnection()
            ->execute($this->insert_sql());
    }

    public function getAll(): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from patients");
    }

    public function update($id)
    {

    }

    public function findById($id)
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from patients where id = " . $id)[0];
    }

    public function delete($id)
    {

    }

    /**
     * @return array|string|string[]
     */
    function insert_sql()
    {
        $r = $_POST;
        return str_replace(
            [
                ":name",
                ":gender",
                ":address",
                ":mobile_number",
            ],
            [
                $r['patientName'],
                $r['gender'],
                $r['address'],
                $r['mobile_number'],
            ],
            "
         INSERT INTO patients 
             (name, gender, address, mobile_number, domain_status)
         VALUES (':name', ':gender', ':address', ':mobile_number', 1);
        ");
    }
}

