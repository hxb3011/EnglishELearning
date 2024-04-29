-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2024 lúc 04:06 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `testdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `UID` varchar(20) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  `Permissions` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `acompmask`
--

DROP TABLE IF EXISTS `acompmask`;
CREATE TABLE `acompmask` (
  `ID` int(11) NOT NULL,
  `AnswerID` int(11) DEFAULT NULL,
  `QCoMaskID` int(11) DEFAULT NULL,
  `Content` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `amatching`
--

DROP TABLE IF EXISTS `amatching`;
CREATE TABLE `amatching` (
  `AnsID` int(11) NOT NULL,
  `QMat` int(11) NOT NULL,
  `QMatKey` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `amulchoption`
--

DROP TABLE IF EXISTS `amulchoption`;
CREATE TABLE `amulchoption` (
  `QOptID` int(11) NOT NULL,
  `AnsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `ID` int(11) NOT NULL,
  `Content` varchar(20) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `ExcsRespID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `PProfID` varchar(20) NOT NULL,
  `PSubID` varchar(20) NOT NULL,
  `AuthID` varchar(20) NOT NULL,
  `SubID` varchar(40) NOT NULL,
  `Content` text NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Updated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conjugation`
--

DROP TABLE IF EXISTS `conjugation`;
CREATE TABLE `conjugation` (
  `InfinitiveID` int(11) NOT NULL,
  `AlternativeID` int(11) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contribution`
--

DROP TABLE IF EXISTS `contribution`;
CREATE TABLE `contribution` (
  `ProfileID` varchar(20) NOT NULL,
  `MeaningID` varchar(20) NOT NULL,
  `Accepted` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `ID` varchar(20) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PosterUri` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `State` tinyint(4) NOT NULL,
  `ProfileID` varchar(20) DEFAULT NULL,
  `BeginDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
  `ID` varchar(20) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `DocUri` varchar(255) DEFAULT NULL,
  `State` tinyint(4) DEFAULT NULL,
  `LessonID` varchar(20) DEFAULT NULL,
  `OrderN` int DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `example`
--

DROP TABLE IF EXISTS `example`;
CREATE TABLE `example` (
  `ID` int(11) NOT NULL,
  `MeaningID` varchar(20) DEFAULT NULL,
  `Example` varchar(20) DEFAULT NULL,
  `Explanation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `excercise`
--

DROP TABLE IF EXISTS `excercise`;
CREATE TABLE `excercise` (
  `ID` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `Deadline` datetime DEFAULT NULL,
  `State` tinyint(4) DEFAULT NULL,
  `CourseID` varchar(20) DEFAULT NULL,
  `OrderN` int DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `execsresponse`
--

DROP TABLE IF EXISTS `execsresponse`;
CREATE TABLE `execsresponse` (
  `ID` varchar(20) NOT NULL,
  `AtDateTime` datetime DEFAULT NULL,
  `ExcerciseID` int(11) DEFAULT NULL,
  `ProfileID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `learntrecord`
--

DROP TABLE IF EXISTS `learntrecord`;
CREATE TABLE `learntrecord` (
  `ProfileID` varchar(20) NOT NULL,
  `MeaningID` varchar(20) NOT NULL,
  `LastReviewed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lemma`
--

DROP TABLE IF EXISTS `lemma`;
CREATE TABLE `lemma` (
  `ID` int(11) NOT NULL,
  `KeyL` varchar(255) NOT NULL,
  `PartOfSpeech` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE `lesson` (
  `ID` varchar(20) DEFAULT NULL,
  `Description` text NOT NULL,
  `State` tinyint(4) DEFAULT NULL,
  `CourseID` varchar(20) DEFAULT NULL,
  `OrderN` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `meaning`
--

DROP TABLE IF EXISTS `meaning`;
CREATE TABLE `meaning` (
  `ID` varchar(20) NOT NULL,
  `LemmaID` int(11) DEFAULT NULL,
  `LevelV` varchar(255) DEFAULT NULL,
  `Meaning` varchar(255) DEFAULT NULL,
  `Explanation` varchar(255) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `ID` varchar(20) NOT NULL,
  `KEYC` varchar(20) DEFAULT NULL,
  `ProfileID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `ProfileID` varchar(20) NOT NULL,
  `SubID` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL,
  `Updated` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `ID` varchar(20) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Gender` tinyint(4) NOT NULL,
  `BirthDay` date NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `UID` varchar(20) NOT NULL,
  `RoleID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pronunciation`
--

DROP TABLE IF EXISTS `pronunciation`;
CREATE TABLE `pronunciation` (
  `LemmaID` int(11) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `IPA` text DEFAULT NULL,
  `Voice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qcompletion`
--

DROP TABLE IF EXISTS `qcompletion`;
CREATE TABLE `qcompletion` (
  `ID` int(11) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `State` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qcompmask`
--

DROP TABLE IF EXISTS `qcompmask`;
CREATE TABLE `qcompmask` (
  `ID` int(11) NOT NULL,
  `Offset` int(11) NOT NULL,
  `Length` int(11) NOT NULL,
  `QCompID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qmatching`
--

DROP TABLE IF EXISTS `qmatching`;
CREATE TABLE `qmatching` (
  `ID` int(11) NOT NULL,
  `Content` text DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `KeyQ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qmatchingkey`
--

DROP TABLE IF EXISTS `qmatchingkey`;
CREATE TABLE `qmatchingkey` (
  `ID` int(11) NOT NULL,
  `Content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qmulchoption`
--

DROP TABLE IF EXISTS `qmulchoption`;
CREATE TABLE `qmulchoption` (
  `ID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Content` varchar(255) DEFAULT NULL,
  `Correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `ID` int(11) NOT NULL,
  `Content` text DEFAULT NULL,
  `State` tinyint(4) DEFAULT NULL,
  `ExcerciseID` int(11) DEFAULT NULL,
  `OrderN` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `ID` varchar(20) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Permissions` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `verification`
--

DROP TABLE IF EXISTS `verification`;
CREATE TABLE `verification` (
  `ProfileID` varchar(20) NOT NULL,
  `KeyVerify` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`UID`);

--
-- Chỉ mục cho bảng `acompmask`
--
ALTER TABLE `acompmask`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_AnswerID_acompmask_answer` (`AnswerID`),
  ADD KEY `FK_QCoMaskID_acompmask_qcompmask` (`QCoMaskID`);

--
-- Chỉ mục cho bảng `amatching`
--
ALTER TABLE `amatching`
  ADD PRIMARY KEY (`AnsID`,`QMat`,`QMatKey`),
  ADD KEY `FK_QMat_amatching_qmatching` (`QMat`),
  ADD KEY `FK_QMatKey_amatching_qmatchingkey` (`QMatKey`);

--
-- Chỉ mục cho bảng `amulchoption`
--
ALTER TABLE `amulchoption`
  ADD PRIMARY KEY (`QOptID`,`AnsID`),
  ADD KEY `FK_AnsID_amulchoption_answer` (`AnsID`);

--
-- Chỉ mục cho bảng `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_QuestionID_answer_question` (`QuestionID`),
  ADD KEY `FK_ExcsRespID_answer_execsresponse` (`ExcsRespID`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`PProfID`,`PSubID`,`AuthID`,`SubID`),
  ADD KEY `FK_PSubID_Comment_Post` (`PSubID`),
  ADD KEY `FK_AuthID_Comment_Post` (`AuthID`);

--
-- Chỉ mục cho bảng `conjugation`
--
ALTER TABLE `conjugation`
  ADD PRIMARY KEY (`InfinitiveID`,`AlternativeID`),
  ADD KEY `FK_AlternativeID_conjugation_Lemma` (`AlternativeID`);

--
-- Chỉ mục cho bảng `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`ProfileID`,`MeaningID`),
  ADD KEY `FK_MeaningID_contri_meaning` (`MeaningID`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ProfileID_course_profile` (`ProfileID`);

--
-- Chỉ mục cho bảng `document`
--
ALTER TABLE `document`
  ADD KEY `FK_CourseID_document_lesson` (`LessonID`);

--
-- Chỉ mục cho bảng `example`
--
ALTER TABLE `example`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_MeaningID_example_meaning` (`MeaningID`);

--
-- Chỉ mục cho bảng `excercise`
--
ALTER TABLE `excercise`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CourseID_excercise_course` (`CourseID`);

--
-- Chỉ mục cho bảng `execsresponse`
--
ALTER TABLE `execsresponse`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ExcerciseID_execsresponse_excercise` (`ExcerciseID`),
  ADD KEY `FK_ProfileID_execsresponse_profile` (`ProfileID`);

--
-- Chỉ mục cho bảng `learntrecord`
--
ALTER TABLE `learntrecord`
  ADD PRIMARY KEY (`ProfileID`,`MeaningID`),
  ADD KEY `FK_MeaningID_learntrecord_meaning` (`MeaningID`);

--
-- Chỉ mục cho bảng `lemma`
--
ALTER TABLE `lemma`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY(`ID`),
  ADD KEY `FK_CourseID_lesson_course` (`CourseID`);

--
-- Chỉ mục cho bảng `meaning`
--
ALTER TABLE `meaning`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_LemmaID_meaning_Lemma` (`LemmaID`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ProfileID_payment_profile` (`ProfileID`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ProfileID`,`SubID`),
  ADD KEY `post_subid_indexes` (`SubID`);

--
-- Chỉ mục cho bảng `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_RoleID_Profile_Role` (`RoleID`),
  ADD KEY `FK_UID_Profile_Account` (`UID`);

--
-- Chỉ mục cho bảng `pronunciation`
--
ALTER TABLE `pronunciation`
  ADD PRIMARY KEY (`LemmaID`,`Region`);

--
-- Chỉ mục cho bảng `qcompletion`
--
ALTER TABLE `qcompletion`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `qcompmask`
--
ALTER TABLE `qcompmask`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ QCompID_qcommask_qcompletion` (`QCompID`);

--
-- Chỉ mục cho bảng `qmatching`
--
ALTER TABLE `qmatching`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_QuestionID_qmatching_question` (`QuestionID`),
  ADD KEY `FK_KeyQ_qmatching_qmatchingkey` (`KeyQ`);

--
-- Chỉ mục cho bảng `qmatchingkey`
--
ALTER TABLE `qmatchingkey`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `qmulchoption`
--
ALTER TABLE `qmulchoption`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_QuestionID_qmulchoption_question` (`QuestionID`);

--
-- Chỉ mục cho bảng `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ExcerciseID_question_excercise` (`ExcerciseID`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`ProfileID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `acompmask`
--
ALTER TABLE `acompmask`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `answer`
--
ALTER TABLE `answer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `example`
--
ALTER TABLE `example`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `excercise`
--
ALTER TABLE `excercise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lemma`
--
ALTER TABLE `lemma`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `qcompmask`
--
ALTER TABLE `qcompmask`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `qmatching`
--
ALTER TABLE `qmatching`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `qmatchingkey`
--
ALTER TABLE `qmatchingkey`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `qmulchoption`
--
ALTER TABLE `qmulchoption`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `question`
--
ALTER TABLE `question`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `acompmask`
--
ALTER TABLE `acompmask`
  ADD CONSTRAINT `FK_AnswerID_acompmask_answer` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`ID`),
  ADD CONSTRAINT `FK_QCoMaskID_acompmask_qcompmask` FOREIGN KEY (`QCoMaskID`) REFERENCES `qcompmask` (`ID`);

--
-- Các ràng buộc cho bảng `amatching`
--
ALTER TABLE `amatching`
  ADD CONSTRAINT `FK_AnsID_amatching_answer` FOREIGN KEY (`AnsID`) REFERENCES `answer` (`ID`),
  ADD CONSTRAINT `FK_QMatKey_amatching_qmatchingkey` FOREIGN KEY (`QMatKey`) REFERENCES `qmatchingkey` (`ID`),
  ADD CONSTRAINT `FK_QMat_amatching_qmatching` FOREIGN KEY (`QMat`) REFERENCES `qmatching` (`ID`);

--
-- Các ràng buộc cho bảng `amulchoption`
--
ALTER TABLE `amulchoption`
  ADD CONSTRAINT `FK_AnsID_amulchoption_answer` FOREIGN KEY (`AnsID`) REFERENCES `answer` (`ID`),
  ADD CONSTRAINT `FK_QOptID_amulchoption_qmulchoption` FOREIGN KEY (`QOptID`) REFERENCES `qmulchoption` (`ID`);

--
-- Các ràng buộc cho bảng `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_ExcsRespID_answer_execsresponse` FOREIGN KEY (`ExcsRespID`) REFERENCES `execsresponse` (`ID`),
  ADD CONSTRAINT `FK_QuestionID_answer_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_AuthID_Comment_Post` FOREIGN KEY (`AuthID`) REFERENCES `profile` (`ID`),
  ADD CONSTRAINT `FK_PProfID_Comment_Post` FOREIGN KEY (`PProfID`) REFERENCES `post` (`ProfileID`),
  ADD CONSTRAINT `FK_PSubID_Comment_Post` FOREIGN KEY (`PSubID`) REFERENCES `post` (`SubID`);

--
-- Các ràng buộc cho bảng `conjugation`
--
ALTER TABLE `conjugation`
  ADD CONSTRAINT `FK_AlternativeID_conjugation_Lemma` FOREIGN KEY (`AlternativeID`) REFERENCES `lemma` (`ID`),
  ADD CONSTRAINT `FK_InfinitiveID_conjugation_Lemma` FOREIGN KEY (`InfinitiveID`) REFERENCES `lemma` (`ID`);

--
-- Các ràng buộc cho bảng `contribution`
--
ALTER TABLE `contribution`
  ADD CONSTRAINT `FK_MeaningID_contri_meaning` FOREIGN KEY (`MeaningID`) REFERENCES `meaning` (`ID`),
  ADD CONSTRAINT `FK_ProfileID_contri_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);

--
-- Các ràng buộc cho bảng `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_ProfileID_course_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);

--
-- Các ràng buộc cho bảng `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_CourseID_document_lesson` FOREIGN KEY (`LessonID`) REFERENCES `lesson` (`ID`);

--
-- Các ràng buộc cho bảng `example`
--
ALTER TABLE `example`
  ADD CONSTRAINT `FK_MeaningID_example_meaning` FOREIGN KEY (`MeaningID`) REFERENCES `meaning` (`ID`);

--
-- Các ràng buộc cho bảng `excercise`
--
ALTER TABLE `excercise`
  ADD CONSTRAINT `FK_CourseID_excercise_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`);

--
-- Các ràng buộc cho bảng `execsresponse`
--
ALTER TABLE `execsresponse`
  ADD CONSTRAINT `FK_ExcerciseID_execsresponse_excercise` FOREIGN KEY (`ExcerciseID`) REFERENCES `excercise` (`ID`),
  ADD CONSTRAINT `FK_ProfileID_execsresponse_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);

--
-- Các ràng buộc cho bảng `learntrecord`
--
ALTER TABLE `learntrecord`
  ADD CONSTRAINT `FK_MeaningID_learntrecord_meaning` FOREIGN KEY (`MeaningID`) REFERENCES `meaning` (`ID`),
  ADD CONSTRAINT `FK_ProfileID_learntrecord_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);

--
-- Các ràng buộc cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_CourseID_lesson_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`);

--
-- Các ràng buộc cho bảng `meaning`
--
ALTER TABLE `meaning`
  ADD CONSTRAINT `FK_LemmaID_meaning_Lemma` FOREIGN KEY (`LemmaID`) REFERENCES `lemma` (`ID`);

--
-- Các ràng buộc cho bảng `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_ProfileID_payment_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_ProfileID_Post_Profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);

--
-- Các ràng buộc cho bảng `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `FK_RoleID_Profile_Role` FOREIGN KEY (`RoleID`) REFERENCES `role` (`ID`),
  ADD CONSTRAINT `FK_UID_Profile_Account` FOREIGN KEY (`UID`) REFERENCES `account` (`UID`);

--
-- Các ràng buộc cho bảng `pronunciation`
--
ALTER TABLE `pronunciation`
  ADD CONSTRAINT `FK_LemmaID_Pronunc_Lemma` FOREIGN KEY (`LemmaID`) REFERENCES `lemma` (`ID`);

--
-- Các ràng buộc cho bảng `qcompletion`
--
ALTER TABLE `qcompletion`
  ADD CONSTRAINT `FK_ID_qcompletion_question` FOREIGN KEY (`ID`) REFERENCES `question` (`ID`);

--
-- Các ràng buộc cho bảng `qmulchoption`
--
ALTER TABLE `qmulchoption`
  ADD CONSTRAINT `FK_QuestionID_qmulchoption_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`);

--
-- Các ràng buộc cho bảng `qcompmask`
--
ALTER TABLE `qcompmask`
  ADD CONSTRAINT `FK_ QCompID_qcommask_qcompletion` FOREIGN KEY (`QCompID`) REFERENCES `qcompletion` (`ID`);

--
-- Các ràng buộc cho bảng `qmatching`
--
ALTER TABLE `qmatching`
  ADD CONSTRAINT `FK_KeyQ_qmatching_qmatchingkey` FOREIGN KEY (`KeyQ`) REFERENCES `qmatchingkey` (`ID`),
  ADD CONSTRAINT `FK_QuestionID_qmatching_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`);

--
-- Các ràng buộc cho bảng `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_ExcerciseID_question_excercise` FOREIGN KEY (`ExcerciseID`) REFERENCES `excercise` (`ID`);

--
-- Các ràng buộc cho bảng `verification`
--
ALTER TABLE `verification`
  ADD CONSTRAINT `FK_ProfilE_Verify_Profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
