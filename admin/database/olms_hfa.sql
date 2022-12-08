-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 04:22 AM
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
-- Table structure for table `answer_tbl`
--

CREATE TABLE `answer_tbl` (
  `answer_id` int(11) NOT NULL,
  `answer_key` varchar(250) DEFAULT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer_tbl`
--

INSERT INTO `answer_tbl` (`answer_id`, `answer_key`, `fk_question_id`) VALUES
(5, '1', 6),
(6, '2', 7),
(7, '3', 8),
(8, '4', 9),
(9, '2', 10),
(10, '1', 11),
(11, '1', 12),
(12, '2', 13),
(13, '1', 14),
(14, '1', 15),
(15, '3', 16),
(16, '1', 17),
(17, '4', 18);

-- --------------------------------------------------------

--
-- Table structure for table `choices_tbl`
--

CREATE TABLE `choices_tbl` (
  `choices_id` int(11) NOT NULL,
  `choices_name` varchar(250) DEFAULT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choices_tbl`
--

INSERT INTO `choices_tbl` (`choices_id`, `choices_name`, `fk_question_id`) VALUES
(17, 'aaa', 6),
(18, 'aaa', 6),
(19, 'aa', 6),
(20, 'aa', 6),
(21, 'bb', 7),
(22, 'bb', 7),
(23, 'bb', 7),
(24, 'bb', 7),
(25, 'cc', 8),
(26, 'cc', 8),
(27, 'cc', 8),
(28, 'cc', 8),
(29, 'dd', 9),
(30, 'dd', 9),
(31, 'dd', 9),
(32, 'dd', 9),
(33, 'ab', 10),
(34, 'ab', 10),
(35, 'ab', 10),
(36, 'ab', 10),
(37, 'as', 11),
(38, 's', 11),
(39, 's', 11),
(40, 's', 11),
(41, 'a', 12),
(42, 'a', 12),
(43, 'a', 12),
(44, 'a', 12),
(45, 'aaa', 13),
(46, 'a', 13),
(47, 'a', 13),
(48, 'a', 13),
(49, '2', 14),
(50, '2', 14),
(51, '2', 14),
(52, '2', 14),
(53, '3', 15),
(54, '3', 15),
(55, '3', 15),
(56, '3', 15),
(57, 'a', 16),
(58, 'a', 16),
(59, 'a', 16),
(60, 'a', 16),
(61, 'this is from absssddsssaa', 17),
(62, 'this is from absssddsssbb', 17),
(63, 'this s from absssddssscc', 17),
(64, 'this is from absssddsssdd', 17),
(65, 'bebelonya', 18),
(66, 'b', 18),
(67, 'b', 18),
(68, 'b', 18);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_tbl`
--

CREATE TABLE `criteria_tbl` (
  `criteria_id` int(11) NOT NULL,
  `criteria_name` varchar(250) DEFAULT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grade_level_tbl`
--

CREATE TABLE `grade_level_tbl` (
  `grade_level_id` int(11) NOT NULL,
  `grade_level_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade_level_tbl`
--

INSERT INTO `grade_level_tbl` (`grade_level_id`, `grade_level_name`) VALUES
(1, 'grade 1'),
(2, 'grade 2'),
(3, 'grade 3'),
(4, 'grade 4'),
(5, 'grade 5'),
(6, 'grade 6'),
(7, 'grade 7'),
(8, 'grade 8'),
(9, 'grade 9'),
(10, 'grade 10'),
(11, 'grade 11'),
(12, 'grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `grading_tbl`
--

CREATE TABLE `grading_tbl` (
  `grading_id` int(11) NOT NULL,
  `grading_name` varchar(250) DEFAULT NULL
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
-- Table structure for table `module_tbl`
--

CREATE TABLE `module_tbl` (
  `module_id` int(11) NOT NULL,
  `fk_subject_list_id` int(11) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `module_file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `question_id` int(11) NOT NULL,
  `question_name` varchar(250) DEFAULT NULL,
  `fk_task_list_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_tbl`
--

INSERT INTO `question_tbl` (`question_id`, `question_name`, `fk_task_list_id`) VALUES
(6, 'question 1', 6),
(7, 'question 2', 6),
(8, 'question 3', 6),
(9, 'question 4', 6),
(10, 'question 5', 6),
(11, 'awdawd', 8),
(12, 'question 2', 8),
(13, 'question 1', 9),
(14, 'question 2', 9),
(15, 'question 3', 9),
(16, 'a', 10),
(17, 'absssddssssdfasdfasdfasdfasdf', 10),
(18, 'test', 10);

-- --------------------------------------------------------

--
-- Table structure for table `section_tbl`
--

CREATE TABLE `section_tbl` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(55) DEFAULT NULL,
  `fk_grade_level_id` int(11) DEFAULT NULL,
  `fk_strand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section_tbl`
--

INSERT INTO `section_tbl` (`section_id`, `section_name`, `fk_grade_level_id`, `fk_strand_id`) VALUES
(3, 'Gold', 10, NULL),
(4, 'Silver', 10, NULL),
(5, 'Cobalt', 10, NULL),
(6, 'Nickel', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strand_tbl`
--

CREATE TABLE `strand_tbl` (
  `strand_id` int(11) NOT NULL,
  `strand_name` varchar(55) DEFAULT NULL,
  `fk_grade_level_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(250) DEFAULT NULL,
  `fk_section_id` int(11) DEFAULT NULL,
  `student_number` varchar(20) DEFAULT NULL,
  `student_password` varchar(250) DEFAULT NULL,
  `student_date_enrolled` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `student_name`, `fk_section_id`, `student_number`, `student_password`, `student_date_enrolled`) VALUES
(1, 'student 1', 3, 'std001', '123', NULL),
(2, 'student 2', 3, 'std002', '123', NULL),
(3, 'student 3', 3, 'std003', '123', NULL),
(4, 'student 4', 4, 'std004', '123', NULL),
(5, 'student 5', 4, 'std005', '123', NULL),
(6, 'student 6', 4, 'std006', '123', NULL),
(7, 'student 7', 5, 'std007', '123', NULL),
(9, 'student 8', 5, 'std008', '123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_list_tbl`
--

CREATE TABLE `subject_list_tbl` (
  `subject_list_id` int(11) NOT NULL,
  `fk_section_id` int(11) DEFAULT NULL,
  `fk_subject_id` int(11) DEFAULT NULL,
  `subject_list_name` varchar(50) DEFAULT NULL,
  `fk_teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_list_tbl`
--

INSERT INTO `subject_list_tbl` (`subject_list_id`, `fk_section_id`, `fk_subject_id`, `subject_list_name`, `fk_teacher_id`) VALUES
(9, 3, 1, 'ap', 1),
(10, 3, 3, 'english', 1),
(11, 3, 4, 'filipino', 1),
(12, 6, 1, 'ap', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject_tbl`
--

CREATE TABLE `subject_tbl` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_tbl`
--

INSERT INTO `subject_tbl` (`subject_id`, `subject_name`) VALUES
(1, 'ap'),
(2, 'math'),
(3, 'english'),
(4, 'filipino');

-- --------------------------------------------------------

--
-- Table structure for table `submission_tbl`
--

CREATE TABLE `submission_tbl` (
  `submission_id` int(11) NOT NULL,
  `submission_name` varchar(20) DEFAULT NULL,
  `score` int(100) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `fk_task_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_list_tbl`
--

CREATE TABLE `task_list_tbl` (
  `task_list_id` int(11) NOT NULL,
  `fk_subject_list_id` int(11) NOT NULL,
  `fk_grading_id` int(11) DEFAULT NULL,
  `task_name` varchar(50) DEFAULT NULL,
  `task_content` varchar(50) DEFAULT NULL,
  `question_item` int(100) DEFAULT NULL,
  `task_type` varchar(50) DEFAULT NULL,
  `sub_type` varchar(50) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `date_deadline` varchar(50) DEFAULT NULL,
  `time_limit` varchar(50) DEFAULT NULL,
  `max_score` int(100) DEFAULT NULL,
  `max_attempts` int(100) DEFAULT NULL,
  `submission_choice` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list_tbl`
--

INSERT INTO `task_list_tbl` (`task_list_id`, `fk_subject_list_id`, `fk_grading_id`, `task_name`, `task_content`, `question_item`, `task_type`, `sub_type`, `date_created`, `date_deadline`, `time_limit`, `max_score`, `max_attempts`, `submission_choice`) VALUES
(6, 9, 1, '01 Multiple choice 1', NULL, 5, '1', '0', '', '', '15:20', 5, 2, 'on'),
(7, 9, 3, '02 Assignment 01', NULL, 2, '1', '0', '', '', '', NULL, 0, 'on'),
(8, 9, 1, '02 Activity 01', NULL, 2, '2', '1', '', '', '', NULL, 0, 'on'),
(9, 9, 4, 'wdawdaw', NULL, 5, '1', '0', '', '', '03:00', NULL, 0, 'on'),
(10, 9, 3, '222', NULL, 4, '2', '0', '', '', '', NULL, 0, 'on'),
(11, 9, 2, 'sample essay', 'this is sample essay', NULL, '1', '3', '2022-10-01', '2022-10-02', '18:00', 2, 1, 'on'),
(12, 9, 3, 'test third grading task name', NULL, 2, '2', '0', '', '', '', NULL, 0, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `task_tbl`
--

CREATE TABLE `task_tbl` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(250) NOT NULL,
  `fk_grading_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(250) DEFAULT NULL,
  `teacher_number` varchar(250) DEFAULT NULL,
  `teacher_password` varchar(250) DEFAULT NULL
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
-- Indexes for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  ADD PRIMARY KEY (`criteria_id`),
  ADD KEY `fk_question_id` (`fk_question_id`);

--
-- Indexes for table `grade_level_tbl`
--
ALTER TABLE `grade_level_tbl`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `grading_tbl`
--
ALTER TABLE `grading_tbl`
  ADD PRIMARY KEY (`grading_id`);

--
-- Indexes for table `module_tbl`
--
ALTER TABLE `module_tbl`
  ADD PRIMARY KEY (`module_id`),
  ADD KEY `fk_subject_list_id` (`fk_subject_list_id`);

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
  ADD KEY `fk_grade_level_id` (`fk_grade_level_id`),
  ADD KEY `fk_strand_id` (`fk_strand_id`);

--
-- Indexes for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  ADD PRIMARY KEY (`strand_id`),
  ADD KEY `fk_grade_level_id` (`fk_grade_level_id`);

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
  ADD KEY `fk_section_id` (`fk_section_id`,`fk_subject_id`,`fk_teacher_id`),
  ADD KEY `fk_teacher_id` (`fk_teacher_id`),
  ADD KEY `fk_subject_id` (`fk_subject_id`);

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
  ADD KEY `fk_task_list_id` (`fk_task_list_id`);

--
-- Indexes for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  ADD PRIMARY KEY (`task_list_id`),
  ADD KEY `fk_grading_id` (`fk_grading_id`),
  ADD KEY `fk_subject_list_id` (`fk_subject_list_id`);

--
-- Indexes for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `fk_grading_id` (`fk_grading_id`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  MODIFY `choices_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_level_tbl`
--
ALTER TABLE `grade_level_tbl`
  MODIFY `grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grading_tbl`
--
ALTER TABLE `grading_tbl`
  MODIFY `grading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `module_tbl`
--
ALTER TABLE `module_tbl`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `section_tbl`
--
ALTER TABLE `section_tbl`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  MODIFY `subject_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `submission_tbl`
--
ALTER TABLE `submission_tbl`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  MODIFY `task_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `task_tbl`
--
ALTER TABLE `task_tbl`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `answer_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`);

--
-- Constraints for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  ADD CONSTRAINT `choices_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`);

--
-- Constraints for table `criteria_tbl`
--
ALTER TABLE `criteria_tbl`
  ADD CONSTRAINT `criteria_tbl_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question_tbl` (`question_id`);

--
-- Constraints for table `module_tbl`
--
ALTER TABLE `module_tbl`
  ADD CONSTRAINT `module_tbl_ibfk_1` FOREIGN KEY (`fk_subject_list_id`) REFERENCES `subject_list_tbl` (`subject_list_id`);

--
-- Constraints for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD CONSTRAINT `question_tbl_ibfk_1` FOREIGN KEY (`fk_task_list_id`) REFERENCES `task_list_tbl` (`task_list_id`);

--
-- Constraints for table `section_tbl`
--
ALTER TABLE `section_tbl`
  ADD CONSTRAINT `section_tbl_ibfk_1` FOREIGN KEY (`fk_grade_level_id`) REFERENCES `grade_level_tbl` (`grade_level_id`),
  ADD CONSTRAINT `section_tbl_ibfk_2` FOREIGN KEY (`fk_strand_id`) REFERENCES `strand_tbl` (`strand_id`);

--
-- Constraints for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  ADD CONSTRAINT `strand_tbl_ibfk_1` FOREIGN KEY (`fk_grade_level_id`) REFERENCES `grade_level_tbl` (`grade_level_id`);

--
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`);

--
-- Constraints for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  ADD CONSTRAINT `subject_list_tbl_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_2` FOREIGN KEY (`fk_teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_3` FOREIGN KEY (`fk_subject_id`) REFERENCES `subject_tbl` (`subject_id`);

--
-- Constraints for table `submission_tbl`
--
ALTER TABLE `submission_tbl`
  ADD CONSTRAINT `submission_tbl_ibfk_1` FOREIGN KEY (`fk_task_list_id`) REFERENCES `task_list_tbl` (`task_list_id`);

--
-- Constraints for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  ADD CONSTRAINT `task_list_tbl_ibfk_3` FOREIGN KEY (`fk_grading_id`) REFERENCES `grading_tbl` (`grading_id`),
  ADD CONSTRAINT `task_list_tbl_ibfk_4` FOREIGN KEY (`fk_subject_list_id`) REFERENCES `subject_list_tbl` (`subject_list_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
