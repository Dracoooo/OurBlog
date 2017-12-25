-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: our_blog_db
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'文字'),(2,'图片'),(3,'音乐'),(4,'视频'),(5,'长文章');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_content` text,
  `comment_create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `post_id_idx` (`post_id`),
  CONSTRAINT `fk_comment_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,1,'我也不想出门','2017-12-20 03:59:53'),(2,2,4,'管理员又怎样','2017-12-20 03:59:53'),(3,1,2,'肉好吃','2017-12-20 03:59:53'),(4,1,2,'想吃就吃','2017-12-20 03:59:53'),(5,1,2,'越吃越胖','2017-12-20 13:05:39'),(6,1,2,'多运动','2017-12-20 13:05:39'),(7,1,2,'瘦身光跑是不够的','2017-12-20 13:05:39');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fans`
--

DROP TABLE IF EXISTS `fans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fans` (
  `user_id` int(11) NOT NULL COMMENT ' 被关注者\n',
  `fan_id` int(11) NOT NULL COMMENT '关注者\n',
  KEY `fk_user_user_id_idx` (`user_id`),
  KEY `fk_fans_user_id` (`fan_id`),
  CONSTRAINT `fk_fans_user_id` FOREIGN KEY (`fan_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='粉丝表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fans`
--

LOCK TABLES `fans` WRITE;
/*!40000 ALTER TABLE `fans` DISABLE KEYS */;
INSERT INTO `fans` VALUES (2,1),(2,3),(1,2),(3,2);
/*!40000 ALTER TABLE `fans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '发表博客的用户id',
  `cat_id` int(11) DEFAULT NULL COMMENT '分类信息id',
  `post_title` varchar(45) DEFAULT NULL COMMENT '标题',
  `post_content` text COMMENT '内容',
  `post_views` int(11) NOT NULL DEFAULT '0' COMMENT '观看数\n',
  `post_recommend` int(11) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `post_create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `post_update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`post_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `cat_id_idx` (`cat_id`),
  CONSTRAINT `fk_post_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='博客表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,2,1,'今天天气真冷','好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷好冷',0,0,'2017-12-20 02:21:23',NULL),(2,2,5,'好冷不想出门','想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉想吃肉',0,0,'2017-12-20 02:22:30',NULL),(3,2,1,'最近又胖了','越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖',0,0,'2017-12-20 02:25:59',NULL),(4,1,1,'我是管理员','我是管理员我是管理员我是管理员我是管理员我是管理员我是管理员我是管理员',0,0,'2017-12-20 03:10:15',NULL),(5,3,1,'tetetetetet','sdtsadtasdtetertfdgdfgdfgdfg',0,0,'2017-12-25 12:33:57',NULL),(6,3,1,'aaaaaaaaaa','aaaaaaaaaaaaaaaaaaaaaaaaa',0,0,'2017-12-25 12:33:57',NULL),(7,1,1,'管理员','啊！',0,0,'2017-12-25 12:33:57',NULL),(8,3,1,'later','laterlaterlaterlater',0,0,'2017-12-25 12:39:06',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(45) NOT NULL COMMENT '用户名',
  `password_hash` varchar(255) NOT NULL COMMENT '用户密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '密码token',
  `email` varchar(45) NOT NULL COMMENT '用户邮箱',
  `auth_key` varchar(45) NOT NULL COMMENT '自动登陆',
  `status` varchar(45) NOT NULL COMMENT '状态',
  `created_at` varchar(45) NOT NULL COMMENT '创建时间',
  `updated_at` varchar(45) NOT NULL COMMENT '更新时间',
  `authority` int(11) NOT NULL DEFAULT '10' COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户账号信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$2y$13$Nj9S9F1MgYs0Vd.j/ck13eCzuqoHWnu1wWdnbXKEJfDenddY2Uv3K',NULL,'admin@admin.com','zS4tvYndBKIJabpY5wfzy1as6u8iZq8P','10','1512986622','1512986622',9999),(2,'Draco','$2y$13$g1Fy94qPutsY02Fwa8oMbuZUpVbZGqIfAgzS2VWyT675WIGjtFdA6',NULL,'draco@dracoooo.cn','3KcRplvjk7EKKT7gJTk7urEUdjkNt-rZ','10','1512988195','1512988195',10),(3,'hhh','$2y$13$GlYcJ87QJusf2nWtKUaTHexZosjzzYvEMpqbrXf/3eDJmW59qjem.',NULL,'84121235@111.com','cbNjjk7hAQKsearerUe_3aifuJxwqNXX','10','1514205097','1514205097',10);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_info` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `user_nickname` varchar(45) NOT NULL COMMENT '用户昵称',
  `user_sex` varchar(16) DEFAULT NULL COMMENT '性别',
  `user_birthday` varchar(45) DEFAULT NULL COMMENT '生日',
  `user_description` varchar(255) DEFAULT NULL COMMENT '个人描述',
  `user_head_img` varchar(45) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_info_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户个人信息表\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_info`
--

LOCK TABLES `users_info` WRITE;
/*!40000 ALTER TABLE `users_info` DISABLE KEYS */;
INSERT INTO `users_info` VALUES (2,'Dracoooo','Man','05.18','我是要成为海贼王的男人！',NULL);
/*!40000 ALTER TABLE `users_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-25 20:52:19
