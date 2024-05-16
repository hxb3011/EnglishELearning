SET FOREIGN_KEY_CHECKS = 0; 
CREATE DATABASE  IF NOT EXISTS `enelearnsys` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
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
INSERT INTO `account` VALUES ('0','root99','$2a$12$5XEbACP2P7uGRqpmeevJOeWpzpevls.1uC7cvzWqhHnNxHnmZIPIq',0,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('1','letoan2505','$2a$12$5XEbACP2P7uGRqpmeevJOeWpzpevls.1uC7cvzWqhHnNxHnmZIPIq',0,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('2','hieuthuan99','$2a$12$5XEbACP2P7uGRqpmeevJOeWpzpevls.1uC7cvzWqhHnNxHnmZIPIq',0,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('36','toanlene','$2y$10$mW0l.wUMfrvj7iovAnTs6O5Ta3UEmi3Zyj4Nq9Mix5HYhd9jvgIbq',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640c9a311c8f','letoan','$2y$10$TiQ2bUUg9DiV0oJ/eoFPw.iGsUrosL3KkVqkUBo0f2P1pDWLV0dNu',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640ca00af54c','huynhxbach','$2y$10$3nQ.AKmPn0G9evGiIjMjMuNBx.JG1GBpuoXfEa.ccLbtW1vTMHSh.',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640ca69c470f','nhatkhai','$2y$10$eM9BR2.1f.8fPsjCYxAgNerhP6hHlztiW9uGEp0rTPyHcn6QVRYZO',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cb1f4be66','khanhnam','$2y$10$JK9zV9MBGCt2Mo9iUrJprOMfacuBQ95M3752wL4EcDCDLqzU2Bh1y',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cbe30bfa7','thanhsang','$2y$10$7Ir/dNPZI8f6DZ3ixlxMKOSWGpzW9bPH4ksgAihuNp1vq55sWMN6C',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cc428abf2','maiphuong','$2y$10$/Fzv9xgm985xyI6l6Hr8iuY.HlQk7hPFrfOUVwtTi30Xwu0E3jfJK',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640ccfe50011','ngovanhuy','$2y$10$7ndSUaG5fYVaFTOVUJ3UweIYoPQ.2.lAWbmZaKCr1Oyt86i2ayfMa',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cd630d2f8','maithiloan','$2y$10$kdb0LFixcUkdOTS6BX12jeehLGgaPqZTTHWYaapAIOoo/DE./r2L.',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640ce125abbd','vanlong','$2y$10$iE03zg9Q1SBjEJ/rBEVWlOyOtHv70fjvcMv7llY0aqU4pJd6AKIri',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640ce5ce2c2e','hathilan','$2y$10$mD/AgN5qZ8qciL.J9fsDd.PH4SuHPlTX1TgQFHRJsQoIKBUjdzX2S',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cebc5a08c','dinhvanphuc','$2y$10$4kuPuCDOsGZozf2tk74AqO3HdbGy8bJb0T8nGcc86XtndFvrejQ8S',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cee6100d4','tranthihang','$2y$10$.KIz2OPWmqA./.PPdC8AOuDdCZVrxXQdZAw7Qln1mpLr9jMlEfiLO',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cf47703ec','nguyenvankhanh','$2y$10$6U8ZWjGfqqS9kfoge1Mj/uNB0wWJWhooWnRHRYTJsdzxawZpEa8DK',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cf731c7af','lethihuong','$2y$10$9Cl4Yo/LM8uiqi3RobpC1ukRvMC2.AdQjzosHYMpS6iuz/rNxjlZu',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640cfb382a0b','phamvanthuan','$2y$10$Odc5ijjO/TM9xZ7K3gVNp.BfAXFa29jZ5ma3.kWSNFX5.Uv2VxQaS',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d031e869a','tranthithu','$2y$10$e7DL0sggSU.9tWLCVTtv/uFS4AbV6BDWnXAWWhcRg64NnyxWvJBr2',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d17e04e18','nguyenvantuan','$2y$10$utCp82OoQNCdhNQoEjAIYeAtEL2bQ8me47nOTIDVZNnjU3iiPcnA.',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d1b41c1ac','hoangthithom','$2y$10$v96QfNqUb5rS9ldBmk8ixeAbrr8dZWIAIrkawVvumgxH.bILc/P4e',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d1df61fa1','vuvanhung','$2y$10$j74..PjkW1sq.Kfp3SI6nO3fc./iK3jRL1yhgjJXkrkfnvRYGd7.y',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d21500756','tranthithuha','$2y$10$YtkZ.xprzKtNXNxEsS7xLeZzMACCpcrVr2ouUa8HSXaFuDFKfcXHS',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d246dbbcd','dovantai','$2y$10$P/09SI6xjF6HZfafnNRFg.VNIaV8Rx8D6jI6GBdFOIEo.KZqN2Wue',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d2cd94491','nguyenthianh','$2y$10$5/tkoSifC335pTo6dGRbX./UDmX2yhmPw7qF/SkW8jaI8SsxvMgPq',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d3267b96c','levantamm','$2y$10$H2.N0ZTNL1G5r7CK3t3sJOBsm0/ddrnVWGf4PIXRKJXjvWQrgbADS',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d34f83333','phamquy','$2y$10$FhmHDSK5FDD6mfrMasnlM.pIa52TEOpzKXvQzNd5HaKsTzjDJpvyK',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d3d4cc50e','hoangvanson','$2y$10$vn9jnOVvus75HpmaxVLrxuTA4PmdL902nc1q.XY0/cpOzMSdcnLZi',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d44986aa3','tranthihong','$2y$10$rIdSCuErWx635ctG4v7AsOPvuWWHkDfrCy4v2wzV.J5oNvQQb4opi',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d48e8d637','nguyevanquan','$2y$10$NheJbzmEH.byV9MdpurD4uUDN6mUUS4wmpQI2apJComBSBr8ABqvy',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d4dd5c4fc','lethithao','$2y$10$Rd7etVfVcDnAKdruNXSw3uPfnfwAcWIVe0oVu2NaaaRWdTMEmWdV.',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d545d964c','dangvanthanh','$2y$10$ri/tvgJfWLQ1aHMgpAeV5uworvu0JXoldNB5BeYbNs0snBV4jFfpW',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d5c094514','phamthikim','$2y$10$qvMrPfhQB3GUiIApnyLCkOtiQvtFOwef0D5Ih.8X4kmHLE2ZmA4zW',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d62c4ccf2','vuvanhoa','$2y$10$4lmwKTQ8ipMcL6o53J/OZ.GOwbmeAq7mphsbTN0yv1JTZJSAIFOPC',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('6640d746e77cb','nguyenthidieu','$2y$10$pKYfIIY59.NXVbdQYlBHSeFr60Nu4k.HZinqy2nSzSpE0oPLIqoPG',1,'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
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
  CONSTRAINT `FK_AnswerID_acompmask_answer` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_QCoMaskID_acompmask_qcompmask` FOREIGN KEY (`QCoMaskID`) REFERENCES `qcompmask` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  CONSTRAINT `FK_AnsID_amatching_answer` FOREIGN KEY (`AnsID`) REFERENCES `answer` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_QMat_amatching_qmatching` FOREIGN KEY (`QMat`) REFERENCES `qmatching` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_QMatKey_amatching_qmatchingkey` FOREIGN KEY (`QMatKey`) REFERENCES `qmatchingkey` (`ID`) ON DELETE CASCADE
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
  CONSTRAINT `FK_AnsID_amulchoption_answer` FOREIGN KEY (`AnsID`) REFERENCES `answer` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_QOptID_amulchoption_qmulchoption` FOREIGN KEY (`QOptID`) REFERENCES `qmulchoption` (`ID`) ON DELETE CASCADE
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
  CONSTRAINT `FK_ExcsRespID_answer_execsresponse` FOREIGN KEY (`ExcsRespID`) REFERENCES `execsresponse` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_QuestionID_answer_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
INSERT INTO `course` VALUES ('COURSE10','public/poster/COURSE10/tu-vung-tieng-anh-du-lich-1.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách sử dụng tiếng Anh một cách tự tin khi đi du lịch. Từ giao tiếp cơ bản đến việc đặt phòng khách sạn và đặt vé máy bay, bạn sẽ được trang bị những kỹ năng cần thiết để thảo luận và làm việc trong môi trường du lịch quốc tế.</span><br></p>',1,'6640ca00cfde3','2024-05-11 15:49:00','2024-08-31 15:49:00',3000,'Khóa học tiếng Anh thông dụng trong du lịch'),('COURSE11','public/poster/COURSE11/hoc-tieng-anh-qua-phim-cho-nguoi-moi-bat-dau-1.jpg','Khóa học tiếng Anh thông dụng trong du lịchTrong khóa học này, bạn sẽ khám phá tiếng Anh qua thế giới của điện ảnh. Từ việc luyện nghe thông qua các đoạn phim đến việc phân tích và thảo luận về nội dung của chúng, bạn sẽ nâng cao kỹ năng ngôn ngữ của mình một cách thú vị và hiệu quả',1,'6640ca00cfde3','2024-05-11 15:51:00','2024-07-31 15:51:00',3000,'Khóa học tiếng Anh qua phim ảnh'),('COURSE12','public/poster/COURSE12/hoc-tieng-anh-bang-am-nhac3.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">\"Khóa học này sẽ dẫn bạn đi qua thế giới âm nhạc để học tiếng Anh. Từ việc học từ vựng và ngữ pháp qua lời bài hát đến việc hiểu và thấu hiểu ý nghĩa sâu sắc của các bài hát, bạn sẽ trải nghiệm một phương pháp học tiếng Anh độc đáo và thú vị.</span><br></p>',1,'6640ca00cfde3','2024-05-11 15:53:00','2024-07-31 15:53:00',3000,'Khóa học tiếng Anh qua nhạc'),('COURSE13','public/poster/COURSE13/khoahoctienganhgiaotiepchuyennghiepdanhriengchonguoidilam.png','                                                                                                                                                <p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \"Segoe UI\", Roboto, Ubuntu, Cantarell, \"Noto Sans\", sans-serif, \"Helvetica Neue\", Arial, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách giao tiếp hiệu quả trong môi trường làm việc bằng tiếng Anh. Từ việc viết thư từ chuyên nghiệp đến báo cáo công việc, bạn sẽ được trang bị những kỹ năng cần thiết để thành công và thăng tiến trong sự nghiệp của mình.</span><br></p>                                                                                                                                        ',1,'6640c9a32f39a','2024-05-11 15:56:00','2024-07-31 15:56:00',3000,'Khóa học tiếng Anh cho người đi làm'),('COURSE14','public/poster/COURSE14/businessenglishvuong.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này sẽ chuẩn bị bạn cho các buổi phỏng vấn tiếng Anh. Từ việc chuẩn bị trước đến cách trả lời các câu hỏi phỏng vấn một cách tự tin và hiệu quả, bạn sẽ được trang bị những kỹ năng cần thiết để thành công trong các cuộc phỏng vấn xin việc hoặc học bổng.</span><br></p>',1,'6640ca00cfde3','2024-05-11 15:58:00','2024-06-30 15:58:00',3000,'Khóa học luyện phỏng vấn tiếng Anh'),('COURSE15','public/poster/COURSE15/zVioYM7Hx5RbUOPErYpTdsCcWwUXBV3k2Zkl0nTBIOncY5JVGUMHSQnTbKyykZAHZnqe1qM2WzzHw4z1mpMKvoCZmZ5s0lSNN7ySporkmrAYHa_RfqI1eN217XyuC3OkalPy7wSwvOfc0J0XKuU31otLsD9vxYDMkYmhIeK_SuFKjVUrQm4bOAH7DYLgaw.jpg','<p>Khóa học này được thiết kế để giúp bạn phát triển kỹ năng tiếng Anh từ những nền tảng cơ bản nhất đến mức độ thành thạo. Với sự hướng dẫn của các giảng viên giàu kinh nghiệm, bạn sẽ được học từ vựng, ngữ pháp, phát âm, và kỹ năng giao tiếp cần thiết. Bài học được xây dựng theo trình tự logic, dễ hiểu, giúp bạn tự tin sử dụng tiếng Anh trong mọi tình huống hàng ngày.<br></p>',1,'6640cc4297fe3','2024-05-17 21:55:00','2024-05-31 21:55:00',2000,'Thành Thạo Tiếng Anh: Từ Cơ Bản Đến Lưu Loát'),('COURSE16','public/poster/COURSE16/tieng-anh-hoc-thuat-la-gi.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách sử dụng tiếng Anh trong môi trường học thuật. Từ việc viết bài luận và báo cáo học thuật đến hiểu và sử dụng các thuật ngữ chuyên ngành, bạn sẽ được trang bị những kỹ năng cần thiết để thành công trong các khóa học đại học, nghiên cứu và công việc liên quan đến môi trường học thuật.</span><br></p>',1,'6640ca69e0b3b','2024-05-11 16:02:00','2024-08-31 16:02:00',2000,'Khóa học tiếng Anh học thuật'),('COURSE17','public/poster/COURSE17/102461.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này tập trung vào việc cải thiện kỹ năng nói tiếng Anh của bạn. Thông qua các bài tập thực hành, hoạt động nhóm, và các tình huống giao tiếp thực tế, bạn sẽ học cách diễn đạt ý tưởng rõ ràng và tự nhiên. Khóa học cũng cung cấp các mẹo và kỹ thuật để vượt qua nỗi sợ hãi khi nói trước đám đông, giúp bạn tự tin hơn trong giao tiếp hàng ngày và trong công việc.</span><br></p>',1,'6640cc4297fe3','2024-05-17 21:58:00','2024-05-31 21:58:00',3000,'Nói Tiếng Anh Tự Tin'),('COURSE18','public/poster/COURSE18/co-nen-mua-khoa-hoc-tieng-anh-online-1024x724.jpg','<span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\"> Khóa học này dành cho những ai đam mê du lịch và muốn sử dụng tiếng Anh để giao tiếp khi đi nước ngoài. Bạn sẽ học các cụm từ và câu hỏi thông dụng khi đi lại, đặt phòng khách sạn, ăn uống, mua sắm, và tham quan. Ngoài ra, khóa học cũng giới thiệu các phong tục, văn hóa và cách ứng xử tại các quốc gia nói tiếng Anh, giúp bạn tự tin và thoải mái hơn khi du lịch.</span>',1,'6640cc4297fe3','2024-05-17 22:01:00','2024-05-31 22:01:00',5000,'Giao Tiếp Quốc Tế'),('COURSE19','public/poster/COURSE19/khoa-hoc-tieng-anh-giao-tiep-co-ban-benative.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này tập trung vào việc cải thiện kỹ năng đàm thoại tiếng Anh trong các tình huống hàng ngày. Bạn sẽ học cách giao tiếp hiệu quả trong các tình huống như mua sắm, hỏi đường, trò chuyện xã giao, và tham gia các hoạt động xã hội. Khóa học cũng cung cấp các bài tập thực hành và tình huống giao tiếp thực tế, giúp bạn tự tin sử dụng tiếng Anh trong cuộc sống hàng ngày.</span><br></p>',1,'6640ca69e0b3b','2024-05-17 22:04:00','2024-05-31 22:04:00',4000,'Tiếng Anh Đàm Thoại Hằng Ngày'),('COURSE2','public/poster/COURSE2/hinh-anh-tieng-anh-giao-tiep-la-gi-so-1.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ nắm vững các kỹ năng giao tiếp hàng ngày để tự tin trò chuyện và tương tác trong các tình huống đời thường. Từ cách giới thiệu bản thân đến kỹ năng thảo luận về các chủ đề phổ biến, bạn sẽ học cách sử dụng ngôn ngữ một cách tự tin và linh hoạt. Khóa học cũng tập trung vào việc giao tiếp qua điện thoại và email, giúp bạn xây dựng kỹ năng liên lạc hiệu quả trong môi trường công việc và xã hội ngày nay.</span><br></p>',1,'6640c9a32f39a','2024-05-11 15:36:00','2024-06-30 15:36:00',2000,'Khóa học tiếng Anh giao tiếp hàng ngày'),('COURSE20','public/poster/COURSE20/add_friend (1).png','                                                                        <p>TESTHEHM<br></p>                                                                    ',1,'6640c9a32f39a','2024-05-18 05:03:00','2024-05-31 05:03:00',4000,'TESTHEHMX'),('COURSE3','public/poster/COURSE3/ec7c516c4c-phat-am-tieng-anh.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học phát âm sẽ giúp bạn rèn luyện và cải thiện kỹ năng phát âm tiếng Anh của mình. Qua các bài học, bạn sẽ học cách phát âm các âm tiếng Anh đúng cách và luyện tập qua các từ và câu phổ biến. Với sự hướng dẫn cụ thể và các bài tập thực hành, khóa học này sẽ giúp bạn phát triển một giọng phát âm rõ ràng và dễ hiểu.</span><br></p>',1,'6640ca69e0b3b','2024-05-11 15:39:00','2024-08-31 15:39:00',2000,'Khóa học phát âm'),('COURSE4','public/poster/COURSE4/z5410594829335_d3ffe463eed8c5054319eb9faaeb5a47.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học các kỹ năng đọc tiếng Anh hiệu quả. Từ phương pháp đọc đến hiểu và phân tích các loại văn bản khác nhau, bạn sẽ được trang bị những công cụ cần thiết để nâng cao khả năng đọc của mình. Khóa học cũng tập trung vào việc phát triển từ vựng và kỹ năng nhận biết cấu trúc câu, giúp bạn trở thành một độc giả linh hoạt và tự tin.</span><br></p>',1,'6640c9a32f39a','2024-05-11 15:41:00','2024-08-31 15:41:00',3000,'Khóa học kỹ năng đọc'),('COURSE5','public/poster/COURSE5/Tổng-hợp-các-từ-viết-tắt-trong-tiếng-Anh-thông-dụng-nhất-1024x536.png','                                                                                                                                                <p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \"Segoe UI\", Roboto, Ubuntu, Cantarell, \"Noto Sans\", sans-serif, \"Helvetica Neue\", Arial, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; white-space-collapse: preserve;\">Khóa học kỹ năng viết sẽ giúp bạn phát triển khả năng viết tiếng Anh một cách rõ ràng và hiệu quả. Từ việc viết email chuyên nghiệp đến viết bài luận và tóm tắt, bạn sẽ học cách tổ chức ý tưởng và trình bày ý kiến một cách logic và hấp dẫn. Qua các bài tập và phản hồi, bạn sẽ cải thiện khả năng viết của mình và trở thành một người viết thành công.</span><br></p>                                                                                                                                        ',1,'6640cb1f587e7','2024-05-11 15:41:00','2024-09-01 15:41:00',3000,'Khóa học kỹ năng viết'),('COURSE6','public/poster/COURSE6/ngu-phap-2.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này sẽ đưa bạn vào thế giới của ngữ pháp tiếng Anh. Từ các quy tắc cơ bản đến những điểm ngữ pháp phức tạp hơn, bạn sẽ hiểu và áp dụng ngữ pháp một cách tự tin. Qua các bài tập và ví dụ thực tế, khóa học sẽ giúp bạn củng cố kiến thức và nâng cao khả năng sử dụng ngôn ngữ một cách chính xác và linh hoạt.</span><br></p>',1,'6640c9a32f39a','2024-05-11 15:43:00','2024-08-31 15:43:00',2000,'Khóa học ngữ pháp tiếng Anh'),('COURSE7','public/poster/COURSE7/Photo.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách sử dụng tiếng Anh trong môi trường kinh doanh. Từ từ vựng và cụm từ chuyên ngành đến các kỹ năng giao tiếp chuyên nghiệp, bạn sẽ được trang bị những công cụ cần thiết để thành công trong thế giới kinh doanh quốc tế ngày nay.</span><br></p>',1,'6640c9a32f39a','2024-05-11 15:44:00','2024-09-30 15:45:00',2000,'Khóa học tiếng Anh kinh doanh'),('COURSE8','public/poster/COURSE8/khoa-luyen-thi-ielts-75-advanced-20230926114724578.jpg','                                                                        <p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \"Segoe UI\", Roboto, Ubuntu, Cantarell, \"Noto Sans\", sans-serif, \"Helvetica Neue\", Arial, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; white-space-collapse: preserve;\">Khóa học này sẽ chuẩn bị bạn cho kỳ thi IELTS một cách toàn diện. Từ các chiến lược luyện thi đến luyện tập các kỹ năng cần thiết (nghe, nói, đọc, viết), bạn sẽ có mọi thứ cần thiết để đạt được điểm số mong muốn trong kỳ thi quan trọng này</span><br></p>                                                                    ',0,'6640cb1f587e7','2024-05-11 15:46:00','2024-09-30 15:46:00',2000,'Khóa học luyện thi IELTS');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `DocUri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `State` tinyint DEFAULT NULL,
  `LessonID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `OrderN` int DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_LessonID_document_lesson` (`LessonID`),
  CONSTRAINT `FK_LessonID_document_lesson` FOREIGN KEY (`LessonID`) REFERENCES `lesson` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES ('DOCUMENT10','Các mẫu câu du lịch','private/video/COURSE10/LESSON6/DOCUMENT10/80 mẫu câu giao tiếp tiếng Anh để bạn DU LỊCH CẤP TỐC.mp4',1,'LESSON6','video',1),('DOCUMENT100','Tài liệu PDF','private/text/COURSE10/LESSON6/DOCUMENT100/Mai_Hoang_Xuan_Intern(.Net, C#).pdf',1,'LESSON6','text',3),('DOCUMENT11','Giao tiếp cơ bản','private/text/COURSE10/LESSON7/DOCUMENT11/4716_Giao tiep trong hoat dong du lich Viet Nam tu su ke thua di san ung xu truyen thong.pdf',1,'LESSON7','text',1),('DOCUMENT12','Giao tiếp du lịch','private/text/COURSE10/LESSON8/DOCUMENT12/Giao tiep du lich.pdf',1,'LESSON8','text',1),('DOCUMENT13','Giao tiếp tại nha ga','private/text/COURSE10/LESSON9/DOCUMENT13/Giao tiep tai nhà ga.pdf',1,'LESSON9','text',1),('DOCUMENT14','Giao tiếp tại nhà ga','private/text/COURSE10/LESSON10/DOCUMENT14/Giao tiep tai nhà ga.pdf',1,'LESSON10','text',1),('DOCUMENT15','Giao tiếp tại quán','private/text/COURSE10/LESSON11/DOCUMENT15/Giao tiep di mua sắm.pdf',1,'LESSON11','text',1),('DOCUMENT16','Giao tiếp cb','private/text/COURSE10/LESSON12/DOCUMENT16/english_for_office_0425.pdf',1,'LESSON12','text',1),('DOCUMENT17',' TRUNG TÂM THƯƠNG MẠI','private/video/COURSE10/LESSON13/DOCUMENT17/[English Town] Từ vựng tiếng Anh chủ đề TRUNG TÂM THƯƠNG MẠI.mp4',1,'LESSON13','video',1),('DOCUMENT18','Giới thiệu','private/video/COURSE11/LESSON14/DOCUMENT18/HỌC TIẾNG ANH QUA PHIM HIỆU QUẢ _ DANG HNN.mp4',1,'LESSON14','video',1),('DOCUMENT19','Phương pháp','private/video/COURSE11/LESSON15/DOCUMENT19/[English Town] Từ vựng tiếng Anh chủ đề TRUNG TÂM THƯƠNG MẠI.mp4',1,'LESSON15','video',1),('DOCUMENT20','Hướng dẫn luyện tập','private/video/COURSE11/LESSON16/DOCUMENT20/HỌC TIẾNG ANH QUA PHIM HIỆU QUẢ _ DANG HNN.mp4',1,'LESSON16','video',1),('DOCUMENT21','Tranh luận','private/video/COURSE11/LESSON17/DOCUMENT21/Phần tranh biện tiếng Anh cực _chất_ của cựu thí sinh Trường Teen - Hoàng Mai Anh _ The Debaters.mp4',1,'LESSON17','video',1),('DOCUMENT22','Luyện tập 1','private/video/COURSE11/LESSON17/DOCUMENT22/[English Town] Từ vựng tiếng Anh chủ đề TRUNG TÂM THƯƠNG MẠI.mp4',1,'LESSON17','video',2),('DOCUMENT23','Học qua bài hát','private/video/COURSE11/LESSON18/DOCUMENT23/videoplayback.mp4',1,'LESSON18','video',1),('DOCUMENT24','Tài liệu đọc','private/text/COURSE11/LESSON18/DOCUMENT24/Giới thiệu về Khóa học cấp Toeic.docx',1,'LESSON18','text',2),('DOCUMENT25','Bài hát TA 1','private/video/COURSE12/LESSON19/DOCUMENT25/[Lyrics+Vietsub] I DO - 911 _ Học tiếng Anh qua bài hát _ Scots English.mp4',1,'LESSON19','video',1),('DOCUMENT26','Bài hát TA2','private/video/COURSE12/LESSON20/DOCUMENT26/Học tiếng Anh qua bài hát - I WANT IT THAT WAY - (Lyrics+Kara+Vietsub) - Thaki English.mp4',1,'LESSON20','video',1),('DOCUMENT27','Bài hát TA3','private/video/COURSE12/LESSON21/DOCUMENT27/videoplayback (1).mp4',1,'LESSON21','video',1),('DOCUMENT28','Bài hát TA4','private/video/COURSE12/LESSON22/DOCUMENT28/Central Cee - Doja (Official Music Video).mp4',1,'LESSON22','video',1),('DOCUMENT29','Bài học TA5','private/video/COURSE12/LESSON23/DOCUMENT29/Central Cee - Doja (Official Music Video).mp4',1,'LESSON23','video',1),('DOCUMENT30','Bài học TA6','private/video/COURSE12/LESSON23/DOCUMENT30/[Lyrics+Vietsub] I DO - 911 _ Học tiếng Anh qua bài hát _ Scots English.mp4',1,'LESSON23','video',2),('DOCUMENT31','Bài học TA7','private/video/COURSE12/LESSON23/DOCUMENT31/Học tiếng Anh qua bài hát - I WANT IT THAT WAY - (Lyrics+Kara+Vietsub) - Thaki English.mp4',1,'LESSON23','video',3),('DOCUMENT32','Tài liệu cơ bản','private/text/COURSE13/LESSON25/DOCUMENT32/Hỏi thăm bạn bè.pdf',1,'LESSON25','text',1),('DOCUMENT33','Tài liệu cần thiết','private/text/COURSE13/LESSON25/DOCUMENT33/Vui mừng hạnh phúc.pdf',1,'LESSON25','text',2),('DOCUMENT34','Ngữ pháp CB','private/text/COURSE13/LESSON26/DOCUMENT34/17 - De nghi xin phép.pdf',1,'LESSON26','text',1),('DOCUMENT35','Bài nghe 1','private/video/COURSE13/LESSON27/DOCUMENT35/[Lyrics+Vietsub] I DO - 911 _ Học tiếng Anh qua bài hát _ Scots English.mp4',1,'LESSON27','video',1),('DOCUMENT36','Phân tích y nghĩa','private/video/COURSE13/LESSON28/DOCUMENT36/HỌC TIẾNG ANH QUA PHIM HIỆU QUẢ _ DANG HNN.mp4',1,'LESSON28','video',1),('DOCUMENT37','Câu hỏi ôn tập','private/text/COURSE13/LESSON29/DOCUMENT37/Giao tiep tại ngan hàng.pdf',1,'LESSON29','text',1),('DOCUMENT38','Tài liệu 12','private/text/COURSE13/LESSON30/DOCUMENT38/Giao tiep tai rap chieu phim.pdf',1,'LESSON30','text',1),('DOCUMENT39','Giới thiệu','private/video/COURSE13/LESSON24/DOCUMENT39/GIỚI THIỆU KHÓA HỌC IELTS ONLINE TỪ A - Z #1 _ WISE ENGLISH OFFICIAL.mp4',1,'LESSON24','video',1),('DOCUMENT40','Mục tiêu khóa học','private/text/COURSE14/LESSON31/DOCUMENT40/Giới thiệu về Khóa học cấp Toeic.docx',1,'LESSON31','text',1),('DOCUMENT41','Hướng dẫn chuẩn bị','private/video/COURSE14/LESSON32/DOCUMENT41/TIẾNG ANH PHỎNG VẤN XIN VIỆC_ 30 CÂU TRẢ LỜI HAY NHẤT - Khóa học tiếng Anh cho người đi làm.mp4',1,'LESSON32','video',1),('DOCUMENT42','Giao tiếp hiệu quả','private/text/COURSE14/LESSON33/DOCUMENT42/Giới thiệu về Khóa học cấp Toeic.docx',1,'LESSON33','text',1),('DOCUMENT43','Video hướng','private/video/COURSE14/LESSON34/DOCUMENT43/002 What Is NgRx.mp4',1,'LESSON34','video',1),('DOCUMENT44','Tài liệu 10 ','private/text/COURSE14/LESSON35/DOCUMENT44/phieudiemrenluyen.pdf',1,'LESSON35','text',1),('DOCUMENT45','Video hướng dẫn','private/video/COURSE14/LESSON36/DOCUMENT45/TIẾNG ANH PHỎNG VẤN XIN VIỆC_ 30 CÂU TRẢ LỜI HAY NHẤT - Khóa học tiếng Anh cho người đi làm.mp4',1,'LESSON36','video',1),('DOCUMENT46','Sau phỏng vấn','private/video/COURSE14/LESSON37/DOCUMENT46/Tiếng Anh Phỏng Vấn Xin Việc.mp4',1,'LESSON37','video',1),('DOCUMENT47','Tiếng anh học thuật là gì','private/text/COURSE16/LESSON38/DOCUMENT47/OK.docx',1,'LESSON38','text',1),('DOCUMENT48','Cấu trúc Câu','private/video/COURSE16/LESSON39/DOCUMENT48/Cấu trúc câu trong tiếng Anh _ Ngữ Pháp Tiếng Anh Cơ Bản.mp4',1,'LESSON39','video',1),('DOCUMENT49','Chuyên ngành','private/text/COURSE16/LESSON40/DOCUMENT49/OK.docx',1,'LESSON40','text',1),('DOCUMENT50','Từ vựng chuyên ngành','private/video/COURSE16/LESSON41/DOCUMENT50/40 TỪ VỰNG TIẾNG ANH CHUYÊN NGÀNH CÔNG NGHỆ THÔNG TIN PHỔ BIẾN NHẤT - Học Tiếng Anh Online.mp4',1,'LESSON41','video',1),('DOCUMENT51','Giới thiệu','private/text/COURSE16/LESSON42/DOCUMENT51/Bản lĩnh và trí tuệ của dân tộc Việt Nam.docx',1,'LESSON42','text',1),('DOCUMENT52','Kỹ năng nghe','private/video/COURSE16/LESSON43/DOCUMENT52/TIẾNG ANH PHỎNG VẤN XIN VIỆC_ 30 CÂU TRẢ LỜI HAY NHẤT - Khóa học tiếng Anh cho người đi làm.mp4',1,'LESSON43','video',1),('DOCUMENT53','Video bài giảng','private/text/COURSE16/LESSON44/DOCUMENT53/bao-cao-do-an-tmdt_compress.pdf',1,'LESSON44','text',1),('DOCUMENT54','Video bài giảng','private/video/COURSE2/LESSON45/DOCUMENT54/Cấu trúc câu trong tiếng Anh _ Ngữ Pháp Tiếng Anh Cơ Bản.mp4',1,'LESSON45','video',1),('DOCUMENT55','Video bài giảng','private/video/COURSE2/LESSON46/DOCUMENT55/Cấu trúc câu trong tiếng Anh _ Ngữ Pháp Tiếng Anh Cơ Bản.mp4',1,'LESSON46','video',1),('DOCUMENT56','Video bài giảng','private/video/COURSE2/LESSON47/DOCUMENT56/Tiếng Anh Phỏng Vấn Xin Việc.mp4',1,'LESSON47','video',1),('DOCUMENT57','Video bài giảng','private/video/COURSE2/LESSON48/DOCUMENT57/TIẾNG ANH PHỎNG VẤN XIN VIỆC_ 30 CÂU TRẢ LỜI HAY NHẤT - Khóa học tiếng Anh cho người đi làm.mp4',1,'LESSON48','video',1),('DOCUMENT58','Giới thiệu','private/text/COURSE2/LESSON49/DOCUMENT58/Giới thiệu về Khóa học cấp Toeic.docx',1,'LESSON49','text',1),('DOCUMENT59','Giới thiệu','private/text/COURSE2/LESSON50/DOCUMENT59/Giới thiệu về Khóa học cấp Toeic.docx',1,'LESSON50','text',1),('DOCUMENT60','Giới thiệu','private/text/COURSE2/LESSON51/DOCUMENT60/Kiểm thử hộp đen - Kiểm thử phần mềm (1).pdf',1,'LESSON51','text',1),('DOCUMENT61','Video bài giảng','private/video/COURSE3/LESSON52/DOCUMENT61/40 TỪ VỰNG TIẾNG ANH CHUYÊN NGÀNH CÔNG NGHỆ THÔNG TIN PHỔ BIẾN NHẤT - Học Tiếng Anh Online.mp4',1,'LESSON52','video',1),('DOCUMENT62','Video bài giảng','private/video/COURSE3/LESSON53/DOCUMENT62/Tiếng Anh Phỏng Vấn Xin Việc.mp4',1,'LESSON53','video',1),('DOCUMENT63','Video bài giảng','private/video/COURSE3/LESSON54/DOCUMENT63/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON54','video',1),('DOCUMENT64','Video bài giảng','private/video/COURSE3/LESSON55/DOCUMENT64/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON55','video',1),('DOCUMENT65','Giới thiệu','private/text/COURSE3/LESSON56/DOCUMENT65/NUnit.pdf',1,'LESSON56','text',1),('DOCUMENT66','Giới thiệu','private/text/COURSE3/LESSON57/DOCUMENT66/OK.docx',1,'LESSON57','text',1),('DOCUMENT67','Giới thiệu','private/text/COURSE3/LESSON58/DOCUMENT67/OK.docx',1,'LESSON58','text',1),('DOCUMENT68','Giới thiệu','private/text/COURSE3/LESSON59/DOCUMENT68/OK.docx',1,'LESSON59','text',1),('DOCUMENT69','Video bài giảng','private/video/COURSE4/LESSON60/DOCUMENT69/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON60','video',1),('DOCUMENT70','Video bài giảng','private/video/COURSE4/LESSON61/DOCUMENT70/Cấu trúc câu trong tiếng Anh _ Ngữ Pháp Tiếng Anh Cơ Bản.mp4',1,'LESSON61','video',1),('DOCUMENT71','Giới thiệu','private/video/COURSE4/LESSON62/DOCUMENT71/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON62','video',1),('DOCUMENT72','Video bài giảng','private/video/COURSE4/LESSON63/DOCUMENT72/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON63','video',1),('DOCUMENT73','Video bài giảng','private/video/COURSE4/LESSON64/DOCUMENT73/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON64','video',1),('DOCUMENT74','Giới thiệu','private/video/COURSE4/LESSON65/DOCUMENT74/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON65','video',1),('DOCUMENT75','Giới thiệu','private/text/COURSE5/LESSON66/DOCUMENT75/OK.docx',1,'LESSON66','text',1),('DOCUMENT76','Tài liêu mô tả','private/text/COURSE5/LESSON67/DOCUMENT76/OK.docx',1,'LESSON67','text',1),('DOCUMENT77','Tài liêu mô tả','private/text/COURSE5/LESSON68/DOCUMENT77/OK.docx',1,'LESSON68','text',1),('DOCUMENT78','Bí quyết luyện thi','private/text/COURSE5/LESSON69/DOCUMENT78/OK.docx',1,'LESSON69','text',1),('DOCUMENT79','Tài liêu mô tả','private/text/COURSE5/LESSON70/DOCUMENT79/OK.docx',1,'LESSON70','text',1),('DOCUMENT80','Video bài giảng','private/video/COURSE5/LESSON71/DOCUMENT80/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON71','video',1),('DOCUMENT81','Video bài giảng','private/video/COURSE6/LESSON72/DOCUMENT81/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON72','video',1),('DOCUMENT82','Bi quyet luyen thi','private/video/COURSE6/LESSON73/DOCUMENT82/Tiếng Anh Phỏng Vấn Xin Việc.mp4',1,'LESSON73','video',1),('DOCUMENT83','Video bài giảng','private/video/COURSE6/LESSON74/DOCUMENT83/Lập Trình Hướng Đối Tượng (OOP Java) trong 8 PHÚT _ Code Thu.mp4',1,'LESSON74','video',1),('DOCUMENT84','Video bài giảng','private/video/COURSE6/LESSON75/DOCUMENT84/videoplayback.mp4',1,'LESSON75','video',1),('DOCUMENT85','Video bài giảng','private/video/COURSE6/LESSON76/DOCUMENT85/[Elight] #5 Tính từ trong tiếng anh_ định nghĩa, chức năng, trật tự - Ngữ pháp t.mp4',1,'LESSON76','video',1),('DOCUMENT86','Tài liêu mô tả','private/video/COURSE6/LESSON77/DOCUMENT86/[Elight] Học tiếng Anh_ Giới từ In On At [Learning English from Zer0].mp4',1,'LESSON77','video',1),('DOCUMENT87','Video bài giảng','private/video/COURSE6/LESSON78/DOCUMENT87/Làm chủ câu bị động (Passive Voice) trong 5 phút [Ngữ pháp tiếng Anh cơ bản - Cá.mp4',1,'LESSON78','video',1),('DOCUMENT88','Video bài giảng','private/video/COURSE7/LESSON79/DOCUMENT88/002 What Is NgRx.mp4',1,'LESSON79','video',1),('DOCUMENT89','Video bài giảng','private/video/COURSE7/LESSON80/DOCUMENT89/002 What Is NgRx.mp4',1,'LESSON80','video',1),('DOCUMENT90','Tài liêu mô tả','private/text/COURSE7/LESSON80/DOCUMENT90/Báo_Cáo_OSSD.pdf',1,'LESSON80','text',2),('DOCUMENT91','Tài liêu mô tả','private/video/COURSE7/LESSON81/DOCUMENT91/My Daily Routine with MJ _ How to Express in English.mp4',1,'LESSON81','video',1),('DOCUMENT92','Giới thiệu','private/text/COURSE8/LESSON82/DOCUMENT92/OK.docx',1,'LESSON82','text',1),('DOCUMENT93','Giới thiệu chung','private/video/COURSE8/LESSON82/DOCUMENT93/Video 1 Giới thiệu chung và các bước làm bài IELTS Online Co (1).mp4',1,'LESSON82','video',2),('DOCUMENT94','Video nghe','private/video/COURSE8/LESSON83/DOCUMENT94/Cải thiện kỹ năng nghe tiếng Anh qua 10 chiến thuật _ Improve English Listening .mp4',1,'LESSON83','video',1),('DOCUMENT95','Video Đọc 1','private/video/COURSE8/LESSON84/DOCUMENT95/Cách tự học IELTS Reading hiệu quả tại nhà _ Sai lầm, tài liệu, cách học.mp4',1,'LESSON84','video',1),('DOCUMENT96','Video về viết','private/video/COURSE8/LESSON85/DOCUMENT96/Lộ trình học IELTS Writing hiệu quả tại nhà PDF tài liệu.mp4',1,'LESSON85','video',1),('DOCUMENT97','Video về nói','private/video/COURSE8/LESSON86/DOCUMENT97/7 cách diễn đạt Band 8 cho IELTS Speaking Part 2.mp4',1,'LESSON86','video',1),('DOCUMENT98','Tài liêu mô tả','private/text/COURSE10/LESSON13/DOCUMENT98/Untitled spreadsheet - Sheet1.pdf',1,'LESSON13','text',2),('DOCUMENT99','Tài liêu mô tả','private/text/COURSE10/LESSON6/DOCUMENT99/Giới thiệu về Khóa học cấp Toeic.docx',1,'LESSON6','text',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `example`
--

LOCK TABLES `example` WRITE;
/*!40000 ALTER TABLE `example` DISABLE KEYS */;
INSERT INTO `example` VALUES (1,'1',NULL,'She eats an apple every day.'),(2,'2',NULL,'The artist painted a beautiful landscape.'),(3,'3',NULL,'The airplane took off smoothly.'),(4,'4',NULL,'An ant crawled across the picnic blanket.'),(5,'5',NULL,'She moved into a new apartment.'),(6,'6',NULL,'The actor received an award for his performance.'),(7,'7',NULL,'The band released a new album.'),(8,'8',NULL,'He joined the army last year.'),(9,'9',NULL,'Please send the package to this address.'),(10,'10',NULL,'She gave the correct answer.'),(11,'11',NULL,'The children are playing with a ball.'),(12,'12',NULL,'She borrowed a book from the library.'),(13,'13',NULL,'She packed her bag for the trip.'),(14,'14',NULL,'A bird is singing in the tree.'),(15,'15',NULL,'He drank a bottle of water.'),(16,'16',NULL,'She opened a box of chocolates.'),(17,'17',NULL,'He rides his bicycle to school.'),(18,'18',NULL,'They walked across the bridge.'),(19,'19',NULL,'She bought a loaf of bread.'),(20,'20',NULL,'A butterfly landed on the flower.'),(21,'21',NULL,'The cat is sleeping on the sofa.'),(22,'22',NULL,'He drives a car to work.'),(23,'23',NULL,'She sat down on the chair.'),(24,'24',NULL,'She baked a chocolate cake.'),(25,'25',NULL,'She uses a computer for work.'),(26,'26',NULL,'He bought a new camera.'),(27,'27',NULL,'She drank a cup of tea.'),(28,'28',NULL,'The clock shows the correct time.'),(29,'29',NULL,'She cut a carrot into slices.'),(30,'30',NULL,'A dark cloud appeared in the sky.'),(31,'31',NULL,'She remained calm during the storm.'),(32,'32',NULL,'He is a clever student.'),(33,'33',NULL,'The garden is full of colorful flowers.'),(34,'34',NULL,'It is dangerous to play with fire.'),(35,'35',NULL,'The room was very dark.'),(36,'36',NULL,'The lake is very deep.'),(37,'37',NULL,'The cake is delicious.'),(38,'38',NULL,'They have different opinions.'),(39,'39',NULL,'The ground is very dry.'),(40,'40',NULL,'He woke up early.'),(41,'41',NULL,'The test was easy.'),(42,'42',NULL,'The bottle is empty.'),(43,'43',NULL,'The car is expensive.'),(44,'44',NULL,'He is a famous actor.'),(45,'45',NULL,'He drives a fast car.'),(46,'46',NULL,'She has a friendly smile.'),(47,'47',NULL,'The glass is full.'),(48,'48',NULL,'The joke was very funny.'),(49,'49',NULL,'He is very gentle with children.'),(50,'50',NULL,'She is very happy today.'),(51,'51',NULL,'The exam was very hard.'),(52,'52',NULL,'The box is very heavy.'),(53,'53',NULL,'She is very honest about her feelings.'),(54,'54',NULL,'The soup is very hot.'),(55,'55',NULL,'The building is huge.'),(56,'56',NULL,'I am very hungry.'),(57,'57',NULL,'She is very kind to everyone.'),(58,'58',NULL,'The house has a large garden.'),(59,'59',NULL,'He arrived late.'),(60,'60',NULL,'He is too lazy to clean his room.'),(61,'61',NULL,'She has long hair.'),(62,'62',NULL,'The music is very loud.'),(63,'63',NULL,'She is very lucky to win the lottery.'),(64,'64',NULL,'The building has a modern design.'),(65,'65',NULL,'The street is very narrow.'),(66,'66',NULL,'She bought a new car.'),(67,'67',NULL,'She is a very nice person.'),(68,'68',NULL,'The children are very noisy.'),(69,'69',NULL,'This is an old book.'),(70,'70',NULL,'He is always polite to others.'),(71,'71',NULL,'The family is very poor.'),(72,'72',NULL,'She is very pretty.'),(73,'73',NULL,'She gave a quick response.'),(74,'74',NULL,'The library is very quiet.'),(75,'75',NULL,'He is a very rich man.'),(76,'76',NULL,'He gave the right answer.'),(77,'77',NULL,'The city is safe at night.'),(78,'78',NULL,'She has short hair.'),(79,'79',NULL,'The turtle is slow.'),(80,'80',NULL,'The cat is small.'),(81,'81',NULL,'She drives carefully.'),(82,'82',NULL,'He spoke clearly.'),(83,'83',NULL,'She completely forgot about the meeting.'),(84,'84',NULL,'She is deeply in love.'),(85,'85',NULL,'She solved the problem easily.'),(86,'86',NULL,'She loves flowers, especially roses.'),(87,'87',NULL,'They finally reached the summit.'),(88,'88',NULL,'They lived happily ever after.'),(89,'89',NULL,'She spoke honestly about her feelings.'),(90,'90',NULL,'She responded immediately.'),(91,'91',NULL,'He stared at her intensely.'),(92,'92',NULL,'She has been feeling tired lately.'),(93,'93',NULL,'He nearly missed the train.'),(94,'94',NULL,'She quickly finished her work.'),(95,'95',NULL,'She rarely goes out.'),(96,'96',NULL,'He answered all the questions.'),(97,'97',NULL,'The train arrives at 10:30.'),(98,'98',NULL,'Can you bring some snacks to the party?'),(99,'99',NULL,'She bought a new dress.'),(100,'100',NULL,'They will begin the meeting at 9:00.'),(101,'101',NULL,'They are building a new house.'),(102,'102',NULL,'He accidentally broke the vase.'),(103,'103',NULL,'Can I borrow your pen?'),(104,'104',NULL,'She believes in ghosts.'),(105,'105',NULL,'The water is boiling.');
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
  `OrderN` int DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_CourseID_excercise_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_excercise_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excercise`
--

LOCK TABLES `excercise` WRITE;
/*!40000 ALTER TABLE `excercise` DISABLE KEYS */;
INSERT INTO `excercise` VALUES (5,'Luyện tập','2024-05-17 14:31:00',1,'COURSE10',10),(6,'DULIEUAO','2024-05-25 00:20:00',1,'COURSE10',3);
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
  CONSTRAINT `FK_ExcerciseID_execsresponse_excercise` FOREIGN KEY (`ExcerciseID`) REFERENCES `excercise` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_ProfileID_execsresponse_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`) ON DELETE CASCADE
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
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite` (
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LemmaID` int NOT NULL,
  `LastReviewed` date DEFAULT NULL,
  PRIMARY KEY (`ProfileID`,`LemmaID`),
  KEY `FK_LemmaID_learntrecord_lemma` (`LemmaID`) /*!80000 INVISIBLE */,
  CONSTRAINT `FK_LemmaID_learntrecord_lemma` FOREIGN KEY (`LemmaID`) REFERENCES `lemma` (`ID`),
  CONSTRAINT `FK_ProfileID_learntrecord_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES ('6640ccfe5cdda',34,NULL);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lemma`
--

LOCK TABLES `lemma` WRITE;
/*!40000 ALTER TABLE `lemma` DISABLE KEYS */;
INSERT INTO `lemma` VALUES (1,'apple','noun'),(2,'artist','noun'),(3,'airplane','noun'),(4,'ant','noun'),(5,'apartment','noun'),(6,'actor','noun'),(7,'album','noun'),(8,'army','noun'),(9,'address','noun'),(10,'answer','noun'),(11,'ball','noun'),(12,'book','noun'),(13,'bag','noun'),(14,'bird','noun'),(15,'bottle','noun'),(16,'box','noun'),(17,'bicycle','noun'),(18,'bridge','noun'),(19,'bread','noun'),(20,'butterfly','noun'),(21,'cat','noun'),(22,'car','noun'),(23,'chair','noun'),(24,'cake','noun'),(25,'computer','noun'),(26,'camera','noun'),(27,'cup','noun'),(28,'clock','noun'),(29,'carrot','noun'),(30,'cloud','noun'),(31,'calm','adjective'),(32,'clever','adjective'),(33,'colorful','adjective'),(34,'dangerous','adjective'),(35,'dark','adjective'),(36,'deep','adjective'),(37,'delicious','adjective'),(38,'different','adjective'),(39,'dry','adjective'),(40,'early','adjective'),(41,'easy','adjective'),(42,'empty','adjective'),(43,'expensive','adjective'),(44,'famous','adjective'),(45,'fast','adjective'),(46,'friendly','adjective'),(47,'full','adjective'),(48,'funny','adjective'),(49,'gentle','adjective'),(50,'happy','adjective'),(51,'hard','adjective'),(52,'heavy','adjective'),(53,'honest','adjective'),(54,'hot','adjective'),(55,'huge','adjective'),(56,'hungry','adjective'),(57,'kind','adjective'),(58,'large','adjective'),(59,'late','adjective'),(60,'lazy','adjective'),(61,'long','adjective'),(62,'loud','adjective'),(63,'lucky','adjective'),(64,'modern','adjective'),(65,'narrow','adjective'),(66,'new','adjective'),(67,'nice','adjective'),(68,'noisy','adjective'),(69,'old','adjective'),(70,'polite','adjective'),(71,'poor','adjective'),(72,'pretty','adjective'),(73,'quick','adjective'),(74,'quiet','adjective'),(75,'rich','adjective'),(76,'right','adjective'),(77,'safe','adjective'),(78,'short','adjective'),(79,'slow','adjective'),(80,'small','adjective'),(81,'carefully','adverb'),(82,'clearly','adverb'),(83,'completely','adverb'),(84,'deeply','adverb'),(85,'easily','adverb'),(86,'especially','adverb'),(87,'finally','adverb'),(88,'happily','adverb'),(89,'honestly','adverb'),(90,'immediately','adverb'),(91,'intensely','adverb'),(92,'lately','adverb'),(93,'nearly','adverb'),(94,'quickly','adverb'),(95,'rarely','adverb'),(96,'answer','verb'),(97,'arrive','verb'),(98,'bring','verb'),(99,'buy','verb'),(100,'begin','verb'),(101,'build','verb'),(102,'break','verb'),(103,'borrow','verb'),(104,'believe','verb'),(105,'boil','verb');
/*!40000 ALTER TABLE `lemma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lesson` (
  `ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `State` tinyint DEFAULT NULL,
  `CourseID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `OrderN` tinyint NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CourseID_lesson_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_lesson_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson`
--

LOCK TABLES `lesson` WRITE;
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` VALUES ('LESSON10','Giao Tiếp Tại Sân Bay và Ga Tàu',1,'COURSE10',6),('LESSON11','Giao Tiếp Trong Nhà Hàng và Quán Cà Phê',1,'COURSE10',7),('LESSON12','Hỏi Đường và Sử Dụng Phương Tiện Giao Thông Công Cộng',1,'COURSE10',8),('LESSON13','Mua Sắm và Thương Mại Trong Du Lịch',1,'COURSE10',9),('LESSON14','Giới thiệu về Tiếng Anh qua Phim Ảnh',1,'COURSE11',1),('LESSON15','Học từ Vựng và Ngữ Pháp qua Phim Ảnh',1,'COURSE11',2),('LESSON16','Luyện Nghe và Hiểu Nội Dung Phim Ảnh',1,'COURSE11',3),('LESSON17','Phân Tích và Thảo Luận về Phim Ảnh',1,'COURSE11',4),('LESSON18','Học Tiếng Anh thông qua Lời Bài Hát trong Phim',1,'COURSE11',5),('LESSON19','Giới thiệu về Tiếng Anh qua Nhạc',1,'COURSE12',1),('LESSON20','Học Từ Vựng và Ngữ Pháp qua Lời Bài Hát',1,'COURSE12',2),('LESSON21','Luyện Nghe và Hiểu Nội Dung Lời Bài Hát',1,'COURSE12',3),('LESSON22','Phân Tích và Thảo Luận về Lời Bài Hát',1,'COURSE12',4),('LESSON23','Học Tiếng Anh thông qua Thể Loại Nhạc',1,'COURSE12',5),('LESSON24','Giới thiệu về Khóa học',1,'COURSE13',1),('LESSON25','Xây dựng Từ Vựng ',1,'COURSE13',2),('LESSON26','Ngữ Pháp Cần Thiết',1,'COURSE13',3),('LESSON27','Luyện Nghe và Hiểu Nội Dung của Lời Bài Hát',1,'COURSE13',4),('LESSON28',' Phân Tích và Thảo Luận về Ý Nghĩa của Bài Hát',1,'COURSE13',5),('LESSON29','Sử dụng Tiếng Anh ',1,'COURSE13',6),('LESSON30','Giao Tiếp và Thương Lượng',1,'COURSE13',7),('LESSON31','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE14',1),('LESSON32','Chuẩn bị cho Phỏng Vấn',1,'COURSE14',2),('LESSON33','Kỹ năng Giao Tiếp và Giao Tiếp Hiệu Quả',1,'COURSE14',3),('LESSON34','Cách Trả lời câu hỏi Phỏng Vấn',1,'COURSE14',4),('LESSON35',' Phản ứng và Thái độ trong Phỏng Vấn',1,'COURSE14',5),('LESSON36',' Luyện tập Phỏng Vấn và Phản Biện',1,'COURSE14',6),('LESSON37','Đánh giá và Phát triển bản thân sau Phỏng Vấn',1,'COURSE14',7),('LESSON38','Tiếng Anh Học Thuật',1,'COURSE16',1),('LESSON39','Cấu trúc Câu và Ngữ Pháp Tiếng Anh Học Thuật',1,'COURSE16',2),('LESSON40',' Từ vựng và Thuật ngữ Chuyên ngành',1,'COURSE16',3),('LESSON41','Kỹ năng Đọc hiểu và Phân tích Văn bản',1,'COURSE16',4),('LESSON42','Kỹ năng Viết và Soạn thảo',1,'COURSE16',5),('LESSON43','Kỹ năng Nghe và Ghi chú',1,'COURSE16',6),('LESSON44','Luyện tập và Đánh giá',1,'COURSE16',7),('LESSON45','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE2',1),('LESSON46','Giao Tiếp Cơ bản',1,'COURSE2',2),('LESSON47',' Gặp gỡ và Chào hỏi',1,'COURSE2',3),('LESSON48','Hỏi và Trả lời thông tin cá nhân',1,'COURSE2',4),('LESSON49','Giao Tiếp Trong Gia Đình và Bạn Bè',1,'COURSE2',5),('LESSON50','Giao Tiếp Tại Nơi làm việc',1,'COURSE2',6),('LESSON51','Kỹ năng Nghe và Phản ứng nhanh',1,'COURSE2',7),('LESSON52','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE3',1),('LESSON53','Nguyên âm và Phụ âm cơ bản',1,'COURSE3',2),('LESSON54',' Ngữ điệu và Trọng âm',1,'COURSE3',3),('LESSON55','Phát âm âm tiết và Từ đúng',1,'COURSE3',4),('LESSON56','Phát âm Tiếng Anh trong Cụm từ và Câu',1,'COURSE3',5),('LESSON57',' Phát âm Tiếng Anh trong Giao Tiếp',1,'COURSE3',6),('LESSON58','Luyện tập và Thực hành',1,'COURSE3',7),('LESSON59','Đánh giá và Phát triển kỹ năng',1,'COURSE3',8),('LESSON6','Giới thiệu về Du lịch và Lịch trình',1,'COURSE10',1),('LESSON60','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE4',1),('LESSON61','Phân loại văn bản và Chiến lược đọc',1,'COURSE4',2),('LESSON62','Kỹ thuật đọc nhanh và Hiểu biết ',1,'COURSE4',3),('LESSON63','Kỹ thuật đọc nhanh và Hiểu biết ',1,'COURSE4',4),('LESSON64','Nhận diện ý chính và Chi tiết quan trọng',1,'COURSE4',5),('LESSON65','Tìm hiểu từ vựng mới và Cách hiểu ngữ pháp',1,'COURSE4',6),('LESSON66','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE5',1),('LESSON67','Cấu trúc văn bản và Ý tưởng chính',1,'COURSE5',2),('LESSON68','Phân loại loại văn bản và Mục đích viết',1,'COURSE5',3),('LESSON69','Phát triển Ý tưởng và Lập kế hoạch viết',1,'COURSE5',4),('LESSON7','Giao tiếp Cơ bản trong Du lịch',1,'COURSE10',2),('LESSON70','Sử dụng Ngôn từ và Ngữ pháp đúng',1,'COURSE5',5),('LESSON71','Phát triển Bố cục và Luồng ý',1,'COURSE5',6),('LESSON72','Giới thiệu về Ngữ Pháp Tiếng Anh',1,'COURSE6',1),('LESSON73','Câu đơn và Câu phức',1,'COURSE6',2),('LESSON74','Thì trong Tiếng Anh',1,'COURSE6',3),('LESSON75','Danh từ và Đại từ',1,'COURSE6',4),('LESSON76','Tính từ và Trạng từ',1,'COURSE6',5),('LESSON77',' Giới từ và Liên từ',1,'COURSE6',6),('LESSON78','Câu điều kiện và Câu bị động',1,'COURSE6',7),('LESSON79','Giới thiệu về Tiếng Anh Kinh doanh',1,'COURSE7',1),('LESSON8','Đặt Phòng Khách sạn và Căn hộ',1,'COURSE10',4),('LESSON80','Từ vựng về Kinh doanh',1,'COURSE7',2),('LESSON81','Giao tiếp trong Kinh doanh',1,'COURSE7',3),('LESSON82','Giới thiệu IELTS',1,'COURSE8',1),('LESSON83','Kỹ năng Nghe',1,'COURSE8',2),('LESSON84',' Kỹ năng Đọc',1,'COURSE8',3),('LESSON85','Kỹ năng Viết',1,'COURSE8',4),('LESSON86','Kỹ năng Nói ',1,'COURSE8',5),('LESSON9','Đặt Vé Máy Bay và Tàu Hỏa',1,'COURSE10',5);
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
INSERT INTO `meaning` VALUES ('1',1,NULL,'táo','Loại trái cây phổ biến, màu đỏ hoặc xanh, thường được ăn tươi hoặc làm nước ép',NULL),('10',10,NULL,'câu trả lời','Lời hồi đáp cho một câu hỏi hoặc vấn đề',NULL),('100',100,NULL,'bắt đầu','Bắt đầu một hành động hoặc quá trình',NULL),('101',101,NULL,'xây dựng','Tạo ra một cấu trúc bằng việc ghép nối các vật liệu',NULL),('102',102,NULL,'phá vỡ','Gây ra sự hỏng hoặc phá hủy',NULL),('103',103,NULL,'mượn','Lấy một cái gì đó từ người khác với ý định trả lại',NULL),('104',104,NULL,'tin','Chấp nhận điều gì đó là sự thật hoặc có ý định tuân theo',NULL),('105',105,NULL,'sôi','Nước hoặc chất lỏng đạt đến điểm sôi',NULL),('11',11,NULL,'quả bóng','Vật hình tròn dùng để chơi trong nhiều môn thể thao',NULL),('12',12,NULL,'sách','Tập hợp các trang viết hoặc in chứa thông tin hoặc câu chuyện',NULL),('13',13,NULL,'túi','Vật dụng dùng để đựng và mang theo đồ',NULL),('14',14,NULL,'chim','Loài động vật có lông vũ và cánh, thường biết bay',NULL),('15',15,NULL,'chai','Vật chứa đựng chất lỏng, thường có hình trụ và cổ hẹp',NULL),('16',16,NULL,'hộp','Vật chứa có hình hộp chữ nhật hoặc vuông, dùng để đựng đồ',NULL),('17',17,NULL,'xe đạp','Phương tiện giao thông có hai bánh, dùng sức người để di chuyển',NULL),('18',18,NULL,'cầu','Công trình xây dựng bắc qua sông, suối hoặc hẻm núi',NULL),('19',19,NULL,'bánh mì','Loại thực phẩm làm từ bột mì, nước và men',NULL),('2',2,NULL,'nghệ sĩ','Người tham gia vào hoạt động sáng tạo nghệ thuật như hội họa, điêu khắc, âm nhạc',NULL),('20',20,NULL,'bướm','Loài côn trùng có cánh màu sắc sặc sỡ, thường bay vào ban ngày',NULL),('21',21,NULL,'mèo','Động vật nuôi trong nhà, thường bắt chuột và rất sạch sẽ',NULL),('22',22,NULL,'xe hơi','Phương tiện giao thông có bốn bánh, chạy bằng động cơ',NULL),('23',23,NULL,'ghế','Đồ vật có mặt ngồi và tựa lưng, dùng để ngồi',NULL),('24',24,NULL,'bánh ngọt','Món ăn làm từ bột, đường và các nguyên liệu khác, thường được nướng',NULL),('25',25,NULL,'máy tính','Thiết bị điện tử dùng để tính toán và xử lý thông tin',NULL),('26',26,NULL,'máy ảnh','Thiết bị dùng để chụp ảnh hoặc quay video',NULL),('27',27,NULL,'cốc','Vật dụng dùng để uống nước hoặc các loại đồ uống khác',NULL),('28',28,NULL,'đồng hồ','Thiết bị dùng để đo và hiển thị thời gian',NULL),('29',29,NULL,'cà rốt','Loại rau củ màu cam, ăn sống hoặc nấu chín',NULL),('3',3,NULL,'máy bay','Phương tiện vận chuyển trên không, có cánh và động cơ',NULL),('30',30,NULL,'mây','Khối nước hoặc băng nhỏ lơ lửng trong không khí, nhìn thấy trên trời',NULL),('31',31,NULL,'bình tĩnh','Không bị kích động hay lo lắng',NULL),('32',32,NULL,'thông minh','Có khả năng hiểu biết nhanh chóng và dễ dàng',NULL),('33',33,NULL,'sặc sỡ','Có nhiều màu sắc tươi sáng',NULL),('34',34,NULL,'nguy hiểm','Có khả năng gây hại hoặc rủi ro',NULL),('35',35,NULL,'tối','Không có nhiều ánh sáng',NULL),('36',36,NULL,'sâu','Có khoảng cách lớn từ bề mặt hoặc từ đỉnh đến đáy',NULL),('37',37,NULL,'ngon','Có mùi vị rất hấp dẫn',NULL),('38',38,NULL,'khác nhau','Không giống nhau',NULL),('39',39,NULL,'khô','Không có nước hoặc độ ẩm',NULL),('4',4,NULL,'kiến','Loài côn trùng nhỏ, sống thành đàn và rất chăm chỉ',NULL),('40',40,NULL,'sớm','Xảy ra trước thời gian dự kiến hoặc thông thường',NULL),('41',41,NULL,'dễ dàng','Không khó để thực hiện hoặc đạt được',NULL),('42',42,NULL,'trống','Không có vật gì bên trong',NULL),('43',43,NULL,'đắt','Có giá cao',NULL),('44',44,NULL,'nổi tiếng','Được biết đến rộng rãi',NULL),('45',45,NULL,'nhanh','Di chuyển với tốc độ cao',NULL),('46',46,NULL,'thân thiện','Dễ gần và vui vẻ',NULL),('47',47,NULL,'đầy','Không còn chỗ trống',NULL),('48',48,NULL,'buồn cười','Gây cười, hài hước',NULL),('49',49,NULL,'dịu dàng','Nhẹ nhàng và tử tế',NULL),('5',5,NULL,'căn hộ','Nơi ở riêng biệt trong một tòa nhà chung cư',NULL),('50',50,NULL,'hạnh phúc','Cảm thấy hoặc biểu lộ niềm vui',NULL),('51',51,NULL,'khó','Không dễ dàng để làm hoặc hiểu',NULL),('52',52,NULL,'nặng','Có trọng lượng lớn',NULL),('53',53,NULL,'trung thực','Nói thật và không che giấu sự thật',NULL),('54',54,NULL,'nóng','Có nhiệt độ cao',NULL),('55',55,NULL,'to lớn','Có kích thước hoặc số lượng lớn',NULL),('56',56,NULL,'đói','Cảm thấy hoặc có nhu cầu ăn',NULL),('57',57,NULL,'tốt bụng','Dễ thương và quan tâm đến người khác',NULL),('58',58,NULL,'lớn','Có kích thước hoặc số lượng lớn',NULL),('59',59,NULL,'muộn','Xảy ra sau thời gian dự kiến',NULL),('6',6,NULL,'diễn viên','Người tham gia biểu diễn trong các vở kịch hoặc phim ảnh',NULL),('60',60,NULL,'lười biếng','Không muốn làm việc hoặc hoạt động',NULL),('61',61,NULL,'dài','Có khoảng cách lớn từ đầu này đến đầu kia',NULL),('62',62,NULL,'to','Có âm lượng lớn',NULL),('63',63,NULL,'may mắn','Có may mắn',NULL),('64',64,NULL,'hiện đại','Thuộc về thời đại hiện nay',NULL),('65',65,NULL,'hẹp','Có chiều rộng nhỏ',NULL),('66',66,NULL,'mới','Chưa được sử dụng hoặc chưa lâu',NULL),('67',67,NULL,'tốt','Dễ chịu, thú vị',NULL),('68',68,NULL,'ồn ào','Gây ra nhiều tiếng động',NULL),('69',69,NULL,'cũ','Đã tồn tại từ lâu',NULL),('7',7,NULL,'album','Bộ sưu tập các bản nhạc hoặc bức ảnh được phát hành cùng nhau',NULL),('70',70,NULL,'lịch sự','Cư xử một cách tôn trọng và tinh tế',NULL),('71',71,NULL,'nghèo','Không có nhiều tài sản hoặc tiền bạc',NULL),('72',72,NULL,'xinh đẹp','Có vẻ ngoài dễ nhìn',NULL),('73',73,NULL,'nhanh','Di chuyển hoặc hành động nhanh chóng',NULL),('74',74,NULL,'yên tĩnh','Không có nhiều tiếng động',NULL),('75',75,NULL,'giàu','Có nhiều tài sản hoặc tiền bạc',NULL),('76',76,NULL,'đúng','Phù hợp với sự thật hoặc đạo đức',NULL),('77',77,NULL,'an toàn','Không có nguy cơ gây hại hoặc nguy hiểm',NULL),('78',78,NULL,'ngắn','Có khoảng cách nhỏ từ đầu này đến đầu kia',NULL),('79',79,NULL,'chậm','Di chuyển với tốc độ thấp',NULL),('8',8,NULL,'quân đội','Lực lượng vũ trang của một quốc gia, chịu trách nhiệm bảo vệ đất nước',NULL),('80',80,NULL,'nhỏ','Có kích thước nhỏ',NULL),('81',81,NULL,'cẩn thận','Làm một việc với sự chú ý và thận trọng',NULL),('82',82,NULL,'rõ ràng','Dễ dàng hiểu hoặc thấy',NULL),('83',83,NULL,'hoàn toàn','Toàn bộ, đầy đủ',NULL),('84',84,NULL,'sâu sắc','Với cảm xúc mạnh mẽ hoặc ở mức độ cao',NULL),('85',85,NULL,'dễ dàng','Không gặp khó khăn hoặc nỗ lực nhiều',NULL),('86',86,NULL,'đặc biệt','Hơn tất cả các trường hợp khác',NULL),('87',87,NULL,'cuối cùng','Sau một thời gian dài chờ đợi',NULL),('88',88,NULL,'vui vẻ','Với sự vui vẻ và hài lòng',NULL),('89',89,NULL,'thành thật','Với sự trung thực',NULL),('9',9,NULL,'địa chỉ','Thông tin về vị trí nơi ở hoặc làm việc của một người',NULL),('90',90,NULL,'ngay lập tức','Không có sự trì hoãn',NULL),('91',91,NULL,'mãnh liệt','Với mức độ cao hoặc mạnh mẽ',NULL),('92',92,NULL,'gần đây','Trong thời gian gần đây',NULL),('93',93,NULL,'gần như','Chỉ một ít nữa là đạt đến',NULL),('94',94,NULL,'nhanh chóng','Với tốc độ nhanh',NULL),('95',95,NULL,'hiếm khi','Không thường xuyên',NULL),('96',96,NULL,'trả lời','Đưa ra phản hồi sau khi được hỏi',NULL),('97',97,NULL,'đến','Đến một nơi cụ thể',NULL),('98',98,NULL,'mang lại','Duy trì hoặc đưa một đối tượng đến một nơi nào đó',NULL),('99',99,NULL,'mua','Trả tiền để sở hữu một cái gì đó',NULL);
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
INSERT INTO `profile` VALUES ('066461b16ce372','Lâm Minh','Hoàng',0,'2002-01-01','1',0,'36','1'),('6640c9a32f39a','Lê Tấn ','Minh Toàn',0,'2003-05-25','0',1,'6640c9a311c8f','0'),('6640ca00cfde3','Huỳnh Xuân ','Bách',1,'2003-01-01','0',1,'6640ca00af54c','2'),('6640ca69e0b3b','Nguyễn Nhật',' Khải',1,'2003-01-01','0',1,'6640ca69c470f','0'),('6640cb1f587e7','Nguyễn Khánh',' Nam',1,'2001-01-12','0',1,'6640cb1f4be66','0'),('6640cbe318bea','Nguyễn Thanh ','Sang',1,'2001-01-01','0',1,'6640cbe30bfa7','0'),('6640cc4297fe3','Mai','Phương',0,'2024-05-01','0',1,'6640cc428abf2','0'),('6640ccfe5cdda','Ngô Văn  ','Huy',1,'1980-01-01','1',1,'6640ccfe50011','1'),('6640cd631ac65','Mai Thị ',' Loan',0,'2000-01-20','1',1,'6640cd630d2f8','1'),('6640ce1267696','Hồ Văn',' Long',1,'2024-05-12','1',1,'6640ce125abbd','1'),('6640ce5cf0395','Hạ Thị',' Lan',0,'2000-07-12','1',1,'6640ce5ce2c2e','1'),('6640cebc67073','Đinh Văn ','Phúc',1,'2000-06-12','1',1,'6640cebc5a08c','1'),('6640cee61d14b','Trần Thị',' Hằng',0,'1995-12-14','1',1,'6640cee6100d4','1'),('6640cf477d6af','Nguyễn Văn',' Khánh',1,'1990-09-12','1',1,'6640cf47703ec','1'),('6640cf7329958','Lê Thị ','Hương',0,'2000-06-12','1',1,'6640cf731c7af','1'),('6640cfb38f96d','Phạm Văn  ','Thuận',1,'2003-12-17','1',1,'6640cfb382a0b','1'),('6640d03201c3a','Trần Thị ','Thu',0,'1995-06-12','1',1,'6640d031e869a','1'),('6640d17e121d9','Nguyễn Văn ','Tuân',1,'1992-06-12','1',1,'6640d17e04e18','1'),('6640d1b429508','Hoàng Thị ','Thơm',0,'2005-02-12','1',1,'6640d1b41c1ac','1'),('6640d1df6f548','Vũ Văn ','Hùng',1,'2024-05-11','1',1,'6640d1df61fa1','1'),('6640d2150d347','Trần Thị ','Thu Hà',0,'2001-10-12','1',1,'6640d21500756','1'),('6640d246e88fd','Đỗ Văn ','Tài',1,'2000-08-12','1',1,'6640d246dbbcd','1'),('6640d2cda1577','Nguyễn Thị ','Ánh',0,'2024-05-01','1',1,'6640d2cd94491','1'),('6640d32688881','Lê Văn ','Tâm',0,'1996-01-12','1',1,'6640d3267b96c','1'),('6640d34f92cca','Nguyễn Thị ','Qúy',0,'2024-05-08','1',1,'6640d34f83333','1'),('6640d3d4d9ee5','Hoàng Văn ','Sơn',1,'1996-05-12','1',1,'6640d3d4cc50e','1'),('6640d44993c0d','Trần Thị ','Hồng',0,'2001-06-09','1',1,'6640d44986aa3','1'),('6640d48e9a67d','Nguyễn Văn ','Quân',1,'2024-05-08','1',1,'6640d48e8d637','1'),('6640d4dd694f6','Lê Thị ','Thảo',0,'2000-06-12','1',1,'6640d4dd5c4fc','1'),('6640d545e6e4a','Đặng Văn  ','Thành',1,'2001-06-12','1',1,'6640d545d964c','1'),('6640d5c0a2ab9','Phạm Thị ','Kim',0,'2002-08-12','1',1,'6640d5c094514','1'),('6640d62c5a035','Vũ Văn ','Hoa',0,'1999-07-12','1',1,'6640d62c4ccf2','1');
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
INSERT INTO `pronunciation` VALUES (1,'UK','/ˈæpəl/',NULL),(1,'US','/ˈæpəl/',NULL),(2,'UK','/ˈɑːtɪst/',NULL),(2,'US','/ˈɑːrtɪst/',NULL),(3,'UK','/ˈeəpleɪn/',NULL),(3,'US','/ˈerpleɪn/',NULL),(4,'UK','/ænt/',NULL),(4,'US','/ænt/',NULL),(5,'UK','/əˈpɑːtmənt/',NULL),(5,'US','/əˈpɑːrtmənt/',NULL),(6,'UK','/ˈæktə/',NULL),(6,'US','/ˈæktər/',NULL),(7,'UK','/ˈælbəm/',NULL),(7,'US','/ˈælbəm/',NULL),(8,'UK','/ˈɑːmi/',NULL),(8,'US','/ˈɑːrmi/',NULL),(9,'UK','/əˈdrɛs/',NULL),(9,'US','/əˈdrɛs/',NULL),(10,'UK','/ˈɑːnsə/',NULL),(10,'US','/ˈænsər/',NULL),(11,'UK','/bɔːl/',NULL),(11,'US','/bɔːl/',NULL),(12,'UK','/bʊk/',NULL),(12,'US','/bʊk/',NULL),(13,'UK','/bæɡ/',NULL),(13,'US','/bæɡ/',NULL),(14,'UK','/bɜːd/',NULL),(14,'US','/bɜːrd/',NULL),(15,'UK','/ˈbɒtl/',NULL),(15,'US','/ˈbɑːtl/',NULL),(16,'UK','/bɒks/',NULL),(16,'US','/bɑːks/',NULL),(17,'UK','/ˈbaɪsɪkəl/',NULL),(17,'US','/ˈbaɪsɪkəl/',NULL),(18,'UK','/brɪdʒ/',NULL),(18,'US','/brɪdʒ/',NULL),(19,'UK','/brɛd/',NULL),(19,'US','/brɛd/',NULL),(20,'UK','/ˈbʌtəflaɪ/',NULL),(20,'US','/ˈbʌtərflaɪ/',NULL),(21,'UK','/kæt/',NULL),(21,'US','/kæt/',NULL),(22,'UK','/kɑː/',NULL),(22,'US','/kɑːr/',NULL),(23,'UK','/tʃɛə/',NULL),(23,'US','/tʃɛr/',NULL),(24,'UK','/keɪk/',NULL),(24,'US','/keɪk/',NULL),(25,'UK','/kəmˈpjuːtə/',NULL),(25,'US','/kəmˈpjuːtər/',NULL),(26,'UK','/ˈkæmərə/',NULL),(26,'US','/ˈkæmərə/',NULL),(27,'UK','/kʌp/',NULL),(27,'US','/kʌp/',NULL),(28,'UK','/klɒk/',NULL),(28,'US','/klɑːk/',NULL),(29,'UK','/ˈkærət/',NULL),(29,'US','/ˈkærət/',NULL),(30,'UK','/klaʊd/',NULL),(30,'US','/klaʊd/',NULL),(31,'UK','/kɑːm/',NULL),(31,'US','/kɑːm/',NULL),(32,'UK','/ˈklɛvə/',NULL),(32,'US','/ˈklɛvər/',NULL),(33,'UK','/ˈkʌləfəl/',NULL),(33,'US','/ˈkʌlərfəl/',NULL),(34,'UK','/ˈdeɪndʒərəs/',NULL),(34,'US','/ˈdeɪndʒərəs/',NULL),(35,'UK','/dɑːk/',NULL),(35,'US','/dɑːrk/',NULL),(36,'UK','/diːp/',NULL),(36,'US','/diːp/',NULL),(37,'UK','/dɪˈlɪʃəs/',NULL),(37,'US','/dɪˈlɪʃəs/',NULL),(38,'UK','/ˈdɪfərənt/',NULL),(38,'US','/ˈdɪfərənt/',NULL),(39,'UK','/draɪ/',NULL),(39,'US','/draɪ/',NULL),(40,'UK','/ˈɜːli/',NULL),(40,'US','/ˈɜːrli/',NULL),(41,'UK','/ˈiːzi/',NULL),(41,'US','/ˈiːzi/',NULL),(42,'UK','/ˈɛmpti/',NULL),(42,'US','/ˈɛmpti/',NULL),(43,'UK','/ɪkˈspɛnsɪv/',NULL),(43,'US','/ɪkˈspɛnsɪv/',NULL),(44,'UK','/ˈfeɪməs/',NULL),(44,'US','/ˈfeɪməs/',NULL),(45,'UK','/fɑːst/',NULL),(45,'US','/fæst/',NULL),(46,'UK','/ˈfrɛndli/',NULL),(46,'US','/ˈfrɛndli/',NULL),(47,'UK','/fʊl/',NULL),(47,'US','/fʊl/',NULL),(48,'UK','/ˈfʌni/',NULL),(48,'US','/ˈfʌni/',NULL),(49,'UK','/ˈdʒɛntl/',NULL),(49,'US','/ˈdʒɛntl/',NULL),(50,'UK','/ˈhæpi/',NULL),(50,'US','/ˈhæpi/',NULL),(51,'UK','/hɑːd/',NULL),(51,'US','/hɑrd/',NULL),(52,'UK','/ˈhɛvi/',NULL),(52,'US','/ˈhɛvi/',NULL),(53,'UK','/ˈɒnɪst/',NULL),(53,'US','/ˈɑnɪst/',NULL),(54,'UK','/hɒt/',NULL),(54,'US','/hɑt/',NULL),(55,'UK','/hjuːdʒ/',NULL),(55,'US','/hjuːdʒ/',NULL),(56,'UK','/ˈhʌŋɡri/',NULL),(56,'US','/ˈhʌŋɡri/',NULL),(57,'UK','/kaɪnd/',NULL),(57,'US','/kaɪnd/',NULL),(58,'UK','/lɑːdʒ/',NULL),(58,'US','/lɑrdʒ/',NULL),(59,'UK','/leɪt/',NULL),(59,'US','/leɪt/',NULL),(60,'UK','/ˈleɪzi/',NULL),(60,'US','/ˈleɪzi/',NULL),(61,'UK','/lɒŋ/',NULL),(61,'US','/lɔːŋ/',NULL),(62,'UK','/laʊd/',NULL),(62,'US','/laʊd/',NULL),(63,'UK','/ˈlʌki/',NULL),(63,'US','/ˈlʌki/',NULL),(64,'UK','/ˈmɒd.ən/',NULL),(64,'US','/ˈmɒdərn/',NULL),(65,'UK','/ˈnærəʊ/',NULL),(65,'US','/ˈnæroʊ/',NULL),(66,'UK','/njuː/',NULL),(66,'US','/nuː/',NULL),(67,'UK','/naɪs/',NULL),(67,'US','/naɪs/',NULL),(68,'UK','/ˈnɔɪzi/',NULL),(68,'US','/ˈnɔɪzi/',NULL),(69,'UK','/əʊld/',NULL),(69,'US','/oʊld/',NULL),(70,'UK','/pəˈlaɪt/',NULL),(70,'US','/pəˈlaɪt/',NULL),(71,'UK','/pɔːr/',NULL),(71,'US','/pʊr/',NULL),(72,'UK','/ˈprɪti/',NULL),(72,'US','/ˈprɪti/',NULL),(73,'UK','/kwɪk/',NULL),(73,'US','/kwɪk/',NULL),(74,'UK','/ˈkwaɪət/',NULL),(74,'US','/ˈkwaɪət/',NULL),(75,'UK','/rɪʧ/',NULL),(75,'US','/rɪʧ/',NULL),(76,'UK','/raɪt/',NULL),(76,'US','/raɪt/',NULL),(77,'UK','/seɪf/',NULL),(77,'US','/seɪf/',NULL),(78,'UK','/ʃɔːt/',NULL),(78,'US','/ʃɔrt/',NULL),(79,'UK','/sləʊ/',NULL),(79,'US','/sloʊ/',NULL),(80,'UK','/smɔl/',NULL),(80,'US','/smɔl/',NULL),(81,'UK','/ˈkeəfəli/',NULL),(81,'US','/ˈkerfəli/',NULL),(82,'UK','/ˈklɪəli/',NULL),(82,'US','/ˈklɪrli/',NULL),(83,'UK','/kəmˈpliːtli/',NULL),(83,'US','/kəmˈpliːtli/',NULL),(84,'UK','/ˈdiːpli/',NULL),(84,'US','/ˈdiːpli/',NULL),(85,'UK','/ˈiːzɪli/',NULL),(85,'US','/ˈiːzəli/',NULL),(86,'UK','/ɪˈspeʃəli/',NULL),(86,'US','/ɪˈspeʃəli/',NULL),(87,'UK','/ˈfaɪnəli/',NULL),(87,'US','/ˈfaɪnəli/',NULL),(88,'UK','/ˈhæpɪli/',NULL),(88,'US','/ˈhæpəli/',NULL),(89,'UK','/ˈɒnɪstli/',NULL),(89,'US','/ˈɑːnɪstli/',NULL),(90,'UK','/ɪˈmiːdiətli/',NULL),(90,'US','/ɪˈmiːdiətli/',NULL),(91,'UK','/ɪnˈtɛnsli/',NULL),(91,'US','/ɪnˈtɛnsli/',NULL),(92,'UK','/ˈleɪtli/',NULL),(92,'US','/ˈleɪtli/',NULL),(93,'UK','/ˈnɪəli/',NULL),(93,'US','/ˈnɪrli/',NULL),(94,'UK','/ˈkwɪkli/',NULL),(94,'US','/ˈkwɪkli/',NULL),(95,'UK','/ˈreəli/',NULL),(95,'US','/ˈrɛrli/',NULL),(96,'UK','/ˈɑːnsə/',NULL),(96,'US','/ˈænsər/',NULL),(97,'UK','/əˈraɪv/',NULL),(97,'US','/əˈraɪv/',NULL),(98,'UK','/brɪŋ/',NULL),(98,'US','/brɪŋ/',NULL),(99,'UK','/baɪ/',NULL),(99,'US','/baɪ/',NULL),(100,'UK','/bɪˈɡɪn/',NULL),(100,'US','/bɪˈɡɪn/',NULL),(101,'UK','/bɪld/',NULL),(101,'US','/bɪld/',NULL),(102,'UK','/breɪk/',NULL),(102,'US','/breɪk/',NULL),(103,'UK','/ˈbɒrəʊ/',NULL),(103,'US','/ˈbɑroʊ/',NULL),(104,'UK','/bɪˈliːv/',NULL),(104,'US','/bɪˈliːv/',NULL),(105,'UK','/bɔɪl/',NULL),(105,'US','/bɔɪl/',NULL);
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
INSERT INTO `property` VALUES ('DEFAULT_INSTRUTOR_ROLE','0'),('DEFAULT_LEARNER_ROLE','1');
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
  CONSTRAINT `FK_ID_qcompletion_question` FOREIGN KEY (`ID`) REFERENCES `question` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcompletion`
--

LOCK TABLES `qcompletion` WRITE;
/*!40000 ALTER TABLE `qcompletion` DISABLE KEYS */;
INSERT INTO `qcompletion` VALUES (49,'They have finished their homework',1);
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
  CONSTRAINT `FK_ QCompID_qcommask_qcompletion` FOREIGN KEY (`QCompID`) REFERENCES `qcompletion` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcompmask`
--

LOCK TABLES `qcompmask` WRITE;
/*!40000 ALTER TABLE `qcompmask` DISABLE KEYS */;
INSERT INTO `qcompmask` VALUES (15,10,8,49);
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
  CONSTRAINT `FK_KeyQ_qmatching_qmatchingkey` FOREIGN KEY (`KeyQ`) REFERENCES `qmatchingkey` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_QuestionID_qmatching_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmatching`
--

LOCK TABLES `qmatching` WRITE;
/*!40000 ALTER TABLE `qmatching` DISABLE KEYS */;
INSERT INTO `qmatching` VALUES (18,'Optimistic ',48,18),(19,'Pessimistic ',48,19),(20,'Ambitious',48,20),(21,'Generous',48,21);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmatchingkey`
--

LOCK TABLES `qmatchingkey` WRITE;
/*!40000 ALTER TABLE `qmatchingkey` DISABLE KEYS */;
INSERT INTO `qmatchingkey` VALUES (13,'AAAa'),(14,'Paris'),(15,'Tokyo'),(16,'Brasília'),(17,'Canberra'),(18,'Having a positive outlook'),(19,'Having a negative outlook'),(20,'Having a strong desire to achieve'),(21,'Willing to give and share');
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
  `QuestionID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_QuestionID_qmulchoption_question` (`QuestionID`),
  CONSTRAINT `FK_QuestionID_qmulchoption_question` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmulchoption`
--

LOCK TABLES `qmulchoption` WRITE;
/*!40000 ALTER TABLE `qmulchoption` DISABLE KEYS */;
INSERT INTO `qmulchoption` VALUES (93,'Berlin',0,43),(94,'Madrid',0,43),(95,'Paris',1,43),(96,'Rome',0,43),(97,'Slow',0,44),(98,'Fast',1,44),(99,'Weak',0,44),(100,'Small',0,44),(101,'goes',0,45),(102,'going',0,45),(103,'went',1,45),(104,'gone',0,45),(105,'Quickly',0,46),(106,'Happy',0,46),(107,'Apple',0,46),(108,'Run',1,46),(109,'in',0,47),(110,'at',1,47),(111,'on',0,47),(112,'by',0,47);
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
  `OrderN` int DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_ExcerciseID_question_excercise` (`ExcerciseID`),
  CONSTRAINT `FK_ExcerciseID_question_excercise` FOREIGN KEY (`ExcerciseID`) REFERENCES `excercise` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (43,'What is the capital of France?',1,5,1),(44,'Choose the correct synonym for the word \"rapid\"',1,5,2),(45,'She _____ to the store yesterday.',1,5,3),(46,'Which word is a noun?',1,5,4),(47,'They arrived _____ the airport on time.',1,5,5),(48,'Nối từ và nghĩa',1,5,6),(49,'Điền vào chỗ trống',1,5,7);
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
INSERT INTO `role` VALUES ('0','Giảng viên (Đầy đủ)','mAb/fn9n/6d/gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('1','Học viên (Đầy đủ)','GAb/VdRKInh/gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('2','Học hành','gAAAAAHQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
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
  `Price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES ('SUB1','2024-03-13 08:01:34','6640d62c5a035','COURSE10',3000),('SUB10','2024-03-14 12:10:06','6640d03201c3a','COURSE10',3000),('SUB11','2024-03-14 12:10:06','6640d17e121d9','COURSE10',3000),('SUB12','2024-03-14 12:10:06','6640d1b429508','COURSE10',3000),('SUB13','2024-03-14 12:10:06','6640d1df6f548','COURSE10',3000),('SUB14','2024-03-14 12:10:06','6640d2150d347','COURSE10',3000),('SUB15','2024-03-14 12:10:06','6640d62c5a035','COURSE11',3000),('SUB16','2024-03-14 12:10:06','6640d03201c3a','COURSE11',3000),('SUB17','2024-03-14 12:10:06','6640d17e121d9','COURSE11',3000),('SUB18','2024-03-14 12:10:06','6640d1b429508','COURSE11',3000),('SUB19','2024-03-14 12:10:06','6640d1df6f548','COURSE11',3000),('SUB2','2024-04-14 12:10:06','6640cd631ac65','COURSE10',3000),('SUB20','2024-04-14 12:10:06','6640d2150d347','COURSE11',3000),('SUB21','2024-04-14 12:10:06','6640cd631ac65','COURSE11',3000),('SUB22','2024-04-14 12:10:06','6640ccfe5cdda','COURSE11',3000),('SUB23','2024-04-14 12:10:06','6640ce1267696','COURSE11',3000),('SUB24','2024-04-14 12:10:06','6640ce5cf0395','COURSE11',3000),('SUB25','2024-04-14 12:10:06','6640cebc67073','COURSE11',3000),('SUB26','2024-04-14 12:10:06','6640cee61d14b','COURSE11',3000),('SUB27','2024-04-14 12:10:06','6640cf7329958','COURSE11',3000),('SUB28','2024-04-14 12:10:06','6640cfb38f96d','COURSE11',3000),('SUB29','2024-04-14 12:10:06','6640d62c5a035','COURSE12',3000),('SUB3','2024-04-14 12:10:06','6640ccfe5cdda','COURSE10',3000),('SUB30','2024-05-14 12:10:06','6640d03201c3a','COURSE12',3000),('SUB31','2024-05-14 12:10:06','6640d17e121d9','COURSE12',3000),('SUB32','2024-05-14 12:10:06','6640d1b429508','COURSE12',3000),('SUB33','2024-05-14 12:10:06','6640d1df6f548','COURSE12',3000),('SUB34','2024-05-14 12:10:06','6640d2150d347','COURSE12',3000),('SUB35','2024-05-13 08:22:19','6640cd631ac65','COURSE12',3000),('SUB36','2024-05-14 12:10:06','6640ccfe5cdda','COURSE12',3000),('SUB37','2024-05-14 12:10:06','6640ce1267696','COURSE12',3000),('SUB38','2024-05-14 12:10:06','6640ce5cf0395','COURSE12',3000),('SUB39','2024-05-14 12:10:06','6640cebc67073','COURSE12',3000),('SUB4','2024-05-14 12:10:06','6640ce1267696','COURSE10',3000),('SUB40','2024-05-14 12:10:06','6640cee61d14b','COURSE12',3000),('SUB41','2024-05-14 12:10:06','6640cf7329958','COURSE12',3000),('SUB42','2024-05-14 12:10:06','6640cfb38f96d','COURSE12',3000),('SUB43','2024-05-13 08:01:34','6640d62c5a035','COURSE13',3000),('SUB44','2024-05-14 12:10:06','6640d03201c3a','COURSE13',3000),('SUB45','2024-05-14 12:10:06','6640d17e121d9','COURSE13',3000),('SUB46','2024-05-14 12:10:06','6640d1b429508','COURSE13',3000),('SUB47','2024-05-14 12:10:06','6640d1df6f548','COURSE13',3000),('SUB48','2024-05-14 12:10:06','6640d2150d347','COURSE13',3000),('SUB49','2024-05-13 08:22:19','6640cd631ac65','COURSE13',3000),('SUB5','2024-05-14 12:10:06','6640ce5cf0395','COURSE10',3000),('SUB50','2024-05-14 12:10:06','6640ccfe5cdda','COURSE13',3000),('SUB51','2024-05-14 12:10:06','6640ce1267696','COURSE13',3000),('SUB52','2024-05-14 12:10:06','6640ce5cf0395','COURSE13',3000),('SUB53','2024-05-14 12:10:06','6640cebc67073','COURSE13',3000),('SUB54','2024-05-14 12:10:06','6640cee61d14b','COURSE13',3000),('SUB55','2024-05-14 12:10:06','6640cf7329958','COURSE13',3000),('SUB56','2024-05-14 12:10:06','6640cfb38f96d','COURSE13',3000),('SUB57','2024-05-16 12:10:06','6640cfb38f96d','COURSE14',3000),('SUB58','2024-04-20 12:10:06','6640d03201c3a','COURSE14',3000),('SUB59','2024-04-20 12:10:06','6640d17e121d9','COURSE14',3000),('SUB6','2024-05-14 12:10:06','6640cebc67073','COURSE10',3000),('SUB60','2024-04-20 12:10:06','6640d1b429508','COURSE14',3000),('SUB61','2024-05-14 12:10:06','6640d1df6f548','COURSE14',3000),('SUB62','2024-03-21 12:10:06','6640d2150d347','COURSE14',3000),('SUB63','2024-03-21 12:10:06','6640cd631ac65','COURSE14',3000),('SUB64','2024-03-22 12:10:06','6640ccfe5cdda','COURSE14',3000),('SUB65','2024-03-22 12:10:06','6640ce1267696','COURSE14',3000),('SUB66','2024-03-21 12:10:06','6640ce5cf0395','COURSE14',3000),('SUB67','2024-05-11 12:10:06','6640cebc67073','COURSE14',3000),('SUB68','2024-05-11 12:10:06','6640cee61d14b','COURSE14',3000),('SUB69','2024-05-14 12:10:06','6640cf7329958','COURSE14',3000),('SUB7','2024-05-14 12:10:06','6640cee61d14b','COURSE10',3000),('SUB70','2024-05-01 12:10:06','6640cfb38f96d','COURSE14',3000),('SUB71','2024-03-21 12:10:06','6640d4dd694f6','COURSE14',3000),('SUB72','2024-05-14 12:10:06','6640d545e6e4a','COURSE14',3000),('SUB73','2024-05-16 23:31:03','6640ccfe5cdda','COURSE15',2000),('SUB8','2024-05-14 12:10:06','6640cf7329958','COURSE10',3000),('SUB9','2024-05-14 12:10:06','6640cfb38f96d','COURSE10',3000);
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tracking` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ProfileID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CourseID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LearnedDocumentID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AtDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ProfileID_tracking_profile` (`ProfileID`),
  KEY `FK_CourseID_tracking_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_tracking_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_ProfileID_tracking_profile` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracking`
--

LOCK TABLES `tracking` WRITE;
/*!40000 ALTER TABLE `tracking` DISABLE KEYS */;
INSERT INTO `tracking` VALUES (8,'6640cd631ac65','COURSE10','DOCUMENT10','2024-05-13 08:22:25'),(16,'6640ccfe5cdda','COURSE10','DOCUMENT10','2024-05-16 17:50:13');
/*!40000 ALTER TABLE `tracking` ENABLE KEYS */;
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
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
INSERT INTO `verification` VALUES ('066461b16ce372','ztoanlene@gmail.com',NULL,NULL,NULL),('6640c9a32f39a','zletanminhtoan2505@gmail.com','letanminhtoan2505@gmail.com','03c079f9415dd60779825636208b4953b789b8a43130765e374c9bec24ccd5e5','2024-05-12 15:56:05'),('6640ca00cfde3','zhuynhxbach@gmail.com','huynhxbach@gmail.com',NULL,NULL),('6640ca69e0b3b','znguyennhatkhai@gmail.com','nguyennhatkhai@gmail.com',NULL,NULL),('6640cb1f587e7','znguyenkhanhnam@gmail.com','nguyenkhanhnam@gmail.com',NULL,NULL),('6640cbe318bea','znguyenthanhsang@gmail.com','nguyenthanhsang@gmail.com',NULL,NULL),('6640cc4297fe3','zmaiphuong@gmail.com','maiphuong@gmail.com',NULL,NULL),('6640ccfe5cdda','zngovanhuy@gmail.com','ngovanhuy@gmail.com',NULL,NULL),('6640cd631ac65','zmaithiloan@gmail.com','maithiloan@gmail.com',NULL,NULL),('6640ce1267696','zhovanlong@gmail.com','hovanlong@gmail.com',NULL,NULL),('6640ce5cf0395','zhathilan@gmail.com','hathilan@gmail.com',NULL,NULL),('6640cebc67073','zdinhvanphuc@gmail.com','dinhvanphuc@gmail.com',NULL,NULL),('6640cee61d14b','ztranthihang@gmail.com','tranthihang@gmail.com',NULL,NULL),('6640cf477d6af','znguyenvankhanh@gmail.com','nguyenvankhanh@gmail.com',NULL,NULL),('6640cf7329958','zlethihuong@gmail.com','lethihuong@gmail.com',NULL,NULL),('6640cfb38f96d','zphamvanthuan@gmail.com','phamvanthuan@gmail.com',NULL,NULL),('6640d03201c3a','ztranthithu@gmail.com','tranthithu@gmail.com',NULL,NULL),('6640d17e121d9','znguyenvantuan@gmail.com','nguyenvantuan@gmail.com',NULL,NULL),('6640d1b429508','zhoangthithom@gmail.com','hoangthithom@gmail.com',NULL,NULL),('6640d1df6f548','zvuvanhung@gmail.com','vuvanhung@gmail.com',NULL,NULL),('6640d2150d347','ztranthithuha@gmail.com','tranthithuha@gmail.com',NULL,NULL),('6640d246e88fd','zdovantai@gmail.com','dovantai@gmail.com',NULL,NULL),('6640d2cda1577','znguyenthianh@gmail.com','nguyenthianh@gmail.com',NULL,NULL),('6640d32688881','zlevantamm@gmail.com','levantamm@gmail.com',NULL,NULL),('6640d34f92cca','zphamthiquy@gmail.com','phamthiquy@gmail.com',NULL,NULL),('6640d3d4d9ee5','zhoangvanson@gmail.com','hoangvanson@gmail.com',NULL,NULL),('6640d44993c0d','ztranthihong@gmail.com','tranthihong@gmail.com',NULL,NULL),('6640d48e9a67d','znguyenvanquan@gmail.com','nguyenvanquan@gmail.com',NULL,NULL),('6640d4dd694f6','zlethithao@gmail.com','lethithao@gmail.com',NULL,NULL),('6640d545e6e4a','zdangvanthanh@gmail.com','dangvanthanh@gmail.com',NULL,NULL),('6640d5c0a2ab9','zphamthikim@gmail.com','phamthikim@gmail.com',NULL,NULL),('6640d62c5a035','zvuvanhoa@gmail.com','vuvanhoa@gmail.com',NULL,NULL);
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

-- Dump completed on 2024-05-17  6:39:50
SET FOREIGN_KEY_CHECKS = 1;