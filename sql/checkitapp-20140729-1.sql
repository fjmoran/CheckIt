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
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `department_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Gerencia General',4),(2,'Gerencia Finanzas',1),(3,'Gerencia Marketing',1),(4,'Dirección',NULL),(7,'Contabilidad',2),(8,'Gerencia Operaciones',1),(9,'Gerencia RR.HH.',1),(10,'Remuneraciones',9),(11,'Marketing Digital',3),(12,'Producción',8);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `process_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_id` (`process_id`),
  CONSTRAINT `form_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
INSERT INTO `form` VALUES (2,'Datos de contacto',1),(3,'Aplica',1),(4,'Adjunta cotización',1),(5,'Actualizar CRM',1),(6,'Minuta',2);
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_field`
--

DROP TABLE IF EXISTS `form_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `process_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`process_id`),
  KEY `process_id` (`process_id`),
  CONSTRAINT `form_field_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_field`
--

LOCK TABLES `form_field` WRITE;
/*!40000 ALTER TABLE `form_field` DISABLE KEYS */;
INSERT INTO `form_field` VALUES (1,'Empresa',2,'empresa',0),(2,'Nombre Contacto',2,'contacto',0),(4,'Descripción',1,'descripcion',1),(5,'Fecha entrega',1,'fecha_entrega',2),(6,'Aplica',1,'aplica',3),(7,'Adjuntar cotización',1,'adjuntar_cotizacion',5),(8,'Actualizar CRM',1,'actualizar_crm',3),(9,'Empresa',1,'empresa',0),(10,'Nombre Contacto',1,'nombre_contacto',0),(11,'Minuta',2,'minuta',1),(12,'campo nuevo',1,'campo_nuevo',0);
/*!40000 ALTER TABLE `form_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_field_option`
--

DROP TABLE IF EXISTS `form_field_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_field_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_field_id` (`form_field_id`),
  CONSTRAINT `form_field_option_ibfk_1` FOREIGN KEY (`form_field_id`) REFERENCES `form_field` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_field_option`
--

LOCK TABLES `form_field_option` WRITE;
/*!40000 ALTER TABLE `form_field_option` DISABLE KEYS */;
INSERT INTO `form_field_option` VALUES (1,'Si',6,1),(2,'No',6,2),(4,'Si',8,1),(5,'No',8,2);
/*!40000 ALTER TABLE `form_field_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_property`
--

DROP TABLE IF EXISTS `form_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`form_id`,`form_field_id`),
  KEY `form_id` (`form_id`),
  KEY `form_field_id` (`form_field_id`),
  CONSTRAINT `form_property_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`),
  CONSTRAINT `form_property_ibfk_2` FOREIGN KEY (`form_field_id`) REFERENCES `form_field` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_property`
--

LOCK TABLES `form_property` WRITE;
/*!40000 ALTER TABLE `form_property` DISABLE KEYS */;
INSERT INTO `form_property` VALUES (5,2,4,0,0,3),(6,2,5,0,0,4),(7,3,6,0,1,1),(8,4,7,0,1,1),(9,5,8,0,1,1),(10,2,9,0,0,1),(11,2,10,0,0,2),(12,6,1,0,1,1),(13,6,2,0,0,2),(14,6,11,0,0,3);
/*!40000 ALTER TABLE `form_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'Grupo 1'),(3,'Grupo 2');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

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
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `kpi_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `kpi_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option`
--

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;
INSERT INTO `option` VALUES (1,'project_name','Perspectiva'),(2,'projects_name','Perspectivas'),(3,'subproject_name','Objetivo Estratégico'),(4,'subprojects_name','Objetivos Estratégicos'),(5,'task_name','Hito'),(6,'tasks_name','Hitos'),(7,'department_name','Área'),(8,'departments_name','Áreas');
/*!40000 ALTER TABLE `option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process`
--

DROP TABLE IF EXISTS `process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process`
--

LOCK TABLES `process` WRITE;
/*!40000 ALTER TABLE `process` DISABLE KEYS */;
INSERT INTO `process` VALUES (1,'Cotización Check!It'),(2,'Proceso número 2');
/*!40000 ALTER TABLE `process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_connector`
--

DROP TABLE IF EXISTS `process_connector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_connector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_task_id` int(11) NOT NULL,
  `target_task_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_task_id_2` (`source_task_id`,`target_task_id`),
  KEY `target_task_id` (`target_task_id`),
  KEY `source_task_id` (`source_task_id`),
  KEY `process_id` (`process_id`),
  CONSTRAINT `process_connector_ibfk_1` FOREIGN KEY (`source_task_id`) REFERENCES `process_task` (`id`),
  CONSTRAINT `process_connector_ibfk_2` FOREIGN KEY (`target_task_id`) REFERENCES `process_task` (`id`),
  CONSTRAINT `process_connector_ibfk_3` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_connector`
--

LOCK TABLES `process_connector` WRITE;
/*!40000 ALTER TABLE `process_connector` DISABLE KEYS */;
INSERT INTO `process_connector` VALUES (46,76,70,1,0),(67,70,64,1,1),(81,65,76,1,2),(83,76,64,1,2),(85,89,91,2,1);
/*!40000 ALTER TABLE `process_connector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_step`
--

DROP TABLE IF EXISTS `process_step`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_task_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_task_id` (`process_task_id`),
  KEY `form_id` (`form_id`),
  CONSTRAINT `process_step_ibfk_1` FOREIGN KEY (`process_task_id`) REFERENCES `process_task` (`id`),
  CONSTRAINT `process_step_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_step`
--

LOCK TABLES `process_step` WRITE;
/*!40000 ALTER TABLE `process_step` DISABLE KEYS */;
INSERT INTO `process_step` VALUES (30,89,6,1),(31,70,2,1),(32,65,2,1);
/*!40000 ALTER TABLE `process_step` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_task`
--

DROP TABLE IF EXISTS `process_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `process_id` int(11) NOT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_id` (`process_id`),
  CONSTRAINT `process_task_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_task`
--

LOCK TABLES `process_task` WRITE;
/*!40000 ALTER TABLE `process_task` DISABLE KEYS */;
INSERT INTO `process_task` VALUES (64,'Actualizar CRM',1,540,420,2),(65,'Formulario Solicitud',1,220,60,1),(70,'Enviar Cotización',1,220,260,0),(76,'Calificación de Prospecto',1,400,160,3),(89,'Crear minuta',2,60,80,1),(91,'Enviar al cliente',2,60,280,2);
/*!40000 ALTER TABLE `process_task` ENABLE KEYS */;
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
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `project_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
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
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
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
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`)
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
  `position` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `lastvisit` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_created` datetime DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `manager` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'christian.oviedo@gmail.com','ec6a6536ca304edf844d1d248a4f08dc','Christian','Oviedo',1,'2','2014-05-08 13:34:24','2014-07-29 09:57:20',NULL,NULL,2,1),(6,'fjmoran@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','Francisco José','Morán',1,'Gerente de Operaciones','2014-05-08 13:34:24','2014-06-27 14:15:46',NULL,NULL,8,1),(9,'director1@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','José','Andrade',1,'Presidente del directorio','2014-05-12 10:12:35','2014-06-17 03:28:29',NULL,NULL,4,1),(10,'director2@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Gastón','Jimenez',1,'Director','2014-05-12 10:12:45',NULL,NULL,NULL,4,0),(18,'gerente@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Roberto','Gomez',1,'Gerente General','2014-05-30 15:43:02','2014-06-17 03:28:08',NULL,NULL,1,1),(20,'marketing@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Alejandro','Pizarro',1,'Gerente de Marketing','2014-05-30 15:43:56','2014-06-02 19:13:29',NULL,NULL,3,1),(22,'rrhh@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Felipe','Díaz',1,'Gerente de RRHH','2014-06-02 21:00:08',NULL,NULL,NULL,9,1),(23,'asesormarketing@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Pablo','Sanhueza',1,'Asesor de marketing','2014-06-02 21:01:47',NULL,NULL,NULL,3,0),(24,'asesoroperaciones@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Nelson','Figueroa',1,'Asesor operaciones','2014-06-02 21:08:51',NULL,NULL,NULL,8,0),(25,'asesorrrhh@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Carlos','Olivos',1,'Asesor RR.HH.','2014-06-02 21:09:52',NULL,NULL,NULL,9,0),(26,'asesorfinanzas@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Andrea','Ramírez',1,'Asesor finanzas','2014-06-02 21:10:53',NULL,NULL,NULL,2,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`),
  KEY `user_id_2` (`user_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (3,5,1),(2,6,1),(4,20,1);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
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
INSERT INTO `user_role` VALUES (5,1),(5,2),(5,3),(5,4),(6,1),(6,4),(9,2),(9,4),(10,2),(18,2),(18,4),(20,2),(20,4),(22,2),(22,4),(23,2),(23,4),(24,2),(24,4),(25,2),(25,4),(26,2),(26,4);
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

-- Dump completed on 2014-07-29 10:38:42
