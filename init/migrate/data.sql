-- MySQL dump 10.13  Distrib 5.5.25a, for osx10.6 (i386)
--
-- Host: localhost    Database: one_day
-- ------------------------------------------------------
-- Server version	5.5.25a-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `complaint`
--

LOCK TABLES `complaint` WRITE;
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;
/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day`
--

LOCK TABLES `day` WRITE;
/*!40000 ALTER TABLE `day` DISABLE KEYS */;
/*!40000 ALTER TABLE `day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day_comment`
--

LOCK TABLES `day_comment` WRITE;
/*!40000 ALTER TABLE `day_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `day_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day_comment_like`
--

LOCK TABLES `day_comment_like` WRITE;
/*!40000 ALTER TABLE `day_comment_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `day_comment_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day_favourite`
--

LOCK TABLES `day_favourite` WRITE;
/*!40000 ALTER TABLE `day_favourite` DISABLE KEYS */;
/*!40000 ALTER TABLE `day_favourite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day_finish_comment`
--

LOCK TABLES `day_finish_comment` WRITE;
/*!40000 ALTER TABLE `day_finish_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `day_finish_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day_interest`
--

LOCK TABLES `day_interest` WRITE;
/*!40000 ALTER TABLE `day_interest` DISABLE KEYS */;
/*!40000 ALTER TABLE `day_interest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `day_like`
--

LOCK TABLES `day_like` WRITE;
/*!40000 ALTER TABLE `day_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `day_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lmb_cms_document`
--

LOCK TABLES `lmb_cms_document` WRITE;
/*!40000 ALTER TABLE `lmb_cms_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `lmb_cms_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lmb_cms_seo`
--

LOCK TABLES `lmb_cms_seo` WRITE;
/*!40000 ALTER TABLE `lmb_cms_seo` DISABLE KEYS */;
/*!40000 ALTER TABLE `lmb_cms_seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lmb_cms_text_block`
--

LOCK TABLES `lmb_cms_text_block` WRITE;
/*!40000 ALTER TABLE `lmb_cms_text_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `lmb_cms_text_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lmb_cms_user`
--

LOCK TABLES `lmb_cms_user` WRITE;
/*!40000 ALTER TABLE `lmb_cms_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `lmb_cms_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moment`
--

LOCK TABLES `moment` WRITE;
/*!40000 ALTER TABLE `moment` DISABLE KEYS */;
/*!40000 ALTER TABLE `moment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moment_comment`
--

LOCK TABLES `moment_comment` WRITE;
/*!40000 ALTER TABLE `moment_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `moment_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moment_comment_like`
--

LOCK TABLES `moment_comment_like` WRITE;
/*!40000 ALTER TABLE `moment_comment_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `moment_comment_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moment_like`
--

LOCK TABLES `moment_like` WRITE;
/*!40000 ALTER TABLE `moment_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `moment_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `news_recipient`
--

LOCK TABLES `news_recipient` WRITE;
/*!40000 ALTER TABLE `news_recipient` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_recipient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `requests_log`
--

LOCK TABLES `requests_log` WRITE;
/*!40000 ALTER TABLE `requests_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_following`
--

LOCK TABLES `user_following` WRITE;
/*!40000 ALTER TABLE `user_following` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_following` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_settings`
--

LOCK TABLES `user_settings` WRITE;
/*!40000 ALTER TABLE `user_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-09-03 21:55:20
