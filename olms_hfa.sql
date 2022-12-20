-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 04:18 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olms_hfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `id` int(90) NOT NULL,
  `username` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`id`, `username`, `admin_username`, `admin_password`) VALUES
(1, 'Adminstrator', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answer_tbl`
--

CREATE TABLE `answer_tbl` (
  `answer_id` int(11) NOT NULL,
  `answer_key` varchar(50) DEFAULT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer_tbl`
--

INSERT INTO `answer_tbl` (`answer_id`, `answer_key`, `fk_question_id`) VALUES
(27, '1', 38),
(28, '1', 39),
(29, '1', 40),
(30, '1', 41),
(31, '1', 42),
(32, 'a', 43),
(33, 'a', 44),
(34, 'a', 45),
(35, 'a', 46),
(36, 'a', 47),
(37, 'True', 48),
(38, 'True', 49),
(39, 'True', 50),
(40, 'True', 51),
(41, 'True', 52);

-- --------------------------------------------------------

--
-- Table structure for table `choices_tbl`
--

CREATE TABLE `choices_tbl` (
  `choices_id` int(11) NOT NULL,
  `choices_name` varchar(50) DEFAULT NULL,
  `is_correct` int(20) NOT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choices_tbl`
--

INSERT INTO `choices_tbl` (`choices_id`, `choices_name`, `is_correct`, `fk_question_id`) VALUES
(61, 'a', 1, 38),
(62, 'b', 0, 38),
(63, 'c', 0, 38),
(64, 'd', 0, 38),
(65, 'a', 1, 39),
(66, 'b', 0, 39),
(67, 'c', 0, 39),
(68, 'd', 0, 39),
(69, 'a', 1, 40),
(70, 'b', 0, 40),
(71, 'c', 0, 40),
(72, 'd', 0, 40),
(73, 'a', 1, 41),
(74, 'b', 0, 41),
(75, 'c', 0, 41),
(76, 'd', 0, 41),
(77, 'a', 1, 42),
(78, 'b', 0, 42),
(79, 'v', 0, 42),
(80, 'd', 0, 42);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_tbl`
--

CREATE TABLE `criteria_tbl` (
  `criteria_id` int(11) NOT NULL,
  `criteria_name` varchar(50) DEFAULT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gradelevel_tbl`
--

CREATE TABLE `gradelevel_tbl` (
  `grade_level_id` int(11) NOT NULL,
  `grade_level_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradelevel_tbl`
--

INSERT INTO `gradelevel_tbl` (`grade_level_id`, `grade_level_name`) VALUES
(1, 'Grade 1'),
(2, 'Grade 2'),
(3, 'Grade 3'),
(4, 'Grade 4'),
(5, 'Grade 5'),
(6, 'Grade 6'),
(7, 'Grade 7'),
(8, 'Grade 8'),
(9, 'Grade 9'),
(10, 'Grade 10'),
(11, 'Grade 11'),
(12, 'Grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `grading_tbl`
--

CREATE TABLE `grading_tbl` (
  `grading_id` int(11) NOT NULL,
  `grading_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grading_tbl`
--

INSERT INTO `grading_tbl` (`grading_id`, `grading_name`) VALUES
(1, 'First Grading'),
(2, 'Second Grading'),
(3, 'Third Grading'),
(4, 'Fourth Grading');

-- --------------------------------------------------------

--
-- Table structure for table `module_section_tbl`
--

CREATE TABLE `module_section_tbl` (
  `module_section_id` int(11) NOT NULL,
  `module_section_name` varchar(50) DEFAULT NULL,
  `module_section_desc` varchar(200) DEFAULT NULL,
  `fk_subject_list_id` int(11) DEFAULT NULL,
  `fk_grading_id` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module_section_tbl`
--

INSERT INTO `module_section_tbl` (`module_section_id`, `module_section_name`, `module_section_desc`, `fk_subject_list_id`, `fk_grading_id`) VALUES
(37, 'Section 1', 'section descasdfasdf', 1, 1),
(38, 'Section 2', 'section 2content', 1, 1),
(39, 'Section 3', 'asd', 1, 1),
(40, 'Section 1', 'asdf', 1, 2),
(41, 'asdf', 'third grading section', 1, 3),
(42, 'Section 2', 's', 1, 2),
(43, 'Section 3', 'dd', 1, 4),
(44, 'Section 4', 'a', 1, 1),
(45, 'Section 1', '123', 1, 4),
(46, 'Section 4.1', 'awdasdfasd', 1, 1),
(47, 'Section 1 third', 'aaa', 1, 3),
(48, 'section 5', 'a', 1, 1),
(49, 'Section 1', 'asdf', 1, 3),
(50, 'Section 2', 'as', 1, 4),
(51, 'Section 3', 'asdf', 1, 2),
(52, 'Section 6', 'asdf', 1, 4),
(53, 'Section 1', 'asd', 2, 1),
(54, 'asdfasdf', 'sss', 2, 1),
(55, 'Seconddddddd', 'asdf', 2, 2),
(56, 'Section 2', 'awd', 1, 3),
(57, 'Section 6', 'q', 1, 1),
(58, 'Section 6', 'adwdaw', 1, 3),
(59, 'Section 7', 'asdfasd', 1, 1),
(60, 'Section 4', 'asdf', 1, 2),
(61, 'Section 7', 'asd', 1, 3),
(62, 'Section 7', 'asdfsss', 1, 4),
(63, 'Section 5', 'asdf', 1, 2),
(64, 'ggwp', 'sdafasdf', 1, 1),
(65, 'Section 1 ', 'this is for section aquarius , grade 6', 7, 1),
(66, 'ss', '123', 3, 1),
(67, 'business', '123', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_tbl`
--

CREATE TABLE `module_tbl` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `fk_subject_list_id` int(11) DEFAULT NULL,
  `module_file` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module_tbl`
--

INSERT INTO `module_tbl` (`module_id`, `module_name`, `fk_subject_list_id`, `module_file`) VALUES
(9, 'AP', NULL, 'AP10_Q2_Mod2_Mga-Isyu-sa-Paggawa-word-FINAL revise'),
(10, 'AP', NULL, 'AP10_Q2_Mod2_Mga-Isyu-sa-Paggawa-word-FINAL revise'),
(11, 'sss', NULL, 'Storyboard_Student.docx'),
(12, 'carlos maralit ', NULL, 'olms_hfa_benru-Dec-11.sql'),
(13, 'image ko', NULL, 'death-oath-benedetta-mobile-legends-ml-wallpaper-1'),
(14, 'carlos', NULL, 'bg2.jpg'),
(15, 'carlos', NULL, 'bg.jpg'),
(16, 'asdfasdfasdf', NULL, 'carlos_adones_newContent.docx'),
(17, 'lololssss', NULL, 'License.pdf'),
(18, 'awddddd', NULL, 'README.txt'),
(19, 'asdfsssss2123123', NULL, 'Piggery.docx'),
(20, 'asdf2222', NULL, 'Piggery.docx'),
(21, 'asdfasdfs123123123123123', NULL, 'submitted_answer_tbl.sql'),
(22, 'tangina mo gumana ka', NULL, 'mdb.min.js.map');

-- --------------------------------------------------------

--
-- Table structure for table `parent_tbl`
--

CREATE TABLE `parent_tbl` (
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(20) DEFAULT NULL,
  `fk_student_id` int(11) DEFAULT NULL,
  `parent_date_added` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `question_id` int(11) NOT NULL,
  `question_number` varchar(11) NOT NULL,
  `question_name` varchar(300) DEFAULT NULL,
  `fk_task_list_id` int(11) DEFAULT NULL,
  `attempt` int(20) NOT NULL,
  `question_filename` varchar(200) DEFAULT NULL,
  `question_filepath` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_tbl`
--

INSERT INTO `question_tbl` (`question_id`, `question_number`, `question_name`, `fk_task_list_id`, `attempt`, `question_filename`, `question_filepath`) VALUES
(38, '1', 'question 1', 29, 0, NULL, NULL),
(39, '2', 'question 2', 29, 0, NULL, NULL),
(40, '3', 'question 3', 29, 0, NULL, NULL),
(41, '4', 'question 4', 29, 0, NULL, NULL),
(42, '5', 'question 5', 29, 0, NULL, NULL),
(43, '1', 'question 1', 30, 0, NULL, NULL),
(44, '2', 'question 2', 30, 0, NULL, NULL),
(45, '3', 'question 3', 30, 0, NULL, NULL),
(46, '4', 'question 4', 30, 0, NULL, NULL),
(47, '5', 'question 5', 30, 0, NULL, NULL),
(48, '1', 'question 1', 31, 0, NULL, NULL),
(49, '2', 'question 2', 31, 0, NULL, NULL),
(50, '3', 'question 3', 31, 0, NULL, NULL),
(51, '4', 'question 4', 31, 0, NULL, NULL),
(52, '5', 'question 5', 31, 0, NULL, NULL),
(53, '', '1.) this is sample \r\n2.) THis is secon dsample', 32, 0, '6.jpg', '../upload/1132');

-- --------------------------------------------------------

--
-- Table structure for table `sample_module`
--

CREATE TABLE `sample_module` (
  `sample_module_id` int(11) NOT NULL,
  `module_filename` varchar(200) DEFAULT NULL,
  `module_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_module`
--

INSERT INTO `sample_module` (`sample_module_id`, `module_filename`, `module_path`) VALUES
(1, 'bg2.jpg', 'upload/1115/bg2.jpg'),
(2, 'bg.jpg', 'upload/1115/bg.jpg'),
(3, 'bg-profile.png', 'upload/1115/bg-profile.png'),
(4, '317800008_1214568532602310_687262471465133697_n.png', 'upload/1115/317800008_1214568532602310_687262471465133697_n.png'),
(5, 'db-design.png', 'upload/1115/db-design.png'),
(6, 'bg2.jpg', 'upload/1115/bg2.jpg'),
(7, '313117293_1179412612978968_1628762679380884227_n.jpg', 'upload/1115/313117293_1179412612978968_1628762679380884227_n.jpg'),
(8, '313129287_515585360434522_6578931411905143900_n.jpg', 'upload/1115/313129287_515585360434522_6578931411905143900_n.jpg'),
(9, '312967655_654317403002115_954805741462735849_n.jpg', 'upload/1115/312967655_654317403002115_954805741462735849_n.jpg'),
(10, '313204925_436281288667204_3409186159964556977_n.jpg', 'upload/1115/313204925_436281288667204_3409186159964556977_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(16, 'aaaafffffff', 'aaa', '2022-12-09 01:17:00', '2022-12-10 01:17:00'),
(17, 'aaaa', 'aaa1', '2022-12-09 01:17:00', '2022-12-10 01:17:00'),
(18, 'carlos', 'test 1', '2022-12-13 10:42:00', '2022-12-30 10:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `section_tbl`
--

CREATE TABLE `section_tbl` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) DEFAULT NULL,
  `fk_grade_level_id` int(11) DEFAULT NULL,
  `fk_strand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section_tbl`
--

INSERT INTO `section_tbl` (`section_id`, `section_name`, `fk_grade_level_id`, `fk_strand_id`) VALUES
(1, 'Gold', 10, NULL),
(2, 'Silver', 10, NULL),
(3, 'Aquarius', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strand_tbl`
--

CREATE TABLE `strand_tbl` (
  `strand_id` int(11) NOT NULL,
  `strand_name` varchar(50) DEFAULT NULL,
  `fk_grade_level_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `strand_tbl`
--

INSERT INTO `strand_tbl` (`strand_id`, `strand_name`, `fk_grade_level_id`) VALUES
(1, 'ABM', 11),
(2, 'ICT', 11),
(3, 'ABM', 12),
(4, 'ICT', 12);

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects_tbl`
--

CREATE TABLE `student_subjects_tbl` (
  `student_subject_id` int(11) NOT NULL,
  `fk_student_id` int(11) NOT NULL,
  `fk_subject_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subjects_tbl`
--

INSERT INTO `student_subjects_tbl` (`student_subject_id`, `fk_student_id`, `fk_subject_list_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 2, 3),
(7, 3, 1),
(8, 3, 2),
(9, 3, 8),
(10, 4, 1),
(11, 4, 2),
(12, 4, 3),
(13, 5, 4),
(14, 5, 5),
(15, 5, 6),
(16, 5, 7),
(17, 6, 7),
(18, 1, 7),
(21, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `fk_section_id` int(11) DEFAULT NULL,
  `student_number` varchar(100) DEFAULT NULL,
  `student_password` varchar(50) DEFAULT NULL,
  `student_date_enrolled` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `student_name`, `fk_section_id`, `student_number`, `student_password`, `student_date_enrolled`) VALUES
(1, 'student 1', 1, 'std001', '123', '2022-11-16'),
(2, 'student 2', 1, 'std002', '123', '2022-11-28'),
(3, 'student 3', 1, 'std003', '123', '2022-12-01'),
(4, 'student 4', 1, 'std004', '123', '2022-10-13'),
(5, 'student 5', 2, 'std005', '123', '2022-12-01'),
(6, 'student 6', 3, 'std006', '123', '2022-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `subject_list_tbl`
--

CREATE TABLE `subject_list_tbl` (
  `subject_list_id` int(11) NOT NULL,
  `subject_list_name` varchar(50) DEFAULT NULL,
  `fk_section_id` int(11) DEFAULT NULL,
  `fk_subject_id` int(11) DEFAULT NULL,
  `fk_teacher_id` int(11) DEFAULT NULL,
  `fk_grade_level_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_list_tbl`
--

INSERT INTO `subject_list_tbl` (`subject_list_id`, `subject_list_name`, `fk_section_id`, `fk_subject_id`, `fk_teacher_id`, `fk_grade_level_id`) VALUES
(1, 'AP', 1, 1, 1, NULL),
(2, 'Hekasi', 3, 2, 1, NULL),
(3, 'Filipino', 1, 3, 1, NULL),
(4, 'Math', 2, 4, 2, NULL),
(5, 'English', 2, 5, 2, NULL),
(6, 'Php', 2, 6, 2, NULL),
(7, 'AP', 3, 1, 1, NULL),
(8, 'Business add', 3, 8, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_tbl`
--

CREATE TABLE `subject_tbl` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_tbl`
--

INSERT INTO `subject_tbl` (`subject_id`, `subject_name`) VALUES
(1, 'AP'),
(2, 'Hekasi'),
(3, 'Filipino'),
(4, 'Math'),
(5, 'English'),
(6, 'Php'),
(7, 'Appdev'),
(8, 'Business Add');

-- --------------------------------------------------------

--
-- Table structure for table `submission_tbl`
--

CREATE TABLE `submission_tbl` (
  `submission_id` int(11) NOT NULL,
  `submission_name` varchar(50) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `attempt` int(11) DEFAULT NULL,
  `fk_student_id` int(20) NOT NULL,
  `submitted` varchar(50) DEFAULT NULL,
  `fk_task_list_id` int(11) NOT NULL,
  `submission_date` varchar(20) DEFAULT NULL,
  `submission_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission_tbl`
--

INSERT INTO `submission_tbl` (`submission_id`, `submission_name`, `score`, `attempt`, `fk_student_id`, `submitted`, `fk_task_list_id`, `submission_date`, `submission_time`) VALUES
(26, '01 Multiple Choice 1', 3, 1, 1, 'Yes', 29, NULL, NULL),
(27, '01 Multiple Choice 1', 0, 2, 1, 'Yes', 29, NULL, NULL),
(28, '01 Quiz 1', 4, 1, 1, 'Yes', 30, NULL, NULL),
(48, '01 Essay 1', 20, 1, 1, 'Yes', 32, '2022-12-20', '06:54 AM'),
(49, '01 Essay 1', 10, 2, 1, 'Yes', 32, '2022-12-20', '06:55 AM'),
(53, '01 Essay 1', 20, 3, 1, 'Yes', 32, '2022-12-20', '07:19 AM'),
(54, '01 Essay 1', 2, 4, 1, 'Yes', 32, '2022-12-20', '07:20 AM'),
(55, '01 Essay 1', 1, 5, 1, 'Yes', 32, '2022-12-20', '07:24 AM'),
(56, '01 Essay 1', 20, 6, 1, 'Yes', 32, '2022-12-20', '07:37 AM'),
(57, '01 Essay 1', 21, 7, 1, 'Yes', 32, '2022-12-20', '07:42 AM'),
(58, '01 Essay 1', 20, 8, 1, 'Yes', 32, '2022-12-20', '07:53 AM'),
(59, '01 Identification 1', 4, 2, 1, 'Yes', 30, '2022-12-20', '11:01 AM'),
(60, '01 Multiple Choice 1', 2, 3, 1, 'Yes', 29, '2022-12-20', '11:04 AM'),
(61, '01 True or false 1', 3, 1, 1, 'Yes', 31, '2022-12-20', '11:06 AM');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_answer_tbl`
--

CREATE TABLE `submitted_answer_tbl` (
  `submitted_answer_id` int(11) NOT NULL,
  `submitted_answer_key` varchar(200) DEFAULT NULL,
  `submitted_answer_choice` int(11) DEFAULT NULL,
  `attempt` int(11) NOT NULL,
  `fk_question_id` int(11) DEFAULT NULL,
  `fk_task_list_id` int(11) DEFAULT NULL,
  `fk_student_id` int(11) DEFAULT NULL,
  `fk_submission_tbl_id` int(11) DEFAULT NULL,
  `submitted_filename` varchar(200) DEFAULT NULL,
  `submitted_filepath` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submitted_answer_tbl`
--

INSERT INTO `submitted_answer_tbl` (`submitted_answer_id`, `submitted_answer_key`, `submitted_answer_choice`, `attempt`, `fk_question_id`, `fk_task_list_id`, `fk_student_id`, `fk_submission_tbl_id`, `submitted_filename`, `submitted_filepath`) VALUES
(50, NULL, 61, 1, 38, 29, 1, 26, NULL, NULL),
(51, NULL, 65, 1, 39, 29, 1, 26, NULL, NULL),
(52, NULL, 69, 1, 40, 29, 1, 26, NULL, NULL),
(53, NULL, 76, 1, 41, 29, 1, 26, NULL, NULL),
(54, NULL, 79, 1, 42, 29, 1, 26, NULL, NULL),
(55, NULL, 62, 2, 38, 29, 1, 27, NULL, NULL),
(56, NULL, 68, 2, 39, 29, 1, 27, NULL, NULL),
(57, NULL, 70, 2, 40, 29, 1, 27, NULL, NULL),
(58, NULL, 76, 2, 41, 29, 1, 27, NULL, NULL),
(59, NULL, 78, 2, 42, 29, 1, 27, NULL, NULL),
(60, 'a', NULL, 1, 43, 30, 1, 28, NULL, NULL),
(61, 's', NULL, 1, 44, 30, 1, 28, NULL, NULL),
(62, 'a', NULL, 1, 45, 30, 1, 28, NULL, NULL),
(63, 'a', NULL, 1, 46, 30, 1, 28, NULL, NULL),
(64, 'a', NULL, 1, 47, 30, 1, 28, NULL, NULL),
(84, '1\r\n2', NULL, 1, 53, 32, 1, 48, '1.jpg', '../upload/student/1132'),
(85, 's\r\nd', NULL, 2, 53, 32, 1, 49, NULL, NULL),
(89, 'd', NULL, 3, 53, 32, 1, 53, NULL, NULL),
(90, 'a', NULL, 4, 53, 32, 1, 54, NULL, NULL),
(91, '1\r\n2', NULL, 5, 53, 32, 1, 55, NULL, NULL),
(92, '1', NULL, 6, 53, 32, 1, 56, NULL, NULL),
(93, 's', NULL, 7, 53, 32, 1, 57, NULL, NULL),
(94, 'qwe', NULL, 8, 53, 32, 1, 58, NULL, NULL),
(95, 'a', NULL, 2, 43, 30, 1, 59, NULL, NULL),
(96, 'a', NULL, 2, 44, 30, 1, 59, NULL, NULL),
(97, 'a', NULL, 2, 45, 30, 1, 59, NULL, NULL),
(98, 's', NULL, 2, 46, 30, 1, 59, NULL, NULL),
(99, 'a', NULL, 2, 47, 30, 1, 59, NULL, NULL),
(100, NULL, 61, 3, 38, 29, 1, 60, NULL, NULL),
(101, NULL, 66, 3, 39, 29, 1, 60, NULL, NULL),
(102, NULL, 71, 3, 40, 29, 1, 60, NULL, NULL),
(103, NULL, 76, 3, 41, 29, 1, 60, NULL, NULL),
(104, NULL, 77, 3, 42, 29, 1, 60, NULL, NULL),
(105, 'True', NULL, 1, 48, 31, 1, 61, NULL, NULL),
(106, 'False', NULL, 1, 49, 31, 1, 61, NULL, NULL),
(107, 'False', NULL, 1, 50, 31, 1, 61, NULL, NULL),
(108, 'True', NULL, 1, 51, 31, 1, 61, NULL, NULL),
(109, 'True', NULL, 1, 52, 31, 1, 61, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_list_tbl`
--

CREATE TABLE `task_list_tbl` (
  `task_list_id` int(11) NOT NULL,
  `task_name` varchar(50) DEFAULT NULL,
  `fk_subject_list_id` int(11) DEFAULT NULL,
  `fk_grading_id` int(11) DEFAULT NULL,
  `fk_module_section_id` int(20) DEFAULT NULL,
  `task_content` varchar(50) DEFAULT NULL,
  `question_item` int(11) DEFAULT NULL,
  `fk_task_type` int(50) DEFAULT NULL,
  `sub_type` varchar(50) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `date_deadline` varchar(50) DEFAULT NULL,
  `time_created` varchar(50) DEFAULT NULL,
  `time_limit` time DEFAULT NULL,
  `max_score` int(11) DEFAULT NULL,
  `max_attempts` int(11) DEFAULT NULL,
  `submission_choice` varchar(50) DEFAULT NULL,
  `given` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list_tbl`
--

INSERT INTO `task_list_tbl` (`task_list_id`, `task_name`, `fk_subject_list_id`, `fk_grading_id`, `fk_module_section_id`, `task_content`, `question_item`, `fk_task_type`, `sub_type`, `date_created`, `date_deadline`, `time_created`, `time_limit`, `max_score`, `max_attempts`, `submission_choice`, `given`) VALUES
(29, '01 Multiple Choice 1', 1, 1, 37, NULL, 5, 1, '0', '2022-12-19', '2022-12-21', '02:14 PM', '02:14:00', NULL, 20, 'No', 'Yes'),
(30, '01 Identification 1', 1, 1, 37, NULL, 5, 1, '1', '2022-12-19', '2022-12-21', '02:16 PM', '02:16:00', NULL, 20, 'No', 'Yes'),
(31, '01 True or false 1', 1, 1, 37, NULL, 5, 1, '2', '2022-12-19', '2022-12-21', '02:17 PM', '02:17:00', NULL, 20, 'No', 'Yes'),
(32, '01 Essay 1', 1, 1, 37, NULL, NULL, 1, '3', '2022-12-19', '2022-12-22', '02:18 PM', '02:17:00', 20, 20, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `task_tbl`
--

CREATE TABLE `task_tbl` (
  `task_id` int(11) NOT NULL,
  `task_main_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_tbl`
--

INSERT INTO `task_tbl` (`task_id`, `task_main_name`) VALUES
(1, 'Assignment'),
(2, 'Activities'),
(3, 'Quiz'),
(4, 'Major Examination');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `teacher_number` varchar(100) DEFAULT NULL,
  `teacher_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_tbl`
--

INSERT INTO `teacher_tbl` (`teacher_id`, `teacher_name`, `teacher_number`, `teacher_password`) VALUES
(1, 'teacher 1', 'tch001', '123'),
(2, 'teacher 2', 'tch002', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `answer_tbl_ibfk_1` (`fk_question_id`);

--
-- Indexes for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  ADD PRIMARY KEY (`choices_id`),
  ADD KEY `choices_tbl_ibfk_1` (`fk_question_id`);

--
-- Indexes for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `criteria_tbl_ibfk_1` (`fk_question_id`);

--
-- Indexes for table `gradelevel_tbl`
--
ALTER TABLE `gradelevel_tbl`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `grading_tbl`
--
ALTER TABLE `grading_tbl`
  ADD PRIMARY KEY (`grading_id`);

--
-- Indexes for table `module_section_tbl`
--
ALTER TABLE `module_section_tbl`
  ADD PRIMARY KEY (`module_section_id`),
  ADD KEY `module_section_tbl_ibfk_1` (`fk_subject_list_id`),
  ADD KEY `fk_grading_tbl` (`fk_grading_id`);

--
-- Indexes for table `module_tbl`
--
ALTER TABLE `module_tbl`
  ADD PRIMARY KEY (`module_id`),
  ADD KEY `fk_subject_list_id` (`fk_subject_list_id`);

--
-- Indexes for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `fk_student_id` (`fk_student_id`);

--
-- Indexes for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `question_tbl_ibfk_1` (`fk_task_list_id`);

--
-- Indexes for table `sample_module`
--
ALTER TABLE `sample_module`
  ADD PRIMARY KEY (`sample_module_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `fk_grade_level_id` (`fk_grade_level_id`),
  ADD KEY `fk_strand_id` (`fk_strand_id`);

--
-- Indexes for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  ADD PRIMARY KEY (`strand_id`),
  ADD KEY `fk_grade_level_id` (`fk_grade_level_id`);

--
-- Indexes for table `student_subjects_tbl`
--
ALTER TABLE `student_subjects_tbl`
  ADD PRIMARY KEY (`student_subject_id`),
  ADD KEY `fk_student_id` (`fk_student_id`),
  ADD KEY `fk_subject_list_id` (`fk_subject_list_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_section_id` (`fk_section_id`);

--
-- Indexes for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  ADD PRIMARY KEY (`subject_list_id`),
  ADD KEY `fk_teacher_id` (`fk_teacher_id`),
  ADD KEY `fk_subject_id` (`fk_subject_id`),
  ADD KEY `fk_section_id` (`fk_section_id`),
  ADD KEY `fk_grade_level_id` (`fk_grade_level_id`);

--
-- Indexes for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `submission_tbl`
--
ALTER TABLE `submission_tbl`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `submission_tbl_ibfk_1` (`fk_task_list_id`),
  ADD KEY `fk_student_id` (`fk_student_id`);

--
-- Indexes for table `submitted_answer_tbl`
--
ALTER TABLE `submitted_answer_tbl`
  ADD PRIMARY KEY (`submitted_answer_id`),
  ADD KEY `fk_question_id` (`fk_question_id`),
  ADD KEY `fk_submission_tbl` (`fk_submission_tbl_id`),
  ADD KEY `submitted_answer_tbl_ibfk_5` (`fk_student_id`),
  ADD KEY `submitted_answer_tbl_ibfk_6` (`fk_task_list_id`);

--
-- Indexes for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  ADD PRIMARY KEY (`task_list_id`),
  ADD KEY `task_list_tbl_ibfk_1` (`fk_grading_id`),
  ADD KEY `task_list_tbl_ibfk_2` (`fk_subject_list_id`),
  ADD KEY `task_list_tbl_ibfk_3` (`fk_task_type`),
  ADD KEY `fk_module_sectin_tbl` (`fk_module_section_id`);

--
-- Indexes for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  MODIFY `choices_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradelevel_tbl`
--
ALTER TABLE `gradelevel_tbl`
  MODIFY `grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grading_tbl`
--
ALTER TABLE `grading_tbl`
  MODIFY `grading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_section_tbl`
--
ALTER TABLE `module_section_tbl`
  MODIFY `module_section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `module_tbl`
--
ALTER TABLE `module_tbl`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sample_module`
--
ALTER TABLE `sample_module`
  MODIFY `sample_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `section_tbl`
--
ALTER TABLE `section_tbl`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_subjects_tbl`
--
ALTER TABLE `student_subjects_tbl`
  MODIFY `student_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  MODIFY `subject_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submission_tbl`
--
ALTER TABLE `submission_tbl`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `submitted_answer_tbl`
--
ALTER TABLE `submitted_answer_tbl`
  MODIFY `submitted_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  MODIFY `task_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `task_tbl`
--
ALTER TABLE `task_tbl`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  ADD CONSTRAINT `answer_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  ADD CONSTRAINT `choices_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  ADD CONSTRAINT `criteria_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_section_tbl`
--
ALTER TABLE `module_section_tbl`
  ADD CONSTRAINT `module_section_tbl_ibfk_1` FOREIGN KEY (`fk_subject_list_id`) REFERENCES `subject_list_tbl` (`subject_list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_section_tbl_ibfk_2` FOREIGN KEY (`fk_grading_id`) REFERENCES `grading_tbl` (`grading_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_tbl`
--
ALTER TABLE `module_tbl`
  ADD CONSTRAINT `module_tbl_ibfk_1` FOREIGN KEY (`fk_subject_list_id`) REFERENCES `subject_list_tbl` (`subject_list_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  ADD CONSTRAINT `parent_tbl_ibfk_1` FOREIGN KEY (`fk_student_id`) REFERENCES `student_tbl` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD CONSTRAINT `question_tbl_ibfk_1` FOREIGN KEY (`fk_task_list_id`) REFERENCES `task_list_tbl` (`task_list_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD CONSTRAINT `section_tbl_ibfk_1` FOREIGN KEY (`fk_grade_level_id`) REFERENCES `gradelevel_tbl` (`grade_level_id`),
  ADD CONSTRAINT `section_tbl_ibfk_2` FOREIGN KEY (`fk_strand_id`) REFERENCES `strand_tbl` (`strand_id`);

--
-- Constraints for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  ADD CONSTRAINT `strand_tbl_ibfk_1` FOREIGN KEY (`fk_grade_level_id`) REFERENCES `gradelevel_tbl` (`grade_level_id`);

--
-- Constraints for table `student_subjects_tbl`
--
ALTER TABLE `student_subjects_tbl`
  ADD CONSTRAINT `student_subjects_tbl_ibfk_1` FOREIGN KEY (`fk_student_id`) REFERENCES `student_tbl` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subjects_tbl_ibfk_2` FOREIGN KEY (`fk_subject_list_id`) REFERENCES `subject_list_tbl` (`subject_list_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`);

--
-- Constraints for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  ADD CONSTRAINT `subject_list_tbl_ibfk_3` FOREIGN KEY (`fk_teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_4` FOREIGN KEY (`fk_subject_id`) REFERENCES `subject_tbl` (`subject_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_5` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_6` FOREIGN KEY (`fk_grade_level_id`) REFERENCES `gradelevel_tbl` (`grade_level_id`);

--
-- Constraints for table `submission_tbl`
--
ALTER TABLE `submission_tbl`
  ADD CONSTRAINT `submission_tbl_ibfk_1` FOREIGN KEY (`fk_task_list_id`) REFERENCES `task_list_tbl` (`task_list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_tbl_ibfk_2` FOREIGN KEY (`fk_student_id`) REFERENCES `student_tbl` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submitted_answer_tbl`
--
ALTER TABLE `submitted_answer_tbl`
  ADD CONSTRAINT `submitted_answer_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submitted_answer_tbl_ibfk_4` FOREIGN KEY (`fk_submission_tbl_id`) REFERENCES `submission_tbl` (`submission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submitted_answer_tbl_ibfk_5` FOREIGN KEY (`fk_student_id`) REFERENCES `student_tbl` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submitted_answer_tbl_ibfk_6` FOREIGN KEY (`fk_task_list_id`) REFERENCES `task_list_tbl` (`task_list_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  ADD CONSTRAINT `task_list_tbl_ibfk_1` FOREIGN KEY (`fk_grading_id`) REFERENCES `grading_tbl` (`grading_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_list_tbl_ibfk_2` FOREIGN KEY (`fk_subject_list_id`) REFERENCES `subject_list_tbl` (`subject_list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_list_tbl_ibfk_3` FOREIGN KEY (`fk_task_type`) REFERENCES `task_tbl` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_list_tbl_ibfk_4` FOREIGN KEY (`fk_module_section_id`) REFERENCES `module_section_tbl` (`module_section_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
