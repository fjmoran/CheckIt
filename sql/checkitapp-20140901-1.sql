-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: app_mstudio
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

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
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,4,2,19,2,'Gerencia General'),(2,4,3,6,3,'Gerencia Finanzas'),(3,4,7,10,3,'Gerencia Marketing'),(4,NULL,1,21,1,'Dirección'),(7,4,4,5,4,'Contabilidad'),(8,4,11,14,3,'Gerencia Operaciones'),(9,4,15,18,3,'Gerencia RR.HH.'),(10,4,16,17,4,'Remuneraciones'),(11,4,8,9,4,'Marketing Digital'),(12,4,12,13,4,'Producción');
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
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `calculation` varchar(1000) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `base_date` date NOT NULL,
  `goal_date` date NOT NULL,
  `base_value` float NOT NULL,
  `goal_value` float NOT NULL,
  `unit` varchar(100) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_frequency` int(11) NOT NULL,
  `review_frequency` int(11) NOT NULL,
  `weight` float NOT NULL,
  `measuring` int(11) NOT NULL,
  `function` int(11) NOT NULL,
  `next_due_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `kpi_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  CONSTRAINT `kpi_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `kpi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi`
--

LOCK TABLES `kpi` WRITE;
/*!40000 ALTER TABLE `kpi` DISABLE KEYS */;
INSERT INTO `kpi` VALUES (10,10,1,2,1,'Cantidad de horas invertidas en innovación por mes','Suma de la cantidad de horas invertidas del personal según reporte de horas',4,'2014-06-02','2015-06-02',0,2500,'personas',8,NULL,5,5,100,0,0,'2015-12-31'),(11,11,1,2,1,'Errores por millon','# de errores / # total de productos',12,'2014-06-02','2015-06-02',24,12,'unidades por millon',8,NULL,2,5,100,1,0,'2014-10-31'),(12,12,1,2,1,'Porcentaje de entrega a tiempo','Porcentaje de entrega a tiempo',5,'2014-06-02','2015-06-02',92,98,'%',8,NULL,4,5,100,0,0,'2014-12-31'),(14,14,1,2,1,'Crecimiento en ventas','Crecimiento en ventas',3,'2014-06-02','2015-06-02',10,25,'% anual',8,NULL,0,0,100,0,2,'2014-06-04'),(15,15,1,2,1,'Cantidad de accidentes','Cantidad de accidentes/Tiempo',12,'2014-06-02','2015-06-02',20,8,'accidentes por año',8,NULL,2,5,100,1,0,'2014-08-31'),(16,16,1,2,1,'Capacitaciones en suite ofimatica','(# de capacitados / # de personas a capacitar) * 100',7,'2014-06-02','2015-06-01',0,50,'%',NULL,24,2,5,100,0,2,'2014-08-31'),(21,21,1,2,1,'I + D','c',5,'2014-08-09','2015-01-15',50,100,'c',8,NULL,2,5,100,0,0,'2014-09-30'),(22,22,1,2,1,'Porcentaje de ejecutivos capacitados en manejo de grupos','(# de ejecutivos capacitados / # de ejecutivos a capacitar) * 100',8,'2014-08-01','2015-09-01',0,75,'%',8,NULL,2,5,100,0,2,'2014-09-30'),(23,23,1,2,1,'% de presupuesto anual ejecutado','(presupuesto ejecutado / presupuesto total) * 100',10,'2014-01-01','2014-12-26',0,100,'%',8,NULL,2,5,100,0,2,'2014-08-31'),(24,24,1,2,1,'% de facturas cobradas en menos de 60 días','(# facturas cobradas en menos de 60 días / # total de facturas) * 100',11,'2014-08-01','2014-12-26',0,80,'%',8,NULL,2,5,100,0,0,'2014-09-30'),(25,25,1,2,1,'Clientes que comprar más de una vez','(#de clientes que compran mas de 1 vez / # de clientes totales)*100',9,'2014-08-01','2014-12-31',10,30,'%',8,NULL,2,5,100,0,0,'2014-09-30');
/*!40000 ALTER TABLE `kpi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_data`
--

DROP TABLE IF EXISTS `kpi_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kpi_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `value` float DEFAULT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kpi_id_2` (`kpi_id`,`period_end`),
  KEY `kpi_id` (`kpi_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `kpi_data_ibfk_1` FOREIGN KEY (`kpi_id`) REFERENCES `kpi` (`id`),
  CONSTRAINT `kpi_data_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_data`
--

LOCK TABLES `kpi_data` WRITE;
/*!40000 ALTER TABLE `kpi_data` DISABLE KEYS */;
INSERT INTO `kpi_data` VALUES (17,12,6,'2014-08-09 11:37:35','2014-01-01','2014-06-30',98,''),(18,15,6,'2014-08-09 11:37:59','2014-06-01','2014-06-30',8,''),(19,11,6,'2014-08-09 11:47:33','2014-09-01','2014-09-30',12,''),(20,15,6,'2014-08-09 12:34:04','2014-07-01','2014-07-31',7,''),(21,14,6,'2014-08-09 13:44:02','2014-06-03','2014-06-03',24,''),(22,10,6,'2014-08-09 13:45:10','2014-01-01','2014-12-31',2000,''),(23,21,6,'2014-08-09 13:45:51','2014-08-01','2014-08-31',87,''),(24,16,6,'2014-08-09 13:49:40','2014-06-03','2014-06-03',30,''),(25,22,6,'2014-08-11 10:39:10','2014-08-01','2014-08-31',30,''),(26,16,6,'2014-08-11 10:39:50','2014-06-01','2014-06-30',35,''),(27,16,6,'2014-08-11 10:40:08','2014-07-01','2014-07-31',38,''),(28,23,6,'2014-08-11 10:55:41','2014-01-01','2014-01-31',10,''),(29,23,6,'2014-08-11 10:55:47','2014-02-01','2014-02-28',15,''),(30,23,6,'2014-08-11 10:55:52','2014-03-01','2014-03-31',25,''),(31,23,6,'2014-08-11 10:55:58','2014-04-01','2014-04-30',28,''),(32,23,6,'2014-08-11 10:56:05','2014-05-01','2014-05-31',30,''),(33,23,6,'2014-08-11 10:56:14','2014-06-01','2014-06-30',45,''),(34,23,6,'2014-08-11 10:56:20','2014-07-01','2014-07-31',48,''),(35,24,6,'2014-08-11 11:00:40','2014-08-01','2014-08-31',65,''),(36,25,6,'2014-08-11 11:22:34','2014-08-01','2014-08-31',17,'');
/*!40000 ALTER TABLE `kpi_data` ENABLE KEYS */;
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
  `value` varchar(1000) NOT NULL,
  `filter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option`
--

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;
INSERT INTO `option` VALUES (1,'project_name','Perspectiva',0),(2,'projects_name','Perspectivas',0),(3,'subproject_name','Objetivo Estratégico',0),(4,'subprojects_name','Objetivos Estratégicos',0),(5,'task_name','Hito',0),(6,'tasks_name','Hitos',0),(7,'department_name','Área',0),(8,'departments_name','Áreas',0),(9,'manager_name','Encargado',0),(10,'managers_name','Encargados',0),(11,'kpi_yellow','95',0),(12,'kpi_red','65',0),(13,'table_rows','10',0),(14,'mision','[Ejemplo]<br>\r\nNuestra Misión como empresa de servicios es promover una actividad empresarial en el sector Internet que aporte valor para nuestros accionistas, clientes y colaboradores, en base a competencias profesionales diferenciales y congruentes con nuestros valores y código ético',1),(15,'vision','[Ejemplo]<br>\r\n- Deseamos ser valorados por los clientes como una organización próxima, transparente y merecedora de confianza. <br>\r\n- Queremos ser líderes en los mercados propios y tener capacidad de innovación para crecer mediante alianzas rentables para nuestros clientes. <br>\r\n- Nos proponemos ser una organización eficiente que fomenta la creatividad mediante el reconocimiento del trabajo bien hecho y el espíritu de equipo.',1),(16,'company_name','Empresa Demo',0);
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
INSERT INTO `process_task` VALUES (64,'Actualizar CRM',1,740,540,2),(65,'Formulario Solicitud',1,140,80,1),(70,'Enviar Cotización',1,380,340,0),(76,'Calificación de Prospecto',1,600,160,3),(89,'Crear minuta',2,60,80,1),(91,'Enviar al cliente',2,60,280,2);
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
  `friendly_name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pos` int(11) NOT NULL,
  `start_page` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin','Administrador de sistema','Tiene acceso a todas las funcionalidades del sistema incluidas las de front y backend',13,'user/admin',0),(2,'strategy_admin','Administrador de gestión estratégica','Tiene acceso al backend para configurar perspectivas, objetivos estratégicos, hitos y KPI.',8,'project/admin',1),(3,'workflow_admin','Administrador de flujos de proceso','Tiene acceso al backend para configurar flujos de proceso y administrar grupos.',9,'process/admin',1),(4,'dashboard_admin','Administrador de cuadros de mando','Tiene acceso al backend para definir los grupos que pueden visualizar cada reporte o cuadro de mando, y configurar los reportes de sistema.',10,'',1),(5,'strategy_manager','Encargado gestión estratégica','Tiene acceso al frontend de gestión estratégica, puede ver todas las perspectivas, Objetivos estratégicos, Hitos, Sub hitos, KPI y sub KPI y editar su contenido para todo su nivel jerárquico.',5,'project/myprojects',1),(6,'strategy_user','Usuario gestión estratégica','Tiene acceso al frontend de gestión estratégica, puede ver las Perspectivas y Objetivos donde posea Hitos, Sub hitos, KPI y sub KPI y puede modificarlos (solo puede modificar los que tiene asignados).',1,'project/myprojects',0),(7,'workflow_manager','Encargado flujos de proceso','Tiene acceso al frontend de flujos de proceso puede ver y reasignar todas las instancias de los flujos en ejecución, puede iniciar los flujos a los cuales pertenece y puede gestionar su inbox.',6,'',1),(8,'workflow_user','Usuario flujos de proceso','Tiene acceso al frontend de flujos de proceso, puede iniciar los flujos a los cuales pertenece y puede gestionar su inbox.',2,'',0),(9,'dashboard_manager','Encargado cuadros de mando','Tiene acceso al frontend de cuadros de mando puede visualizar todos los cuadros definidos con toda su información independiente de su nivel jerárquico.',7,'site/report',1),(10,'dashboard_user','Usuario cuadros de mando','Tiene acceso al frontend de cuadros de mando y puede visualizar los cuadros que le han sido asignados, la información a visualizar depende de su nivel jerárquico.',3,'site/report',0),(11,'viewer','Visualizador global','Tiene acceso al frontend de gestión estratégica, flujos de trabajo y cuadros de mando puede visualizar toda la información pero no puede modificarla. Puede gestionar su inbox e iniciar los flujos a los cuales pertenece',11,'site/report',1),(12,'system_admin','Administrador de usuarios','Puede administrar usuarios, departamentos y grupos.',12,'user/admin',1);
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
  `weight` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproject`
--

LOCK TABLES `subproject` WRITE;
/*!40000 ALTER TABLE `subproject` DISABLE KEYS */;
INSERT INTO `subproject` VALUES (3,'Crecer en el mercado internacional',1,2,100),(4,'Ofrecer productos innovadores y de calidad',2,3,100),(5,'Implementar procesos de innovación de productos',3,8,100),(7,'Incrementar la capacitación del personal',4,9,100),(8,'Desarrollar habilidades blandas a ejecutivos',4,9,100),(9,'Foco en retención de clientes',2,3,100),(10,'Ejecución de presupuesto',1,2,100),(11,'Aumentar flujo de caja',1,2,100),(12,'Procesos de fabricación',3,8,100);
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
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `task_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (5,5,1,2,1,'Ver factibilidad técnica',4,'2014-05-17','2014-06-04',0,NULL,NULL,24,NULL),(7,7,1,2,1,'Estudio de mercado',5,'2014-06-02','2014-08-28',0,NULL,12,NULL,NULL),(8,8,1,2,1,'Curso de capacitación ISO-9001',7,'2014-06-02','2014-07-31',0,NULL,NULL,6,NULL);
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
  `status` int(11) NOT NULL DEFAULT '1',
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
INSERT INTO `user` VALUES (5,'christian.oviedo@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','Christian','Oviedo',1,'Gerente de Finanzas','2014-05-08 13:34:24','2014-08-29 19:18:47',NULL,NULL,2,1),(6,'admin@getcheck.it','81dc9bdb52d04dc20036dbd8313ed055','Administrador','Global',1,'Gerente de Operaciones','2014-05-08 13:34:24','2014-08-29 19:20:18',NULL,NULL,8,1),(9,'director1@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','José','Andrade',1,'Presidente del directorio','2014-05-12 10:12:35','2014-06-17 03:28:29',NULL,NULL,4,1),(10,'director2@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Gastón','Jimenez',1,'Director','2014-05-12 10:12:45',NULL,NULL,NULL,4,0),(18,'gerente@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Roberto','Gomez',1,'Gerente General','2014-05-30 15:43:02','2014-06-17 03:28:08',NULL,NULL,1,1),(20,'marketing@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Alejandro','Pizarro',1,'Gerente de Marketing','2014-05-30 15:43:56','2014-06-02 19:13:29',NULL,NULL,3,1),(22,'rrhh@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Felipe','Díaz',1,'Gerente de RRHH','2014-06-02 21:00:08',NULL,NULL,NULL,9,1),(23,'asesormarketing@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Pablo','Sanhueza',1,'Asesor de marketing','2014-06-02 21:01:47',NULL,NULL,NULL,3,0),(24,'asesoroperaciones@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Nelson','Figueroa',1,'Asesor operaciones','2014-06-02 21:08:51',NULL,NULL,NULL,8,0),(25,'asesorrrhh@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Carlos','Olivos',1,'Asesor RR.HH.','2014-06-02 21:09:52',NULL,NULL,NULL,9,0),(26,'asesorfinanzas@check-it.cl','81dc9bdb52d04dc20036dbd8313ed055','Andrea','Ramírez',1,'Asesor finanzas','2014-06-02 21:10:53',NULL,NULL,NULL,2,0);
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
  KEY `group_id` (`group_id`)
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
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (5,1),(5,2),(5,6),(5,10),(6,1),(9,2),(9,4),(10,2),(18,2),(18,4),(20,2),(20,4),(22,2),(22,4),(23,2),(23,4),(24,2),(24,4),(25,2),(25,4),(26,2),(26,4);
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

-- Dump completed on 2014-09-01 15:46:07
