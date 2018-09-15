
create table student 
(
    ID int(20) primary key auto_increment,
    student_id int(20),
    student_lname varchar(20) not null,
    student_mname varchar(20),
    student_fname varchar(20) not null,
    student_gender varchar(10) not null,
    student_bdate date not null,
    student_bplace varchar(200),
    student_religion varchar(50),
    student_address_street varchar(50),
    student_address_municipality varchar(50),
    student_contact_number varchar(50),
    student_status varchar(20),
    student_spouse_name varchar(50),
    student_last_school_year_attended varchar(15) not null,
    student_mothers_name varchar(100),
    student_fathers_name varchar(100),
    student_mothers_occupation varchar(50),
    student_fathers_occupation varchar(50),
    student_guardian varchar(50),
    student_admission_date date
       
);

create table course
(
    ID int(20) primary key auto_increment,
    course_code varchar(20) not null,
    course_description varchar(50) not null,
    course_year varchar(10)
);

create table student_course
(
    student_id int(20) not null,
    course_id int(20) not null,
    student_course_dateCreated date,
    index(student_id),
    index(course_id),
    constraint PK_STUDENT_COURSE primary key(student_id,course_id),
    constraint FK_STUDENT_COURSE_STUDENT foreign key(student_id) references STUDENT(ID),
    constraint FK_STUDENT_COURSE_COURSE foreign key(course_id) references COURSE(ID)
);

create table subject
(
    ID int(20) primary key  auto_increment,
    subj_code varchar(20) not null,
    subj_description varchar(50) not null,
    subj_units_lec int(5),
    subj_units_lab int(5)
);

create table prospectus
(
    subj_id int(20) not null,
    course_id int(20) not null,
    prospectus_pre_requisites int(20),
    prospectus_yearlevel varchar(20),
    prospectus_term varchar(20),
    index(subj_id),
    index(course_id),
    constraint PK_PROSPECTUS primary key(subj_id,course_id),
    constraint FK_PROSPECTUS_SUBJECT foreign key(subj_id) references SUBJECT(ID),
    constraint FK_PROSPECTUS_COURSE foreign key(course_id) references COURSE(ID)  
);

create table room
(
    ID int(20) primary key auto_increment,
    room_building_name varchar(50),
    room_number varchar(10),
    room_capacity int(5)
);

create table instructor
(
    ID int(20) primary key auto_increment,
    instructor_name varchar(100) not null,
    instructor_address varchar(100) not null,
    instructor_position varchar(50) not null,
    instructor_specialization varchar(50) not null,
    instructor_employment_status varchar(50)
);

create table academicyear
(
    ID int(20) primary key auto_increment,
    academicyear_year varchar(10) not null,
    academicyear_term varchar(20) not null,
    academicyear_status varchar(20)
);



create table subjectoffering
(
    ID int(20) primary key auto_increment,
    academicyear_id int(20) not null,
    instructor_id int(20) not null,
    subj_id int(20) not null,
    room_id int(20) not null,
    subjectoffering_slots int(5),
    subjectoffering_section varchar(20),
    subjectoffering_timein varchar(10),
    subjectoffering_timeout varchar(10),
    subjectoffering_days varchar(10),
    index(academicyear_id),
    index(instructor_id),
    index(subj_id),
    index(room_id),
    constraint FK_SUBJECTOFFERING_SUBJECT foreign key(subj_id) references SUBJECT(ID),
    constraint FK_SUBJECTOFFERING_ROOM foreign key(room_id) references ROOM(ID),
    constraint FK_SUBJECTOFFERING_INSTRUCTOR foreign key(instructor_id) references INSTRUCTOR(ID),
    constraint FK_SUBJECTOFFERING_ACADEMICYEAR foreign key(academicyear_id) references ACADEMICYEAR(ID)
);


create table miscelleneous
(
    ID int(20) primary key auto_increment,
    miscelleneous_description varchar(20) not null,
    miscelleneous_amount double
);
create table tuition
(
    ID int(20) primary key auto_increment,
    tuition_description varchar(20) not null,
    tuition_amount double
);
create table mandatory
(
    ID int(20) primary key auto_increment,
    mandatory_description varchar(20) not null,
    mandatory_amount double
);

create table assessment
(
    ID int(20) primary key auto_increment,
    users_id int(11),
    student_id int(20) not null,
    academicyear_id int(20) not null,
    assessment_miscelleneous_amount double,
    assessment_mandatory_amount double,
    assessment_tuition_amount double,
    assessment_total double,
    assessment_amount_paid double,
    assessment_remarks varchar(20),
    index(users_id),
    index(student_id),
    index(academicyear_id),
    constraint FK_ASSESSMENT_STUDENT foreign key(student_id) references STUDENT(ID),
    constraint FK_ASSESSMENT_USERS foreign key(users_id) references USERS(id),
    constraint FK_ASSESSMENT_ACADEMICYEAR foreign key(academicyear_id) references ACADEMICYEAR(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



create table subjectenrolling
(
    ID int(20) primary key auto_increment,
    subjectoffering_id int(20) not null,
    student_id int(20) not null,
    users_id int(20) not null,
    assessment_id int(20) not null,
    index(subjectoffering_id),
    index(student_id),
    index(users_id),
    index(assessment_id),
    constraint FK_SUBJECTENROLLING_STUDENT foreign key(student_id) references STUDENT(ID),
    constraint FK_SUBJECTENROLLING_USERS foreign key(users_id) references USERS(ID),
    constraint FK_SUBJECTENROLLING_SUBJECTOFFERING foreign key(subjectoffering_id) references SUBJECTOFFERING(ID),
    constraint FK_SUBJECTENROLLING_ASSESSMENT foreign key(assessment_id) references ASSESSMENT(ID)
);

create table payment
(
    ID int(20) primary key auto_increment,
    assessment_id int(20) not null,
    payment_or_number int(25) not null,
    payment_amount double,
    payment_date date,
    index(assessment_id),
    constraint FK_PAYMENT_ASSESSMENT foreign key(assessment_id) references ASSESSMENT(ID)
);


create table miscelleneousfee
(
    assessment_id int(20) not null,
    miscelleneous_id int(20) not null,
    index(assessment_id),
    index(miscelleneous_id),
    constraint PK_MISCELLENEOUSFEE primary key(assessment_id,miscelleneous_id),
    constraint FK_MISCELLENEOUSFEE_ASSESSMENT foreign key(assessment_id) references ASSESSMENT(ID),
    constraint FK_MISCELLENEOUSFEE_MISCELLENEOUS foreign key(miscelleneous_id) references MISCELLENEOUS(ID)
);

create table mandatoryfee
(
    assessment_id int(20) not null,
    mandatory_id int(20) not null,
    index(assessment_id),
    index(mandatory_id),
    constraint PK_MANDATORYFEE primary key(assessment_id,mandatory_id),
    constraint FK_MANDATORYFEE_ASSESSMENT foreign key(assessment_id) references ASSESSMENT(ID),
    constraint FK_MANDATORYFEE_MANDATORY foreign key(mandatory_id) references MANDATORY(ID)
);

create table tuitionfee
(
    assessment_id int(20) not null,
    tuition_id int(20) not null,
    index(assessment_id),
    index(tuition_id),
    constraint PK_TUITIONFEE primary key(assessment_id,tuition_id),
    constraint FK_TUITIONFEE_ASSESSMENT foreign key(assessment_id) references ASSESSMENT(ID),
    constraint FK_TUITIONFEE_TUITION foreign key(tuition_id) references TUITION(ID)
);


CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `middle_name` varchar(20) NOT NULL,
  `position` varchar(50) NOT NULL,
  `employment_status` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
);
