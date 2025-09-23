-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 09:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, 'LKG'),
(2, 'UKG'),
(3, '1st'),
(4, '2nd'),
(5, '3rd'),
(6, '4th'),
(7, '5th'),
(8, '6th'),
(9, '7th'),
(10, '8th'),
(11, '9th'),
(12, '10th');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_id`, `subject_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4),
(9, 3, 1),
(10, 3, 2),
(11, 3, 3),
(12, 3, 4),
(13, 3, 5),
(14, 3, 10),
(15, 4, 1),
(16, 4, 2),
(17, 4, 3),
(18, 4, 4),
(19, 4, 5),
(20, 4, 10),
(21, 5, 1),
(22, 5, 2),
(23, 5, 3),
(24, 5, 4),
(25, 5, 5),
(26, 5, 10),
(27, 6, 1),
(28, 6, 2),
(29, 6, 3),
(30, 6, 4),
(31, 6, 5),
(32, 6, 10),
(33, 7, 1),
(34, 7, 2),
(35, 7, 3),
(36, 7, 4),
(37, 7, 5),
(38, 7, 6),
(39, 7, 7),
(40, 7, 8),
(41, 7, 9),
(42, 7, 10),
(43, 8, 1),
(44, 8, 2),
(45, 8, 3),
(46, 8, 4),
(47, 8, 5),
(48, 8, 6),
(49, 8, 7),
(50, 8, 8),
(51, 8, 9),
(52, 8, 10),
(53, 9, 1),
(54, 9, 2),
(55, 9, 3),
(56, 9, 4),
(57, 9, 5),
(58, 9, 6),
(59, 9, 7),
(60, 9, 8),
(61, 9, 9),
(62, 9, 10),
(63, 10, 1),
(64, 10, 2),
(65, 10, 3),
(66, 10, 4),
(67, 10, 5),
(68, 10, 6),
(69, 10, 7),
(70, 10, 8),
(71, 10, 9),
(72, 10, 10),
(73, 11, 1),
(74, 11, 2),
(75, 11, 3),
(76, 11, 4),
(77, 11, 5),
(78, 11, 6),
(79, 11, 7),
(80, 11, 8),
(81, 11, 9),
(82, 11, 10),
(83, 12, 1),
(84, 12, 2),
(85, 12, 3),
(86, 12, 4),
(87, 12, 5),
(88, 12, 6),
(89, 12, 7),
(90, 12, 8),
(91, 12, 9),
(92, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `fee_struct`
--

CREATE TABLE `fee_struct` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `Form_fee` int(5) NOT NULL,
  `AD_fee` int(8) NOT NULL,
  `MS_CHG` int(8) NOT NULL,
  `CM` int(8) NOT NULL,
  `Tuition` int(8) NOT NULL,
  `Exam_fee` int(8) NOT NULL,
  `st_Session` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_struct`
--

INSERT INTO `fee_struct` (`id`, `class_id`, `Form_fee`, `AD_fee`, `MS_CHG`, `CM`, `Tuition`, `Exam_fee`, `st_Session`) VALUES
(1, 1, 1000, 20000, 1000, 3000, 3200, 0, '2023-2024'),
(2, 2, 1000, 20000, 1000, 3000, 3200, 0, '2023-2024'),
(3, 3, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(4, 4, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(5, 5, 1000, 20000, 1000, 3000, 3500, 3000, '2023-2024'),
(6, 6, 1000, 20000, 1000, 3000, 3500, 99999, '2023-2024'),
(7, 7, 1000, 20000, 1000, 3000, 3500, 3000, '2023-2024'),
(8, 8, 1000, 20000, 1000, 3000, 3800, 999, '2023-2024'),
(9, 9, 1000, 20000, 1000, 3000, 3800, 3000, '2023-2024'),
(10, 10, 1000, 20000, 1000, 3000, 3800, 3000, '2023-2024'),
(11, 11, 1000, 20000, 1000, 3000, 4200, 3500, '2023-2024'),
(12, 12, 1000, 20000, 1000, 3000, 4400, 3500, '2023-2024'),
(13, 1, 1000, 20000, 1000, 3000, 3200, 0, '2024-2025'),
(14, 2, 1000, 20000, 1000, 3000, 3200, 999, '2024-2025'),
(15, 3, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(16, 4, 1000, 20000, 1000, 999999, 3200, 3000, '2024-2025'),
(17, 5, 1000, 20000, 1000, 3000, 3500, 3000, '2024-2025'),
(18, 6, 1000, 20000, 1000, 3000, 3500, 3000, '2024-2025'),
(19, 7, 1000, 20000, 1000, 3000, 3500, 3000, '2024-2025'),
(20, 8, 1000, 20000, 1000, 3000, 3800, 3000, '2024-2025'),
(21, 9, 1000, 999999, 1000, 3000, 3800, 3000, '2024-2025'),
(22, 10, 1000, 20000, 1000, 3000, 3800, 3000, '2024-2025'),
(23, 11, 1000, 20000, 1000, 3000, 4200, 3500, '2024-2025'),
(24, 12, 1000, 20000, 1000, 3000, 4400, 3500, '2024-2025'),
(25, 1, 1000, 20000, 1000, 3000, 3200, 0, '2025-2026'),
(26, 2, 1000, 20000, 1000, 3000, 3200, 0, '2025-2026'),
(27, 3, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(28, 4, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(29, 5, 1000, 20000, 1000, 3000, 4000, 3000, '2025-2026'),
(30, 6, 1000, 20000, 1000, 3000, 3500, 3000, '2025-2026'),
(31, 7, 1000, 20000, 1000, 3000, 3500, 3000, '2025-2026'),
(32, 8, 1000, 20000, 1000, 3000, 3800, 3000, '2025-2026'),
(33, 9, 1000, 20000, 1000, 3000, 3800, 3000, '2025-2026'),
(34, 10, 1000, 20000, 1000, 3000, 3800, 3000, '2025-2026'),
(35, 11, 1000, 20000, 1000, 3000, 4200, 3500, '2025-2026'),
(36, 12, 0, 0, 0, 0, 0, 0, '2025-2026');

-- --------------------------------------------------------

--
-- Table structure for table `setting_tb_std`
--

CREATE TABLE `setting_tb_std` (
  `s_reg_no` int(5) NOT NULL,
  `st_1` varchar(50) NOT NULL,
  `st_2` varchar(50) NOT NULL,
  `st_3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_tb_std`
--

INSERT INTO `setting_tb_std` (`s_reg_no`, `st_1`, `st_2`, `st_3`) VALUES
(20263, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `First_Name` varchar(25) NOT NULL,
  `Last_Name` varchar(25) NOT NULL,
  `Class` varchar(5) NOT NULL,
  `Section` varchar(1) NOT NULL,
  `DoB` date NOT NULL,
  `Gender` varchar(3) NOT NULL,
  `F_First_Name` varchar(25) NOT NULL,
  `F_Last_Name` varchar(25) NOT NULL,
  `M_First_Name` varchar(25) NOT NULL,
  `M_Last_Name` varchar(25) NOT NULL,
  `S_Address` mediumtext NOT NULL,
  `S_Address_s` mediumtext NOT NULL,
  `City` varchar(200) NOT NULL,
  `State` varchar(500) NOT NULL,
  `Zip_Code` varchar(15) NOT NULL,
  `Phone` int(15) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `std_pic` varchar(200) NOT NULL,
  `S_REG_NUM` int(6) NOT NULL,
  `st_Session` varchar(50) NOT NULL,
  `reg_date` int(10) NOT NULL,
  `sibling_dcp` mediumtext NOT NULL,
  `tuition_fee_mode` varchar(10) NOT NULL,
  `total_fee` int(10) NOT NULL,
  `sibling_discount` int(10) NOT NULL,
  `monthly_fee` int(10) NOT NULL,
  `relation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `First_Name`, `Last_Name`, `Class`, `Section`, `DoB`, `Gender`, `F_First_Name`, `F_Last_Name`, `M_First_Name`, `M_Last_Name`, `S_Address`, `S_Address_s`, `City`, `State`, `Zip_Code`, `Phone`, `Email`, `std_pic`, `S_REG_NUM`, `st_Session`, `reg_date`, `sibling_dcp`, `tuition_fee_mode`, `total_fee`, `sibling_discount`, `monthly_fee`, `relation`) VALUES
(1, 'Harjinder', 'Singh', '3', 'A', '2020-01-08', '', 'Sukhwinder', 'Singh', 'Kulwant', 'Kaur', '234 Janta Nagar', '234 Janta Nagar', 'Ludhiana', 'Punjab', '141003', 2147483647, 'harjinder@gmail.com', '../std_pic/20252.png', 20252, '', 0, '', '', 0, 0, 0, ''),
(2, 'Jaskaran', 'Singh', '5', 'C', '2018-10-11', 'He', 'Balwinder', 'Singh', 'Jaswant', 'Kaur', '2134 Daba', '2134 Daba', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaskaran@gmail.com', '../std_pic/20253.png', 20253, '2024-2025', 0, '', '', 0, 0, 0, ''),
(3, 'Jaskaran', 'Singh', '4', 'C', '2018-10-11', 'He', 'Balwinder', 'Singh', 'Jaswant', 'Kaur', '2134 Daba', '2134 Daba', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaskaran@gmail.com', '../std_pic/20254.png', 20254, '2024-2025', 0, '', '', 0, 0, 0, ''),
(4, 'Jaskaran', 'Singh', '4', 'C', '2018-10-11', 'He', 'Balwinder', 'Singh', 'Jaswant', 'Kaur', '2134 Daba', '2134 Daba', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaskaran@gmail.com', '../std_pic/20254.png', 20254, '2024-2025', 0, '', '', 0, 0, 0, ''),
(5, 'Jaskaran', 'Singh', '8', 'B', '2018-10-11', 'He', 'Balwinder', 'Singh', 'Jaswant', 'Kaur', '2134 Daba', '2134 Daba', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaskaran@gmail.com', '../std_pic/20255.png', 20255, '2023-2024', 0, '', '', 0, 0, 0, ''),
(6, 'Jaskaran', 'Singh', '6', 'A', '2018-10-11', 'He', 'Balwinder', 'Singh', 'Jaswant', 'Kaur', '2134 Daba', '2134 Daba', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaskaran@gmail.com', '../std_pic/20256.png', 20256, '2023-2024', 0, '', '', 0, 0, 0, ''),
(7, 'jaspreet', 'singh', '7', 'C', '2014-07-24', 'He', 'Manpreet', 'Singh', 'Jaswinder', 'Kaur', '234 shimlapuri', '234 shimlapuri', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaspreet@gmail.com', '../std_pic/20257.png', 20257, '2024-2025', 0, '', '', 0, 0, 0, ''),
(8, 'jaspreet', 'singh', '4', 'B', '2014-07-24', 'He', 'Manpreet', 'Singh', 'Jaswinder', 'Kaur', '234 shimlapuri', '234 shimlapuri', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaspreet@gmail.com', '../std_pic/20258.png', 20258, '2024-2025', 0, '', '', 0, 0, 0, ''),
(9, 'jaspreet', 'singh', '3rd', 'C', '2014-07-24', 'He', 'Manpreet', 'Singh', 'Jaswinder', 'Kaur', '234 shimlapuri', '234 shimlapuri', 'Ludhiana', 'Punjab', '141003', 2147483647, 'jaspreet@gmail.com', '../std_pic/20259.png', 20259, '2025-2026', 0, '', '', 0, 0, 0, ''),
(10, 'Rohn', 'kamar', 'UKG', 'B', '2008-08-12', 'He', 'Ravinder', 'Kumar', 'Sunita', 'Rani', 'Dabba', 'Shimlapuri', 'Ludhiana', 'Punjab', '14010', 2147483647, 'rohan12@gmsail.com', '../std_pic/20260.jpg', 20260, '2024-2025', 0, '', '', 0, 0, 0, ''),
(11, 'Rohn', 'kamar', 'UKG', 'B', '2025-09-11', 'He', 'Ravinder', 'Kumar', 'Sunita', 'Rani', 'Dabba', 'Shimlapuri', 'Ludhiana', 'Punjab', '14010', 1234567890, 'rohan12@gmsail.com', '../std_pic/20261.jpg', 20261, '2024-2025', 0, 'this is the description of students sibling details', '', 0, 0, 0, ''),
(12, 'Rohn', 'kamar', '2nd', 'B', '2025-09-11', 'He', 'Ravinder', 'Kumar', 'Sunita', 'Rani', 'Dabba', 'Shimlapuri', 'Ludhiana', 'Punjab', '14010', 1234567890, 'rohan12@gmsail.com', '../std_pic/20262.jpg', 20262, '2024-2025', 0, 'this is the description of students sibling details', '', 0, 0, 0, ''),
(13, 'Rohn', 'kamar', '2nd', 'B', '2025-09-11', 'He', 'Ravinder', 'Kumar', 'Sunita', 'Rani', 'Dabba', 'Shimlapuri', 'Ludhiana', 'Punjab', '14010', 1234567890, 'rohan12@gmsail.com', '../std_pic/20262.jpg', 20262, '2024-2025', 0, 'this is the description of students sibling details', '', 0, 0, 0, ''),
(14, 'Rohn', 'kamar', '1st', 'C', '2025-09-04', 'He', 'Ravinder', 'Kumar', 'Sunita', 'Rani', 'Dabba', 'Shimlapuri', 'Ludhiana', 'Punjab', '14010', 1234567890, 'rohan12@gmsail.com', '../std_pic/20263.jpg', 20263, '2024-2025', 2025, 'hjjbjbjkk', '', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'ENGLISH'),
(2, 'PUNJABI'),
(3, 'HINDI'),
(4, 'MATH'),
(5, 'EVS'),
(6, 'ART'),
(7, 'SCIENCE'),
(8, 'SOCIAL STUDIES'),
(9, 'PHYSICAL EDUCATION'),
(10, 'COMPUTER SCIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `s_reg_no` int(10) NOT NULL,
  `description` mediumtext NOT NULL,
  `for_month` varchar(90) NOT NULL,
  `s_session` varchar(20) NOT NULL,
  `class_name` varchar(10) NOT NULL,
  `class_section` varchar(10) NOT NULL,
  `m_fee` int(20) NOT NULL,
  `t_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `privilege` varchar(25) NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `privilege`, `id`) VALUES
('admin', '1234', ' admin@gmail.com', 'Admin', 1),
('', '', '', '', 3),
('', '', '', '', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `fee_struct`
--
ALTER TABLE `fee_struct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_class` (`class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `fee_struct`
--
ALTER TABLE `fee_struct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `class_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `fee_struct`
--
ALTER TABLE `fee_struct`
  ADD CONSTRAINT `fee_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
