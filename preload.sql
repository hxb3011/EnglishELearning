CREATE DATABASE  IF NOT EXISTS `enelearnsys` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `enelearnsys`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: enelearnsys
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `UID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Status` tinyint DEFAULT NULL,
  `Permissions` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acompmask`
--

DROP TABLE IF EXISTS `acompmask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acompmask` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AnswerID` int DEFAULT NULL,
  `QCoMaskID` int DEFAULT NULL,
  `Content` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_AnswerID_acompmask_answer` (`AnswerID`),
  KEY `FK_QCoMaskID_acompmask_qcompmask` (`QCoMaskID`),
  CONSTRAINT `FK_AnswerID_acompmask_answer` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`ID`),
  CONSTRAINT `FK_QCoMaskID_acompmask_qcompmask` FOREIGN KEY (`QCoMaskID`) REFERENCES `qcompmask` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acompmask`
--

LOCK TABLES `acompmask` WRITE;
/*!40000 ALTER TABLE `acompmask` DISABLE KEYS */;
/*!40000 ALTER TABLE `acompmask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amatching`
--

DROP TABLE IF EXISTS `amatching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amatching` (
  `AnsID` int NOT NULL,
  `QMat` int NOT NULL,
  `QMatKey` int NOT NULL,
  PRIMARY KEY (`AnsID`,`QMat`,`QMatKey`),
  KEY `FK_QMat_amatching_qmatching` (`QMat`),
  KEY `FK_QMatKey_amatching_qmatchingkey` (`QMatKey`),
  CONSTRAINT `FK_AnsID_amatching_answer` FOREIGN KEY (`AnsID`) REFERENCES `answer` (`ID`),
  CONSTRAINT `FK_QMat_amatching_qmatching` FOREIGN KEY (`QMat`) REFERENCES `qmatching` (`ID`),
  CONSTRAINT `FK_QMatKey_amatching_qmatchingkey` FOREIGN KEY (`QMatKey`) REFERENCES `qmatchingkey` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amatching`
--

LOCK TABLES `amatching` WRITE;
/*!40000 ALTER TABLE `amatching` DISABLE KEYS */;
/*!40000 ALTER TABLE `amatching` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amulchoption`
--

DROP TABLE IF EXISTS `amulchoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amulchoption` (
  `QOptID` int NOT NULL,
  `AnsID` int NOT NULL,
  PRIMARY KEY (`QOptID`,`AnsID`),
  KEY `FK_AnsID_amulchoption_answer` (`AnsID`),
  CONSTRAINT `FK_AnsID_amulchoption_answer` FOREIGN KEY (`AnsID`) REFERENCES `answer` (`ID`),
  CONSTRAINT `FK_QOptID_amulchoption_qmulchoption` FOREIGN KEY (`QOptID`) REFERENCES `qmulchoption` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amulchoption`
--

LOCK TABLES `amulchoption` WRITE;
/*!40000 ALTER TABLE `amulchoption` DISABLE KEYS */;
/*!40000 ALTER TABLE `amulchoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answer` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Content` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `QuestionID` int DEFAULT NULL,
  `ExcsRespID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_QuestionID_answer_question` (`QuestionID`),
  KEY `FK_ExcsRespID_answer_execsresponse` (`ExcsRespID`),
  CONSTRAINT `FK_ExcsRespID_answer_execsresponse` FOREIGN KEY (`ExcsRespID`) REFERENCES `execsresponse` (`ID`),
  CONSTRAINT `FK_QuestionID_answer_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `PProfID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PSubID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AuthID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SubID` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Status` tinyint NOT NULL,
  `Updated` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`PProfID`,`PSubID`,`AuthID`,`SubID`),
  KEY `FK_PSubID_Comment_Post` (`PSubID`),
  KEY `FK_AuthID_Comment_Post` (`AuthID`),
  CONSTRAINT `FK_AuthID_Comment_Post` FOREIGN KEY (`AuthID`) REFERENCES `profile` (`ID`),
  CONSTRAINT `FK_PProfID_Comment_Post` FOREIGN KEY (`PProfID`) REFERENCES `post` (`ProfileID`),
  CONSTRAINT `FK_PSubID_Comment_Post` FOREIGN KEY (`PSubID`) REFERENCES `post` (`SubID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conjugation`
--

DROP TABLE IF EXISTS `conjugation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conjugation` (
  `InfinitiveID` int NOT NULL,
  `AlternativeID` int NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`InfinitiveID`,`AlternativeID`),
  KEY `FK_AlternativeID_conjugation_Lemma` (`AlternativeID`),
  CONSTRAINT `FK_AlternativeID_conjugation_Lemma` FOREIGN KEY (`AlternativeID`) REFERENCES `lemma` (`ID`),
  CONSTRAINT `FK_InfinitiveID_conjugation_Lemma` FOREIGN KEY (`InfinitiveID`) REFERENCES `lemma` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conjugation`
--

LOCK TABLES `conjugation` WRITE;
/*!40000 ALTER TABLE `conjugation` DISABLE KEYS */;
/*!40000 ALTER TABLE `conjugation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contribution`
--

DROP TABLE IF EXISTS `contribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contribution` (
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `MeaningID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Accepted` bit(1) DEFAULT b'0',
  PRIMARY KEY (`ProfileID`,`MeaningID`),
  KEY `FK_MeaningID_contri_meaning` (`MeaningID`),
  CONSTRAINT `FK_MeaningID_contri_meaning` FOREIGN KEY (`MeaningID`) REFERENCES `meaning` (`ID`),
  CONSTRAINT `FK_ProfileID_contri_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contribution`
--

LOCK TABLES `contribution` WRITE;
/*!40000 ALTER TABLE `contribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `contribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PosterUri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `State` tinyint NOT NULL,
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `BeginDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ProfileID_course_profile` (`ProfileID`),
  CONSTRAINT `FK_ProfileID_course_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `DocUri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `State` tinyint DEFAULT NULL,
  `CourseID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  KEY `FK_CourseID_document_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_document_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `example`
--

DROP TABLE IF EXISTS `example`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `example` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `MeaningID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Example` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Explanation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_MeaningID_example_meaning` (`MeaningID`),
  CONSTRAINT `FK_MeaningID_example_meaning` FOREIGN KEY (`MeaningID`) REFERENCES `meaning` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `example`
--

LOCK TABLES `example` WRITE;
/*!40000 ALTER TABLE `example` DISABLE KEYS */;
/*!40000 ALTER TABLE `example` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `excercise`
--

DROP TABLE IF EXISTS `excercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `excercise` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Deadline` datetime DEFAULT NULL,
  `State` tinyint DEFAULT NULL,
  `CourseID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CourseID_excercise_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_excercise_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excercise`
--

LOCK TABLES `excercise` WRITE;
/*!40000 ALTER TABLE `excercise` DISABLE KEYS */;
/*!40000 ALTER TABLE `excercise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `execsresponse`
--

DROP TABLE IF EXISTS `execsresponse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `execsresponse` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AtDateTime` datetime DEFAULT NULL,
  `ExcerciseID` int DEFAULT NULL,
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ExcerciseID_execsresponse_excercise` (`ExcerciseID`),
  KEY `FK_ProfileID_execsresponse_profile` (`ProfileID`),
  CONSTRAINT `FK_ExcerciseID_execsresponse_excercise` FOREIGN KEY (`ExcerciseID`) REFERENCES `excercise` (`ID`),
  CONSTRAINT `FK_ProfileID_execsresponse_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `execsresponse`
--

LOCK TABLES `execsresponse` WRITE;
/*!40000 ALTER TABLE `execsresponse` DISABLE KEYS */;
/*!40000 ALTER TABLE `execsresponse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learntrecord`
--

DROP TABLE IF EXISTS `learntrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `learntrecord` (
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `MeaningID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LastReviewed` date DEFAULT NULL,
  PRIMARY KEY (`ProfileID`,`MeaningID`),
  KEY `FK_MeaningID_learntrecord_meaning` (`MeaningID`),
  CONSTRAINT `FK_MeaningID_learntrecord_meaning` FOREIGN KEY (`MeaningID`) REFERENCES `meaning` (`ID`),
  CONSTRAINT `FK_ProfileID_learntrecord_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learntrecord`
--

LOCK TABLES `learntrecord` WRITE;
/*!40000 ALTER TABLE `learntrecord` DISABLE KEYS */;
/*!40000 ALTER TABLE `learntrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lemma`
--

DROP TABLE IF EXISTS `lemma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lemma` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `KeyL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PartOfSpeech` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lemma`
--

LOCK TABLES `lemma` WRITE;
/*!40000 ALTER TABLE `lemma` DISABLE KEYS */;
/*!40000 ALTER TABLE `lemma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lesson` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `State` tinyint DEFAULT NULL,
  `CourseID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `OrderN` tinyint NOT NULL,
  KEY `FK_CourseID_lesson_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_lesson_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson`
--

LOCK TABLES `lesson` WRITE;
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meaning`
--

DROP TABLE IF EXISTS `meaning`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meaning` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LemmaID` int DEFAULT NULL,
  `LevelV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Meaning` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Explanation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_LemmaID_meaning_Lemma` (`LemmaID`),
  CONSTRAINT `FK_LemmaID_meaning_Lemma` FOREIGN KEY (`LemmaID`) REFERENCES `lemma` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meaning`
--

LOCK TABLES `meaning` WRITE;
/*!40000 ALTER TABLE `meaning` DISABLE KEYS */;
/*!40000 ALTER TABLE `meaning` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KEYC` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ProfileID_payment_profile` (`ProfileID`),
  CONSTRAINT `FK_ProfileID_payment_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SubID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Status` tinyint NOT NULL,
  `Updated` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ProfileID`,`SubID`),
  KEY `post_subid_indexes` (`SubID`),
  CONSTRAINT `FK_ProfileID_Post_Profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gender` tinyint NOT NULL,
  `BirthDay` date NOT NULL,
  `Type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Status` tinyint NOT NULL,
  `UID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `RoleID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_RoleID_Profile_Role` (`RoleID`),
  KEY `FK_UID_Profile_Account` (`UID`),
  CONSTRAINT `FK_RoleID_Profile_Role` FOREIGN KEY (`RoleID`) REFERENCES `role` (`ID`),
  CONSTRAINT `FK_UID_Profile_Account` FOREIGN KEY (`UID`) REFERENCES `account` (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pronunciation`
--

DROP TABLE IF EXISTS `pronunciation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pronunciation` (
  `LemmaID` int NOT NULL,
  `Region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IPA` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Voice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`LemmaID`,`Region`),
  CONSTRAINT `FK_LemmaID_Pronunc_Lemma` FOREIGN KEY (`LemmaID`) REFERENCES `lemma` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pronunciation`
--

LOCK TABLES `pronunciation` WRITE;
/*!40000 ALTER TABLE `pronunciation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pronunciation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property` (
  `key` varchar(100) NOT NULL,
  `value` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property`
--

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qcompletion`
--

DROP TABLE IF EXISTS `qcompletion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qcompletion` (
  `ID` int NOT NULL,
  `Content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `State` tinyint DEFAULT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `FK_ID_qcompletion_question` FOREIGN KEY (`ID`) REFERENCES `question` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcompletion`
--

LOCK TABLES `qcompletion` WRITE;
/*!40000 ALTER TABLE `qcompletion` DISABLE KEYS */;
/*!40000 ALTER TABLE `qcompletion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qcompmask`
--

DROP TABLE IF EXISTS `qcompmask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qcompmask` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Offset` int NOT NULL,
  `Length` int NOT NULL,
  `QCompID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ QCompID_qcommask_qcompletion` (`QCompID`),
  CONSTRAINT `FK_ QCompID_qcommask_qcompletion` FOREIGN KEY (`QCompID`) REFERENCES `qcompletion` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcompmask`
--

LOCK TABLES `qcompmask` WRITE;
/*!40000 ALTER TABLE `qcompmask` DISABLE KEYS */;
/*!40000 ALTER TABLE `qcompmask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qmatching`
--

DROP TABLE IF EXISTS `qmatching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qmatching` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `QuestionID` int DEFAULT NULL,
  `KeyQ` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_QuestionID_qmatching_question` (`QuestionID`),
  KEY `FK_KeyQ_qmatching_qmatchingkey` (`KeyQ`),
  CONSTRAINT `FK_KeyQ_qmatching_qmatchingkey` FOREIGN KEY (`KeyQ`) REFERENCES `qmatchingkey` (`ID`),
  CONSTRAINT `FK_QuestionID_qmatching_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmatching`
--

LOCK TABLES `qmatching` WRITE;
/*!40000 ALTER TABLE `qmatching` DISABLE KEYS */;
/*!40000 ALTER TABLE `qmatching` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qmatchingkey`
--

DROP TABLE IF EXISTS `qmatchingkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qmatchingkey` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmatchingkey`
--

LOCK TABLES `qmatchingkey` WRITE;
/*!40000 ALTER TABLE `qmatchingkey` DISABLE KEYS */;
/*!40000 ALTER TABLE `qmatchingkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qmulchoption`
--

DROP TABLE IF EXISTS `qmulchoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qmulchoption` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Correct` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmulchoption`
--

LOCK TABLES `qmulchoption` WRITE;
/*!40000 ALTER TABLE `qmulchoption` DISABLE KEYS */;
/*!40000 ALTER TABLE `qmulchoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `State` tinyint DEFAULT NULL,
  `ExcerciseID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ExcerciseID_question_excercise` (`ExcerciseID`),
  CONSTRAINT `FK_ExcerciseID_question_excercise` FOREIGN KEY (`ExcerciseID`) REFERENCES `excercise` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Permissions` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription` (
  `ID` varchar(100) NOT NULL,
  `AtDateTime` datetime DEFAULT NULL,
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CourseID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CourseID_subcription_course` (`CourseID`),
  KEY `FK_ProfileID_subcription_profile` (`ProfileID`),
  CONSTRAINT `FK_CourseID_subcription_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`),
  CONSTRAINT `FK_ProfileID_subcription_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verification`
--

DROP TABLE IF EXISTS `verification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verification` (
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KeyVerify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ProfileID`,`KeyVerify`),
  UNIQUE KEY `reset_token_hash_UNIQUE` (`reset_token_hash`),
  CONSTRAINT `FK_ProfilE_Verify_Profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verification`
--

LOCK TABLES `verification` WRITE;
/*!40000 ALTER TABLE `verification` DISABLE KEYS */;
/*!40000 ALTER TABLE `verification` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-06 16:56:26
