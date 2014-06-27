-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: checkitapp
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.12.04.1

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
-- Table structure for table `kpi`
--

DROP TABLE IF EXISTS `kpi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `base_date` date NOT NULL,
  `goal_date` date NOT NULL,
  `base_value` float NOT NULL,
  `goal_value` float NOT NULL,
  `unit` varchar(100) NOT NULL,
  `real_value` float NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `limit_red` float NOT NULL,
  `limit_yellow` float NOT NULL,
  `limit_green` float NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `position_id` (`position_id`),
  CONSTRAINT `kpi_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  CONSTRAINT `kpi_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi`
--

LOCK TABLES `kpi` WRITE;
/*!40000 ALTER TABLE `kpi` DISABLE KEYS */;
INSERT INTO `kpi` VALUES (9,'Porcentaje de Satisfacción del cliente','Porcentaje de Satisfacción del cliente',4,'1 año','2014-06-02','2015-04-15',60,80,'%',60,NULL,60,70,80,3),(10,'Tasa de referidos','Tasa de referidos',4,'1 vez al año','2014-06-02','2015-06-02',1300,2500,'personas',1300,NULL,1300,2000,2500,3),(11,'Errores por millon','Errores por millon',5,'cada 6 meses','2014-06-02','2015-06-02',12,4,'unidades por millon',12,NULL,12,8,4,8),(12,'Porcentaje de entrega a tiempo','Porcentaje de entrega a tiempo',5,'1 vez al año','2014-06-02','2015-06-02',92,98,'%',92,NULL,92,95,98,8),(13,'Rentabilidad por cliente','Rentabilidad por cliente',1,'cada 6 meses','2014-06-02','2015-06-02',1500,2500,'USD',3500,'2014-06-03 19:42:45',1500,2000,2500,2),(14,'Crecimiento en ventas','Crecimiento en ventas',3,'1 vez al año','2014-06-02','2015-06-02',10,25,'% anual',20,'2014-06-03 07:33:13',10,18,25,2),(15,'Cantidad de accidentes','Cantidad de accidentes',7,'cada 3 meses','2014-06-02','2015-06-02',8,2,'accidentes por año',8,NULL,8,4,2,9),(16,'Obsolescencia de equipos informáticos ','Obsolescencia de equipos informáticos ',7,'1 vez por año','2014-06-02','2015-06-02',25,5,'%',6,'2014-06-03 15:05:24',25,10,5,9);
/*!40000 ALTER TABLE `kpi` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `option` VALUES (1,'project_name','Perspectiva'),(2,'projects_name','Perspectivas'),(3,'subproject_name','Objetivo Estratégico'),(4,'subprojects_name','Objetivos Estratégicos'),(5,'task_name','Hito'),(6,'tasks_name','Hitos');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'Gerente General',4),(2,'Gerente Finanzas',1),(3,'Gerente Marketing',1),(4,'Director',NULL),(7,'Asesor Finanzas',2),(8,'Gerente de Operaciones',1),(9,'Gerente RR.HH.',1),(10,'Asesor RR.HH.',9),(11,'Asesor de Marketing',3),(12,'Asesor de Operaciones',8);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Financiera',4),(2,'Clientes',4),(3,'Procesos Internos',4),(4,'Aprendizaje y Desarrollo',4);
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
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `position_id` (`position_id`),
  CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproject`
--

LOCK TABLES `subproject` WRITE;
/*!40000 ALTER TABLE `subproject` DISABLE KEYS */;
INSERT INTO `subproject` VALUES (1,'Maximizar la rentabilidad',1,2),(2,'Crecer a través de nuevos productos',1,2),(3,'Crecer en el mercado internacional',1,2),(4,'Ofrecer productos innovadores con alto valor nutritivo',2,3),(5,'Implementar procesos de innovación de productos',3,8),(6,'Contar con información sobre inteligencia de mercado',3,8),(7,'Incrementar la capacitación del personal',4,9);
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
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `position_id` (`position_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Análisis de necesidades de clientes',2,'2014-05-08','2014-06-20',0,NULL,7),(2,'Definición de lugar planta distribución',3,'2014-05-14','2014-07-30',1,'2014-05-17',7),(3,'Análisis mercado peruano',3,'2014-03-04','2014-05-13',0,NULL,7),(4,'Determinación de mercado objetivo',2,'2014-05-16','2014-08-19',0,NULL,7),(5,'Ver factibilidad técnica',4,'2014-05-17','2014-06-04',0,NULL,11),(6,'Comienzo de operación mercado peruano',3,'2014-05-17','2014-10-27',0,NULL,7),(7,'Estudio de mercado',6,'2014-06-02','2014-08-28',0,NULL,12),(8,'Curso de capacitación ISO-9001',7,'2014-06-02','2014-07-31',0,NULL,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'christian.oviedo@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','Christian','Oviedo',1,2,'2014-05-08 13:34:24','2014-06-26 21:40:53',NULL,NULL),(6,'fjmoran@gmail.com','21232f297a57a5a743894a0e4a801fc3','Francisco José','Morán',1,2,'2014-05-08 13:34:24','2014-06-03 14:36:16',NULL,NULL),(9,'director1@check-it.cl','21a70a20a394dc2a038843a51a64322b','Director 1','Empresa',1,4,'2014-05-12 10:12:35','2014-06-17 03:28:29',NULL,NULL),(10,'director2@check-it.cl','c9c25d0280cad37aa512f2394f5baa34','Director 2','Empresa',1,4,'2014-05-12 10:12:45',NULL,NULL,NULL),(18,'gerente@check-it.cl','740d9c49b11f3ada7b9112614a54be41','Gerente','General',1,1,'2014-05-30 15:43:02','2014-06-17 03:28:08',NULL,NULL),(19,'finanzas@check-it.cl','d63d1f46dc616ff29efc6576bc19bc3d','Gerente','Finanzas',1,2,'2014-05-30 15:43:31','2014-06-02 09:08:18',NULL,NULL),(20,'marketing@check-it.cl','c769c2bd15500dd906102d9be97fdceb','Gerente','Marketing',1,3,'2014-05-30 15:43:56','2014-06-02 19:13:29',NULL,NULL),(21,'operaciones@check-it.cl','527c128fd90c90859a5ca1617a2cd23d','Gerente','Operaciones',1,8,'2014-06-02 20:58:31',NULL,NULL,NULL),(22,'rrhh@check-it.cl','89f71c4e9055ee73c3bc372528a54b9c','Gerente','RRHH',1,9,'2014-06-02 21:00:08',NULL,NULL,NULL),(23,'asesormarketing@check-it.cl','6a20e01a1604491def7c3b3b9ae5454d','Asesor','Marketing',1,11,'2014-06-02 21:01:47',NULL,NULL,NULL),(24,'asesoroperaciones@check-it.cl','482ef9d2cf35e966dfcaa8f4eaa76786','Asesor','Operaciones',1,12,'2014-06-02 21:08:51',NULL,NULL,NULL),(25,'asesorrrhh@check-it.cl','c4ac719461d9cacd6e75507afdd9c621','Asesor','RRHH',1,10,'2014-06-02 21:09:52',NULL,NULL,NULL),(26,'asesorfinanzas@check-it.cl','4cd2440705e2ddbf9e9c044851c4f93c','Asesor','Finanzas',1,7,'2014-06-02 21:10:53',NULL,NULL,NULL);
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
INSERT INTO `user_role` VALUES (5,1),(5,2),(5,4),(6,1),(6,4),(9,2),(9,4),(10,2),(18,2),(18,4),(19,2),(19,4),(20,2),(20,4),(21,2),(21,4),(22,2),(22,4),(23,2),(23,4),(24,2),(24,4),(25,2),(25,4),(26,2),(26,4);
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

-- Dump completed on 2014-06-27 16:42:32
