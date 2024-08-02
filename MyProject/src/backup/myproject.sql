-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `CON_ID` int(11) NOT NULL,
  `EMP_ID` text NOT NULL,
  `CON_ADD` text NOT NULL,
  `CON_MOBILE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`CON_ID`, `EMP_ID`, `CON_ADD`, `CON_MOBILE`) VALUES
(1, '1', 'namkhana', '7584007890');

-- --------------------------------------------------------

--
-- Table structure for table `contact_emp`
--

CREATE TABLE `contact_emp` (
  `CON_ID` int(11) NOT NULL,
  `CON_FROM` text NOT NULL,
  `CON_TO` text NOT NULL,
  `CON_POST` text NOT NULL,
  `CON_MSG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_msg`
--

CREATE TABLE `contact_msg` (
  `CON_MSG_ID` int(11) NOT NULL,
  `EMP_ID_FROM` int(11) NOT NULL,
  `EMP_ID_TO` int(11) NOT NULL DEFAULT 1,
  `CON_MSG_MSG` text NOT NULL,
  `CON_MSG_MSG_DESC` text NOT NULL,
  `CON_MSG_STATUS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_msg`
--

INSERT INTO `contact_msg` (`CON_MSG_ID`, `EMP_ID_FROM`, `EMP_ID_TO`, `CON_MSG_MSG`, `CON_MSG_MSG_DESC`, `CON_MSG_STATUS`) VALUES
(10, 3, 1, 'subtext', 'complite', 'reject'),
(13, 4, 1, 'test another', 'check', 'reject'),
(14, 10, 1, 'post', 'explain post', 'accept'),
(16, 10, 1, 'test', 'test demo again', 'accept'),
(17, 10, 1, 'test', 'test demo again', 'accept'),
(18, 3, 1, 'demo test', 'lorem huuuuuu', 'accept'),
(19, 4, 1, 'text 5', 'demo test another page', 'accept'),
(20, 4, 1, 'text 5', 'demo test another page', 'reject'),
(21, 4, 1, 'demo.text final', 'final test done', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EDU_ID` int(11) NOT NULL,
  `EDU_NAME` text NOT NULL,
  `EDU_START_YEAR` text NOT NULL,
  `EDU_END_YEAR` text NOT NULL,
  `EDU_COMMAND` text NOT NULL,
  `EDU_UNIVERCITY` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`EDU_ID`, `EDU_NAME`, `EDU_START_YEAR`, `EDU_END_YEAR`, `EDU_COMMAND`, `EDU_UNIVERCITY`) VALUES
(1, 'Madhyamik', '2018', '2019', '', 'Haripur Gadadhar Vidyapith'),
(2, 'Higher Secondary', '2020', '2021', '', 'Narayanitala Dhaneswar Siksha Sadan Higher Secondary School'),
(3, 'CCA (Certificate in Computer Applications)', '2021', '2022', 'course', 'Ramakrishna Mission Shilpamandira Computer Centre (2021-2022)'),
(4, 'CCPA (Certificate in Computer Programming & Application)', '2022', '2023', 'course', 'Ramakrishna Mission Shilpamandira Computer Centre (2021-2022)'),
(5, 'CACPA (Certificate in Advanced Computer Programming & Applications)', '2022', '2023', 'course', 'Ramakrishna Mission Shilpamandira Computer Centre (2021-2022)'),
(6, 'CSE (Certificate in Software Engineering)', '2023', '2024', 'course', 'Ramakrishna Mission Shilpamandira Computer Centre (2021-2022)');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMP_ID` int(11) NOT NULL,
  `EMP_NAME` text NOT NULL,
  `EMP_EMAIL` text NOT NULL,
  `EMP_PASSWORD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMP_ID`, `EMP_NAME`, `EMP_EMAIL`, `EMP_PASSWORD`) VALUES
(1, 'sayan das', 'sayan@gmail.com', '123'),
(3, 'partha das', 'partha@gmail.com', '123'),
(4, 'piyali das', 'piyali@gmail.com', '8567');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `PRO_ID` int(11) NOT NULL,
  `PRO_NAME` text NOT NULL,
  `PRO_CONTENT` text NOT NULL,
  `PRO_IMG` text NOT NULL,
  `EMP_ID` int(11) NOT NULL,
  `PRO_COMMAND` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`PRO_ID`, `PRO_NAME`, `PRO_CONTENT`, `PRO_IMG`, `EMP_ID`, `PRO_COMMAND`) VALUES
(1, 'Portfolio Website', 'This is a digital copy of CV, and Presentation of What he do.', './src/resources/portfolio.png', 1, 0),
(2, 'Project Converter', 'Version : 1.0', './src/resources/phone-app.png', 1, 1),
(3, 'Music Player', 'Version : 1.0', './src/resources/app-music.png', 1, 1),
(4, 'Camera', 'Version : 1.0', './src/resources/app-camera.png', 1, 1),
(5, 'Login Page', 'Playing with HTML AND CSS AND JS', './src/resources/login.png', 1, 0),
(6, 'Number Gussing Game', 'This project is JavaScript Base game project.', './src/resources/numbergame.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `SKILL_ID` int(11) NOT NULL,
  `SKILL_NAME` text NOT NULL,
  `SKILL_ICON` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`SKILL_ID`, `SKILL_NAME`, `SKILL_ICON`) VALUES
(1, 'HTML', '<i class=\"fa-brands fa-html5\"></i>\r\n'),
(2, 'CSS', '<i class=\"fa-brands fa-css3-alt\"></i>'),
(3, 'PHP', '<i class=\"fa-brands fa-php\"></i>'),
(4, 'JAVA', '<i class=\"fa-brands fa-java\"></i>'),
(5, 'JS', '<i class=\"fa-brands fa-js\"></i>'),
(6, 'ANDROID', '<i class=\"fa-brands fa-android\"></i>'),
(7, 'MySQL', '<i class=\"fa-solid fa-database\"></i>'),
(8, 'IOT', '<i class=\"fa-solid fa-robot\"></i>'),
(9, 'HARDWARE', '<i class=\"fa-solid fa-screwdriver-wrench\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `skill_emp`
--

CREATE TABLE `skill_emp` (
  `SKILL_ID` int(11) NOT NULL,
  `EMP_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill_emp`
--

INSERT INTO `skill_emp` (`SKILL_ID`, `EMP_ID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`CON_ID`);

--
-- Indexes for table `contact_emp`
--
ALTER TABLE `contact_emp`
  ADD PRIMARY KEY (`CON_ID`);

--
-- Indexes for table `contact_msg`
--
ALTER TABLE `contact_msg`
  ADD PRIMARY KEY (`CON_MSG_ID`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EDU_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMP_ID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`PRO_ID`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`SKILL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `CON_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_emp`
--
ALTER TABLE `contact_emp`
  MODIFY `CON_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_msg`
--
ALTER TABLE `contact_msg`
  MODIFY `CON_MSG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EDU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EMP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `PRO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `SKILL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
