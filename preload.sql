SET FOREIGN_KEY_CHECKS = 0; 
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
INSERT INTO `account` VALUES ('0','root99','Hello|11',0,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('1','letoan2505','M123456m',1,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('2','hieuthuan99','M123456m',1,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('ACCOUNT1','LETOAN','M123456m',1,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('ACCOUNT2','HOANGSON','M12345',1,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('ACCOUNT3','LE HOAN','M12345',1,'////////////gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
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
INSERT INTO `acompmask` VALUES (2,8,14,'haha');
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
INSERT INTO `amatching` VALUES (7,14,17),(7,15,14),(7,16,15),(7,17,17);
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
INSERT INTO `amulchoption` VALUES (85,5),(91,6);
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
INSERT INTO `answer` VALUES (5,'',39,'ExcersR1'),(6,'',40,'ExcersR1'),(7,'',41,'ExcersR1'),(8,'',42,'ExcersR1');
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
INSERT INTO `course` VALUES ('COURSE1','public/poster/COURSE1/banner-mobile-02-02.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học cơ bản là nền tảng quan trọng để bắt đầu hành trình học tiếng Anh của bạn. Trong khóa học này, bạn sẽ khám phá các khái niệm ngữ pháp cơ bản, tích lũy từ vựng hàng ngày và phát triển kỹ năng nghe và nói căn bản. Từ việc giới thiệu bản thân đến gặp gỡ và giao tiếp trong các tình huống hàng ngày, khóa học này sẽ giúp bạn xây dựng một cơ sở vững chắc để tiếp tục học tiếng Anh một cách hiệu quả và tự tin hơn.</span><br></p>',1,'PRO1','2024-05-11 15:29:00','2024-05-31 15:29:00',100,'Khóa học cơ bản'),('COURSE10','public/poster/COURSE10/tu-vung-tieng-anh-du-lich-1.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách sử dụng tiếng Anh một cách tự tin khi đi du lịch. Từ giao tiếp cơ bản đến việc đặt phòng khách sạn và đặt vé máy bay, bạn sẽ được trang bị những kỹ năng cần thiết để thảo luận và làm việc trong môi trường du lịch quốc tế.</span><br></p>',1,'PRO3','2024-05-11 15:49:00','2024-08-31 15:49:00',100,'Khóa học tiếng Anh thông dụng trong du lịch'),('COURSE11','public/poster/COURSE11/hoc-tieng-anh-qua-phim-cho-nguoi-moi-bat-dau-1.jpg','Khóa học tiếng Anh thông dụng trong du lịchTrong khóa học này, bạn sẽ khám phá tiếng Anh qua thế giới của điện ảnh. Từ việc luyện nghe thông qua các đoạn phim đến việc phân tích và thảo luận về nội dung của chúng, bạn sẽ nâng cao kỹ năng ngôn ngữ của mình một cách thú vị và hiệu quả',1,'PRO1','2024-05-11 15:51:00','2024-07-31 15:51:00',100,'Khóa học tiếng Anh qua phim ảnh'),('COURSE12','public/poster/COURSE12/hoc-tieng-anh-bang-am-nhac3.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">\"Khóa học này sẽ dẫn bạn đi qua thế giới âm nhạc để học tiếng Anh. Từ việc học từ vựng và ngữ pháp qua lời bài hát đến việc hiểu và thấu hiểu ý nghĩa sâu sắc của các bài hát, bạn sẽ trải nghiệm một phương pháp học tiếng Anh độc đáo và thú vị.</span><br></p>',1,'PRO2','2024-05-11 15:53:00','2024-07-31 15:53:00',100,'Khóa học tiếng Anh qua nhạc'),('COURSE13','public/poster/COURSE13/khoahoctienganhgiaotiepchuyennghiepdanhriengchonguoidilam.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách giao tiếp hiệu quả trong môi trường làm việc bằng tiếng Anh. Từ việc viết thư từ chuyên nghiệp đến báo cáo công việc, bạn sẽ được trang bị những kỹ năng cần thiết để thành công và thăng tiến trong sự nghiệp của mình.</span><br></p>',1,'PRO3','2024-05-11 15:56:00','2024-07-31 15:56:00',100,'Khóa học tiếng Anh cho người đi làm'),('COURSE14','public/poster/COURSE14/businessenglishvuong.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này sẽ chuẩn bị bạn cho các buổi phỏng vấn tiếng Anh. Từ việc chuẩn bị trước đến cách trả lời các câu hỏi phỏng vấn một cách tự tin và hiệu quả, bạn sẽ được trang bị những kỹ năng cần thiết để thành công trong các cuộc phỏng vấn xin việc hoặc học bổng.</span><br></p>',1,'PRO1','2024-05-11 15:58:00','2024-06-30 15:58:00',100,'Khóa học luyện phỏng vấn tiếng Anh'),('COURSE16','public/poster/COURSE16/tieng-anh-hoc-thuat-la-gi.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách sử dụng tiếng Anh trong môi trường học thuật. Từ việc viết bài luận và báo cáo học thuật đến hiểu và sử dụng các thuật ngữ chuyên ngành, bạn sẽ được trang bị những kỹ năng cần thiết để thành công trong các khóa học đại học, nghiên cứu và công việc liên quan đến môi trường học thuật.</span><br></p>',1,'PRO3','2024-05-11 16:02:00','2024-08-31 16:02:00',100,'Khóa học tiếng Anh học thuật'),('COURSE2','public/poster/COURSE2/hinh-anh-tieng-anh-giao-tiep-la-gi-so-1.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ nắm vững các kỹ năng giao tiếp hàng ngày để tự tin trò chuyện và tương tác trong các tình huống đời thường. Từ cách giới thiệu bản thân đến kỹ năng thảo luận về các chủ đề phổ biến, bạn sẽ học cách sử dụng ngôn ngữ một cách tự tin và linh hoạt. Khóa học cũng tập trung vào việc giao tiếp qua điện thoại và email, giúp bạn xây dựng kỹ năng liên lạc hiệu quả trong môi trường công việc và xã hội ngày nay.</span><br></p>',1,'PRO2','2024-05-11 15:36:00','2024-06-30 15:36:00',200,'Khóa học tiếng Anh giao tiếp hàng ngày'),('COURSE3','public/poster/COURSE3/ec7c516c4c-phat-am-tieng-anh.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học phát âm sẽ giúp bạn rèn luyện và cải thiện kỹ năng phát âm tiếng Anh của mình. Qua các bài học, bạn sẽ học cách phát âm các âm tiếng Anh đúng cách và luyện tập qua các từ và câu phổ biến. Với sự hướng dẫn cụ thể và các bài tập thực hành, khóa học này sẽ giúp bạn phát triển một giọng phát âm rõ ràng và dễ hiểu.</span><br></p>',1,'PRO3','2024-05-11 15:39:00','2024-08-31 15:39:00',100,'Khóa học phát âm'),('COURSE4','public/poster/COURSE4/z5410594829335_d3ffe463eed8c5054319eb9faaeb5a47.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học các kỹ năng đọc tiếng Anh hiệu quả. Từ phương pháp đọc đến hiểu và phân tích các loại văn bản khác nhau, bạn sẽ được trang bị những công cụ cần thiết để nâng cao khả năng đọc của mình. Khóa học cũng tập trung vào việc phát triển từ vựng và kỹ năng nhận biết cấu trúc câu, giúp bạn trở thành một độc giả linh hoạt và tự tin.</span><br></p>',1,'PRO1','2024-05-11 15:41:00','2024-08-31 15:41:00',200,'Khóa học kỹ năng đọc'),('COURSE5','public/poster/COURSE5/Tổng-hợp-các-từ-viết-tắt-trong-tiếng-Anh-thông-dụng-nhất-1024x536.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học kỹ năng viết sẽ giúp bạn phát triển khả năng viết tiếng Anh một cách rõ ràng và hiệu quả. Từ việc viết email chuyên nghiệp đến viết bài luận và tóm tắt, bạn sẽ học cách tổ chức ý tưởng và trình bày ý kiến một cách logic và hấp dẫn. Qua các bài tập và phản hồi, bạn sẽ cải thiện khả năng viết của mình và trở thành một người viết thành công.</span><br></p>',1,'PRO2','2024-05-11 15:41:00','2024-09-01 15:41:00',200,'Khóa học kỹ năng viết'),('COURSE6','public/poster/COURSE6/ngu-phap-2.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này sẽ đưa bạn vào thế giới của ngữ pháp tiếng Anh. Từ các quy tắc cơ bản đến những điểm ngữ pháp phức tạp hơn, bạn sẽ hiểu và áp dụng ngữ pháp một cách tự tin. Qua các bài tập và ví dụ thực tế, khóa học sẽ giúp bạn củng cố kiến thức và nâng cao khả năng sử dụng ngôn ngữ một cách chính xác và linh hoạt.</span><br></p>',1,'PRO2','2024-05-11 15:43:00','2024-08-31 15:43:00',300,'Khóa học ngữ pháp tiếng Anh'),('COURSE7','public/poster/COURSE7/Photo.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ học cách sử dụng tiếng Anh trong môi trường kinh doanh. Từ từ vựng và cụm từ chuyên ngành đến các kỹ năng giao tiếp chuyên nghiệp, bạn sẽ được trang bị những công cụ cần thiết để thành công trong thế giới kinh doanh quốc tế ngày nay.</span><br></p>',1,'PRO3','2024-05-11 15:44:00','2024-09-30 15:45:00',400,'Khóa học tiếng Anh kinh doanh'),('COURSE8','public/poster/COURSE8/khoa-luyen-thi-ielts-75-advanced-20230926114724578.jpg','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Khóa học này sẽ chuẩn bị bạn cho kỳ thi IELTS một cách toàn diện. Từ các chiến lược luyện thi đến luyện tập các kỹ năng cần thiết (nghe, nói, đọc, viết), bạn sẽ có mọi thứ cần thiết để đạt được điểm số mong muốn trong kỳ thi quan trọng này</span><br></p>',1,'PRO1','2024-05-11 15:46:00','2024-09-30 15:46:00',400,'Khóa học luyện thi IELTS'),('COURSE9','public/poster/COURSE9/download.png','<p><span style=\"color: rgb(13, 13, 13); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; white-space-collapse: preserve;\">Trong khóa học này, bạn sẽ được chuẩn bị cho kỳ thi TOEFL thông qua việc luyện tập các kỹ năng cần thiết và học các chiến lược làm bài hiệu quả. Với sự hỗ trợ từ giáo viên có kinh nghiệm và các tài liệu luyện thi chất lượng, bạn sẽ tự tin bước vào kỳ thi với khả năng tối ưu.</span><br></p>',1,'PRO3','2024-05-11 15:48:00','2024-07-01 15:48:00',100,'Khóa học luyện thi TOEFL');
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
  `OrderN` int DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_CourseID_excercise_course` (`CourseID`),
  CONSTRAINT `FK_CourseID_excercise_course` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excercise`
--

LOCK TABLES `excercise` WRITE;
/*!40000 ALTER TABLE `excercise` DISABLE KEYS */;
INSERT INTO `excercise` VALUES (4,'Đề 10 câu','2024-05-13 19:52:00',1,'COURSE1',6);
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
INSERT INTO `execsresponse` VALUES ('ExcersR1','2024-05-11 16:10:03',4,'1');
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
INSERT INTO `lesson` VALUES ('LESSON1','Ngữ pháp cơ bản',0,'COURSE1',1),('LESSON10','Giao Tiếp Tại Sân Bay và Ga Tàu',1,'COURSE10',5),('LESSON11','Giao Tiếp Trong Nhà Hàng và Quán Cà Phê',1,'COURSE10',6),('LESSON12','Hỏi Đường và Sử Dụng Phương Tiện Giao Thông Công Cộng',1,'COURSE10',7),('LESSON13','Mua Sắm và Thương Mại Trong Du Lịch',1,'COURSE10',8),('LESSON14','Giới thiệu về Tiếng Anh qua Phim Ảnh',1,'COURSE11',1),('LESSON15','Học từ Vựng và Ngữ Pháp qua Phim Ảnh',1,'COURSE11',2),('LESSON16','Luyện Nghe và Hiểu Nội Dung Phim Ảnh',1,'COURSE11',3),('LESSON17','Phân Tích và Thảo Luận về Phim Ảnh',1,'COURSE11',4),('LESSON18','Học Tiếng Anh thông qua Lời Bài Hát trong Phim',1,'COURSE11',5),('LESSON19','Giới thiệu về Tiếng Anh qua Nhạc',1,'COURSE12',1),('LESSON2','Từ vựng căn bản',1,'COURSE1',2),('LESSON20','Học Từ Vựng và Ngữ Pháp qua Lời Bài Hát',1,'COURSE12',2),('LESSON21','Luyện Nghe và Hiểu Nội Dung Lời Bài Hát',1,'COURSE12',3),('LESSON22','Phân Tích và Thảo Luận về Lời Bài Hát',1,'COURSE12',4),('LESSON23','Học Tiếng Anh thông qua Thể Loại Nhạc',1,'COURSE12',5),('LESSON24','Giới thiệu về Khóa học',1,'COURSE13',1),('LESSON25','Xây dựng Từ Vựng ',1,'COURSE13',2),('LESSON26','Ngữ Pháp Cần Thiết',1,'COURSE13',3),('LESSON27','Luyện Nghe và Hiểu Nội Dung của Lời Bài Hát',1,'COURSE13',4),('LESSON28',' Phân Tích và Thảo Luận về Ý Nghĩa của Bài Hát',1,'COURSE13',5),('LESSON29','Sử dụng Tiếng Anh ',1,'COURSE13',6),('LESSON3','Kỹ năng nghe',1,'COURSE1',3),('LESSON30','Giao Tiếp và Thương Lượng',1,'COURSE13',7),('LESSON31','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE14',1),('LESSON32','Chuẩn bị cho Phỏng Vấn',1,'COURSE14',2),('LESSON33','Kỹ năng Giao Tiếp và Giao Tiếp Hiệu Quả',1,'COURSE14',3),('LESSON34','Cách Trả lời câu hỏi Phỏng Vấn',1,'COURSE14',4),('LESSON35',' Phản ứng và Thái độ trong Phỏng Vấn',1,'COURSE14',5),('LESSON36',' Luyện tập Phỏng Vấn và Phản Biện',1,'COURSE14',6),('LESSON37','Đánh giá và Phát triển bản thân sau Phỏng Vấn',1,'COURSE14',7),('LESSON38','Tiếng Anh Học Thuật',1,'COURSE16',1),('LESSON39','Cấu trúc Câu và Ngữ Pháp Tiếng Anh Học Thuật',1,'COURSE16',2),('LESSON4','Kỹ năng đọc',1,'COURSE1',4),('LESSON40',' Từ vựng và Thuật ngữ Chuyên ngành',1,'COURSE16',3),('LESSON41','Kỹ năng Đọc hiểu và Phân tích Văn bản',1,'COURSE16',4),('LESSON42','Kỹ năng Viết và Soạn thảo',1,'COURSE16',5),('LESSON43','Kỹ năng Nghe và Ghi chú',1,'COURSE16',6),('LESSON44','Luyện tập và Đánh giá',1,'COURSE16',7),('LESSON45','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE2',1),('LESSON46','Giao Tiếp Cơ bản',1,'COURSE2',2),('LESSON47',' Gặp gỡ và Chào hỏi',1,'COURSE2',3),('LESSON48','Hỏi và Trả lời thông tin cá nhân',1,'COURSE2',4),('LESSON49','Giao Tiếp Trong Gia Đình và Bạn Bè',1,'COURSE2',5),('LESSON5','Kỹ năng viết',1,'COURSE1',5),('LESSON50','Giao Tiếp Tại Nơi làm việc',1,'COURSE2',6),('LESSON51','Kỹ năng Nghe và Phản ứng nhanh',1,'COURSE2',7),('LESSON52','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE3',1),('LESSON53','Nguyên âm và Phụ âm cơ bản',1,'COURSE3',2),('LESSON54',' Ngữ điệu và Trọng âm',1,'COURSE3',3),('LESSON55','Phát âm âm tiết và Từ đúng',1,'COURSE3',4),('LESSON56','Phát âm Tiếng Anh trong Cụm từ và Câu',1,'COURSE3',5),('LESSON57',' Phát âm Tiếng Anh trong Giao Tiếp',1,'COURSE3',6),('LESSON58','Luyện tập và Thực hành',1,'COURSE3',7),('LESSON59','Đánh giá và Phát triển kỹ năng',1,'COURSE3',8),('LESSON6','Giới thiệu về Du lịch và Lịch trình',1,'COURSE10',1),('LESSON60','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE4',1),('LESSON61','Phân loại văn bản và Chiến lược đọc',1,'COURSE4',2),('LESSON62','Kỹ thuật đọc nhanh và Hiểu biết ',1,'COURSE4',3),('LESSON63','Kỹ thuật đọc nhanh và Hiểu biết ',1,'COURSE4',4),('LESSON64','Nhận diện ý chính và Chi tiết quan trọng',1,'COURSE4',5),('LESSON65','Tìm hiểu từ vựng mới và Cách hiểu ngữ pháp',1,'COURSE4',6),('LESSON66','Giới thiệu và Mục tiêu của Khóa học',1,'COURSE5',1),('LESSON67','Cấu trúc văn bản và Ý tưởng chính',1,'COURSE5',2),('LESSON68','Phân loại loại văn bản và Mục đích viết',1,'COURSE5',3),('LESSON69','Phát triển Ý tưởng và Lập kế hoạch viết',1,'COURSE5',4),('LESSON7','Giao tiếp Cơ bản trong Du lịch',1,'COURSE10',2),('LESSON70','Sử dụng Ngôn từ và Ngữ pháp đúng',1,'COURSE5',5),('LESSON71','Phát triển Bố cục và Luồng ý',1,'COURSE5',6),('LESSON72','Giới thiệu về Ngữ Pháp Tiếng Anh',1,'COURSE6',1),('LESSON73','Câu đơn và Câu phức',1,'COURSE6',2),('LESSON74','Thì trong Tiếng Anh',1,'COURSE6',3),('LESSON75','Danh từ và Đại từ',1,'COURSE6',4),('LESSON76','Tính từ và Trạng từ',1,'COURSE6',5),('LESSON77',' Giới từ và Liên từ',1,'COURSE6',6),('LESSON78','Câu điều kiện và Câu bị động',1,'COURSE6',7),('LESSON8','Đặt Phòng Khách sạn và Căn hộ',1,'COURSE10',3),('LESSON9','Đặt Vé Máy Bay và Tàu Hỏa',1,'COURSE10',4);
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
INSERT INTO `profile` VALUES ('0','Nguyễn','Thanh Hồng',1,'1985-03-22','0',0,'1','0'),('1','Vũ','Hiếu Thuận',0,'2000-08-13','1',0,'2','1'),('PRO1','Lê ','Hoàng Lâm',0,'2003-05-05','0',1,'ACCOUNT1','0'),('PRO2','Long','Lân',0,'2003-05-07','0',1,'ACCOUNT2','0'),('PRO3','Liêm','Văn Rô',0,'2003-05-07','0',1,'ACCOUNT3','0');
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
  CONSTRAINT `FK_ID_qcompletion_question` FOREIGN KEY (`ID`) REFERENCES `question` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcompletion`
--

LOCK TABLES `qcompletion` WRITE;
/*!40000 ALTER TABLE `qcompletion` DISABLE KEYS */;
INSERT INTO `qcompletion` VALUES (42,'My brother plays football every Saturday.',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcompmask`
--

LOCK TABLES `qcompmask` WRITE;
/*!40000 ALTER TABLE `qcompmask` DISABLE KEYS */;
INSERT INTO `qcompmask` VALUES (14,11,5,42);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmatching`
--

LOCK TABLES `qmatching` WRITE;
/*!40000 ALTER TABLE `qmatching` DISABLE KEYS */;
INSERT INTO `qmatching` VALUES (14,'France',41,14),(15,'Japan',41,15),(16,'Brazil',41,16),(17,'Australia',41,17);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmatchingkey`
--

LOCK TABLES `qmatchingkey` WRITE;
/*!40000 ALTER TABLE `qmatchingkey` DISABLE KEYS */;
INSERT INTO `qmatchingkey` VALUES (13,'AAAa'),(14,'Paris'),(15,'Tokyo'),(16,'Brasília'),(17,'Canberra');
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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qmulchoption`
--

LOCK TABLES `qmulchoption` WRITE;
/*!40000 ALTER TABLE `qmulchoption` DISABLE KEYS */;
INSERT INTO `qmulchoption` VALUES (85,'Berlin',0,39),(86,'London',0,39),(87,'Paris',1,39),(88,'Rome',0,39),(89,'Childs',0,40),(90,'Childrens',0,40),(91,'Childs\'',0,40),(92,'Children',1,40);
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (38,'Which of the following is a synonym for \"beautiful\"?',1,4,1),(39,'What is the capital city of France?',1,4,2),(40,'What is the plural form of \"child\"?',1,4,3),(41,'Match the following countries with their capitals',1,4,4),(42,'Điền vào chỗ trống',1,4,5);
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
INSERT INTO `role` VALUES ('0','Giảng viên (Đầy đủ)','mAb/fn9n/6d/gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),('1','Học viên (Đầy đủ)','GAb/VdRKInh/gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES ('SUB1','2024-05-11 00:00:00','1','COURSE1');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracking`
--

LOCK TABLES `tracking` WRITE;
/*!40000 ALTER TABLE `tracking` DISABLE KEYS */;
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

-- Dump completed on 2024-05-11 23:32:50
  
SET FOREIGN_KEY_CHECKS = 1;