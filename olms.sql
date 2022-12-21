-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2022 at 01:14 PM
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
-- Database: `olms`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_tbl`
--

CREATE TABLE `answer_tbl` (
  `answer_id` int(11) NOT NULL,
  `fk_question_id` int(11) DEFAULT NULL,
  `answer_key` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `choices_tbl`
--

CREATE TABLE `choices_tbl` (
  `choices_id` int(11) NOT NULL,
  `fk_question_id` int(11) DEFAULT NULL,
  `choices` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gradelevel_tbl`
--

CREATE TABLE `gradelevel_tbl` (
  `grade_level_id` int(11) NOT NULL,
  `level_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grading_tbl`
--

CREATE TABLE `grading_tbl` (
  `grading_id` int(11) NOT NULL,
  `fk_subject_id` int(11) DEFAULT NULL,
  `grading_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `question_id` int(11) NOT NULL,
  `fk_task_list_id` int(11) DEFAULT NULL,
  `questionnaire` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section_tbl`
--

CREATE TABLE `section_tbl` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(200) DEFAULT NULL,
  `fk_grade_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `strand_tbl`
--

CREATE TABLE `strand_tbl` (
  `section_id` int(11) NOT NULL,
  `fk_grade_level` int(11) NOT NULL,
  `strand_name` char(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(200) DEFAULT NULL,
  `fk_section_id` int(200) DEFAULT NULL,
  `student_number` int(11) NOT NULL,
  `student_password` varchar(20) DEFAULT NULL,
  `student_enrolled` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `fk_student_id` int(11) DEFAULT NULL,
  `subject_name` varchar(50) NOT NULL,
  `fk_teacher_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_list_tbl`
--

CREATE TABLE `task_list_tbl` (
  `task_list_id` int(11) NOT NULL,
  `fk_task_id` int(11) DEFAULT NULL,
  `task_list_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_tbl`
--

CREATE TABLE `task_tbl` (
  `task_id` int(11) NOT NULL,
  `fk_grading` int(11) DEFAULT NULL,
  `task_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `teacher_id` int(11) NOT NULL,
  `teacher_numebr` int(20) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `teacher_password` varchar(20) NOT NULL,
  `teacher_enrolled` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_question_id` (`fk_question_id`);

--
-- Indexes for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  ADD PRIMARY KEY (`choices_id`),
  ADD KEY `fk_question_id` (`fk_question_id`);

--
-- Indexes for table `gradelevel_tbl`
--
ALTER TABLE `gradelevel_tbl`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `grading_tbl`
--
ALTER TABLE `grading_tbl`
  ADD PRIMARY KEY (`grading_id`),
  ADD KEY `fk_student_id` (`fk_subject_id`);

--
-- Indexes for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_task_list_id` (`fk_task_list_id`);

--
-- Indexes for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `fk_grade_level` (`fk_grade_level`);

--
-- Indexes for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `fk_grade_level` (`fk_grade_level`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_section_id` (`fk_section_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `fk_student_id` (`fk_student_id`,`fk_teacher_id`),
  ADD KEY `fk_teacher_id` (`fk_teacher_id`);

--
-- Indexes for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  ADD PRIMARY KEY (`task_list_id`),
  ADD KEY `fk_task_id` (`fk_task_id`);

--
-- Indexes for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `fk_grading` (`fk_grading`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  ADD CONSTRAINT `answer_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`);

--
-- Constraints for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  ADD CONSTRAINT `choices_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`);

--
-- Constraints for table `grading_tbl`
--
ALTER TABLE `grading_tbl`
  ADD CONSTRAINT `grading_tbl_ibfk_1` FOREIGN KEY (`fk_subject_id`) REFERENCES `subject` (`subject_id`);

--
-- Constraints for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD CONSTRAINT `question_tbl_ibfk_1` FOREIGN KEY (`fk_task_list_id`) REFERENCES `task_list_tbl` (`task_list_id`);

--
-- Constraints for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD CONSTRAINT `section_tbl_ibfk_1` FOREIGN KEY (`fk_grade_level`) REFERENCES `gradelevel_tbl` (`grade_level_id`);

--
-- Constraints for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  ADD CONSTRAINT `strand_tbl_ibfk_1` FOREIGN KEY (`fk_grade_level`) REFERENCES `gradelevel_tbl` (`grade_level_id`);

--
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`fk_teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`),
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `student_tbl` (`student_id`);

--
-- Constraints for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  ADD CONSTRAINT `task_list_tbl_ibfk_1` FOREIGN KEY (`fk_task_id`) REFERENCES `task_tbl` (`task_id`);

--
-- Constraints for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD CONSTRAINT `task_tbl_ibfk_1` FOREIGN KEY (`fk_grading`) REFERENCES `grading_tbl` (`grading_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
