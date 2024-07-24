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
        if ($idCSV) {
            return MySQLConnection::getConnection()
                ->getColumnsValue("select * from file_upload where id in ($idCSV)");
        }
        return [];
    }

    function delete($id)
    {
        $path = $this->findById($id)['path'];
        shell_exec("rm \"../../files/surgeries/$path\"");
        MySQLConnection::getConnection()
            ->execute("delete from file_upload where id = $id");
    }

    function findById($id)
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from file_upload where id = $id")[0];
    }

    function remove_id($idsInCSV, $removalId): string
    {
        $array = explode(",", $idsInCSV);

        // Find the key of the element to remove
        $key = array_search($removalId, $array);

        if ($key !== false) {
            // Remove the element from the array
            unset($array[$key]);
        }

        // Re-index the array to ensure the keys are in a proper sequence
        $array = array_values($array);

        // Convert the array back to a string
        return implode(",", $array);
    }

}