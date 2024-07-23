<?php

namespace PatientManagementSolution\surgeries;

use PatientManagementSolution\db\MySQLConnection;
use PatientManagementSolution\file_upload\FileUploadController;

class SurgeryDetailsController
{
    public function create($surgery_id)
    {
        MySQLConnection::getConnection()
            ->execute($this->insert_sql($surgery_id));

        $this->fileUpload($_FILES['before_image']);
        $this->moveToPatientDetailsView();
    }

    public function addFile($id)
    {
        $path = $this->fileUpload($_FILES['before_image']);
        if ($path) {
            $fileUploadController = new FileUploadController();
            $file_upload_id = $fileUploadController->create($path);
            $existingIdCSV = $this->findById($id)['before_surgery_images_csv'];
            if ($existingIdCSV) {
                $existingIdCSV .= ",$file_upload_id";
            } else {
                $existingIdCSV = $file_upload_id;
            }

            return MySQLConnection::getConnection()
                ->execute("update surgery_details set before_surgery_images_csv = '$existingIdCSV' where id = $id");
        }
        return false;
    }

    function deleteFile($surgery_details_id)
    {
        $data = "abc,bcd,dff";
        var_dump(str_getcsv($data));
    }

    function createSurgeryFileDir($surgery_id)
    {
        if (!is_dir("../../files/surgeries/$surgery_id")) {
            shell_exec("mkdir \"../../files/surgeries/$surgery_id\"");
        }
        shell_exec("chmod 777 -R \"../../files/surgeries/\"");
    }

    function fileUpload($file)
    {
        if ($file) {
            //sleep(1);
            $filename = $file['name'];
            $file_type = strtolower(pathinfo(basename($filename), PATHINFO_EXTENSION));
            $dir = "../../files/surgeries/";
            $target_file = $dir . time() . "." . $file_type;
            $file_tmp_name = $file['tmp_name'];

            if (move_uploaded_file($file_tmp_name, $target_file)) {
                return $target_file;
            }
        }
        return false;
    }

    public function findBySurgeryId($surgery_id): array
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue("select * from surgery_details where surgery_id = $surgery_id");
    }

    public function findById($surgery_details_id)
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue(
                "select * from surgery_details where id=$surgery_details_id;")[0];
    }

    public function update($surgery_id)
    {
        MySQLConnection::getConnection()
            ->execute("UPDATE surgery_details t
                SET t.remarks = '$_POST[remarks]',
                    t.date    = '$_POST[date]'
                WHERE t.id = $surgery_id;
                ");
        $this->moveToPatientDetailsView();
    }

    public function delete($id)
    {
        MySQLConnection::getConnection()
            ->execute("DELETE FROM surgery_details where id = $id;");
        $this->moveToPatientDetailsView();
    }

    private function insert_sql($surgery_id): string
    {
        $remarks = $_POST['remarks'];
        $date = $_POST['date'];
        $surgery_type = $_POST['surgery_type'] ?? 1;

        return "INSERT INTO surgery_details (surgery_id, hospital_id, 
                             remarks, date, surgery_type, domain_status)
                VALUES ($surgery_id, $_POST[hospital_id], '$remarks', '$date', $surgery_type, 1);";
    }

    /**
     * @return void
     */
    public function moveToPatientDetailsView()
    {
        header("location:PatientDetailsView.php?patientId=$_GET[patientId]");
    }
}