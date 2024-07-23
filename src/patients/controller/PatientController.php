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
       return MySQLConnection::getConnection()
            ->execute($this->update_sql($id));
    }

    public function findById($id)
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from patients where id = $id;")[0];
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
                ":date_of_birth",
            ],
            [
                $r['name'],
                $r['gender'],
                $r['address'],
                $r['mobile_number'],
                $r['date_of_birth'],
            ],
            "
         INSERT INTO patients 
             (name, gender, address, mobile_number, date_of_birth, domain_status)
         VALUES (':name', ':gender', ':address', ':mobile_number', ':date_of_birth', 1);
        ");
    }

    /**
     * @param $id
     * @return string
     */
    private function update_sql($id): string
    {
        return "
            UPDATE patients t
                SET t.name          = '$_POST[name]',
                        t.gender        = '$_POST[gender]',
                        t.address       = '$_POST[address]',
                        t.mobile_number = '$_POST[mobile_number]',
                        t.date_of_birth = '$_POST[date_of_birth]'
                    WHERE t.id = $id;";
    }
}

