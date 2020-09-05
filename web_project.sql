-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 07:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(50) NOT NULL,
  `adminpassword` varchar(100) NOT NULL,
  `adminname` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminpassword`, `adminname`) VALUES
('20-0001-01', '$2y$10$VufgIz7QNGm37itlZ0StguuRr88p.t05lhW5GsH0eZhJvXJqHCPaW', 'raiyan'),
('20-0001-02', '$2y$10$RdbzRQJSA6rW4Al8l35vCeEH.zhdc2q9p4lZtCYTjYF4ikAP0InTa', 'raiyan'),
('20-0002-01', '$2y$10$LhL.ToT5CG5hgo4Me7nfSOcXncQJgbuA5aoHroXIO5H2RiqeukK6W', 'shihab'),
('20-0002-02', '$2y$10$crHLjEabP07jC2ot5Lz07.PX/dF3r7VbRcPdruog9bzdtJMAP0A2K', 'shihab'),
('20-0003-01', '$2y$10$yulJMtDI09Ktqoa8vlM1ce0Z2qmP0XfhVYlVVsbgC0LV1ih3s0e4a', 'rayman');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignmentid` int(100) NOT NULL,
  `assignmentadddate` datetime(6) NOT NULL,
  `assignmentduedate` datetime(6) NOT NULL,
  `classid` int(50) NOT NULL,
  `sectionid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid` int(50) NOT NULL,
  `classnumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `classnumber`) VALUES
(1000, 'Play'),
(1001, 'Nursery'),
(1002, 'KG'),
(1003, 'One'),
(1004, 'Two'),
(1005, 'Three'),
(1006, 'Four'),
(1007, 'Five'),
(1008, 'Six'),
(1009, 'Seven'),
(1010, 'Eight'),
(1011, 'Nine'),
(1012, 'Ten'),
(1013, 'Eleven'),
(1014, 'Twelve');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `gradeid` int(50) NOT NULL,
  `ct1` varchar(50) NOT NULL,
  `ct2` varchar(50) NOT NULL,
  `mid` varchar(50) NOT NULL,
  `ct3` varchar(50) NOT NULL,
  `ct4` varchar(50) NOT NULL,
  `final` varchar(50) NOT NULL,
  `studentid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `homeworkid` int(100) NOT NULL,
  `homeworkadddate` datetime(6) NOT NULL,
  `homeworkduedate` datetime(6) NOT NULL,
  `classid` int(50) NOT NULL,
  `sectionid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionid` int(50) NOT NULL,
  `sectionname` varchar(10) NOT NULL,
  `classid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionid`, `sectionname`, `classid`) VALUES
(100, 'A', 1000),
(101, 'A', 1001),
(102, 'A', 1002),
(103, 'A', 1003),
(104, 'A', 1004);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` varchar(50) NOT NULL,
  `studentpassword` varchar(100) NOT NULL,
  `studentname` varchar(50) NOT NULL,
  `classid` int(50) NOT NULL,
  `sectionid` int(50) NOT NULL,
  `studentbloodgroup` varchar(50) NOT NULL,
  `studentmobile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `studentpassword`, `studentname`, `classid`, `sectionid`, `studentbloodgroup`, `studentmobile`) VALUES
('20-0001-04', '$2y$10$PMCkllBkCHJV9tK2kmjn1.qYQkMnS/Avx8Ty/p0LCCOdXGwImFpG2', 'raiyan', 1000, 100, 'B+', '0123'),
('20-0002-04', '$2y$10$QV0TuFl.ahJx45ev7.Wgq.mwOaET766D/uSLjai1jQ.PIU.8sPOBu', 'shihab', 1000, 100, 'O+', '0123'),
('20-0003-04', '$2y$10$hqJ.km7Pe0PCsNRi.WDhee8dZG2OrJYmy2du9TNWpoqf4ideghuny', 'Forhad', 1000, 100, 'A+', '0123');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` int(50) NOT NULL,
  `subjectname` varchar(50) NOT NULL,
  `classid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectname`, `classid`) VALUES
(900, 'English', 1000),
(901, 'Bangla', 1000),
(902, 'Math', 1003),
(903, 'English', 1003),
(904, 'Bangla', 1003),
(905, 'Math', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherid` varchar(50) NOT NULL,
  `teachername` varchar(40) NOT NULL,
  `teacherpassword` varchar(100) NOT NULL,
  `classid` int(50) NOT NULL,
  `sectionid` int(50) NOT NULL,
  `subjectid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherid`, `teachername`, `teacherpassword`, `classid`, `sectionid`, `subjectid`) VALUES
('20-0001-03', 'raiyan', '$2y$10$qu4Q9Syju693mc2NrbDmvufkMDe.TPHb9Y.6ybdjY/AjShy4ab.IG', 1000, 100, 900),
('20-0002-03', 'shihab', '$2y$10$rvDcQ4byEhBsgiSy5MAKkezqJL255MBRYOZWr9Pz0BuGGLMxmPUVa', 1001, 101, 905);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `directory` varchar(50) NOT NULL,
  `filename` varchar(150) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`directory`, `filename`, `datetime`) VALUES
('uploads/20-0001-03100', 'Class_routine_Nine_English Medium_Science_A.pdf', '2020-05-18 07:48:30'),
('uploads/20-0001-03100', 'Class_routine_Nine_English Medium_A&B.pdf', '2020-05-18 12:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`) VALUES
('20-0001-01'),
('20-0001-02'),
('20-0001-03'),
('20-0001-04'),
('20-0002-01'),
('20-0002-02'),
('20-0002-03'),
('20-0002-04'),
('20-0003-01'),
('20-0003-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `sectionid` (`sectionid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`gradeid`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homeworkid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `sectionid` (`sectionid`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionid`),
  ADD KEY `classid` (`classid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `sectionid` (`sectionid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`),
  ADD KEY `classid` (`classid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `sectionid` (`sectionid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`datetime`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`),
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`sectionid`) REFERENCES `section` (`sectionid`);

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`),
  ADD CONSTRAINT `homework_ibfk_2` FOREIGN KEY (`sectionid`) REFERENCES `section` (`sectionid`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`sectionid`) REFERENCES `section` (`sectionid`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`sectionid`) REFERENCES `section` (`sectionid`),
  ADD CONSTRAINT `teacher_ibfk_3` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
