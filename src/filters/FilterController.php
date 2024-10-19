<?php

namespace PatientManagementSolution\filters;

use PatientManagementSolution\db\MySQLConnection;

class FilterController
{
    public function filter($surgery_name)
    {
        return MySQLConnection::getConnection()
            ->getColumnsValue($this->getSql($surgery_name));
    }

    /**
     * @param $patient_name
     * @return string
     */
    public function getSql($patient_name): string
    {
        return "select p.name as patient_name, s.name as surgery_name, 
       p.date_of_birth, p.address, p.gender, p.mobile_number, p.domain_status, p.image_path,
       p.id as patient_id, s.id as surgery_id
                from patients p
                inner join surgery s on p.id = s.patient_id
                where s.name like '%$patient_name%'
                order by s.id desc";
    }

}