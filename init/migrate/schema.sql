-- MySQL dump 10.13  Distrib 5.6.10, for osx10.8 (x86_64)
--
-- Host: localhost    Database: one_day
-- ------------------------------------------------------
-- Server version	5.6.10

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
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaint` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(1023) COLLATE utf8_bin NOT NULL DEFAULT '',
  `day_id` int(11) unsigned DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL,
  `cip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `day`
--

DROP TABLE IF EXISTS `day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `facebook_id` varchar(20) DEFAULT NULL,
  `twitter_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `final_description` varchar(1023) DEFAULT NULL,
  `type` enum('Working day','Day off','Holiday','Trip','Special event') NOT NULL,
  `image_ext` enum('jpg','png','gif','jpeg') DEFAULT NULL,
  `is_gathering_enabled` int(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` int(1) unsigned NOT NULL DEFAULT '0',
  `views_count` int(11) unsigned NOT NULL DEFAULT '0',
  `ctime` int(10) unsigned NOT NULL,
  `utime` int(10) unsigned NOT NULL,
  `cip` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `is_deleted` (`is_deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2131353 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `day_comment`
--

DROP TABLE IF EXISTS `day_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `day_id` int(11) unsigned NOT NULL,
  `text` varchar(1023) NOT NULL DEFAULT '',
  `ctime` int(10) unsigned NOT NULL,
  `utime` int(10) unsigned NOT NULL,
  `cip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `day_favorite`
--

DROP TABLE IF EXISTS `day_favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day_favorite` (
  `user_id` int(11) unsigned NOT NULL,
  `day_id` int(11) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `day_interest`
--

DROP TABLE IF EXISTS `day_interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day_interest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `day_id` int(11) unsigned NOT NULL,
  `rating` int(10) unsigned NOT NULL DEFAULT '0',
  `is_pinned` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `day_id` (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `day_like`
--

DROP TABLE IF EXISTS `day_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `day_id` int(11) unsigned NOT NULL,
  `facebook_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `twitter_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-day_id` (`user_id`,`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `device_notification`
--

DROP TABLE IF EXISTS `device_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_notification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `device_token_id` int(11) unsigned NOT NULL DEFAULT '0',
  `text` varchar(256) CHARACTER SET armscii8 NOT NULL DEFAULT '',
  `icon` int(2) unsigned NOT NULL DEFAULT '0',
  `sound` varchar(63) CHARACTER SET armscii8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `device_token`
--

DROP TABLE IF EXISTS `device_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `token` varchar(128) CHARACTER SET ascii NOT NULL DEFAULT '',
  `ctime` int(11) unsigned NOT NULL DEFAULT '0',
  `logins_count` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `max_count` int(11) unsigned NOT NULL,
  `taken_count` int(11) unsigned DEFAULT '0',
  `ctime` int(11) unsigned DEFAULT NULL,
  `utime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lmb_cms_document`
--

DROP TABLE IF EXISTS `lmb_cms_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lmb_cms_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  `is_published` tinyint(1) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `identifier` varchar(128) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `ctime` int(11) NOT NULL DEFAULT '0',
  `utime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `parent_id` (`parent_id`),
  KEY `id` (`id`,`parent_id`),
  KEY `identifier` (`identifier`,`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lmb_cms_seo`
--

DROP TABLE IF EXISTS `lmb_cms_seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lmb_cms_seo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lmb_cms_text_block`
--

DROP TABLE IF EXISTS `lmb_cms_text_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lmb_cms_text_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lmb_cms_user`
--

DROP TABLE IF EXISTS `lmb_cms_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lmb_cms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(64) DEFAULT NULL,
  `generated_password` varchar(64) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `role_type` varchar(10) NOT NULL DEFAULT '0',
  `ctime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `moment`
--

DROP TABLE IF EXISTS `moment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `day_id` int(11) unsigned NOT NULL,
  `description` varchar(1023) NOT NULL DEFAULT '',
  `location_latitude` float DEFAULT NULL,
  `location_longitude` float DEFAULT NULL,
  `image_ext` enum('jpg','jpeg','png','gif') DEFAULT NULL,
  `time` int(10) unsigned NOT NULL,
  `timezone` int(4) NOT NULL,
  `facebook_id` char(20) DEFAULT NULL,
  `twitter_id` char(20) DEFAULT NULL,
  `instagram_id` char(32) DEFAULT NULL,
  `flickr_id` char(20) DEFAULT NULL,
  `facebook_post_id` char(20) DEFAULT NULL,
  `twitter_post_id` char(20) DEFAULT NULL,
  `is_hidden` int(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` int(1) unsigned NOT NULL DEFAULT '0',
  `ctime` int(10) unsigned NOT NULL,
  `utime` int(10) unsigned NOT NULL,
  `cip` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `day_id` (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `moment_comment`
--

DROP TABLE IF EXISTS `moment_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moment_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `moment_id` int(11) unsigned NOT NULL,
  `text` varchar(1023) NOT NULL DEFAULT '',
  `ctime` int(10) unsigned NOT NULL,
  `utime` int(10) unsigned NOT NULL,
  `cip` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moment_id` (`moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `moment_like`
--

DROP TABLE IF EXISTS `moment_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moment_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `moment_id` int(11) unsigned NOT NULL,
  `facebook_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `twitter_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-moment_it` (`user_id`,`moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `link` varchar(256) NOT NULL DEFAULT '',
  `text` char(255) NOT NULL DEFAULT '',
  `day_id` int(11) unsigned DEFAULT NULL,
  `moment_id` int(11) unsigned DEFAULT NULL,
  `day_comment_id` int(11) unsigned DEFAULT NULL,
  `moment_comment_id` int(11) unsigned DEFAULT NULL,
  `day_like_id` int(11) unsigned DEFAULT NULL,
  `moment_like_id` int(11) unsigned DEFAULT NULL,
  `ctime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_id` (`sender_id`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2131344 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `news_recipient`
--

DROP TABLE IF EXISTS `news_recipient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_recipient` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `is_pushed` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requests_log`
--

DROP TABLE IF EXISTS `requests_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) COLLATE ascii_bin NOT NULL DEFAULT '',
  `method` varchar(7) COLLATE ascii_bin NOT NULL DEFAULT '',
  `path` varchar(255) COLLATE ascii_bin NOT NULL DEFAULT '',
  `get` text COLLATE ascii_bin NOT NULL,
  `post` text COLLATE ascii_bin NOT NULL,
  `cookies` text COLLATE ascii_bin NOT NULL,
  `code` int(3) unsigned NOT NULL DEFAULT '0',
  `response` text COLLATE ascii_bin NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schema_info`
--

DROP TABLE IF EXISTS `schema_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schema_info` (
  `version` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sphinx_counter`
--

DROP TABLE IF EXISTS `sphinx_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sphinx_counter` (
  `counter_id` int(11) unsigned NOT NULL DEFAULT '0',
  `max_doc_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `counter_id` (`counter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invitation_id` int(11) unsigned DEFAULT NULL,
  `user_settings_id` int(11) unsigned DEFAULT NULL,
  `name` char(100) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `image_ext` enum('jpg','jpeg','png','gif') DEFAULT NULL,
  `facebook_uid` char(20) NOT NULL DEFAULT '',
  `facebook_access_token` char(255) NOT NULL DEFAULT '',
  `facebook_profile_utime` int(10) unsigned NOT NULL DEFAULT '0',
  `timezone` int(4) NOT NULL,
  `twitter_uid` char(20) DEFAULT NULL,
  `twitter_access_token` char(255) DEFAULT NULL,
  `twitter_access_token_secret` char(255) DEFAULT NULL,
  `instagram_uid` char(64) NOT NULL DEFAULT '',
  `instagram_token` char(64) NOT NULL DEFAULT '',
  `flickr_uid` char(64) NOT NULL DEFAULT '',
  `flickr_token` char(64) NOT NULL DEFAULT '',
  `location` char(255) NOT NULL DEFAULT '',
  `occupation` char(255) NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `current_day_id` int(11) unsigned DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `utime` int(10) unsigned NOT NULL DEFAULT '0',
  `cip` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facebook_uid` (`facebook_uid`),
  KEY `facebook_access_token` (`facebook_access_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2131520 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_following`
--

DROP TABLE IF EXISTS `user_following`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_following` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `follower_user_id` int(11) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `follower_user_id-user_id` (`follower_user_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notifications_new_days` int(1) unsigned NOT NULL DEFAULT '0',
  `notifications_new_comments` int(1) unsigned NOT NULL DEFAULT '0',
  `notifications_new_replays` int(1) unsigned NOT NULL DEFAULT '0',
  `notifications_related_activity` int(1) unsigned NOT NULL DEFAULT '0',
  `notifications_shooting_photos` int(1) unsigned NOT NULL DEFAULT '0',
  `photos_save_original` int(1) unsigned NOT NULL DEFAULT '0',
  `photos_save_filtered` int(1) unsigned NOT NULL DEFAULT '0',
  `social_share_facebook` int(1) unsigned NOT NULL DEFAULT '0',
  `social_share_twitter` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-17 15:36:25
-- MySQL dump 10.13  Distrib 5.6.10, for osx10.8 (x86_64)
--
-- Host: localhost    Database: one_day
-- ------------------------------------------------------
-- Server version	5.6.10

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
-- Dumping data for table `schema_info`
--

LOCK TABLES `schema_info` WRITE;
/*!40000 ALTER TABLE `schema_info` DISABLE KEYS */;
INSERT INTO `schema_info` (`version`) VALUES (1363379859);
/*!40000 ALTER TABLE `schema_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-17 15:36:26

INSERT INTO `invitation` (`id`, `code`, `max_count`, `taken_count`, `ctime`, `utime`)
VALUES
	(1,'They shall not pass',100,0,1363379351,1363379351);
