alter table surgery
    add name varchar(255) not null;

alter table surgery_details
    drop foreign key surgery_details_surgery_id_fk;

alter table surgery_details
    add constraint surgery_details_surgery_id_fk
        foreign key (surgery_id) references surgery (id);

alter table patients
    add date_of_birth date null;

alter table surgery_details
    modify date date not null;

create table if not exists file_upload
(
    id   int auto_increment,
    path varchar(250) not null,
    constraint file_upload_pk
        primary key (id)
);

alter table patients
    add if not exists image_path varchar(250) null;