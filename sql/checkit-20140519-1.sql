CREATE DATABASE  IF NOT EXISTS `checkit` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `checkit`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: checkit
-- ------------------------------------------------------
-- Server version	5.5.34

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
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option`
--

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;
INSERT INTO `option` VALUES (1,'project_name','Estrategia'),(2,'projects_name','Estrategias'),(3,'subproject_name','Objetivo Estratégico'),(4,'subprojects_name','Objetivos Estratégicos'),(5,'task_name','Hito'),(6,'tasks_name','Hitos');
/*!40000 ALTER TABLE `option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'Gerente General',NULL),(2,'Gerente Finanzas',1),(3,'Gerente Marketing',1);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`),
  CONSTRAINT `project_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Entorno - Cluster',2),(2,'Expansión territorial',2);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin'),(2,'dashboard'),(3,'process'),(4,'strategy');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subproject`
--

DROP TABLE IF EXISTS `subproject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subproject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproject`
--

LOCK TABLES `subproject` WRITE;
/*!40000 ALTER TABLE `subproject` DISABLE KEYS */;
INSERT INTO `subproject` VALUES (1,'Dependencia del Proyecto Cluster: manejo de los Contratos y Principales causas',1),(2,'Crear dependencia de Codelco hacia la empresa a través de buenos resultados en las pruebas preliminares',1),(3,'Visibilidad: mantener al usuario enterado de lo que se está haciendo, mostrando resultado y entregando información relevante',1),(4,'Crear una sucursal en Arica',2);
/*!40000 ALTER TABLE `subproject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Hito 1',2,'2014-05-08','2014-06-20',0,NULL),(2,'Hito 1',1,'2014-05-14','2014-07-30',1,'2014-05-17'),(3,'Hito 1',3,'2014-03-04','2014-05-13',0,NULL),(4,'Hito 2',2,'2014-05-16','2014-05-31',0,NULL),(5,'Ver Factibilidad tecnica',4,'2014-05-17','2014-05-30',0,NULL),(6,'Hito 3',1,'2014-05-17','2014-05-01',0,NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `lastvisit` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `position_id` (`position_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'christian.oviedo@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','Christian','Oviedo',1,2,'2014-05-08 13:34:24','2014-05-19 15:18:34',NULL,NULL),(6,'fjmoran@gmail.com','21232f297a57a5a743894a0e4a801fc3','Francisco José','Morán',1,2,'2014-05-08 13:34:24','2014-05-19 11:08:36',NULL,NULL),(9,'juanito@check-it.cl','0cc175b9c0f1b6a831c399e269772661','Juan','Gomez',1,1,'2014-05-12 10:12:35',NULL,NULL,NULL),(10,'pedrito@check-it.cl','92eb5ffee6ae2fec3ad71c777531578f','Pedro','Fernandez',1,3,'2014-05-12 10:12:45',NULL,NULL,NULL),(11,'c@c.cl','4a8a08f09d37b73795649038408b5f33','c','c',1,2,'2014-05-12 10:13:11','2014-05-16 19:26:13',NULL,NULL),(12,'e@e.cl','e1671797c52e15f763380b45e841ec32','e','e',0,NULL,'2014-05-12 10:14:44',NULL,NULL,NULL),(13,'d@d.cl','8277e0910d750195b448797616e091ad','d','d',0,NULL,'2014-05-12 10:14:53',NULL,NULL,NULL),(14,'f@f.cl','8fa14cdd754f91cc6554c9e71929cce7','f','f',0,NULL,'2014-05-12 10:15:21',NULL,NULL,NULL),(15,'g@g.cl','b2f5ff47436671b6e533d8dc3614845d','g','g',0,NULL,'2014-05-12 10:18:46',NULL,NULL,NULL),(16,'h@h.cl','2510c39011c5be704182423e3a695e91','h','h',0,NULL,'2014-05-12 10:18:54',NULL,NULL,NULL),(17,'i@i.cl','865c0c0b4ab0e063e5caa3387c1a8741','i','i',0,NULL,'2014-05-12 10:19:03',NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (5,1),(5,4),(6,1),(6,4),(9,1),(9,2),(9,3),(9,4),(10,1),(10,2),(10,3),(10,4),(11,4);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-19 16:07:59
