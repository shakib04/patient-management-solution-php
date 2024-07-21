<?php

require_once "../../vendor/autoload.php";

use PatientManagementSolution\db\MySQLConnection;

$mysqli = new MySQLConnection();

$patient_table_create_sql =
    "    create table if not exists patients
(
    id            int auto_increment,
    name          varchar(100) not null,
    gender        varchar(15)  null,
    address       varchar(200) null,
    mobile_number varchar(20)  null,
    domain_status int not null,
    constraint patients_pk
        primary key (id)
);";

$success = $mysqli->execute($patient_table_create_sql);
if ($success) {
    echo "<h2>patient table created success!</h2>";
}


$hospital_table_create_sql =
    "create table if not exists hospital
(
    id       int auto_increment,
    name     varchar(250) not null,
    code     varchar(20)  not null,
    branch   varchar(100) null,
    location varchar(250) null,
    constraint hospital_pk
        primary key (id)
);";

$success = $mysqli->execute($hospital_table_create_sql);
if ($success) {
    echo "<h2>hospital table created success!</h2>";
}

$surgery_table_create_sql =
    "create table if not exists surgery
(
    id         int auto_increment,
    patient_id int not null,
    constraint surgery_pk
        primary key (id),
    constraint surgery_patients_id_fk
        foreign key (patient_id) references patients (id)
);";

$success = $mysqli->execute($surgery_table_create_sql);
if ($success) {
    echo "<h2>surgery table created success!</h2>";
}

$surgery_details_create_sql =
    "create table if not exists surgery_details
(
    id                        int auto_increment,
    surgery_id                int          not null,
    hospital_id               int          not null,
    before_surgery_images_csv varchar(100) null,
    after_surgery_images_csv  varchar(100) null,
    remarks                   text         null,
    date                      datetime     not null,
    surgery_type              int          null,
    domain_status             int          null,
    constraint surgery_details_pk
        primary key (id),
    constraint surgery_details_hospital_id_fk
        foreign key (hospital_id) references hospital (id),
    constraint surgery_details_surgery_id_fk
        foreign key (surgery_id) references hospital (id)
);

";

$success = $mysqli->execute($surgery_details_create_sql);
if ($success) {
    echo "<h2>surgery details table created success!</h2>";
}