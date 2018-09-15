-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2018 at 08:42 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icenrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `ID` int(20) NOT NULL,
  `academicyear_year` varchar(20) NOT NULL,
  `academicyear_term` varchar(20) NOT NULL,
  `academicyear_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`ID`, `academicyear_year`, `academicyear_term`, `academicyear_status`) VALUES
(39, '2018-2019', 'Second Semester', 'Inactive'),
(40, '2018-2019', 'First Semester', 'Inactive'),
(41, '2018-2019', 'First Semester', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `admin_preferences`
--

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `ID` int(20) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `student_id` int(20) NOT NULL,
  `academicyear_id` int(20) NOT NULL,
  `assessment_miscelleneous_amount` double DEFAULT NULL,
  `assessment_mandatory_amount` double DEFAULT NULL,
  `assessment_tuition_amount` double DEFAULT NULL,
  `assessment_total` double DEFAULT NULL,
  `assessment_amount_paid` double DEFAULT NULL,
  `assessment_remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `controlling`
--

CREATE TABLE `controlling` (
  `ID` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `academicyear_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `controlling_date` date NOT NULL,
  `controlling_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `ID` int(20) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_description` varchar(200) NOT NULL,
  `course_year` varchar(10) DEFAULT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `course_code`, `course_description`, `course_year`, `departmentid`) VALUES
(6, 'BS-IT', 'Bachelor of Science in Information Technology major in Database Systems', '2024', 1),
(7, 'BS-Mathematics', 'LL', '2019-2020', 9);

-- --------------------------------------------------------

--
-- Stand-in structure for view `coursedetails`
-- (See below for the actual view)
--
CREATE TABLE `coursedetails` (
`course_code` varchar(20)
,`course_description` varchar(200)
,`course_year` varchar(10)
,`ID` int(20)
,`departmentid` int(11)
,`Department` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `Department` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `Department`) VALUES
(1, 'Department of Information Technology'),
(9, 'Department of Education');

-- --------------------------------------------------------

--
-- Table structure for table `dept_chairperson`
--

CREATE TABLE `dept_chairperson` (
  `userid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'admin', 'Administrator', '#9c27b0'),
(2, 'TBA', 'To Be Assign', '#795548'),
(3, 'registrar', 'Registrar', '#607D8B'),
(4, 'assessor', 'Assessor', '#607D8B'),
(5, 'chairman', 'Administrator', '#607d8b');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `ID` int(20) NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `instructor_address` varchar(100) NOT NULL,
  `instructor_position` varchar(50) NOT NULL,
  `instructor_gender` varchar(50) NOT NULL,
  `instructor_civil_status` varchar(50) NOT NULL,
  `instructor_email_address` varchar(100) NOT NULL,
  `instructor_specialization` varchar(50) NOT NULL,
  `instructor_employment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`ID`, `instructor_name`, `instructor_address`, `instructor_position`, `instructor_gender`, `instructor_civil_status`, `instructor_email_address`, `instructor_specialization`, `instructor_employment_status`) VALUES
(1, 'Reymond G. Aljas', 'Naawan, Misamis Oriental', 'ICT - incharge', 'Male', 'Single', 'abuseropaw@gmail.com', 'Information Technology', 'Active'),
(2, 'Christine F. Gonzales', 'Lugait, Misamis Oriental', 'ICT - incharge', 'Female', 'Single', 'abuseropaw@gmail.com', 'Information Technology', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mandatory`
--

CREATE TABLE `mandatory` (
  `ID` int(20) NOT NULL,
  `mandatory_description` varchar(20) NOT NULL,
  `mandatory_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mandatory`
--

INSERT INTO `mandatory` (`ID`, `mandatory_description`, `mandatory_amount`) VALUES
(1, 'Tae nako', 1001),
(3, 'asdasd', 113);

-- --------------------------------------------------------

--
-- Table structure for table `mandatoryfee`
--

CREATE TABLE `mandatoryfee` (
  `assessment_id` int(20) NOT NULL,
  `mandatory_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `miscelleneous`
--

CREATE TABLE `miscelleneous` (
  `ID` int(20) NOT NULL,
  `miscelleneous_description` varchar(20) NOT NULL,
  `miscelleneous_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `miscelleneous`
--

INSERT INTO `miscelleneous` (`ID`, `miscelleneous_description`, `miscelleneous_amount`) VALUES
(1, 'Laboratory Fee', 250);

-- --------------------------------------------------------

--
-- Table structure for table `miscelleneousfee`
--

CREATE TABLE `miscelleneousfee` (
  `assessment_id` int(20) NOT NULL,
  `miscelleneous_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(20) NOT NULL,
  `assessment_id` int(20) NOT NULL,
  `payment_or_number` int(25) NOT NULL,
  `payment_amount` double DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prospectus`
--

CREATE TABLE `prospectus` (
  `subj_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `prospectus_pre_requisites` int(20) DEFAULT NULL,
  `prospectus_yearlevel` varchar(20) DEFAULT NULL,
  `prospectus_term` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prospectus`
--

INSERT INTO `prospectus` (`subj_id`, `course_id`, `prospectus_pre_requisites`, `prospectus_yearlevel`, `prospectus_term`) VALUES
(10, 6, NULL, 'First Year', 'First Semester'),
(11, 6, NULL, 'First Year', 'First Semester'),
(12, 6, NULL, 'First Year', 'First Semester'),
(12, 7, NULL, 'First Year', 'First Semester'),
(13, 6, NULL, 'First Year', 'First Semester'),
(14, 6, NULL, 'First Year', 'First Semester'),
(15, 6, NULL, 'First Year', 'First Semester'),
(16, 6, NULL, 'First Year', 'First Semester'),
(17, 6, NULL, 'First Year', 'First Semester'),
(18, 6, 11, 'First Year', 'Second Semester'),
(19, 6, 18, 'First Year', 'Second Semester'),
(20, 6, 12, 'First Year', 'Second Semester'),
(20, 7, 12, 'Second Year', 'First Semester'),
(21, 6, 22, 'First Year', 'Second Semester'),
(22, 6, 16, 'First Year', 'Second Semester'),
(23, 6, 10, 'First Year', 'Second Semester'),
(24, 6, 17, 'First Year', 'Second Semester');

-- --------------------------------------------------------

--
-- Stand-in structure for view `prospectusdetails`
-- (See below for the actual view)
--
CREATE TABLE `prospectusdetails` (
`subj_id` int(20)
,`course_id` int(20)
,`prospectus_pre_requisites` int(20)
,`prospectus_yearlevel` varchar(20)
,`prospectus_term` varchar(20)
,`course_code` varchar(20)
,`course_description` varchar(200)
,`course_year` varchar(10)
,`subj_code` varchar(20)
,`subj_description` varchar(50)
,`subj_units_lec` int(5)
,`subj_units_lab` int(5)
,`Prerequisite` varchar(71)
);

-- --------------------------------------------------------

--
-- Table structure for table `public_preferences`
--

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL,
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `public_preferences`
--

INSERT INTO `public_preferences` (`id`, `transition_page`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ID` int(20) NOT NULL,
  `room_building_name` varchar(50) DEFAULT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `room_capacity` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ID`, `room_building_name`, `room_number`, `room_capacity`) VALUES
(10, 'DIT', '202', 50),
(11, 'DIT', '201', 55);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(20) NOT NULL,
  `student_id` int(20) DEFAULT NULL,
  `student_lname` varchar(20) NOT NULL,
  `student_mname` varchar(20) DEFAULT NULL,
  `student_fname` varchar(20) NOT NULL,
  `student_gender` varchar(10) NOT NULL,
  `student_bdate` date NOT NULL,
  `student_bplace` varchar(200) DEFAULT NULL,
  `student_religion` varchar(50) DEFAULT NULL,
  `student_address_street` varchar(50) DEFAULT NULL,
  `student_address_municipality` varchar(50) DEFAULT NULL,
  `student_address_barangay` varchar(100) NOT NULL,
  `student_address_province` varchar(100) NOT NULL,
  `student_contact_number` varchar(50) DEFAULT NULL,
  `student_status` varchar(20) DEFAULT NULL,
  `student_spouse_name` varchar(50) DEFAULT NULL,
  `student_last_school_year_attended` varchar(100) NOT NULL,
  `student_mothers_name` varchar(100) DEFAULT NULL,
  `student_fathers_name` varchar(100) DEFAULT NULL,
  `student_mothers_occupation` varchar(50) DEFAULT NULL,
  `student_fathers_occupation` varchar(50) DEFAULT NULL,
  `student_guardian` varchar(50) DEFAULT NULL,
  `student_admission_date` date DEFAULT NULL,
  `student_picture` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `student_id`, `student_lname`, `student_mname`, `student_fname`, `student_gender`, `student_bdate`, `student_bplace`, `student_religion`, `student_address_street`, `student_address_municipality`, `student_address_barangay`, `student_address_province`, `student_contact_number`, `student_status`, `student_spouse_name`, `student_last_school_year_attended`, `student_mothers_name`, `student_fathers_name`, `student_mothers_occupation`, `student_fathers_occupation`, `student_guardian`, `student_admission_date`, `student_picture`) VALUES
(8, 1008002, 'asd', 'asd', 'asda', 'Female', '2018-08-22', 'Naawan, Misamis Oriental', 'Roman Catholic', 'Pedro Pagalan St., Purok - 4, Poblacion', 'Naawan', 'Poblacion', 'Misamis Oriental', '09090649289', 'Single', 'Christine Gonzales', 'Mindanao State University at Naawan', 'Cecilia Aljas', 'Beinvenido Aljas', 'Fish Vendor', 'Hatchery Tech', 'Amaw', '2018-08-04', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `studentdetails`
-- (See below for the actual view)
--
CREATE TABLE `studentdetails` (
`ID` int(20)
,`student_id` int(20)
,`FullName` varchar(63)
);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `student_course_dateCreated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_id`, `student_course_dateCreated`) VALUES
(8, 6, '2018-08-04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_coursedetails`
-- (See below for the actual view)
--
CREATE TABLE `student_coursedetails` (
`course_id` int(20)
,`student_course_dateCreated` date
,`student_id` int(20)
,`ID` int(20)
,`Name` varchar(63)
,`course_code` varchar(20)
,`course_description` varchar(200)
,`course_year` varchar(10)
,`departmentid` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `ID` int(20) NOT NULL,
  `subj_code` varchar(20) NOT NULL,
  `subj_description` varchar(50) NOT NULL,
  `subj_units_lec` int(5) DEFAULT NULL,
  `subj_units_lab` int(5) DEFAULT NULL,
  `subj_prerequisite` int(15) NOT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`ID`, `subj_code`, `subj_description`, `subj_units_lec`, `subj_units_lab`, `subj_prerequisite`, `departmentid`) VALUES
(10, 'NSTP 1', 'National Service Training Program I', 3, 0, 0, 1),
(11, 'Eng 3', 'Speech Communication', 3, 0, 0, 1),
(12, 'PE 1', 'Physical Fitness and Health', 2, 0, 0, 1),
(13, 'Eng 1', 'Study and Thinking Skills', 3, 0, 0, 1),
(14, 'Fil 1', 'Sining ng Komunikasyon', 3, 0, 0, 1),
(15, 'Hist 1', 'Philippine History', 3, 0, 0, 1),
(16, 'CSc 100', 'Fundamentals of Computing', 3, 1, 0, 1),
(17, 'Math 17', 'Algebra and Trigonometry', 6, 0, 0, 1),
(18, 'Eng 2', 'Writing in the Discipline', 3, 0, 0, 1),
(19, 'Psych 20', 'Business Pyschology', 3, 0, 0, 1),
(20, 'PE 2', 'Martial Arts/Dance', 2, 0, 0, 1),
(21, 'Bio 1', 'Basic Biology', 3, 0, 0, 1),
(22, 'CSc 101N', 'Computer Programming I', 3, 0, 0, 1),
(23, 'NSTP (CWTS) 2', 'NSTP - Civic Welfare Training Service II', 3, 0, 0, 1),
(24, 'Math 51', 'Analytic Geometry and Calculus I', 6, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjectcrediting`
--

CREATE TABLE `subjectcrediting` (
  `subj_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `subjectcrediting_grade` varchar(15) NOT NULL,
  `subjectcrediting_taken` int(2) NOT NULL,
  `creditedBy` int(20) NOT NULL,
  `dateofCredit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjectcrediting`
--

INSERT INTO `subjectcrediting` (`subj_id`, `student_id`, `subjectcrediting_grade`, `subjectcrediting_taken`, `creditedBy`, `dateofCredit`) VALUES
(13, 8, '2', 1, 1, '2018-08-07'),
(14, 8, '1', 3, 1, '2018-08-07'),
(15, 8, '5', 1, 1, '2018-08-07'),
(16, 8, '1', 1, 1, '2018-08-07');

-- --------------------------------------------------------

--
-- Stand-in structure for view `subjectcreditingdetails`
-- (See below for the actual view)
--
CREATE TABLE `subjectcreditingdetails` (
`subj_id` int(20)
,`student_id` int(20)
,`subjectcrediting_grade` varchar(15)
,`subjectcrediting_taken` int(2)
,`creditedBy` int(20)
,`dateofCredit` date
,`subj_code` varchar(20)
,`subj_description` varchar(50)
,`FullName` varchar(63)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `subjectdetails`
-- (See below for the actual view)
--
CREATE TABLE `subjectdetails` (
`ID` int(20)
,`subj_code` varchar(20)
,`subj_description` varchar(50)
,`subj_units_lec` int(5)
,`subj_units_lab` int(5)
,`subj_prerequisite` int(15)
,`departmentid` int(11)
,`Department` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `subjectenrolling`
--

CREATE TABLE `subjectenrolling` (
  `ID` int(20) NOT NULL,
  `subjectoffering_id` int(20) NOT NULL,
  `users_id` int(20) NOT NULL,
  `controlling_id` int(20) NOT NULL,
  `subjectenrolling_grade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subjectoffering`
--

CREATE TABLE `subjectoffering` (
  `ID` int(20) NOT NULL,
  `academicyear_id` int(20) DEFAULT NULL,
  `instructor_id` int(20) NOT NULL,
  `subj_id` int(20) NOT NULL,
  `room_id` int(20) NOT NULL,
  `subjectoffering_slots` int(5) DEFAULT NULL,
  `subjectoffering_section` varchar(20) DEFAULT NULL,
  `subjectoffering_timein` time DEFAULT NULL,
  `subjectoffering_timeout` time DEFAULT NULL,
  `subjectoffering_days` varchar(10) DEFAULT NULL,
  `subjectoffering_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `subjectofferingdetails`
-- (See below for the actual view)
--
CREATE TABLE `subjectofferingdetails` (
`ID` int(20)
,`academicyear_id` int(20)
,`instructor_id` int(20)
,`subj_id` int(20)
,`room_id` int(20)
,`subjectoffering_slots` int(5)
,`subjectoffering_section` varchar(20)
,`subjectoffering_timein` time
,`subjectoffering_timeout` time
,`subjectoffering_days` varchar(10)
,`subjectoffering_status` varchar(50)
,`instructor_name` varchar(100)
,`instructor_address` varchar(100)
,`instructor_position` varchar(50)
,`instructor_gender` varchar(50)
,`instructor_civil_status` varchar(50)
,`instructor_email_address` varchar(100)
,`instructor_specialization` varchar(50)
,`instructor_employment_status` varchar(50)
,`subj_code` varchar(20)
,`subj_description` varchar(50)
,`subj_units_lec` int(5)
,`subj_units_lab` int(5)
,`subj_prerequisite` int(15)
,`room_building_name` varchar(50)
,`room_number` varchar(10)
,`room_capacity` int(5)
,`academicyear_year` varchar(20)
,`academicyear_term` varchar(20)
,`academicyear_status` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `tuition`
--

CREATE TABLE `tuition` (
  `ID` int(20) NOT NULL,
  `tuition_description` varchar(20) NOT NULL,
  `tuition_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tuition`
--

INSERT INTO `tuition` (`ID`, `tuition_description`, `tuition_amount`) VALUES
(1, 'SubjectsTuition', 250),
(5, 'asd', 123);

-- --------------------------------------------------------

--
-- Table structure for table `tuitionfee`
--

CREATE TABLE `tuitionfee` (
  `assessment_id` int(20) NOT NULL,
  `tuition_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `middle_name`, `position`, `employment_status`, `address`, `specialization`, `type`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$xaqVLAcWmATSqPiWHGTWn.oFHYxTeSEI4jzaOaA1pxDnVl8.xib06', '', 'admin@admin.com', '', NULL, NULL, 'SqLf9PmqMU99/wRoTvqMwO', 1268889823, 1533674176, 1, 'Reymond', 'Aljas', 'ADMIN', '09090649289', '', '', '', '', '', 'ADMIN'),
(2, '127.0.0.1', 'administrator', '$2y$08$UpR5/zyYKgPNWThldAdyp.Pd1W5pwm3CqFRyfoXXNvcWNMXfAkqoS', NULL, 'abuseropaw@gmail.com', NULL, NULL, NULL, NULL, 1526561976, 1530855725, 1, 'Reymond', 'Aljas', 'MEMBER', '09090649289', 'Gomera', '', '', '', '', 'INSTRUCTOR'),
(6, '127.0.0.1', 'christine gonzales', '$2y$08$u6PspD0KZkDdHn2l5jRGU./q0gh40SzNayZK5TTjtt3Ch4JCzn3PS', NULL, 'tinang@gmail.com', NULL, NULL, NULL, NULL, 1527758440, NULL, 1, 'Christine', 'Gonzales', 'MSU @ Naawan', '09090649289', '', '', '', '', '', ''),
(7, '127.0.0.1', 'melquisedic ycat', '$2y$08$zihLY864r5AqZsSQdoM/p.3BQqZFuqTmn5h1ibMX2HheoBu3h1OkS', NULL, 'ycat@gmail.com', NULL, NULL, NULL, NULL, 1527758518, NULL, 1, 'Melquisedic', 'Ycat', 'MSU @ Naawan', '09090649289', '', '', '', '', '', ''),
(8, '127.0.0.1', 'alan asdasd', '$2y$08$5LjOSzKYvugWmQKgYsUbqeLv8uENtcxAucq4RnmFj1H0OQSIHmYji', NULL, 'ad@gmail.com', NULL, NULL, NULL, NULL, 1530853165, 1530860898, 1, 'Alan', 'asdasd', 'MSU @ Naawan', '09090649289', '', '', '', '', '', 'CHAIRMAN'),
(9, '::1', 'wen gals', '$2y$08$yzkJUMBusTLvmgajDNBOvuBmRRO40/miElho172F1C5cm095vVVuW', NULL, 'wengals@gmail.com', NULL, NULL, NULL, 'OdCwNH0ybohHIGEfbue0hu', 1531977155, 1531981000, 1, 'Wen', 'Gals', 'MSU', '09267896541', '', '', '', '', '', ''),
(10, '127.0.0.1', 'melquisedic asdasddasdsd', '$2y$08$/6bpHYw78dE4hnensO5.TeiEinx175Hy9BjAfyOB381HOkq9cqWxO', NULL, 'asdasd@gmail.com', NULL, NULL, NULL, NULL, 1533591892, NULL, 1, 'Melquisedic', 'asdasddasdsd', 'adasd', '09090649289', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` mediumint(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(5, 1, 1),
(8, 2, 1),
(17, 6, 4),
(18, 7, 3),
(39, 8, 2),
(38, 9, 2),
(37, 10, 5);

-- --------------------------------------------------------

--
-- Structure for view `coursedetails`
--
DROP TABLE IF EXISTS `coursedetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `coursedetails`  AS  select `c`.`course_code` AS `course_code`,`c`.`course_description` AS `course_description`,`c`.`course_year` AS `course_year`,`c`.`ID` AS `ID`,`c`.`departmentid` AS `departmentid`,`d`.`Department` AS `Department` from (`course` `c` join `department` `d` on((`c`.`departmentid` = `d`.`ID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `prospectusdetails`
--
DROP TABLE IF EXISTS `prospectusdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prospectusdetails`  AS  select `p`.`subj_id` AS `subj_id`,`p`.`course_id` AS `course_id`,`p`.`prospectus_pre_requisites` AS `prospectus_pre_requisites`,`p`.`prospectus_yearlevel` AS `prospectus_yearlevel`,`p`.`prospectus_term` AS `prospectus_term`,`c`.`course_code` AS `course_code`,`c`.`course_description` AS `course_description`,`c`.`course_year` AS `course_year`,`s`.`subj_code` AS `subj_code`,`s`.`subj_description` AS `subj_description`,`s`.`subj_units_lec` AS `subj_units_lec`,`s`.`subj_units_lab` AS `subj_units_lab`,(select concat(`ss`.`subj_code`,'-',`ss`.`subj_description`) from `subject` `ss` where (`ss`.`ID` = `p`.`prospectus_pre_requisites`)) AS `Prerequisite` from ((`prospectus` `p` join `course` `c` on((`p`.`course_id` = `c`.`ID`))) join `subject` `s` on((`p`.`subj_id` = `s`.`ID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `studentdetails`
--
DROP TABLE IF EXISTS `studentdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentdetails`  AS  select `student`.`ID` AS `ID`,`student`.`student_id` AS `student_id`,concat(`student`.`student_lname`,', ',`student`.`student_fname`,' ',`student`.`student_mname`) AS `FullName` from `student` ;

-- --------------------------------------------------------

--
-- Structure for view `student_coursedetails`
--
DROP TABLE IF EXISTS `student_coursedetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_coursedetails`  AS  select `sc`.`course_id` AS `course_id`,`sc`.`student_course_dateCreated` AS `student_course_dateCreated`,`s`.`student_id` AS `student_id`,`s`.`ID` AS `ID`,concat(`s`.`student_lname`,', ',`s`.`student_fname`,' ',`s`.`student_lname`) AS `Name`,`c`.`course_code` AS `course_code`,`c`.`course_description` AS `course_description`,`c`.`course_year` AS `course_year`,`c`.`departmentid` AS `departmentid` from ((`student_course` `sc` join `student` `s` on((`s`.`ID` = `sc`.`student_id`))) join `course` `c` on((`c`.`ID` = `sc`.`course_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `subjectcreditingdetails`
--
DROP TABLE IF EXISTS `subjectcreditingdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subjectcreditingdetails`  AS  select `sc`.`subj_id` AS `subj_id`,`sc`.`student_id` AS `student_id`,`sc`.`subjectcrediting_grade` AS `subjectcrediting_grade`,`sc`.`subjectcrediting_taken` AS `subjectcrediting_taken`,`sc`.`creditedBy` AS `creditedBy`,`sc`.`dateofCredit` AS `dateofCredit`,`s`.`subj_code` AS `subj_code`,`s`.`subj_description` AS `subj_description`,`sd`.`FullName` AS `FullName` from ((`subjectcrediting` `sc` join `subject` `s` on((`sc`.`subj_id` = `s`.`ID`))) join `studentdetails` `sd` on((`sc`.`student_id` = `sd`.`ID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `subjectdetails`
--
DROP TABLE IF EXISTS `subjectdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subjectdetails`  AS  select `s`.`ID` AS `ID`,`s`.`subj_code` AS `subj_code`,`s`.`subj_description` AS `subj_description`,`s`.`subj_units_lec` AS `subj_units_lec`,`s`.`subj_units_lab` AS `subj_units_lab`,`s`.`subj_prerequisite` AS `subj_prerequisite`,`s`.`departmentid` AS `departmentid`,`d`.`Department` AS `Department` from (`subject` `s` join `department` `d` on((`s`.`departmentid` = `d`.`ID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `subjectofferingdetails`
--
DROP TABLE IF EXISTS `subjectofferingdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subjectofferingdetails`  AS  select `so`.`ID` AS `ID`,`so`.`academicyear_id` AS `academicyear_id`,`so`.`instructor_id` AS `instructor_id`,`so`.`subj_id` AS `subj_id`,`so`.`room_id` AS `room_id`,`so`.`subjectoffering_slots` AS `subjectoffering_slots`,`so`.`subjectoffering_section` AS `subjectoffering_section`,`so`.`subjectoffering_timein` AS `subjectoffering_timein`,`so`.`subjectoffering_timeout` AS `subjectoffering_timeout`,`so`.`subjectoffering_days` AS `subjectoffering_days`,`so`.`subjectoffering_status` AS `subjectoffering_status`,`i`.`instructor_name` AS `instructor_name`,`i`.`instructor_address` AS `instructor_address`,`i`.`instructor_position` AS `instructor_position`,`i`.`instructor_gender` AS `instructor_gender`,`i`.`instructor_civil_status` AS `instructor_civil_status`,`i`.`instructor_email_address` AS `instructor_email_address`,`i`.`instructor_specialization` AS `instructor_specialization`,`i`.`instructor_employment_status` AS `instructor_employment_status`,`s`.`subj_code` AS `subj_code`,`s`.`subj_description` AS `subj_description`,`s`.`subj_units_lec` AS `subj_units_lec`,`s`.`subj_units_lab` AS `subj_units_lab`,`s`.`subj_prerequisite` AS `subj_prerequisite`,`r`.`room_building_name` AS `room_building_name`,`r`.`room_number` AS `room_number`,`r`.`room_capacity` AS `room_capacity`,`a`.`academicyear_year` AS `academicyear_year`,`a`.`academicyear_term` AS `academicyear_term`,`a`.`academicyear_status` AS `academicyear_status` from ((((`subjectoffering` `so` join `instructor` `i` on((`so`.`instructor_id` = `i`.`ID`))) join `subject` `s` on((`so`.`subj_id` = `s`.`ID`))) join `room` `r` on((`so`.`room_id` = `r`.`ID`))) join `academicyear` `a` on((`so`.`academicyear_id` = `a`.`ID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `academicyear_id` (`academicyear_id`);

--
-- Indexes for table `controlling`
--
ALTER TABLE `controlling`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `academicyear_id` (`academicyear_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dept_chairperson`
--
ALTER TABLE `dept_chairperson`
  ADD PRIMARY KEY (`userid`,`departmentid`),
  ADD KEY `departmentid` (`departmentid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandatory`
--
ALTER TABLE `mandatory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mandatoryfee`
--
ALTER TABLE `mandatoryfee`
  ADD PRIMARY KEY (`assessment_id`,`mandatory_id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `mandatory_id` (`mandatory_id`);

--
-- Indexes for table `miscelleneous`
--
ALTER TABLE `miscelleneous`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `miscelleneousfee`
--
ALTER TABLE `miscelleneousfee`
  ADD PRIMARY KEY (`assessment_id`,`miscelleneous_id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `miscelleneous_id` (`miscelleneous_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `assessment_id` (`assessment_id`);

--
-- Indexes for table `prospectus`
--
ALTER TABLE `prospectus`
  ADD PRIMARY KEY (`subj_id`,`course_id`),
  ADD KEY `subj_id` (`subj_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `public_preferences`
--
ALTER TABLE `public_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `subj_prerequisite` (`subj_prerequisite`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `subjectcrediting`
--
ALTER TABLE `subjectcrediting`
  ADD PRIMARY KEY (`student_id`,`subj_id`),
  ADD KEY `subj_id` (`subj_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subjectenrolling`
--
ALTER TABLE `subjectenrolling`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `subjectoffering_id` (`subjectoffering_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `controlling_id` (`controlling_id`);

--
-- Indexes for table `subjectoffering`
--
ALTER TABLE `subjectoffering`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `academicyear_id` (`academicyear_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `subj_id` (`subj_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `tuition`
--
ALTER TABLE `tuition`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tuitionfee`
--
ALTER TABLE `tuitionfee`
  ADD PRIMARY KEY (`assessment_id`,`tuition_id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `tuition_id` (`tuition_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mandatory`
--
ALTER TABLE `mandatory`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `miscelleneous`
--
ALTER TABLE `miscelleneous`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `public_preferences`
--
ALTER TABLE `public_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `subjectenrolling`
--
ALTER TABLE `subjectenrolling`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjectoffering`
--
ALTER TABLE `subjectoffering`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tuition`
--
ALTER TABLE `tuition`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `FK_ASSESSMENT_ACADEMICYEAR` FOREIGN KEY (`academicyear_id`) REFERENCES `academicyear` (`ID`),
  ADD CONSTRAINT `FK_ASSESSMENT_STUDENT` FOREIGN KEY (`student_id`) REFERENCES `student` (`ID`),
  ADD CONSTRAINT `FK_ASSESSMENT_USERS` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `controlling`
--
ALTER TABLE `controlling`
  ADD CONSTRAINT `FK_CONTROLLING_ACADEMICYEAR` FOREIGN KEY (`academicyear_id`) REFERENCES `academicyear` (`ID`),
  ADD CONSTRAINT `FK_CONTROLLING_STUDENT` FOREIGN KEY (`student_id`) REFERENCES `student` (`ID`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`ID`);

--
-- Constraints for table `mandatoryfee`
--
ALTER TABLE `mandatoryfee`
  ADD CONSTRAINT `FK_MANDATORYFEE_ASSESSMENT` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`ID`),
  ADD CONSTRAINT `FK_MANDATORYFEE_MANDATORY` FOREIGN KEY (`mandatory_id`) REFERENCES `mandatory` (`ID`);

--
-- Constraints for table `miscelleneousfee`
--
ALTER TABLE `miscelleneousfee`
  ADD CONSTRAINT `FK_MISCELLENEOUSFEE_ASSESSMENT` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`ID`),
  ADD CONSTRAINT `FK_MISCELLENEOUSFEE_MISCELLENEOUS` FOREIGN KEY (`miscelleneous_id`) REFERENCES `miscelleneous` (`ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_PAYMENT_ASSESSMENT` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`ID`);

--
-- Constraints for table `prospectus`
--
ALTER TABLE `prospectus`
  ADD CONSTRAINT `FK_PROSPECTUS_COURSE` FOREIGN KEY (`course_id`) REFERENCES `course` (`ID`),
  ADD CONSTRAINT `FK_PROSPECTUS_SUBJECT` FOREIGN KEY (`subj_id`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `FK_STUDENT_COURSE_COURSE` FOREIGN KEY (`course_id`) REFERENCES `course` (`ID`),
  ADD CONSTRAINT `FK_STUDENT_COURSE_STUDENT` FOREIGN KEY (`student_id`) REFERENCES `student` (`ID`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`ID`);

--
-- Constraints for table `subjectcrediting`
--
ALTER TABLE `subjectcrediting`
  ADD CONSTRAINT `subjectcrediting_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`ID`),
  ADD CONSTRAINT `subjectcrediting_ibfk_2` FOREIGN KEY (`subj_id`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `subjectenrolling`
--
ALTER TABLE `subjectenrolling`
  ADD CONSTRAINT `FK_SUBJECTENROLLING_CONTROLLING` FOREIGN KEY (`controlling_id`) REFERENCES `controlling` (`ID`),
  ADD CONSTRAINT `FK_SUBJECTENROLLING_SUBJECTOFFERING` FOREIGN KEY (`subjectoffering_id`) REFERENCES `subjectoffering` (`ID`),
  ADD CONSTRAINT `FK_SUBJECTENROLLING_USERS` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subjectoffering`
--
ALTER TABLE `subjectoffering`
  ADD CONSTRAINT `FK_SUBJECTOFFERING_ACADEMICYEAR` FOREIGN KEY (`academicyear_id`) REFERENCES `academicyear` (`ID`),
  ADD CONSTRAINT `FK_SUBJECTOFFERING_INSTRUCTOR` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`ID`),
  ADD CONSTRAINT `FK_SUBJECTOFFERING_ROOM` FOREIGN KEY (`room_id`) REFERENCES `room` (`ID`),
  ADD CONSTRAINT `FK_SUBJECTOFFERING_SUBJECT` FOREIGN KEY (`subj_id`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `tuitionfee`
--
ALTER TABLE `tuitionfee`
  ADD CONSTRAINT `FK_TUITIONFEE_ASSESSMENT` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`ID`),
  ADD CONSTRAINT `FK_TUITIONFEE_TUITION` FOREIGN KEY (`tuition_id`) REFERENCES `tuition` (`ID`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
