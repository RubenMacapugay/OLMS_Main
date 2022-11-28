-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 09:38 AM
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
  `answer_key` varchar(50) DEFAULT NULL,
  `fk_question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer_tbl`
--

INSERT INTO `answer_tbl` (`answer_id`, `answer_key`, `fk_question_id`) VALUES
(235, '1', NULL),
(236, '3', NULL),
(237, '4', NULL),
(238, '2', NULL),
(245, '1', NULL),
(246, '3', NULL),
(247, '4', NULL),
(248, '2', NULL);

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
(597, 'Joyful Mystery of the Rosary', 1, NULL),
(598, 'Glorious Mystery of the Rosary', 0, NULL),
(599, 'Luminous Mystery of the Rosary', 0, NULL),
(600, 'Sorrowful Mystery of the Rosary', 0, NULL),
(601, 'Joyful Mystery of the Rosary', 0, NULL),
(602, 'Glorious Mystery of the Rosary', 0, NULL),
(603, 'Luminous Mystery of the Rosary', 1, NULL),
(604, 'Sorrowful Mystery of the Rosary', 0, NULL),
(605, 'Joyful Mystery of the Rosary', 0, NULL),
(606, 'Glorious Mystery of the Rosary', 0, NULL),
(607, 'Luminous Mystery of the Rosary', 0, NULL),
(608, 'Sorrowful Mystery of the Rosary', 1, NULL),
(609, 'Joyful Mystery of the Rosary', 0, NULL),
(610, 'Glorious Mystery of the Rosary', 1, NULL),
(611, 'Luminous Mystery of the Rosary', 0, NULL),
(612, 'Sorrowful Mystery of the Rosary', 0, NULL),
(617, 'Joyful Mystery of the Rosary', 1, NULL),
(618, 'Glorious Mystery of the Rosary', 0, NULL),
(619, 'Luminous Mystery of the Rosary', 0, NULL),
(620, 'Sorrowful Mystery of the Rosary', 0, NULL),
(621, 'Joyful Mystery of the Rosary', 0, NULL),
(622, 'Glorious Mystery of the Rosary', 0, NULL),
(623, 'Luminous Mystery of the Rosary', 1, NULL),
(624, 'Sorrowful Mystery of the Rosary', 0, NULL),
(625, 'Joyful Mystery of the Rosary', 0, NULL),
(626, 'Glorious Mystery of the Rosary', 0, NULL),
(627, 'Luminous Mystery of the Rosary', 0, NULL),
(628, 'Sorrowful Mystery of the Rosary', 1, NULL),
(629, 'Joyful Mystery of the Rosary', 0, NULL),
(630, 'Glorious Mystery of the Rosary', 1, NULL),
(631, 'Luminous Mystery of the Rosary', 0, NULL),
(632, 'Sorrowful Mystery of the Rosary', 0, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `module_tbl`
--

CREATE TABLE `module_tbl` (
  `module_id` int(200) NOT NULL,
  `module_name` varchar(100) DEFAULT NULL,
  `fk_module_section_tbl` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_tbl`
--

CREATE TABLE `question_tbl` (
  `question_id` int(11) NOT NULL,
  `question_number` varchar(11) NOT NULL,
  `question_name` varchar(100) DEFAULT NULL,
  `fk_task_list_id` int(11) DEFAULT NULL,
  `attempt` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Silver', 10, NULL);

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
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `fk_section_id` int(11) DEFAULT NULL,
  `student_number` varchar(100) DEFAULT NULL,
  `student_password` varchar(50) DEFAULT NULL,
  `student_date_enrolled` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `student_name`, `fk_section_id`, `student_number`, `student_password`, `student_date_enrolled`) VALUES
(1, 'student 1', NULL, 'std001', '123', NULL),
(2, 'student 2', NULL, 'std002', '123', NULL);

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
  `fk_student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_list_tbl`
--

INSERT INTO `subject_list_tbl` (`subject_list_id`, `subject_list_name`, `fk_section_id`, `fk_subject_id`, `fk_teacher_id`, `fk_student_id`) VALUES
(1, 'AP', 1, 1, 1, 1),
(2, 'Hekasi', 1, 2, 1, 1),
(3, 'Filipino', 1, 3, 1, 1),
(4, 'Math', 2, 4, 2, 2),
(5, 'English', 2, 5, 2, 2),
(6, 'Php', 2, 6, 2, 2);

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
  `fk_task_list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `fk_submission_tbl_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `time_limit` varchar(50) DEFAULT NULL,
  `max_score` int(11) DEFAULT NULL,
  `max_attempts` int(11) DEFAULT NULL,
  `submission_choice` varchar(50) DEFAULT NULL,
  `given` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `question_tbl`
--
ALTER TABLE `question_tbl`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `question_tbl_ibfk_1` (`fk_task_list_id`);

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
  ADD KEY `fk_section_id` (`fk_section_id`),
  ADD KEY `fk_student_id` (`fk_student_id`),
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
-- AUTO_INCREMENT for table `answer_tbl`
--
ALTER TABLE `answer_tbl`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `choices_tbl`
--
ALTER TABLE `choices_tbl`
  MODIFY `choices_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=645;

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
  MODIFY `module_section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `module_tbl`
--
ALTER TABLE `module_tbl`
  MODIFY `module_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_tbl`
--
ALTER TABLE `question_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `section_tbl`
--
ALTER TABLE `section_tbl`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strand_tbl`
--
ALTER TABLE `strand_tbl`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  MODIFY `subject_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submission_tbl`
--
ALTER TABLE `submission_tbl`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `submitted_answer_tbl`
--
ALTER TABLE `submitted_answer_tbl`
  MODIFY `submitted_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1162;

--
-- AUTO_INCREMENT for table `task_list_tbl`
--
ALTER TABLE `task_list_tbl`
  MODIFY `task_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

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
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`);

--
-- Constraints for table `subject_list_tbl`
--
ALTER TABLE `subject_list_tbl`
  ADD CONSTRAINT `subject_list_tbl_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `section_tbl` (`section_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_2` FOREIGN KEY (`fk_student_id`) REFERENCES `student_tbl` (`student_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_3` FOREIGN KEY (`fk_teacher_id`) REFERENCES `teacher_tbl` (`teacher_id`),
  ADD CONSTRAINT `subject_list_tbl_ibfk_4` FOREIGN KEY (`fk_subject_id`) REFERENCES `subject_tbl` (`subject_id`);

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
