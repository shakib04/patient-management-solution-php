<?php

namespace PatientManagementSolution\patients\controller;

use PatientManagementSolution\db\MySQLConnection;

class PatientController
{
    public function save()
    {
        $image_path = null;
        if ($_FILES['image']){
            $image_path = $this->fileUpload($_FILES['image']);
        }
        MySQLConnection::getConnection()
            ->execute($this->insert_sql($image_path));
    }

    public function getAll(): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from patients");
    }

    public function update($id)
    {
       $image_path = null;
       if ($_FILES['image']){
           $image_path = $this->fileUpload($_FILES['image']);
       }
       return MySQLConnection::getConnection()
            ->execute($this->update_sql($id, $image_path));
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
    function insert_sql($image_path)
    {
        $r = $_POST;
        return str_replace(
            [
                ":name",
                ":gender",
                ":address",
                ":mobile_number",
                ":date_of_birth",
                ":image_path",
            ],
            [
                $r['name'],
                $r['gender'],
                $r['address'],
                $r['mobile_number'],
                $r['date_of_birth'],
                $image_path,
            ],
            "
         INSERT INTO patients 
             (name, gender, address, mobile_number, date_of_birth, image_path, domain_status)
         VALUES (':name', ':gender', ':address', ':mobile_number', ':date_of_birth', ':image_path',1);
        ");
    }

    function fileUpload($file)
    {
        if ($file) {
            //sleep(1);
            $filename = $file['name'];
            $file_type = strtolower(pathinfo(basename($filename), PATHINFO_EXTENSION));
            $dir = "../../files/patients/";
            $target_file = $dir . time() . "." . $file_type;
            $file_tmp_name = $file['tmp_name'];

            if (move_uploaded_file($file_tmp_name, $target_file)) {
                return $target_file;
            }
        }
        return false;
    }

    /**
     * @param $id
     * @return string
     */
    private function update_sql($id, $image_path): string
    {
        $imageUpdateSql = "";
        if ($image_path) {
            $imageUpdateSql = ", image_path = '$image_path'";
        }
        $dateOfBirthSql = "";
        if ($_POST['date_of_birth']) {
            $dateOfBirthSql = ", date_of_birth = '$_POST[date_of_birth]'";
        }
        return "
            UPDATE patients 
                SET name          = '$_POST[name]',
                        gender        = '$_POST[gender]',
                        address       = '$_POST[address]',
                        mobile_number = '$_POST[mobile_number]'
                        $dateOfBirthSql
                        $imageUpdateSql
                    WHERE id = $id;";
    }
}

