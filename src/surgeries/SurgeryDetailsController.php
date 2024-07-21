<?php

namespace PatientManagementSolution\surgeries;

use PatientManagementSolution\db\MySQLConnection;

class SurgeryDetailsController
{
    public function create($surgery_id)
    {
//        echo MySQLConnection::getConnection()
//            ->execute($this->insert_sql($surgery_id));
        echo time() . "<br>";
        sleep(1);
        echo time();
        if (!is_dir("../../files/surgeries/$surgery_id")) {
            shell_exec("mkdir \"../../files/surgeries/$surgery_id\"");
        }
        shell_exec("chmod 777 -R \"../../files/surgeries/\"");
    }

    function deleteFile($surgery_details_id)
    {
        $data = "abc,bcd,dff";
        var_dump(str_getcsv($data));
    }

    function fileUpload()
    {
        $filename = $_FILES['before_images']['name'];
        $file_type = strtolower(pathinfo(basename($filename), PATHINFO_EXTENSION));
        $dir = "../../files/surgeries/";
        $customName = "before";
        $sql = "insert into $customName";
        $target_file = $dir . time() . "." . $file_type;
        $file_tmp_name = $_FILES['before_images']['tmp_name'];

        if (move_uploaded_file($file_tmp_name, $target_file)) {
            echo "moved";
            return $target_file;
        }
        return false;
    }

    public function findBySurgeryId($surgery_id)
    {

    }

    public function findById($surgery_details_id)
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue(
                "select * from surgery_details where id=$surgery_details_id;")[0];
    }

    public function update($surgery_id)
    {

    }

    public function delete($id)
    {

    }

    private function insert_sql($surgery_id): string
    {
        $r = $_POST;
        $hospital_id = $_POST['hospital_id'];
        $remarks = $_POST['remarks'];
        $date = $_POST['date'];
        $surgery_type = $_POST['surgery_type'] ?? 1;

        return "INSERT INTO surgery_details (surgery_id, hospital_id, 
                             remarks, date, surgery_type, domain_status)
                VALUES ($surgery_id, $hospital_id, '$remarks', '$date', $surgery_type, 1);";
    }
}