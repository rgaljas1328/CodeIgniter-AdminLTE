

create view subjectofferingdetails as
select so.ID, so.academicyear_id, so.instructor_id, so.subj_id, so.room_id,
    so.subjectoffering_slots,
    so.subjectoffering_section,
    so.subjectoffering_timein,
    so.subjectoffering_timeout,
    so.subjectoffering_days,
    so.subjectoffering_status,
    i.instructor_name,
    i.instructor_address,
    i.instructor_position,
    i.instructor_gender,
    i.instructor_civil_status,
    i.instructor_email_address,
    i.instructor_specialization,
    i.instructor_employment_status,
    s.subj_code,
    s.subj_description,
    s.subj_units_lec,
    s.subj_units_lab,
    s.subj_prerequisite,
    r.room_building_name,
    r.room_number,
    r.room_capacity,
    a.academicyear_year,
    a.academicyear_term,
    a.academicyear_status
    from subjectoffering so
    inner join instructor i on so.instructor_id = i.ID
    inner join subject s on so.subj_id = s.ID
    inner join room r on so.room_id = r.ID
    inner join academicyear a on so.academicyear_id = a.ID;

CREATE VIEW student_courseDetails as 
select 
sc.course_id,
sc.student_course_dateCreated,
s.student_id,
s.ID,
concat(s.student_lname,', ',s.student_fname,' ', s.student_lname) as Name, 
c.course_code,
c.course_description,
c.course_year,
c.departmentid 
from student_course sc 
inner join student s on s.ID = sc.student_id
inner join course c on c.ID = sc.course_id;
    

create table controlling (
    ID int(20) primary key,
    student_id int(20) not null,
    academicyear_id int(20) not null,
    course_id int(20) not null,
    controlling_date date not null,
    controlling_status varchar(50) not NULL,
    index(student_id),
    index(academicyear_id),
    constraint FK_CONTROLLING_STUDENT foreign key(student_id) references STUDENT(ID),
    constraint FK_CONTROLLING_ACADEMICYEAR foreign key(academicyear_id) references ACADEMICYEAR(ID)
);