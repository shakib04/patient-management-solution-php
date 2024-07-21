<?php

namespace PatientManagementSolution\hospitals;

use PatientManagementSolution\db\MySQLConnection;

class HospitalController
{
    public static $instance;

    public static function getInstance(): HospitalController
    {
        if (self::$instance === null) {
            self::$instance = new HospitalController();
        }
        return self::$instance;
    }

    public function save()
    {
        $mysql = $this->getMySQLConnection();
        $mysql->execute($this->insert_sql());
        $this->redirectToList();
    }

    public function update($id)
    {
        $this->getMySQLConnection()->execute($this->update_sql($id));
        $this->redirectToList();
        echo "updated";
    }

    public function delete($id)
    {

        $this->getMySQLConnection()->execute("DELETE FROM hospital WHERE id=$id");
        $this->redirectToList();
        echo "deleted";
    }

    public function findById(int $id)
    {
        $mysql = $this->getMySQLConnection();
        return $mysql->getColumnsValue("select * from hospital where id = " . $id)[0];
    }

    public function getAll(): array
    {
        $mysqli = $this->getMySQLConnection();
        return $mysqli->getColumnsValue("select * from hospital");
    }

    function insert_sql()
    {
        $r = $_POST;
        return str_replace(
            [
                ":name",
                ":code",
                ":branch",
                ":location",
            ],
            [
                $r['name'],
                $r['code'],
                $r['branch'],
                $r['location'],
            ],
            "INSERT INTO 
        hospital (name, code, branch, location)
        VALUES (':name', ':code', ':branch', ':location');");
    }

    function update_sql($id)
    {
        $r = $_POST;
        return str_replace(
            [
                ":id",
                ":name",
                ":code",
                ":branch",
                ":location",
            ],
            [
                $id,
                $r['name'],
                $r['code'],
                $r['branch'],
                $r['location'],
            ],
            "UPDATE hospital h
                SET h.name     = ':name',
                    h.code     = ':code',
                    h.branch   = ':branch',
                    h.location = ':location'
                WHERE h.id = ':id';
            ");
    }

    /**
     * @return MySQLConnection
     */
    public function getMySQLConnection(): MySQLConnection
    {
        return new MySQLConnection();
    }

    /**
     * @return void
     */
    public function redirectToList()
    {
        header("location:HospitalListView.php");
    }
}


