-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 12:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `PhoneNo` varchar(30) NOT NULL,
  `Gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Name`, `Email`, `Username`, `Password`, `Address`, `PhoneNo`, `Gender`) VALUES
(2, 'Htet Mo', 'htet@gmail.com', 'Htet', '123', 'Yangon, Myanmar', '09786204343', 'female'),
(3, 'Nandar La Wun', 'nandar@gmail.com', 'Nandar', '123', 'Yangon, Myanmar', '09799630183', 'female'),
(4, 'Park Cho Rong', 'rong03@gmail.com', 'Rong Rong', '123', 'Seoul, Korea', '87878798787', 'female'),
(5, 'Moon Byul ', 'moon@gmail.com', 'Moonbyul', '111', 'Seoul, Korea', '3434343', 'female'),
(6, 'Kang Seulgi', 'seulgi@gmail.com', 'Seulgi', '123', 'Seoul, Korea', '87987989789', 'female'),
(8, 'Mya Mya', 'mya@gmail.com', 'Mya', '123', 'Yangon, Myanmar', '09879847795', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `AnswerID` int(20) NOT NULL,
  `StudentID` int(20) NOT NULL,
  `CorrectOrWrong` varchar(10) NOT NULL,
  `TestID` int(20) NOT NULL,
  `QuestionID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`AnswerID`, `StudentID`, `CorrectOrWrong`, `TestID`, `QuestionID`) VALUES
(1, 1, 'Correct', 44, 56),
(33, 1, 'Wrong', 46, 42),
(34, 1, 'Correct', 46, 3),
(35, 1, 'Correct', 37, 45),
(36, 1, 'Correct', 37, 46),
(37, 1, 'Correct', 48, 45),
(38, 1, 'Wrong', 48, 58),
(39, 1, 'Correct', 41, 52),
(40, 1, 'Correct', 41, 53),
(41, 1, 'Wrong', 41, 54),
(42, 1, 'Correct', 45, 43),
(43, 1, 'Wrong', 45, 57),
(52, 1, 'Correct', 69, 83),
(53, 1, 'Wrong', 69, 84),
(54, 1, 'Wrong', 69, 85),
(55, 1, 'Correct', 69, 42);

-- --------------------------------------------------------

--
-- Table structure for table `blank_type`
--

CREATE TABLE `blank_type` (
  `BlankTypeID` int(11) NOT NULL,
  `QuestionID` varchar(20) NOT NULL,
  `Answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blank_type`
--

INSERT INTO `blank_type` (`BlankTypeID`, `QuestionID`, `Answer`) VALUES
(1, '2', '2'),
(3, '3', 'kitten'),
(4, '43', 'Apple'),
(5, '45', '2'),
(6, '46', '4'),
(7, '53', '8'),
(8, '59', 'stratosphere'),
(9, '66', '8'),
(10, '71', '25'),
(11, '75', 'William Shakespeare'),
(12, '78', '1'),
(13, '81', '10'),
(14, '85', '10');

-- --------------------------------------------------------

--
-- Table structure for table `multiplechoice`
--

CREATE TABLE `multiplechoice` (
  `MultipleChoiceOptionID` int(11) NOT NULL,
  `QuestionNo` int(11) DEFAULT NULL,
  `Answer` varchar(100) NOT NULL,
  `QuestionID` int(20) NOT NULL,
  `CorrectAnswer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `multiplechoice`
--

INSERT INTO `multiplechoice` (`MultipleChoiceOptionID`, `QuestionNo`, `Answer`, `QuestionID`, `CorrectAnswer`) VALUES
(1, NULL, '11', 1, 0),
(2, NULL, '5', 1, 1),
(3, NULL, '1', 1, 0),
(4, NULL, '4', 1, 0),
(5, NULL, '0', 1, 0),
(95, 1, 'qw', 50, 1),
(96, 1, 'as', 50, 0),
(97, 1, 'dw', 50, 0),
(98, 1, 've', 50, 0),
(99, 1, 'qer', 50, 0),
(100, NULL, 'A', 52, 1),
(101, NULL, 'B', 52, 0),
(102, NULL, 'C', 52, 0),
(103, NULL, 'D', 52, 0),
(104, NULL, 'E', 52, 0),
(105, 1, 'A', 56, 0),
(106, 1, 'D', 56, 0),
(107, 1, 'G', 56, 1),
(108, 1, 'Q', 56, 0),
(109, 1, 'Y', 56, 0),
(110, NULL, '8', 58, 0),
(111, NULL, '7', 58, 0),
(112, NULL, '6', 58, 1),
(113, NULL, '12', 58, 0),
(114, NULL, '3', 58, 0),
(115, NULL, '1', 63, 0),
(116, NULL, '4', 63, 1),
(117, NULL, '2', 63, 0),
(118, NULL, '0', 63, 0),
(119, NULL, '10', 63, 0),
(120, 1, '4', 64, 0),
(121, 1, '9', 64, 1),
(122, 1, '1', 64, 0),
(123, 1, '6', 64, 0),
(124, 1, '0', 64, 0),
(125, 2, '7', 65, 0),
(126, 2, '8', 65, 0),
(127, 2, '3', 65, 0),
(128, 2, '4', 65, 0),
(129, 2, '6', 65, 0),
(130, 1, '6', 73, 1),
(131, 1, '3', 73, 0),
(132, 1, '9', 73, 0),
(133, 1, '27', 73, 0),
(134, 1, '333', 73, 0),
(135, 1, '12', 77, 1),
(136, 1, '4', 77, 0),
(137, 1, '6', 77, 0),
(138, 1, '4', 77, 0),
(139, 1, '2', 77, 0),
(140, 1, '10', 80, 1),
(141, 1, '3', 80, 0),
(142, 1, '2', 80, 0),
(143, 1, '4', 80, 0),
(144, 1, '1', 80, 0),
(145, 1, '10', 83, 1),
(146, 1, '2', 83, 0),
(147, 1, '3', 83, 0),
(148, 1, '4', 83, 0),
(149, 1, '5', 83, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `QuestionID` int(20) NOT NULL,
  `QuestionNo` int(11) DEFAULT NULL,
  `Question` varchar(200) NOT NULL,
  `QuestionType` varchar(50) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Grade` varchar(30) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Category` varchar(30) NOT NULL,
  `Difficulty` varchar(30) NOT NULL,
  `AdminID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`QuestionID`, `QuestionNo`, `Question`, `QuestionType`, `Subject`, `Grade`, `CreatedDate`, `Category`, `Difficulty`, `AdminID`) VALUES
(1, NULL, 'What is 4 + 1?', 'Multiple Choice', 'Maths', 'Year 10', '2021-09-05 17:30:00', 'Test', 'Medium', 2),
(2, NULL, 'The result of 1+1 is ___.', 'Blank Type', 'Maths', 'Year 10', '2021-09-05 17:30:00', 'Test', 'Easy', 2),
(3, NULL, 'Word for baby cat is ___.', 'Blank Type', 'English', 'Year 10', '2021-09-05 17:30:00', 'Test', 'Easy', 2),
(42, NULL, 'Cat is a dog.', 'True or False', 'English', 'Year 10', '2021-09-06 17:30:00', 'Test', 'Easy', 5),
(43, NULL, 'The fruit ____ starts with A and ends with E.', 'Blank Type', 'English', 'Year 10', '2021-09-06 17:30:00', 'Test', 'Medium', 5),
(45, 1, '1+1 is ____.', 'Blank Type', 'Math', 'Year 10', '2021-09-06 17:30:00', 'Test', 'Easy', 5),
(46, 2, '2 + 2 is ___.', 'Blank Type', 'Math', 'Year 10', '2021-09-06 17:30:00', 'Test', 'Easy', 5),
(47, 1, 'Fish lives in water.', 'True or False', 'English', 'Year 10', '2021-09-07 17:30:00', 'Test', 'Easy', 5),
(48, 2, 'Tiger is vegetarian.', 'True or False', 'English', 'Year 10', '2021-09-07 17:30:00', 'Test', 'Easy', 5),
(50, 1, 'hghjghjgj', 'Multiple Choice', 'English', 'Year 10', '2021-10-07 17:30:00', 'Test', 'Easy', 5),
(51, 2, 'eerwer', 'True or False', 'English', 'Year 10', '2021-10-07 17:30:00', 'Test', 'Easy', 5),
(52, 1, 'What is A?', 'Multiple Choice', 'English', 'Year 12', '2021-10-07 17:30:00', 'Test', 'Hard', 5),
(53, 2, '3 + 5 = ___?', 'Blank Type', 'English', 'Year 12', '2021-10-07 17:30:00', 'Test', 'Easy', 5),
(54, 3, '6 + 6 is 11.', 'True or False', 'English', 'Year 12', '2021-10-07 17:30:00', 'Test', 'Hard', 5),
(55, 1, 'Cat lives in water.', 'True or False', 'English', 'Year 10', '2021-10-20 17:30:00', 'Test', 'Easy', 5),
(56, 1, 'Choose G.', 'Multiple Choice', 'English', 'Year 10', '2021-10-20 17:30:00', 'Test', 'Easy', 5),
(57, 2, 'Square root of 25 is 5.', 'True or False', 'English', 'Year 10', '2021-10-21 17:30:00', 'Test', 'Easy', 5),
(58, NULL, 'What is square root of 36?', 'Multiple Choice', 'Math', 'Year 10', '2021-10-28 17:30:00', 'Test', 'Medium', 5),
(59, NULL, 'The second of layer of atmosphere is ___.', 'Blank Type', 'Science', 'Year 10', '2021-10-28 17:30:00', 'Test', 'Hard', 5),
(62, NULL, '6 * 6 is 36.', 'True or False', 'Math', 'Year 10', '2021-10-28 17:30:00', 'Test', 'Medium', 5),
(63, NULL, 'What is 2 + 2?', 'Multiple Choice', 'Math', 'Year 10', '2021-11-06 17:30:00', 'Test', 'Hard', 5),
(64, 1, 'What is 3 * 3?', 'Multiple Choice', 'English', 'Year 10', '2021-11-25 17:30:00', 'Test', 'Easy', 5),
(65, 2, 'What is the square root of 64?', 'Multiple Choice', 'English', 'Year 10', '2021-11-25 17:30:00', 'Test', 'Hard', 5),
(66, 2, '4 + 4 is ___.', 'Blank Type', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(67, 2, 'erer', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(68, 1, 'fsfsdf', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(69, 1, 'fdsfdf', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(70, 2, 'dsfdfr', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(71, 1, '5 * 5 is ___.', 'Blank Type', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(72, 2, '5 * 5 is 25.', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(73, 1, 'What is 3 + 3 + 3?', 'Multiple Choice', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(74, 2, 'wrewr', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(75, NULL, 'Romeo and Juliet was written by ___.', 'Blank Type', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(76, NULL, 'The name for little cats is \"Kitten\".', 'True or False', 'English', 'Year 10', '2021-11-26 17:30:00', 'Test', 'Easy', 5),
(83, 1, 'What is 5 + 5?', 'Multiple Choice', 'English', 'Year 10', '2021-11-28 17:30:00', 'Test', 'Easy', 5),
(84, 2, '5is 5 is 3.', 'True or False', 'English', 'Year 10', '2021-11-28 17:30:00', 'Test', 'Easy', 5),
(85, 3, '5 + 5 is ___.', 'Blank Type', 'English', 'Year 10', '2021-11-28 17:30:00', 'Test', 'Easy', 5);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `ResultID` int(20) NOT NULL,
  `StudentID` int(20) NOT NULL,
  `Comment` varchar(50) DEFAULT NULL,
  `FinalScores` int(11) NOT NULL,
  `Grade` varchar(50) NOT NULL,
  `PassOrFail` varchar(10) DEFAULT NULL,
  `IssuedDate` varchar(10) NOT NULL,
  `AdminID` int(10) NOT NULL,
  `TestID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`ResultID`, `StudentID`, `Comment`, `FinalScores`, `Grade`, `PassOrFail`, `IssuedDate`, `AdminID`, `TestID`) VALUES
(3, 1, 'Excellent work!', 20, 'A', 'Fail', '2021-11-02', 5, 37),
(4, 1, 'You are good.', 50, 'C', 'Pass', '2021-11-07', 5, 48),
(7, 1, 'Good job.', 20, 'B', 'Pass', '2021-11-03', 5, 69);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` int(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `PhoneNo` varchar(30) NOT NULL,
  `Grade` varchar(30) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `ProfilePicture` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `Name`, `Email`, `Username`, `Password`, `Address`, `PhoneNo`, `Grade`, `Gender`, `ProfilePicture`) VALUES
(1, 'Bae Joohyun', 'joo12@gmail.com', 'Joohyun', '123', 'Seoul, Korea', '4354354354', 'Year 10', 'female', 0x416e6e6f746174696f6e20323032302d30382d3236203231333930382e706e67),
(3, 'Mya Mya', 'mya@gmail.com', 'MyaMya', '123', 'Yangon', '3343423', 'Year 10', 'female', 0x55736572496d6167652f5f77616c6c7061706572666c6172652e636f6d5f77616c6c7061706572202831292e6a7067),
(5, 'Mary Rose', 'rosy@gmail.com', 'Mary', '123', 'Yangon', '3243243', 'Year 12', 'female', 0x77656576692d666e622e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `student_test`
--

CREATE TABLE `student_test` (
  `StudentTestID` int(20) NOT NULL,
  `TestID` int(20) NOT NULL,
  `StudentID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_test`
--

INSERT INTO `student_test` (`StudentTestID`, `TestID`, `StudentID`) VALUES
(1, 46, 1),
(2, 37, 1),
(3, 48, 1),
(4, 41, 1),
(5, 45, 1),
(8, 69, 1),
(9, 44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `TestID` int(20) NOT NULL,
  `TestName` varchar(50) NOT NULL,
  `Duration_Mins` int(11) NOT NULL,
  `StartTime` timestamp NULL DEFAULT NULL,
  `Subject` varchar(30) NOT NULL,
  `Grade` varchar(20) NOT NULL,
  `NoOfQuestions` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `AdminID` int(10) NOT NULL,
  `TotalMarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`TestID`, `TestName`, `Duration_Mins`, `StartTime`, `Subject`, `Grade`, `NoOfQuestions`, `Status`, `AdminID`, `TotalMarks`) VALUES
(37, 'Test 1', 20, '2021-09-09 06:08:04', 'Math', 'Year 10', 2, 'Pending', 5, 100),
(38, 'Test 2', 20, '2021-07-09 05:17:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(39, 'Test 3', 20, '0000-00-00 00:00:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(41, 'Test 4', 1, '2021-10-18 06:06:25', 'English', 'Year 10', 3, 'Pending', 5, 100),
(42, 'Test 5', 60, '0000-00-00 00:00:00', 'English', 'Year 12', 1, 'Published', 5, 10),
(43, 'Test 6', 60, '2021-07-09 05:17:00', 'English', 'Year 10', 1, 'Pending', 5, 10),
(44, 'Test 7', 30, '2021-07-09 05:17:00', 'English', 'Year 10', 1, 'Pending', 5, 100),
(45, 'Test 8', 1, '2021-11-02 23:30:00', 'English', 'Year 10', 2, 'Published', 5, 20),
(46, 'Test 9', 1, '2021-12-01 01:30:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(48, 'Test 11', 20, '2021-11-05 23:30:00', 'Math', 'Year 10', 2, 'Pending', 5, 100),
(49, 'Test 10', 20, '0000-00-00 00:00:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(50, 'English Test 2022', 60, '2022-12-12 00:30:00', 'English', 'Year 10', 3, 'Published', 5, 100),
(51, 'Test 12', 60, '2021-12-02 23:30:00', 'English', 'Year 10', 3, 'Pending', 5, 30),
(53, 'Test 13', 30, '2021-07-09 05:17:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(55, 'dfdsfd', 43, '2021-07-10 03:30:00', 'English', 'Year 10', 2, 'Pending', 5, 2124),
(56, 'fdfsdfdsf', 60, '0000-00-00 00:00:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(57, 'gttgdrgd', 60, '2021-07-09 05:17:00', 'English', 'Year 10', 2, 'Pending', 5, 2),
(62, 'dfdsfsggsgsdg', 45, '2021-07-09 05:17:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(64, 'Test English 1', 20, '2021-11-27 05:17:00', 'English', 'Year 10', 2, 'Pending', 5, 100),
(65, 'Test 21', 60, '2021-11-30 01:30:00', 'English', 'Year 10', 2, 'Pending', 5, 20),
(69, 'Test101', 1, '2021-11-28 05:17:00', 'English', 'Year 10', 4, 'Published', 5, 40),
(70, 'You can take this test', 3, '2021-11-29 00:30:00', 'English', 'Year 10', 4, 'Published', 5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE `test_question` (
  `TestQuestionID` int(20) NOT NULL,
  `QuestionID` varchar(20) NOT NULL,
  `TestID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`TestQuestionID`, `QuestionID`, `TestID`) VALUES
(28, '45', '37'),
(29, '46', '37'),
(30, '47', '38'),
(31, '48', '38'),
(32, '50', '39'),
(33, '51', '39'),
(34, '52', '41'),
(35, '53', '41'),
(36, '54', '41'),
(37, '3', '42'),
(38, '55', '43'),
(39, '56', '44'),
(40, '43', '45'),
(41, '57', '45'),
(42, '42', '46'),
(43, '3', '46'),
(46, '45', '48'),
(47, '58', '48'),
(48, '64', '49'),
(49, '43', '49'),
(50, '42', '50'),
(51, '42', '50'),
(52, '65', '50'),
(53, '65', '51'),
(54, '65', '51'),
(55, '66', '51'),
(61, '3', '53'),
(62, '43', '53'),
(66, '47', '55'),
(67, '67', '55'),
(68, '68', '56'),
(69, '3', '56'),
(70, '42', '56'),
(71, '42', '57'),
(72, '56', '57'),
(85, '69', '62'),
(86, '43', '62'),
(89, '71', '64'),
(90, '72', '64'),
(91, '73', '65'),
(92, '74', '65'),
(102, '83', '69'),
(103, '84', '69'),
(104, '85', '69'),
(105, '42', '69'),
(106, '58', '70'),
(107, '42', '70'),
(108, '2', '70'),
(109, '1', '70');

-- --------------------------------------------------------

--
-- Table structure for table `true_or_false`
--

CREATE TABLE `true_or_false` (
  `TrueOrFalseID` int(11) NOT NULL,
  `TrueOrFalse` varchar(10) NOT NULL,
  `QuestionID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `true_or_false`
--

INSERT INTO `true_or_false` (`TrueOrFalseID`, `TrueOrFalse`, `QuestionID`) VALUES
(1, 'False', '42'),
(2, 'True', '47'),
(3, 'False', '48'),
(4, 'False', '51'),
(5, 'False', '54'),
(6, 'True', '55'),
(7, 'True', '57'),
(8, 'True', '62'),
(9, 'False', '67'),
(10, 'False', '68'),
(11, 'False', '69'),
(12, 'False', '70'),
(13, 'False', '72'),
(14, 'False', '74'),
(15, 'True', '76'),
(16, 'False', '79'),
(17, 'False', '82'),
(18, 'False', '84');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`AnswerID`),
  ADD KEY `TestID` (`TestID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `blank_type`
--
ALTER TABLE `blank_type`
  ADD PRIMARY KEY (`BlankTypeID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `multiplechoice`
--
ALTER TABLE `multiplechoice`
  ADD PRIMARY KEY (`MultipleChoiceOptionID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`ResultID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `TestID` (`TestID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `student_test`
--
ALTER TABLE `student_test`
  ADD PRIMARY KEY (`StudentTestID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`TestID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`TestQuestionID`),
  ADD KEY `TestQuestionID` (`TestQuestionID`),
  ADD KEY `TestID` (`TestID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `true_or_false`
--
ALTER TABLE `true_or_false`
  ADD PRIMARY KEY (`TrueOrFalseID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `AnswerID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `blank_type`
--
ALTER TABLE `blank_type`
  MODIFY `BlankTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `multiplechoice`
--
ALTER TABLE `multiplechoice`
  MODIFY `MultipleChoiceOptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `QuestionID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `ResultID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_test`
--
ALTER TABLE `student_test`
  MODIFY `StudentTestID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `TestID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `TestQuestionID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `true_or_false`
--
ALTER TABLE `true_or_false`
  MODIFY `TrueOrFalseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
