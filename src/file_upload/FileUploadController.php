<?php

namespace PatientManagementSolution\file_upload;

use PatientManagementSolution\db\MySQLConnection;

class FileUploadController
{
    function create($path)
    {
        $execution = MySQLConnection::getConnection()
            ->execute("INSERT INTO file_upload (path)
                        VALUES ('$path');");
        if ($execution) {
            return MySQLConnection::getConnection()
                ->getColumnsValue("select id from file_upload order by id desc limit 1")[0]['id'];
        }
        return $execution;
    }

    function getPathArray($idCSV): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select path from file_upload where id in ($idCSV)");
    }

    function delete($id)
    {
        MySQLConnection::getConnection()
            ->execute("delete from file_upload where id = $id");
    }

}