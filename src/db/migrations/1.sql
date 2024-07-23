alter table surgery_details
    drop foreign key surgery_details_surgery_id_fk;

alter table surgery_details
    add constraint surgery_details_surgery_id_fk
        foreign key (surgery_id) references surgery (id);

alter table patients
    add date_of_birth date null;